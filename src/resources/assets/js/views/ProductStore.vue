<template>
    <v-container grid-list-md>
        <v-layout>
            <v-flex>
                <v-toolbar flat color="white">
                    <v-toolbar-title>Products Store</v-toolbar-title>
                    <v-divider
                            class="mx-2"
                            inset
                            vertical
                    ></v-divider>
                    <v-toolbar-title>{{ titlePage }}</v-toolbar-title>
                </v-toolbar>
            </v-flex>
        </v-layout>

        <form>
               <v-layout>
                   <v-flex xs12 md6>
                       <v-text-field
                               v-model="product.model"
                               :counter="10"
                               error-messages=""
                               label="Model"
                               data-vv-name="model"
                               required
                       ></v-text-field>
                   </v-flex>
                   <v-flex xs12 md6>
                       <v-text-field
                               v-model="product.title"
                               :counter="30"
                               error-messages=""
                               label="Title"
                               data-vv-name="title"
                               required
                       ></v-text-field>
                   </v-flex>
               </v-layout>
            <v-layout>
                <v-flex xs12 md6>
                    <v-select
                            :items="categories"
                            item-text="title"
                            item-value="id"
                            v-model="product.category_id"
                            label="categories"
                    ></v-select>
                </v-flex>
                <v-flex xs12 md6>
                    <v-select
                            :items="manufacturers"
                            item-text="title"
                            item-value="id"
                            v-model="product.manufacturer_id"
                            label="manufacturers"
                    ></v-select>
                </v-flex>
            </v-layout>
            <v-layout>
                <v-flex xs12 md6>
                    <v-text-field
                            v-model="product.html_h1"
                            :counter="10"
                            error-messages=""
                            label="html_h1"
                            data-vv-name="html_h1"
                            required
                    ></v-text-field>
                </v-flex>
                <v-flex xs12 md6>
                    <v-text-field
                            v-model="product.html_title"
                            :counter="30"
                            error-messages=""
                            label="html_title"
                            data-vv-name="html_title"
                            required
                    ></v-text-field>
                </v-flex>
            </v-layout>
            <v-layout>
                <v-flex md12>
                    <v-text-field
                            v-model="product.meta_keywords"
                            error-messages=""
                            label="meta_keywords"
                            data-vv-name="meta_keywords"
                            required
                    ></v-text-field>
                </v-flex>
            </v-layout>
            <v-layout>
                <v-flex md12>
                    <v-text-field
                            v-model="product.meta_description"
                            error-messages=""
                            label="meta_description"
                            data-vv-name="meta_description"
                            required
                    ></v-text-field>
                </v-flex>
            </v-layout>
            <v-layout>
                <v-flex md12>
                    <v-textarea
                            label="description"
                            v-model="product.description"
                            data-vv-name="description"
                            required
                    ></v-textarea>
                </v-flex>
            </v-layout>
        </form>
    </v-container>
</template>

<script>
    export default {
        name: "ProductStore",
        data: () => ({
            product: {
                id: '',
                model: '',
                title: '',
                manufacturer_id: '',
                category_id: '',
                html_h1: '',
                html_title: '',
                meta_keywords: '',
                meta_description: '',
                description: '',
                price: '',
                count: '',
                status: '',
                created_by: ''
            },
            manufacturers : [],
            categories: []
        }),
        computed: {
            titlePage: function() {
                return this.$route.params.id == 0 ? 'New Item' : 'Item id '+ this.product_id;
            },
            // isset_item: function()  {
            //   return this.$route.params.id == 0 ? false : true;
            // },
            product_id: function () {
                return this.$route.params.id;

            }
        },
        created () {
            this.initialize()
        },
        methods: {
            initialize() {
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
            }
        }

    }
</script>

<style scoped>

</style>