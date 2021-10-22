<template>

</template>

<script>
export default {
    name: "system_entity_modify_modal",
    data() {
        return {
            oModalData : this.$root.oSystemEntityModalData
        }
    },
    watch : {
        oSystemEntityModalData (data) {
          console.log(data)
        }
    },
    methods: {
        initMNodalValue: function () {
            console.log(this.$root.oSystemEntityModalData);
        }
    }
}

</script>

<style scoped>

</style>
