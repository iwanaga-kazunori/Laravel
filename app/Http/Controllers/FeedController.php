<?php

namespace App\Http\Controllers;

use App\User;
use App\FeedComment;
use App\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\HTML;
use App\Feed;
use App\FavoriteTeams;
use App\Services\ApiTokenService;
use App\Http\Controllers\ApiTokenController;
use App\Http\Resources\FeedCollection;
use Illuminate\Pagination\Paginator;

class FeedController extends Controller
{
    private ApiTokenService $apiTokenService;
    public function __construct(ApiTokenService $apiTokenService)
    {
       $this->apiTokenService = $apiTokenService;
    }
    //
    public function feed(Request $request)
    {
        // RSSのURL
        $url = 'https://kicker.town/feed'; //https://fussball.jp/feed
        // 制御文字を取り除く
        $str = preg_replace('/[\x00-\x1f]/',' ',file_get_contents($url));
        //contentを取り出す
        $str = str_replace('<content:' ,'<content_',$str);  
        $str = str_replace('</content:' ,'</content_',$str);
        $rss = simplexml_load_string($str, NULL, LIBXML_NOCDATA);

        // 初期化
        $rss_contents = [];

        foreach($rss->channel->item as $item){
            $title = (string)$item->title;  //タイトル　＊＊＊
            $link = (string)$item->link;  //リンク　＊＊＊
            $pubDate = (string)$item->pubDate;  //元の日時Fri, 03 Jun 2022 22:44:14 +0000
            $date = date('Y/m/d', strtotime($pubDate));  //0000/00/00　＊＊＊
            $team = (string)$item->category[0];  //チーム名　＊＊＊
            $guid = (string)$item->guid;  //元ページのリダイレクトURL
            $news_id = substr($guid, 23);  //記事のURLから抽出した番号　＊＊＊
            //説明文
            $description = $item->description;  //元の説明文
            $description = str_replace('　','',$description);  //空白削除
            $description = str_replace('<p>','',$description);  //<p>削除
            $description = mb_substr($description, 0, 40);  //40文字だけ切り取り　＊＊＊
            $content = $item->content_encoded;  //本文全部　＊＊＊
            //画像URL抽出
            $target_text = $content;  //対象の文字列
            $delimiter_start = 'src="';  //区切り文字（開始）
            $delimiter_end = '" alt=""';  //区切り文字（終了）
            $start_position = strpos($target_text, $delimiter_start) + strlen($delimiter_start);  //開始位置
            $length = strpos($target_text, $delimiter_end) - $start_position;  //切り出す部分の長さ
            $img_path = mb_substr($target_text, $start_position, $length, "utf-8" );  //切り出し　＊＊＊
            $search = '/\.gif$|\.png$|\.jpg$|\.jpeg$|\.webp$|\.bmp$/i';
            if(preg_match($search, $img_path)){
                $img_path = $img_path;
                print('ok');
               }else{
                $img_path = 'storage/images/noimage.png';
                print('no');
               }
            
            //contennt不要部分削除
            $delimiter_end2 = '<p>The post';  //区切り文字（終了）
            if(strpos($content,$delimiter_end2) !== false){
                $start_position2 = 0;  //開始位置
                $length2 = strpos($target_text, $delimiter_end2) - $start_position2;  //切り出す部分の長さ
                $content = substr($target_text, $start_position2, $length2);  //切り出し　＊＊＊
            }

            $delimiter_end3 = '<blockquote';
            if(strpos($content,$delimiter_end3) !== false){
                  //区切り文字（終了）
                $start_position3 = 0;  //開始位置
                $length3 = strpos($content, $delimiter_end3) - $start_position3;  //切り出す部分の長さ
                $content = substr($content, $start_position3, $length3);  //切り出し　＊＊＊
            }

            // 登録用の配列を作る
            $rss_content = [
                'news_id' => $news_id,
                'title' => $title,
                'date' => $date,
                'link' => $link,
                'team' => $team,
                'description' => $description,
                'content' => $content,
                'img_path' => $img_path,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ];
            // dd($rss_content);
            $check = Feed::where('news_id', '=',  $news_id)->first();
                if ($check === null) {
                // DBに情報がなければ登録する
                Feed::insert($rss_content);
            }

            // 表示用にすべてを配列に入れる
            $rss_contents[] = $rss_content;
        }
        $rss_contents = Feed::orderByDesc('created_at')->paginate(10);
        // dd($rss_contents);
        return view('feed.index', ['rss_content' => $rss_contents]);
    }

    public function feedRead(Request $request)
    {
        $user = Auth::user();
        $fateams = $user->favoriteteams;
        // dd($fateams);
        $token = $this->apiTokenService->update($request);
        return view('feed.read', ['user' => $user, 'token' => $token, 'fateams' => $fateams]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiFeed(): \Illuminate\Http\JsonResponse
    {
        $feed = Feed::orderByDesc('created_at')->with(['comments.user','teammaster'])->paginate(12);
        
        $feed_comment = FeedComment::get();
        foreach ($feed as $detail){
            $detail->comments;
        }
        foreach ($feed as $detail){
            $detail->teammaster;
        }
        foreach ($feed_comment as $detail){
            $detail->user;
        }
        return response()->json($feed);
    }

    public function apiStore(Request $request)
    {
        $form = $request->all();
        unset($form['feed_id']);
        
        $form['created_at'] = Carbon::now();
        $form['updated_at'] = Carbon::now();
        $feedComment = new FeedComment;

        $feedComment->fill($form)->save();
        $feedComment->get();
        $id = $feedComment->id;
        $result = [
            'data' => $id,
        ];
        return response()->json($result);
    }

    /**
     * @param $feedId
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiGetComments($feedId): \Illuminate\Http\JsonResponse
    {
        $feed = FeedComment::where('feed_id', '=', $feedId)->orderByDesc('created_at')->get();
        return response()->json($feed);
    }
}
