<template>
    <div>
        <v-data-table
                :headers="headers"
                :items="clients"
                hide-actions
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
        </v-data-table>
    </div>
</template>

<script>
    export default {
        name: "List",
        data() {
            return {
                clients: {},
                headers: [
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