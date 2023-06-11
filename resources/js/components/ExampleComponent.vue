<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                    <p style="color:black">{{ favoriteteams.id }}</p>
                    <ul id="example-1">
                        <li v-for="favoriteteam in favoriteteams.favorite_teams" style="color:black">
                        {{ favoriteteam }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            favoriteteams: {
                type: Object,
                required: true
            },
        },
        mounted() {
            
        },
        data() {
        return {
            
            }
        },
        methods: {
            
        }
    }
</script>
