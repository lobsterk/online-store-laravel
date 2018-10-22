import Vue              from 'vue'
import Router           from 'vue-router'
import Clients          from '../components/сlients/';
import Manufacturer     from '../components/manufacturer/';
import Categories       from '../components/categories/';

Vue.use(Router);

export default new Router({
    // mode: 'history',
    routes: [
        { path: '/clients', name: 'clients', text: 'Клиенты', component: Clients , view: true},
        { path: '/manufacturer', name: 'manufacturer', text: 'Производители', component: Manufacturer , view: true},
        { path: '/categories', name: 'categories', text: 'Производители', component: Categories , view: true},
    ],
    'mode' : 'history'
})
