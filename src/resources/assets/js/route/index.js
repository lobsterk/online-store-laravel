import Vue              from 'vue'
import Router           from 'vue-router'
import Test             from '../components/ExampleComponent.vue';
import Clients          from '../components/сlients/List.vue';

Vue.use(Router);

export default new Router({
    // mode: 'history',
    routes: [
        { path: '/test', name: 'test', text: 'Тесты', component: Test , view: true},
        { path: '/clients', name: 'clients', text: 'Клиенты', component: Clients , view: true},
    ]
})
