<template>
  <div class="list">
    <label v-if="title !== ''" class="list__title">{{ title }}</label>
    <slot></slot>
  </div>
</template>

<script>
export default {
  props: {
    title:{
      type: String,
      default: ''
    }
  }
}
</script>

<style>
@import './List.css';
</style>
