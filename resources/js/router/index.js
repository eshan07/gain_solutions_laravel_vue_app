import {createRouter, createWebHistory} from 'vue-router'
import Home from '../layouts/pages/Home.vue'
import About from '../layouts/pages/About.vue'
const routes = [
    {
        path:'/',
        name:'home',
        component:Home,
    },
    {
        path:'/about',
        name:'about',
        component:About,
    }
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
})
export default router;
