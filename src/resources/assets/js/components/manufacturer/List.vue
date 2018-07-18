<template>
    <div>
        <v-toolbar flat color="white">
            <v-toolbar-title>Manufacturers</v-toolbar-title>
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
                                    <v-text-field v-model="editedItem.title" label="Manufacturer"></v-text-field>
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
                :items="manufacturers"
                hide-actions
                class="elevation-1"
        >
            <template slot="items" slot-scope="props">
                <td>{{ props.item.title }}</td>
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
                <v-btn color="primary" @click="init">Reset</v-btn>
            </template>
        </v-data-table>
    </div>
</template>

<script>
    export default {
        name: "List",
        data() {
            return {
                search: '',
                manufacturers: [],

                valid: true,
                title: '',
                new_record: false,

                dialog: false,
                headers: [
                    { text: 'Title', value: 'title' },
                ],
                desserts: [],
                editedIndex: -1,
                editedItem: {
                    title: '',
                },
                defaultItem: {
                    title: '',
                }
            }
        },
        created() {
            this.init();
        },
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
        methods: {
            init() {
                this.manufacturers = [];
                axios
                    .get("/admin/manufacturers/")
                    .then(
                        response => (
                            this.manufacturers = response.data
                        )
                    );
            },
            /*submit() {
                console.log('Submit form');
                if (this.$refs.form.validate()) {
                    axios
                        .post('/admin/manufacturers', {
                            title: this.title,
                        })
                        .then(
                            response
                        );

                    this.new_record = !this.new_record;
                }
            },*/
            clear() {
                this.$refs.form.reset()
            },

            editItem(item) {
                this.editedIndex = this.manufacturers.indexOf(item);
                this.editedItem = Object.assign({}, item);
                this.dialog = true;
            },

            deleteItem(item) {
                const index = this.manufacturers.indexOf(item);
                if (confirm('Are you sure you want to delete this item?')) {
                    axios.post(`/admin/manufacturers/${item.id}`, { '_method' : 'DELETE' });

                    this.manufacturers.splice(index, 1);
                }
            },

            close() {
                this.dialog = false;
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem);
                    this.editedIndex = -1;
                }, 300)
            },

            save() {
                if (this.editedIndex > -1) {
                    Object.assign(this.manufacturers[this.editedIndex], this.editedItem);
                } else {
                    this.manufacturers.push(this.editedItem);
                }
                this.close();
            }
        }
    }
</script>

<style scoped>

</style>