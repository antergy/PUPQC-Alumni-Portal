<template>
  <component :is="layout === '' ? 'default' : layout"></component>
</template>

<script>
export default {
  props: {
    layout: {
      type: String,
      default: 'default'
    }
  }
}
</script>