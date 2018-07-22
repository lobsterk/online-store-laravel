<template>
    <div>
        <v-toolbar flat color="white">
            <v-toolbar-title>Categories</v-toolbar-title>
            <v-divider
                    class="mx-2"
                    inset
                    vertical
            ></v-divider>
            <v-spacer></v-spacer>
            <v-dialog v-model="dialog" max-width="500px">
                <v-btn slot="activator" color="primary" dark class="mb-2">New Item</v-btn>
                <v-card>
                    <v-card-title>
                        <span class="headline">{{ formTitle }}</span>
                    </v-card-title>

                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12 sm12 md12>
                                    <v-text-field v-model="editedItem.title" label="Title"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md6>
                                    <v-select
                                            :items="[0,1]"
                                            v-model="editedItem.display_menu"
                                            :label="headers[1].text"
                                    ></v-select>
                                </v-flex>
                                <v-flex xs12 sm6 md6>
                                    <v-select
                                            :items="[0,1]"
                                            v-model="editedItem.status"
                                            :label="headers[2].text"
                                    ></v-select>
                                </v-flex>
                               <v-flex xs12 sm12 md12>
                                    <v-text-field v-model="editedItem.slug" label="Slug"></v-text-field>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
                        <v-btn color="blue darken-1" flat @click.native="save">Save</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-toolbar>
        <v-data-table
                :headers="headers"
                :items="categories"
                hide-actions
                class="elevation-1"
        >
            <template slot="items" slot-scope="props">
                <td>{{ props.item.title }}</td>
                <td>{{ props.item.display_menu }}</td>
                <td>{{ props.item.status }}</td>
                <td>{{ props.item.slug }}</td>
                <td class="justify-center layout px-0">
                    <v-icon
                            small
                            class="mr-2"
                            @click="editItem(props.item)"
                    >
                        edit
                    </v-icon>
                    <v-icon
                            small
                            @click="deleteItem(props.item)"
                    >
                        delete
                    </v-icon>
                </td>
            </template>
            <template slot="no-data">
                <v-btn color="primary" @click="initialize">Reset</v-btn>
            </template>
        </v-data-table>
    </div>
</template>

<script>
    export default {
        name: "List",
        data: () => ({
            dialog: false,
            categories: [],
            headers: [
                {text: 'Title', value: 'title'},
                {text: 'DisplayMenu', value: 'display_menu'},
                {text: 'Status', value: 'status'},
                {text: 'Slug', value: 'slug'},
                {text: 'Actions', value: 'name', sortable: false}
            ],
            editedIndex: -1,
            editedItem: {
                title: '',
                display_menu: 0,
                status: 0,
                slug: '',
            },
            defaultItem: {
                title: '',
                display_menu: 0,
                status: 0,
                slug: '',
            },
            display_menu_select: [
                'Inactive',
                'Active'
            ],
            display_status_select: [
                'Off',
                'On'
            ]
        }),
        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
            }
        },
        watch: {
            dialog(val) {
                val || this.close()
            },
        },

        created() {
            this.initialize()
        },

        methods: {
            initialize() {
                axios
                    .get('/admin/category')
                    .then(response => {
                        this.categories = response.data;
                    })
            },
            display_menu_str(val) {
                return val ? this.display_menu_select[0] : this.display_menu_select[1]
            },
            display_status_str(val) {
                return val ? this.display_status_select[0] : this.display_status_select[1]
            },
            editItem(item) {
                this.editedIndex = this.categories.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            deleteItem(item) {
                const index = this.categories.indexOf(item)
                confirm('Are you sure you want to delete this item?') && this.categories.splice(index, 1)
            },

            close() {
                this.dialog = false
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                }, 300)
            },

            save() {
                if (this.editedIndex > -1) {
                    Object.assign(this.categories[this.editedIndex], this.editedItem)
                } else {
                    this.categories.push(this.editedItem)
                }
                this.close()
            }
        }
    }
</script>

<style scoped>

</style>