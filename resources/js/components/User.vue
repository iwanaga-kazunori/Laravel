<template>
  <div>
    <ul class="pagination">
        <li
  class="inactive"
  :class="(current_page == 1) ? 'disabled' : ''"
  @click="changePage(current_page-1)"
>&laquo;</li>
      <li v-for="page in frontPageRange" :key="page" @click="changePage(page)" :class="(isCurrent(page)) ? 'active' : 'inactive'">{{ page }}</li>
      <li v-show="front_dot" class="inactive disabled">...</li>
      <li v-for="page in middlePageRange" :key="page" @click="changePage(page)" :class="(isCurrent(page)) ? 'active' : 'inactive'">{{ page }}</li>
      <li v-show="end_dot" class="inactive disabled">...</li>
      <li v-for="page in endPageRange" :key="page" @click="changePage(page)" :class="(isCurrent(page)) ? 'active' : 'inactive'">{{ page }}</li>
      <li
  class="inactive"
  :class="(current_page >= last_page) ? 'disabled' : ''"
  @click="changePage(current_page+1)"
>&raquo;</li>
    </ul>
    <ul>
      <li v-for="user in users" :key="user.id">{{ user.id}}: {{ user.name }}</li>
    </ul>
    {{ users }}
  </div>
</template>

<script>
import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
Vue.use(Vuex)

export default {
    data() {
        return {
            users: [],
            current_page:1,
            last_page: "",
            range: 5,
            front_dot: false,
            end_dot: false
        };
    },
    methods: {
        async getUsers() {
        const result = await axios.get(`/api/users?page=${this.current_page}`);
        const users = result.data;
        this.current_page = users.current_page;
        this.last_page = users.last_page;
        this.users = users.data;
        },
        calRange(start, end) {
            const range = [];
            for (let i = start; i <= end; i++) {
            range.push(i);
            }
            return range;
        },
        changePage(page) {
            if (page > 0 && page <= this.last_page) {
                this.current_page = page;
                this.getUsers();
            }
        },
        isCurrent(page) {
            return page === this.current_page;
        },
    },
    created() {
        this.getUsers();
    },
    computed: {
        sizeCheck() {
            if (this.last_page <= this.range + 4) {
                return false;
            }
            return true;
        },
        frontPageRange() {
            if (!this.sizeCheck) {
                this.front_dot = false;
                this.end_dot = false;
                return this.calRange(1, this.last_page);
            }
            return this.calRange(1, 2);
        },
        middlePageRange() {
            if (!this.sizeCheck) return [];
                let start = "";
                let end = "";
            if (this.current_page <= this.range) {
                start = 3;
                end = this.range + 2;
                this.front_dot = false;
                this.end_dot = true;
            } else if (this.current_page > this.last_page - this.range) {
                start = this.last_page - this.range - 1;
                end = this.last_page - 2;
                this.front_dot = true;
                this.end_dot = false;
            } else {
                start = this.current_page - Math.floor(this.range / 2);
                end = this.current_page + Math.floor(this.range / 2);
                this.front_dot = true;
                this.end_dot = true;
            }
            return this.calRange(start, end);
        },
        endPageRange() {
            if (!this.sizeCheck) return [];
                return this.calRange(this.last_page - 1, this.last_page);
        }
    },
};
</script>

<style scoped>
    .pagination {
        display: flex;
        list-style-type: none;
    }
    .pagination li {
        border: 1px solid #ddd;
        padding: 6px 12px;
        text-align: center;
    }
    .active {
        background-color: #3377ab;
        color:white;
    }
    .inactive{
        color: #3377ab;
    }
    .pagination li + li {
        border-left: none;
    }
    .disabled {
  cursor: not-allowed;
}
</style>
