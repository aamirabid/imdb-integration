<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">IMD INTEGRATION</a>
            <div class="collapse navbar-collapse" id="navbarColor07">
                <input class="form-control me-2" type="search" v-model.trim="search" placeholder="Search Movies" @keyup.enter="getFilteredMovies" aria-label="Search">
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <img v-if="movies.length ==0" class="img-sm" src="https://i.pinimg.com/originals/49/e5/8d/49e58d5922019b8ec4642a2e2b9291c2.png"/>
            <div v-if="movies.length !=0" class="col-md-4 mb-5" v-for="(item, index) in movies" :key="index">
               <div class="card">
                    <img v-bind:src=item.Poster   class="card-img-bottom" onerror="https://w7.pngwing.com/pngs/116/765/png-transparent-clapperboard-computer-icons-film-movie-poster-angle-text-logo-thumbnail.png">
                    <div class="card-body">
                        <h5 class="card-title">{{item.Title}}</h5>
                        <p class="card-text"><small class="text-muted">{{item?.Type}},{{item?.Year}}</small></p>
                    </div>
                    <router-link :to="{name: 'Movie', params: { id: item?.imdbID }}" class="btn btn-primary">Details</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
    data() {
        return {
            movies: [],
            search:""
        }
    },
    methods: {
        getFilteredMovies() {
            if (this.search) {
                axios.get(`api/movies/?queryTxt=${this.search}`)
                .then((res) => {
                    this.movies = res.data;
                });
            }
        }
    },

    mounted() {
        console.log('Component mounted.');
    }
}
</script>
