<template>
    <div class="container">
       {{ message }}
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
               message: 'Привет'
            };

        }
    }
</script>
