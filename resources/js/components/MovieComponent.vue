<template>
    <div class="container">
        <img v-if="!movie" class="img-sm" src="https://i.pinimg.com/originals/49/e5/8d/49e58d5922019b8ec4642a2e2b9291c2.png"/>
        <div v-if="movie" class="card mt-5">
            <div class="row g-0">
                <div class="col-lg-4">
                <img v-bind:src=movie?.preview?.Poster class="img-fluid rounded-start" alt="">
                </div>
                <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{movie?.preview?.Title}}</h5>
                    <p class="card-text">{{movie?.preview?.Plot}}</p>
                    <p class="card-text">{{movie?.preview?.Released}}</p>
                    <p class="card-text">Votes: {{movie?.averageVotes || 'N/A'}}</p>
                    <p class="card-text">Add Vote</p>
                    <select v-on:change="addVote($event)" class="form-control">
                        <option selected disabled value="">Please add vote out of 10</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            movie:null
        }
    },
    created(){
        axios.get(`api/movies/${this.$route.params.id}`)
        .then((res) => {
            this.movie = res.data;
        });
    },
    methods: {
        addVote(event) {
            const value =event.target.value;
            if (value) {
                axios.post('api/movies/add-vote',{movieId:this.$route.params.id,vote:value})
                .then((res) => {
                    this.movie.averageVotes=res.data?.averageVote;
                });
            }
        }
    },
    mounted() {
        console.log('Component mounted.');
    }
}
</script>
