import VueRouter from 'vue-router'
import Vue from 'vue'
import Home from './components/HomeComponent.vue'
import Login from './components/LoginComponent.vue'
import Register from './components/RegisterComponent.vue'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes:[
        {
            path:"/",
            name: "login",
            component:Login,
        },
        {
            path:"/home",
            name: "home",
            component:Home,
        },
        {
            path:"/register",
            name: "register",
            component:Register,
        },

        // otherwise redirect to login
        {   path: "*", 
            redirect: "/",
        },
    ]

})
export default router