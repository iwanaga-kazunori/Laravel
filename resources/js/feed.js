require('./bootstrap');
require('vue-moment');

import Vue from'vue'
import Vuex from 'vuex'
import axios from 'axios'
import VueLoading from 'vue-loading-template'
Vue.use(Vuex)
Vue.use(VueLoading)
Vue.component('matches-component', require('./components/MatchesComponent.vue').default);
Vue.component('mypage-component', require('./components/MypageComponent.vue').default);
Vue.component('sns-component', require('./components/SnsComponent.vue').default);
Vue.component('loading-component', require('./components/LoadingComponent.vue').default);
import FeedList from './components/FeedListComponent'
const store = new Vuex.Store({
    state: {
        feeds: [],
        matches: [],
        teams: [],
        selectFeedId: null,
        postComment: '',
        comments: [],
        isSending: false,
        current_page:1,
        last_page: "",
        range: 5,
        front_dot: false,
        end_dot: false,
        loading: "",
        isLoading: false,
        favoriteTeams: [],
    },
    mutations: {
        // 新着情報を読み込む
        setFeeds : function(state,feeds) {
            state.feeds = feeds
        },
        // 新着情報のモーダルに使用
        selectFeedId (state, i) {
            state.selectFeedId = i
        },
        // 新着情報のページネーション
        setCurrentPage (state, current_page) {
            state.current_page = current_page
        },
        setLastPage (state, last_page) {
            state.last_page = last_page
        },
        setRange (state, range) {
            state.range = range
        },
        setFrontDot (state, front_dot) {
            state.front_dot = front_dot
        },
        setEndDot (state, end_dot) {
            state.end_dot = end_dot
        },
        // 記事のコメントを一時的に保存する
        setPostComment (state, value) {
            state.postComment = value
        },
        // 新着情報のコメント投稿時
        isSendingChange (state) {
            state.isSending = true
        },
        isSendingReset (state) {
            state.isSending = false
        },
        // 試合結果・日程を読み込む
        setMatches : function(state,matches) {
            state.matches = matches
        },
        setTeams : function(state,teams) {
            state.teams = teams
        },
        isLoadingOff (state) {
            state.isLoading = false
        },
        isLoadingOn (state) {
            state.isLoading = true
        },
        setFeeds (state, feeds) {
            state.feeds = feeds
        },
        setFavoriteTeams : function(state,favoriteTeams) {
            state.favoriteTeams = favoriteTeams
        },
        getFeeds (state) {
            let token = document.head.querySelector('meta[name=api-token]')
            const url = '/api/feed?page=1' + '&api_token=' + token.content
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
        
    },
    actions: {
        // 新着情報取得
        getFeeds (state) {
            let token = document.head.querySelector('meta[name=api-token]')
            const url = '/api/feed?page=1' + '&api_token=' + token.content
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
        // 試合結果・日程取得
        getMatches (state){
            axios.get('api/matches')
            .then(function (response) {
                store.commit('setMatches',response.data)
            })
            .catch(function (error) {
                    console.log(error)
            })
        },
        getTeams (state){
            axios.get('api/teams')
            .then(function (response) {
                store.commit('setTeams',response.data)
            })
            .catch(function (error) {
                    console.log(error)
            })
        },
        getFavoriteTeams(state) {
            let id = document.head.querySelector('meta[name=user_id]')
            const url = '/api/favoriteTeamsRead?id=' + id.content
            // console.log(url)
            axios.get(url)
            .then(function (response) {
                store.commit('setFavoriteTeams',response.data)
            })
            .catch(function (error) {
                console.log(error)
            })
        },
    },
});

const app = new Vue({
    el: '#app',
    components: { 
        FeedList,
    } ,
    store,
    data() {
        return {
          date: this.$moment().format(),
          isLoading: false
        };
      },
})
