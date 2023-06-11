<template>
    <div>
        <h2>コメント一覧</h2>
        <div v-if="comments.length">
            <div v-for="(comment, index) in comments" class="row">
                
                <div class="col-md-8" style="border-bottom:solid 1px #ccc;">
                    {{ comment.comment }}
                </div>
                <div class="col-md-4" style="border-bottom:solid 1px #ccc;">
                    {{ comment.created_at }}
                </div>
                
            </div>
        </div>
        <div v-else> 
            <p>コメントがありませんでした。</p>
        </div>
        <br><br><br>
            <div v-for="tcomment in tcomments" v-bind:key="tcomment.id">
                {{ tcomment.id }}
                {{ tcomment.content }}
            </div>
        <br><br>
        <!--<form v-on:submit.prevent="addComment">
            <textarea type="text" v-model="newComment" placeholder="コメント投稿"></textarea>
            <button type="submit">投稿</button>
        </form>-->
    </div>
</template>

<script>
import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
Vue.use(Vuex)
export default {
    name: "CommentList",
    created () {
        this.getComments()
    },
    data: function () {
            return {
                
                tcomment: "",
                newComment: '',
                
            }  
        },
    methods: {
        // 該当ニュースのコメントを取得する
        getComments: function () {
            let token = document.head.querySelector('meta[name=api-token]')
            console.log(token)
            let feedId = this.$store.state.selectFeedId
            let url = '/api/comments/' + feedId + '?api_token=' + token.content

            axios({method: 'get',  url: url})
                .then(response => {
                    this.$store.state.comments[feedId] = response.data
                })
                .catch(error => {
                    console.log(error)
                })
        },
        addComment () {
                this.$store.commit('addComment', {
                    content: this.newComment,
                })
                this.newComment = ''
                this.getCommments()
            },
    },
    computed: {
        comments: {
            get () {
                let feedId = this.$store.state.selectFeedId
                return this.$store.state.comments[feedId]
            }
        },
        tcomments () {
                return this.$store.state.tcomments
            },
    }
}
</script>

<style scoped>

</style>
