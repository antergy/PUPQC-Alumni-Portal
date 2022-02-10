<template>
    <div class="sysconfig">
        <div class="w-full mx-auto mt-4 ml-20 rounded">
            <p class="text-2xl">Alumni Tracer Study</p>
            <div class="separator"></div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "AlumniTracerStudy",
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
    .charts .charts-object {
        text-align: -webkit-center;
        margin-top: 10px;
    }
    .charts .charts-label {
        font-weight: bold;
        font-size: 20px;
    }
</style>
