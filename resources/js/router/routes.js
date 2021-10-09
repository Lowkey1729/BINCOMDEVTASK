import Vue from 'vue';
import VueRouter  from 'vue-router';
import Dashboard from '../views/Dashboard.vue';
import LGAResults from '../views/LGAResults.vue';
import NewPollingResult from '../views/NewPollingResult.vue';


Vue.use(VueRouter)

let routes = [

    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
    },

    {
        path: '/all_polling_results',
        name: 'polling_units.results',
        component: LGAResults,
    },

    {
        path: '/new_polling_result',
        name: 'new_polling_result',
        component: NewPollingResult,
    },



]

const router = new VueRouter({
    mode: 'history',
    routes
})


export default router
