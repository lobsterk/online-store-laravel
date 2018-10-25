import Vue              from 'vue'
import Router           from 'vue-router'
import Clients          from '../views/client';
import Manufacturer     from '../views/manufacturer';
import Categories       from '../views/category';
import Products         from '../views/product';

Vue.use(Router);

export default new Router({
    // mode: 'history',
    routes: [
        { path: '/clients', name: 'clients', text: 'Клиенты', component: Clients , view: true},
        { path: '/manufacturer', name: 'manufacturer', text: 'Manufacturer', component: Manufacturer , view: true},
        { path: '/categories', name: 'categories', text: 'Categories', component: Categories , view: true},
        { path: '/products', name: 'products', text: 'Products', component: Products , view: true},
    ]
})
