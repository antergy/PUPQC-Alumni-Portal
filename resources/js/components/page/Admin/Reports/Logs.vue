<template>
    <div class="sysconfig">
        <div class="w-full mx-auto mt-4 ml-20 rounded">
            <p class="text-2xl">System Logs</p>
            <div class="separator"></div>

        </div>
    </div>
</template>
<script>
    export default {
        name: "Logs",
        created() {
            this.$root.setUserInfo();
        },
        mounted() {
        },
        methods: {

        }
    }
</script>

<style scoped>
    @import './reports.css';
</style>
