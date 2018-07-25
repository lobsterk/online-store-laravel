<template>
    <v-app id="inspire">
        <v-navigation-drawer
                app
                fixed
                v-model="show_menu"
        >
            <left-menu></left-menu>
        </v-navigation-drawer>

        <v-toolbar color="indigo" dark fixed app>
            <v-toolbar-side-icon @click.stop="show_menu=!show_menu"></v-toolbar-side-icon>
            <v-toolbar-title>Админ панель online-store-laravel</v-toolbar-title>
        </v-toolbar>
        <v-content>
               <router-view></router-view>
        </v-content>
        <v-footer color="indigo" app>
            <span class="white--text">&copy; 2018</span>
        </v-footer>
    </v-app>
</template>

<script>
    import Menu from './menu/'

    export default {
        name: 'App',
        components: {
            'left-menu'  : Menu,
        },
        data() {
            return {
                show_menu: null
            }
        },
        props: {
            source: String
        }
    }
</script>