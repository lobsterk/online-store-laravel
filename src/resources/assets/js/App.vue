<template>
    <div id="inspire">

        <left-menu v-if="show_menu"> </left-menu>

        <v-toolbar color="indigo" dark fixed app>
            <v-toolbar-side-icon @click="show_menu=!show_menu"></v-toolbar-side-icon>
            <v-toolbar-title>Админ панель online-store-laravel</v-toolbar-title>
        </v-toolbar>
        <v-content>
               <router-view></router-view>
        </v-content>
        <v-footer color="indigo" app>
            <span class="white--text">&copy; 2018</span>
        </v-footer>
    </div>
</template>

<script>
    import Menu from './components/menu/Menu.vue'

    export default {
        name: 'VAppMain',
        components: {
            'left-menu'  : Menu,
        },
        data() {
            return {
                show_menu: true
            }
        },
        props: {
            source: String
        }
    }
</script>