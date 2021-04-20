<template>
  <div 
    @click.stop="redirect()" 
    :class="['item', { dropdown: isDropdown }, { active: isActive }, { 'pl-4': isSub } ]"
  >
    <span v-if="text !== ''" class="item__text">
      {{ text }}
      <font-awesome-icon v-if="isDropdown" far :icon="isToggle ? 'chevron-up' : 'chevron-down'" />
    </span>
    <div v-show="isToggle">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  mounted () {
    if (this.$children.length > 0) {
      this.isDropdown = true
      this.isToggle = this.$children.filter(component => 
        component.isActive || component.isToggle
      ).length > 0;
    }
  },
  computed: {
    isActive () {
      return this.to !== undefined && this.$route.path === this.to;
    },
    isSub () {
      return this.$parent?.$vnode.componentOptions.tag === 'ListItem';
    },
    currentToggle () {
      return this.$children.filter(component => component.isActive || component.isToggle).length > 0
    }
  },
  props: {
    to: {
      type: String,
      default: undefined
    },
    text: {
      type: String,
      default: ''
    }
  },
  data () {
    return {
      isToggle: false,
      isDropdown: false
    }
  },
  watch: {
    'currentToggle': (val) => {
      console.log(val)
    }
  },
  methods: {
    redirect () {
      if (this.to !== '' && 
        this.to !== undefined && 
        this.to !== this.$route.path ) {
        this.$router.push(this.to)
      } else if (
        (this.to === '' || this.to === undefined) &&
        this.isDropdown === true
      ) {
        this.isToggle = !this.isToggle
      }
    }
  }
}
</script>

<style scoped>
@import './ListItem.css';
</style>
