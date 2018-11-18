
<template>
    <div>
        <v-toolbar flat color="white">
            <v-toolbar-title>Products</v-toolbar-title>
            <v-divider
                    class="mx-2"
                    inset
                    vertical
            ></v-divider>
            <v-card>
                <v-card-title>
                    {{ table_header}}
                    <v-spacer></v-spacer>
                    <v-text-field
                            v-model="search"
                            append-icon="search"
                            label="Поиск"
                            single-line
                            hide-details
                    ></v-text-field>
                </v-card-title>
            </v-card>
            <v-spacer></v-spacer>
            <v-btn color="primary" dark class="mb-2" to='/products/new'>New Item</v-btn>
        </v-toolbar>
        <v-data-table
                :headers="headers"
                :items="products"
                hide-actions
                class="elevation-1"
                :search="search"
        >
            <template slot="items" slot-scope="props">
                <td>{{ props.item.model }}</td>
                <td>{{ props.item.title }}</td>
                <td>{{ props.item.status }}</td>
                <td><span :class="getStatus(props.item.category_id) ? '' : 'red'">{{ getCategoryName(props.item.category_id) }}</span></td>
                <td>{{ getManufacturerName(props.item.manufacturer_id) }}</td>
                <td>{{ props.item.price }}</td>
                <td>{{ props.item.count }}</td>
                <td>{{ props.item.views }}</td>
                <td class="justify-center layout px-0">
                    <v-icon
                            small
                            class="mr-2"
                            to='/products/0'
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
            headers: [
                { text: 'Model', value: 'model', align: 'left' },
                { text: 'Title', value: 'title', align: 'left' },
                { text: 'Status', value: 'status', align: 'left' },
                { text: 'Category', value: 'category' },
                { text: 'Manufacturer', value: 'manufacturer' },
                { text: 'Price', value: 'price' },
                { text: 'Сount', value: 'count' },
                { text: 'Views', value: 'views' }
            ],
            products: [],
            categories: [],
            manufacturers: [],
            search: ''
        }),

        watch: {
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
                axios
                    .get("admin/category/all")
                    .then(
                        response => (
                            this.categories = response.data
                        )
                    );
            },

            getCategoryName(id) {
                for (let i=0; i < this.categories.length; i++){
                    if (this.categories[i].id == id) {
                        return this.categories[i].title;
                    }
                }
            },
            getManufacturerName(id) {
                for (let i=0; i < this.manufacturers.length; i++){
                    if (this.manufacturers[i].id == id) {
                        return this.manufacturers[i].title;
                    }
                }
            },
            getStatus(id) {
                for (let i=0; i < this.categories.length; i++){
                    if (this.categories[i].id == id) {
                        return this.categories[i].status;
                    }
                }
            },

            deleteItem (item) {
                const index = this.products.indexOf(item);
                if (confirm('Are you sure you want to delete this item?')) {
                    axios
                        .delete(`/admin/product/${item.id}`)
                        .then(response  => {
                            console.log(response.data)
                        });
                    this.products.splice(index, 1);
                }

            },

        }
    }
</script>