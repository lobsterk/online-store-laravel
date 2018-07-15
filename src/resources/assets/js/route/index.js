import Vue              from 'vue'
import Router           from 'vue-router'
import Clients          from '../components/сlients/List.vue';
import Manufacturer      from '../components/manufacturer/List.vue';

Vue.use(Router);

export default new Router({
    // mode: 'history',
    routes: [
        { path: '/clients', name: 'clients', text: 'Клиенты', component: Clients , view: true},
        { path: '/manufacturer', name: 'manufacturer', text: 'Производители', component: Manufacturer , view: true},
    ]
})
