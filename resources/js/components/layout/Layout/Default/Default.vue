<template>
  <div class="layout">
    <Navigation class="layout-header" />
    <div class="layout-content">
      <Sidebar />
      <router-view />
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>
@import './default.css';
</style>
