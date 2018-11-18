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

        <v-form ref="form" v-model="valid" lazy-validation>
               <v-layout>
                   <v-flex xs12 md6>
                       <v-text-field
                               v-model="product.model"
                               :rules="[v => !!v || 'Item is required']"
                               :counter="10"
                               error-messages=""
                               label="Model"
                               required
                       ></v-text-field>
                   </v-flex>
                   <v-flex xs12 md6>
                       <v-text-field
                               v-model="product.title"
                               :rules="[v => !!v || 'Item is required']"
                               :counter="30"
                               error-messages=""
                               label="Title"
                               required
                       ></v-text-field>
                   </v-flex>
               </v-layout>
            <v-layout>
                <v-flex xs12 md6>
                    <v-select
                            :items="categories"
                            :rules="[v => !!v || 'Item is required']"
                            item-text="title"
                            item-value="id"
                            v-model="product.category_id"
                            label="categories"
                    ></v-select>
                </v-flex>
                <v-flex xs12 md6>
                    <v-select
                            :items="manufacturers"
                            :rules="[v => !!v || 'Item is required']"
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
                            v-model="product.price"
                            :rules="[v => !!v || 'Item is required']"
                            error-messages=""
                            label="Price"
                            mask="#####"
                            required
                    ></v-text-field>
                </v-flex>
                <v-flex xs12 md6>
                    <v-text-field
                            v-model="product.count"
                            error-messages=""
                            label="Count"
                            disabled
                    ></v-text-field>
                </v-flex>
            </v-layout>
            <v-layout>
                <v-flex xs12 md6>
                    <v-select
                            :items="productStatus"
                            item-text="value"
                            item-value="id"
                            :rules="[v => !!v || 'Item is required']"
                            v-model="product.status"
                            error-messages=""
                            label="Status"
                            required
                    ></v-select>
                </v-flex>
                <v-flex xs12 md6>
                    <v-text-field
                            v-model="product.views"
                            error-messages=""
                            label="Views"
                            disabled
                    ></v-text-field>
                </v-flex>
            </v-layout>
            <v-layout>
                <v-flex xs12 md6>
                    <v-text-field
                            v-model="product.html_h1"
                            :rules="[v => !!v || 'Item is required']"
                            :counter="10"
                            error-messages=""
                            label="html_h1"
                            required
                    ></v-text-field>
                </v-flex>
                <v-flex xs12 md6>
                    <v-text-field
                            v-model="product.html_title"
                            :rules="[v => !!v || 'Item is required']"
                            :counter="30"
                            error-messages=""
                            label="html_title"
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
                            required
                    ></v-text-field>
                </v-flex>
            </v-layout>
            <v-layout>
                <v-flex md12>
                    <wysiwyg v-model="product.description" />
                </v-flex>
            </v-layout>
            <v-btn
                    :disabled="!valid"
                    @click="submit"
            >
                submit
            </v-btn>
        </v-form>
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
                count: 0,
                views: 0,
                status: 1,
                created_by: ''
            },
            manufacturers : [],
            categories: [],
            valid: true,
            productStatus: []
        }),
        computed: {
            titlePage: function() {
                return this.$route.params.id == 'new' ? 'New Item' : 'Item model '+ this.product.model;
            },
            product_id: function () {
                return this.$route.params.id;
            }
        },
        watch: {
            'product.model': function(newModel, oldModel) {
                this.product.title =newModel + ' ' + this.getCategoryName(this.product.category_id);
                this.product.html_h1 = this.getManufacturerName(this.product.manufacturer_id) + ' ' + newModel + ' ' + this.getCategoryName(this.product.category_id);
                this.product.html_title = this.getManufacturerName(this.product.manufacturer_id) + ' ' + newModel + ' ' + this.getCategoryName(this.product.category_id);
                this.product.meta_keywords = this.getManufacturerName(this.product.manufacturer_id)+','+this.getCategoryName(this.product.category_id)+','+newModel;
                this.product.meta_description = this.getManufacturerName(this.product.manufacturer_id)+' '+this.getCategoryName(this.product.category_id)+' '+newModel;
            },
            'product.category_id': function(newId, oldId) {
                this.product.title =this.product.model + ' ' + this.getCategoryName(newId);
                this.product.html_h1 = this.getManufacturerName(this.product.manufacturer_id) + ' ' + this.product.model + ' ' + this.getCategoryName(newId);
                this.product.html_title = this.getManufacturerName(this.product.manufacturer_id) + ' ' + this.product.model + ' ' + this.getCategoryName(newId);
                this.product.meta_keywords = this.getManufacturerName(this.product.manufacturer_id)+','+this.getCategoryName(newId)+','+this.product.model;
                this.product.meta_description = this.getManufacturerName(this.product.manufacturer_id)+' '+this.getCategoryName(newId)+' '+this.product.model;
            },
            'product.manufacturer_id': function(newId, oldId) {
                this.product.title =this.product.model + ' ' + this.getCategoryName(this.product.category_id);
                this.product.html_h1 = this.getManufacturerName(newId) + ' ' + this.product.model + ' ' + this.getCategoryName(this.product.category_id);
                this.product.html_title = this.getManufacturerName(newId) + ' ' + this.product.model + ' ' + this.getCategoryName(this.product.category_id);
                this.product.meta_keywords = this.getManufacturerName(newId)+','+this.getCategoryName(this.product.category_id)+','+this.product.model;
                this.product.meta_description = this.getManufacturerName(newId)+' '+this.getCategoryName(this.product.category_id)+' '+this.product.model;
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
                axios
                    .get("admin/product/get/status")
                    .then(
                        response => (
                            this.productStatus = response.data
                        )
                    );
                if (this.product_id > 0) {
                    axios
                        .get("admin/product/get/item/"+this.product_id)
                        .then(
                            response => (
                                this.product = response.data
                            )
                        );
                }
            },
            submit() {
                if (this.product_id > 0) {
                    delete this.product.views;
                    axios
                        .put(`/admin/product/${this.product_id}`, {'data' : this.product})
                        .then( response => {
                            console.log(response.data)
                        });
                } else {
                    axios
                        .post(`/admin/product/`, {'data' : this.product})
                        .then( response => {
                            console.log(response.data)
                        });
                }
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
        }

    }
</script>

<style scoped>

</style>