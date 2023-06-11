<template>
    <div class="container feedlist">
        <div class="row justify-content-center">
            <h2>Nachricht</h2>
            <div class="d-flex justify-content-around flex-wrap">
                <div v-for="(feed, index) in feeds" class="col-md-3 col-6 feed" @click="ModalShow(index)">
                    <div class="bg">
                        <div class="thumbnail">
                            <div class="img"><img :src="feed.img_path"></div>
                            <div v-if="feed.teammaster" class="logo">
                                <img :src="'/'+feed.teammaster.path">
                            </div>
                        </div>
                        <p class="date">{{ feed.date }}</p>
                        <h3>{{ feed.title }}</h3>
                    </div>
                </div>
            </div>
            <modal 
                name="feed" 
                v-on:click="ModalShow"
                :draggable="true"
                height="80%"
                width="90%"
            >
                <div class="modal-header" v-if="this.$store.state.selectFeedId !== null">
                    <table>
                        <tr>
                            <td class="date">{{ feeds[this.$store.state.selectFeedId].date }}</td>
                            <td class="team">{{ feeds[this.$store.state.selectFeedId].team }}</td>
                            <td rowspan="2" class="logo"><img :src="'/'+feeds[this.$store.state.selectFeedId].teammaster.path"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="title"><h3>{{ feeds[this.$store.state.selectFeedId].title }}</h3></td>    
                        </tr>
                    </table>
                </div>
                <div class="modal-body">
                    <div class="" v-if="this.$store.state.selectFeedId !== null">
                        <div ref="news_id" class="news_id">{{ feeds[this.$store.state.selectFeedId].news_id }}</div>
                        <div v-html="feeds[this.$store.state.selectFeedId].content" class="feed_content"></div>
                        <h3>コメント一覧</h3>
                        <div v-if="feeds[this.$store.state.selectFeedId].comments.length" class="feed_comment">
                            <table>
                                <tr v-for="comment in feeds[this.$store.state.selectFeedId].comments">
                                    <td class="date">{{ comment.created_at | moment("YYYY/MM/DD") }}　</td>
                                    <td class="name"><img :src="'/storage/images/' + comment.user.profile_image" width="10px">{{ comment.user.name }}　</td>
                                    <td class="comment">{{ comment.comment }}</td>
                                </tr>
                            </table>
                            <hr>
                        </div>
                        <div v-else class="feed_comment_none">
                            <hr>
                            <p>コメントがありません。</p>
                        </div>
                        <p style="color:red;font-weight:bold;background-color: #800;">{{ error }}</p>
                        <div v-if="isSending == false" class="commnet_post">
                            <div>
                                <textarea v-model="commentForm"></textarea>  
                            </div>
                            <div class="button">
                                <button v-on:click="SendPostComment">投稿</button>
                            </div>
                        </div>
                        <div v-else class="issending">投稿中<br>しばらくお待ちください</div>
                    </div>
                </div>
                <button v-on:click="ModalHide" class="close_button">close</button>
            </modal>
            <div class="pagination_bg">
                <ul class="pagination">
                    <li class="inactive" 
                        :class="(this.$store.state.current_page == 1) ? 'disabled' : ''"
                        @click="changePage(currentPage-1)"
                    >&laquo;</li>
                    <li v-for="page in frontPageRange" :key="page" @click="changePage(page)" :class="(isCurrent(page)) ? 'active' : 'inactive'">{{ page }}</li>
                    <li v-show="this.$store.state.front_dot" class="inactive disabled">...</li>
                    <li v-for="page in middlePageRange" :key="page" @click="changePage(page)" :class="(isCurrent(page)) ? 'active' : 'inactive'">{{ page }}</li>
                    <li v-show="this.$store.state.end_dot" class="inactive disabled">...</li>
                    <li v-for="page in endPageRange" :key="page" @click="changePage(page)" :class="(isCurrent(page)) ? 'active' : 'inactive'">{{ page }}</li>
                    <li class="inactive"
                        :class="(this.$store.state.current_page >= this.$store.state.last_page) ? 'disabled' : ''"
                        @click="changePage(currentPage + 1)"
                    >&raquo;</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue'
import Vuex from 'vuex'
import VModal from 'vue-js-modal'
import vueMoment from 'vue-moment'
import Loading from './LoadingComponent'

Vue.use(Vuex)
Vue.use(VModal)
Vue.use(vueMoment)

export default {
    name: "FeedList",
    components: {
        Loading,
    },
    data: function() {
        return { 
            error: '',
        }   
    },
    watch: {
        feeds: function(newVal, oldVal) {
            // データが変化した時に行いたい処理
            // console.log("=====watch=====")
            // console.log(newVal, oldVal)
        },
        deep : true,
    },
    mounted () {
        this.$store.dispatch('getFeeds')
        this.$store.dispatch('getMatches')
    },
    methods: {
        // ページネーション時の新着情報取得
        getFeeds (store, page) {
            let token = document.head.querySelector('meta[name=api-token]')
            const url = '/api/feed?page=' + page + '&api_token=' + token.content         
            axios.get(url)
                .then(function (response) {
                    store.commit('setFeeds', response.data.data)
                    store.commit('setCurrentPage', response.data.current_page)
                    store.commit('setLastPage', response.data.last_page)
                })
                .catch(function (error) {
                    console.log(error)
                })
        },
        // モーダルオープン
        ModalShow (i) {
            this.error= ''
            this.$store.commit('selectFeedId', i)
            this.$modal.show('feed')
        },
        // モーダルクローズ
        ModalHide () {
            this.$modal.hide('feed')
        },
        // ページネーション
        calRange(start, end) {
            const range = [];
            for (let i = start; i <= end; i++) {
                range.push(i)
            }
            return range
        },
        changePage(page) {
            this.isLoadingOn()
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
            if (page > 0 && page <= this.$store.state.last_page) {
                this.$store.state.current_page = page
                this.getFeeds(this.$store, page)
            }
            setTimeout(() => {
                this.isLoadingOff();}
                ,4000
            )
        },
        isCurrent(page) {
            return page === this.$store.state.current_page
        },
        // コメント取得後新着情報更新
        UpdateState () {
            this.$store.commit('getFeeds')
        },
        // コメント投稿時のメソッド
        isSendingChange () {
            this.$store.commit('isSendingChange')
        },
        isSendingReset () {
            this.$store.commit('isSendingReset')
        },
        // コメント投稿
        async SendPostComment () {
            if (!this.$store.state.postComment) {
                // console.log('コメントなし')
                this.error='コメントを入力してください'
            }
            if (this.$store.state.postComment) {
                // console.log('コメントあり')
                this.isSendingChange()
                let url = '/api/feed'
                //userのidを取得
                let user_id = document.head.querySelector('meta[name=user_id]')
                //userのnews_idを取得
                var news_id = this.$refs.news_id
            
                let params = {
                    feed_id: this.$store.state.selectFeedId,
                    comment: this.$store.state.postComment,
                    user_id: user_id.content,
                    news_id: news_id.innerHTML
                }
            
                // Ajaxでデータを投げる
                await axios.put(url, params)
                    .then(function (response) {
                    })
                    .catch(function (error) {
                        console.log(error)
                    })
                this.$store.state.postComment = ''
                this.UpdateState()
                alert('投稿が完了しました！');
                this.ModalHide()
                this.isSendingReset()
            }
        },
        isLoadingOn () {
            this.$store.commit('isLoadingOn')
        },
        isLoadingOff () {
            this.$store.commit('isLoadingOff')
        },
    },
    computed: {
        feeds: function(){
  		        return this.$store.state.feeds
  	    },
        selectFeedId: function(){
  		        return this.$store.state.selectFeedId
  	    },
        matches: function(){
                return this.$store.state.matches
        },
        isSending: function(){
  		        return this.$store.state.isSending
  	    },
        currentPage: function() {
                return this.$store.state.current_page
        },
        commentForm: {
            get () {
                return this.$store.getters.postComment
            },
            set (value) {
                this.$store.commit('setPostComment', value)
            }
        },
        sizeCheck: function() {
            if (this.$store.state.last_page <= this.$store.state.range + 4) {
                return false
            }
            return true
        },
        frontPageRange: function() {
            if (!this.sizeCheck) {
                this.front_dot = false;
                this.end_dot = false;
                return this.calRange(1, this.$store.state.last_page);
            }
            return this.calRange(1, 2)
        },
        middlePageRange() {
            if (!this.sizeCheck) return []
                let start = ""
                let end = ""
            if (this.$store.state.current_page <= this.$store.state.range) {
                start = 3
                end = this.$store.state.range + 2
                this.$store.state.front_dot = false
                this.$store.state.end_dot = true
                this.$store.commit('setFrontDot', false)
                this.$store.commit('setEndDot', true)                
            } else if (this.$store.state.current_page > this.$store.state.last_page - this.$store.state.range) {
                start = this.$store.state.last_page - this.$store.state.range - 1
                end = this.$store.state.last_page - 2
                this.$store.state.front_dot = true
                this.$store.state.end_dot = false
            } else {
                start = this.$store.state.current_page - Math.floor(this.$store.state.range / 2)
                end = this.$store.state.current_page + Math.floor(this.$store.state.range / 2)
                this.$store.state.front_dot = true
                this.$store.state.end_dot = true
            }
            return this.calRange(start, end)
        },
        endPageRange() {
            if (!this.sizeCheck) return []
                return this.calRange(this.$store.state.last_page - 1, this.$store.state.last_page)
        },
        isloading() {
            return this.$store.state.isloading
        } 
    },
}
</script>
<style scoped>

</style>
