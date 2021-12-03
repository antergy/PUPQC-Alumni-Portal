<template>
  <div class="admin">
      <div class="w-full mx-auto mt-4 ml-20 rounded">
          <p class="text-2xl">Tracer Form Management</p>
          <div class="separator"></div>
          <!-- Tab Contents -->
          <div class="bg-white w-full">
              < Insert Table Here >
          </div>
      </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
        };
    },
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
@import './Admin.css';
</style>
