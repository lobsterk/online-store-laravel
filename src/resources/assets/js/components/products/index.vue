
<template>
    <div>
        <v-toolbar flat color="white">
            <v-toolbar-title>Products</v-toolbar-title>
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
                                <v-flex xs12 sm6 md4>
                                    <v-text-field v-model="editedItem.name" label="Dessert name"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md4>
                                    <v-text-field v-model="editedItem.calories" label="Calories"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md4>
                                    <v-text-field v-model="editedItem.fat" label="Fat (g)"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md4>
                                    <v-text-field v-model="editedItem.carbs" label="Carbs (g)"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md4>
                                    <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
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
                :items="products"
                hide-actions
                class="elevation-1"
        >
            <template slot="items" slot-scope="props">
                <td>{{ props.item.model }}</td>
                <td>{{ props.item.title }}</td>
                <td>{{ props.item.category }}</td>
                <td>{{ props.item.manufacturer }}</td>
                <td>{{ props.item.price }}</td>
                <td>{{ props.item.count }}</td>
                <td>{{ props.item.views }}</td>
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
        data: () => ({
            dialog: false,
            headers: [
                { text: 'Model', value: 'model', align: 'left' },
                { text: 'Title', value: 'title', align: 'left' },
                { text: 'Category', value: 'category' },
                { text: 'Manufacturer', value: 'manufacturer' },
                { text: 'Price', value: 'price' },
                { text: 'Сount', value: 'count' },
                { text: 'Views', value: 'views' }
            ],
            products: [],
            categories: [],
            manufacturers: [],
            editedIndex: -1,
            editedItem: {
                model: '',
                title: 0,
                category: 0,
                manufacturer: 0,
                price: 0,
                count: 0,
                views: 0
            },
            defaultItem: {
                model: '',
                title: 0,
                category: 0,
                manufacturer: 0,
                price: 0,
                count: 0,
                views: 0
            }
        }),

        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
            }
        },

        watch: {
            dialog (val) {
                val || this.close()
            }
        },

        created () {
            this.initialize()
        },

        methods: {
            initialize () {
                axios
                    .get("/admin/product")
                    .then(
                        response => (
                            this.products = response.data
                        )
                );
                axios
                    .get("/admin/manufacturer/")
                    .then(
                        response => (
                            this.manufacturers = response.data
                        )
                );
            },

            editItem (item) {
                this.editedIndex = this.products.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            deleteItem (item) {
                const index = this.products.indexOf(item)
                confirm('Are you sure you want to delete this item?') && this.products.splice(index, 1)
            },

            close () {
                this.dialog = false
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                }, 300)
            },

            save () {
                if (this.editedIndex > -1) {
                    Object.assign(this.products[this.editedIndex], this.editedItem)
                } else {
                    this.products.push(this.editedItem)
                }
                this.close()
            }
        }
    }
</script>