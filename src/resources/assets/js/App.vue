<template>
    <v-app id="inspire">

        <left-menu v-if="show_menu"> </left-menu>

        <v-toolbar color="indigo" dark fixed app>
            <v-toolbar-side-icon @click="show_menu=!show_menu"></v-toolbar-side-icon>
            <v-toolbar-title>Админ панель online-store-laravel</v-toolbar-title>
        </v-toolbar>
        <v-content>
            <v-container fluid fill-height>
                <v-layout
                        justify-center
                        align-center
                >
                    <v-flex text-xs-center>
                        <router-view></router-view>
                        container
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
        <v-footer color="indigo" app>
            <span class="white--text">&copy; 2018</span>
        </v-footer>
    </v-app>
</template>

<script>
    import Menu from './components/menu/Menu.vue'

    export default {
        name: 'App',
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