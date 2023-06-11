<template>
    <div class="container matches">
        <div class="row justify-content-center">
            <h2 class="col-md-12">Ergebnis</h2>
            <div class="col-md-8 col-12">
                <table>
                    <tbody>
                        <tr v-for="match in matcheItems" :key="matches.id" class="row">
                            <td class="logo col-md-4 col-3"><img :src="'https://crests.football-data.org/'+ match.homeTeam.id +'.svg'"><br>{{ match.homeTeam.name }}</td>
                            <td class="score col-md-1 col-1">{{ match.score.fullTime.homeTeam }}</td>
                            <td class="date col-md-2 col-3">{{ match.utcDate | moment("YYYY/MM/DD")}}<br><span class="bar">-</span></td>
                            <td class="score col-md-1 col-1">{{ match.score.fullTime.awayTeam }}</td>
                            <td class="logo col-md-4 col-3"><img :src="'https://crests.football-data.org/'+ match.awayTeam.id +'.svg'"><br>{{ match.awayTeam.name }}</td>
                        </tr>
                    </tbody>
                </table>
                <button
                    class="more_button"
                    v-if="(matcheItems.length - count) >= 0"
                    type="button"
                    @click="isMore"
                >
                    もっと見る
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue'
import Vuex from 'vuex'
import VModal from 'vue-js-modal'
import vueMoment from 'vue-moment'

Vue.use(Vuex)
Vue.use(VModal)
Vue.use(vueMoment)
    
export default {
    data: function() {
        return { count: 10 }   
    },
    mounted() {
        
    },
    computed: {
        matches: function(){
            return this.$store.state.matches
        },
        matcheItems() {
            const matches = this.matches
            return matches.slice(0, this.count)
        }
    },
    methods: {
        isMore() {
            this.count += 10
        }
    },
}
</script>
