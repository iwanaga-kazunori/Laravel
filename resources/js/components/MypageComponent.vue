<template>
    <div class="container mypage">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Meine Seite</h2>
                <div class="profile row justify-content-center">
                    <div class="icon col-md-5">
                        <p v-if="showUserImage" class="icon_image"><img v-bind:src="'/storage/images/' + user.profile_image"></p>
                        <button v-on:click="showImage" class="button">編集</button>
                        <modal
                            name="profile_image"
                            :draggable="true"
                            width="320px"
                            height="auto"
                            class="icon_modal"
                        >
                            <div class="modal-header">
                                <h3>アイコン登録</h3>
                            </div>
                            <div class="modal-body">
                                <p><input type="file" ref="preview" @change="fileSelected" /></p>
                                <p v-if="error" class="error">
                                    {{ error }}
                                </p>
                                <div v-if="previewUrl" class="preview">
                                    <img :src="previewUrl">
                                </div>
                                <p ref="user_id" style="display:none;">{{ user.id }}</p>
                                <button v-on:click="fileUpload" class="button">upload</button>
                                <button v-on:click="hideImage" class="close_button">close</button>
                            </div>  
                        </modal>
                    </div>
                    <div class="name col-md-6">
                        <table>
                            <tr><th>ニックネーム：</th><td>{{ user.name }}</td></tr>
                            <tr><th>メールアドレス：</th><td>{{ user.email }}</td></tr>
                        </table>
                        <div class="favorite_teams  col-md-12">
                            <h3>お気に入りのチーム</h3>
                            <div v-if="favoriteTeams.favorite_teams">
                                <ul>
                                    <li v-for="(favorite_team, index) in favoriteTeams.favorite_teams">{{ favorite_team }}</li>
                                </ul>
                                <button v-on:click="showEditFavorite" class="button">編集</button>
                                <!--お気に入りのチーム更新-->
                                <modal
                                    name="edit-favorite"
                                    :draggable="true"
                                    width="80%"
                                    height="auto"
                                    class="edit-favorite"
                                >
                                    <div class="modal-header">
                                        <h3>お気に入りのチーム登録</h3>
                                    </div>
                                    <div class="modal-body">
                                        <form @submit.prevent="favoriteTeamsUpdate">
                                            <div class="team_wrap">
                                                <div v-for="(team, i) in teams" :key="i" class="team_list">
                                                    <input
                                                        :id="'team.team_name_ja' + i"
                                                        type="checkbox"
                                                        :value="team.team_name_ja"
                                                        v-model="editTeams"
                                                    >
                                                    <label :for="'team.team_name_ja' + i">{{team.team_name_ja}}</label>
                                                </div>
                                            </div>
                                            <p ref="user_id" style="display:none;">{{ user.id }}</p>
                                            <button class="button">登録</button>
                                            <p>{{ editTeams }}</p>
                                        </form>
                                        <button v-on:click="hideEditFavorite" class="close_button">close</button>
                                    </div>
                                </modal>
                            </div>
                            <!--お気に入りのチーム登録-->
                            <div v-else>
                                <p>登録されておりません</p>
                                <button v-on:click="showFavorite" class="button">登録</button>
                                <modal
                                    name="favorite"
                                    width="80%"
                                    height="auto"
                                    class="select-favorite"
                                >
                                    <div class="modal-header">
                                        <h3>お気に入りのチーム登録</h3>
                                    </div>
                                    <div class="modal-body">
                                        <p v-if="error" class="error">
                                            {{ error }}
                                        </p>
                                        <form @submit.prevent="favoriteTeamsCreate">
                                            <div class="team_wrap">
                                                <div v-for="(team, i) in teams" :key="i" class="team_list">
                                                    <input
                                                        :id="'team.team_name_ja' + i"
                                                        type="checkbox"
                                                        :value="team.team_name_ja"
                                                        v-model="selectedTeams"
                                                    >
                                                    <label :for="'team.team_name_ja' + i">{{team.team_name_ja}}</label>
                                                </div>
                                            </div>
                                            <p ref="user_id" style="display:none;">{{ user.id }}</p>
                                            <button class="button">登録</button>
                                            <p>{{ selectedTeams }}</p>
                                        </form>
                                        <button v-on:click="hideFavorite" class="close_button">close</button>
                                    </div>
                                </modal>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="favorite_feed" style="margin-top: 30px;">
                    <h2>Nachrichten des Lieblingsteams</h2>
                    <div class="favorite_feed_content">お気に入りチームが登録されていません</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue'
import VModal from 'vue-js-modal'
import axios from 'axios'
Vue.use(VModal)
export default {
    data : function()  {
        return { 
            imageData: '',
            fileInfo: '',
            name:'',
            userImage: '',
            showUserImage: true,
            showNewUserImage: false,
            selectedTeams: [],
            previewUrl: "",
            editTeams: [],
            error: '',
        }
    },
    props: {
        user: {
            type:Object,
        },
        fateams: {
            type:Object,
        },
    },
    watch: {
        user: function(newVal, oldVal) {
            // データが変化した時に行いたい処理
            // console.log("=====userwatch=====")
            // console.log(newVal, oldVal)
        },
        deep : true,
    },
    methods: {
        showImage() {
            this.error = '';
            this.previewUrl = "";
            this.$modal.show('profile_image');
        },
        hideImage() {
            this.error = '';
            this.previewUrl = "";
            this.$modal.hide('profile_image');
        },
        onFileChange(e) {
            const files = e.target.files;
            if(files.length > 0) {
                const file = files[0];
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imageData = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        resetFile() {
            const input = this.$refs.file;
            input.type = 'text';
            input.type = 'file';
            this.imageData = '';
        },
        fileSelected(event){
            console.log(event)
            this.error = '';
            this.fileInfo = event.target.files[0]
            const previewFile = this.$refs.preview.files[0]
            this.previewUrl = URL.createObjectURL(previewFile)
        },
        fileUpload(){
            if(this.fileInfo != '') {
                const user_id = this.$refs.user_id.innerHTML
                const formData = new FormData()
            
                formData.append('file',this.fileInfo)
                formData.append("id",user_id)
                axios.post('/api/fileupload', formData )
                    .then(response =>{
                        this.userImage = response.data
                        if(response.data.profile_image) {
                            this.user.profile_image = response.data.profile_image
                        }
                        console.log(response.data)
                        this.fileInfo = '';
                        this.hideImage()
                    });
            } else {
                console.log('エラー')
                this.error = 'ファイルを選択してください';
            }
        },
        showFavorite() {
            this.selectedTeams = [];
            this.error = '';
            this.$modal.show('favorite');
        },
        hideFavorite() {
            this.$modal.hide('favorite');
        },
        favoriteTeamsCreate() {
            const user_id = this.$refs.user_id.innerHTML
            console.log(this.selectedTeams)
            var params = {
                selectedTeams:this.selectedTeams,
                id:user_id
            }
            if (this.selectedTeams != "") {
                axios.post("/api/favoriteTeamsCreate", params).then((res) => {
                    this.selectedTeams = "";
                    this.favoriteTeamsRead();
                    this.hideFavorite();
                });
            } else {
                console.log('エラー')
                this.error = '選択してください';
            }
        },
        favoriteTeamsRead() {
            this.$store.dispatch('getFavoriteTeams')
        },
        showEditFavorite() {
            this.editTeams = [];
            this.$modal.show('edit-favorite');
        },
        hideEditFavorite() {
            this.$modal.hide('edit-favorite');
        },
        favoriteTeamsUpdate() {
            const user_id = this.$refs.user_id.innerHTML
            console.log(this.editTeams)
            var params = {
                editTeams:this.editTeams,
                id:user_id
            }
            if (this.editTeams != "") {
                axios.post("/api/favoriteTeamsUpdate", params).then((res) => {
                    this.editTeams = "";
                    this.favoriteTeamsRead();
                    this.hideEditFavorite();
                });
            }
        },
    },
    mounted () {
        this.$store.dispatch('getTeams')
        this.$store.dispatch('getFavoriteTeams')
    },
    computed: {
        teams: function(){
                return this.$store.state.teams
        },
        favoriteTeams: function(){
                return this.$store.state.favoriteTeams
        },
    }
}
</script>
