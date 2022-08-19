import {createWebHashHistory,createRouter} from 'vue-router'
import Movies from "./components/MoviesComponent.vue";
import Movie from "./components/MovieComponent.vue";


 const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        {
            path: '/movies',
            name: 'Movies',
            component: Movies
        },
        {

            path: '/movies/:id',
            name: 'Movie',
            component: Movie
        },
    ]
 });

 export default router;
