<template>
    <div>
        <v-list dense>
            <v-list-tile v-for="menu in menus" v-bind:key="menu.title">
                <v-list-tile-action>
                    <v-icon v-html="menu.icon"></v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>
                        <router-link v-text="menu.title" :to="menu.link"></router-link>
                    </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
    </div>
</template>

<script>
    export default {
        name: "Menu",
        data() {
            return {
                menus: [
                    { title: 'Home', icon : 'home', link: '/'},
                    { title: 'Clients', icon : 'contact_mail', link: '/clients'},
                    { title: 'Manufacturers', icon : 'accessibility', link: '/manufacturer'},
                    { title: 'Categories', icon : 'group_work', link: '/categories'},
                    { title: 'Products', icon : 'local_mall', link: '/products'},
                ]
            }
        }
    }
</script>

<style scoped>

</style>