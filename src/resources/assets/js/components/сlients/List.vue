<template>
    <div>
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
        <v-data-table
                :headers="table_headers"
                :items="clients"
                :search="search"
                class="elevation-1"
        >
            <template slot="items" slot-scope="props">
                <td class="text-xs-left">{{ props.item.name }}</td>
                <td class="text-xs-left">{{ props.item.surname }}</td>
                <td class="text-xs-left">{{ props.item.patronymic }}</td>
                <td class="text-xs-left">{{ props.item.email }}</td>
                <td class="text-xs-left">{{ props.item.phone }}</td>
                <td class="text-xs-left">{{ props.item.last_login }}</td>
            </template>
            <v-alert slot="no-results" :value="true" color="error" icon="warning">
                По запросу "{{ search }}" ничего не найдено.
            </v-alert>
        </v-data-table>
    </div>
</template>

<script>
    export default {
        name: "List",
        data() {
            return {
                clients: [],
                search : '',
                table_header: "Клиенты",
                table_headers: [
                    { text: 'Имя', value: 'name' },
                    { text: 'Фамилия', value: 'surname' },
                    { text: 'Отчество', value: 'patronymic' },
                    { text: 'Email', value: 'email' },
                    { text: 'Телефон', value: 'phone' },
                    { text: 'Посл. вход', value: 'last_login' }
                ],
            }
        },
        created() {
            this.init();
        },
        methods: {
            init() {
                axios
                .get("/admin/clients/")
                .then(
                    response => (
                            this.clients = response.data
                    )
                );
            }
        }

    }
</script>

<style scoped>

</style>