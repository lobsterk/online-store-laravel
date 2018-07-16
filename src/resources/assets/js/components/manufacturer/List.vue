<template>
    <div>
        <v-card>
            <v-card-title>
                <v-btn fab dark small color="pink"  @click="new_record=!new_record">
                    <v-icon dark>add</v-icon>
                </v-btn>
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

        <v-data-table
                :headers="table_headers"
                :items="manufacturers"
                :search="search"
                class="elevation-1"
                rowsPerPageText="Строк на странице"
        >
            <template slot="items" slot-scope="props">
                <td class="text-xs-left">{{ props.item.title }}</td>
            </template>
            <v-alert slot="no-results" :value="true" color="error" icon="warning">
                По запросу "{{ search }}" ничего не найдено.
            </v-alert>
        </v-data-table>

        <v-layout row justify-center>
            <v-dialog v-model="new_record" persistent max-width="290">
                <v-card>
                    <v-card-title class="headline">Добавить нового производителя</v-card-title>
                    <v-card-text>
                        <v-form ref="form" v-model="valid" lazy-validation>
                            <v-text-field
                                    v-model="title"
                                    label="Производитель"
                                    required
                            ></v-text-field>

                            <v-btn @click="submit" > Сохранить </v-btn>
                            <v-btn @click="new_record=!new_record">Закрыть</v-btn>
                        </v-form>
                    </v-card-text>

                </v-card>
            </v-dialog>
        </v-layout>
    </div>
</template>

<script>
    export default {
        name: "List",
        data() {
            return {
                search: '',
                manufacturers: [],
                table_headers: [
                    { text: 'Производитель', value: 'title' },
                ],
                valid: true,
                title: '',
                new_record: false
            }
        },
        created() {
            this.init();
            console.log('manufacturer');

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
            submit () {
                console.log('Submit form');
                if (this.$refs.form.validate()) {
                    axios
                        .post('/admin/manufacturers', {
                        title: this.title,
                        })
                        .then(
                            response => (
                               console.log(response.data)
                            )
                        );
                    this.init();
                    this.new_record = !this.new_record;
                }
            },
            clear () {
                this.$refs.form.reset()
            }
        }
    }
</script>

<style scoped>

</style>