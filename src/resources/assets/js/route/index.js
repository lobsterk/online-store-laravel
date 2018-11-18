import Vue                  from 'vue'
import Router               from 'vue-router'
import Clients              from '../views/Client';
import Manufacturer         from '../views/Manufacturer';
import Categories           from '../views/Category';
import Products             from '../views/Product';
import ProductsStore        from '../views/ProductStore';

Vue.use(Router);

export default new Router({
    // mode: 'history',
    routes: [
        { path: '/clients', name: 'clients', text: 'Клиенты', component: Clients , view: true},
        { path: '/manufacturer', name: 'manufacturer', text: 'Manufacturer', component: Manufacturer , view: true},
        { path: '/categories', name: 'categories', text: 'Categories', component: Categories , view: true},
        { path: '/products', name: 'products', text: 'Products', component: Products , view: true},
        { path: '/products/:id', name: 'product', text: 'Products', component: ProductsStore , view: true},
    ]
})
