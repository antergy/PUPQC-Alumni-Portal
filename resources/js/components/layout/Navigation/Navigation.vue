<template>
  <div class="navigation">
    <div class="navigation__container">
      <span class="navigation__title">PUPQC Alumni Portal</span>
    </div>
    <div class="navigation__container mr-20">
      <div class="navigation__item">
        <button 
          @click="currentTab = 'Home'" 
          :class="['navigation__button', { active: currentTab === 'Home' }]"
        >
          <font-awesome-icon fas icon="home" />
        </button>
      </div>
      <div class="navigation__item">
        <button 
          @click="currentTab = 'Profile'" 
          :class="['navigation__button', { active: currentTab === 'Profile' }]"
        >
          <font-awesome-icon fas icon="user" />
        </button>
      </div>
      <div class="navigation__item">
        <button 
          @click="currentTab = 'Logout'" 
          :class="['navigation__button', { active: currentTab === 'Logout' }]"
        >
          <font-awesome-icon fas icon="sign-out-alt" />
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted () {
    this.currentTab = this.$route.name
  },
  data () {
    return {
      currentTab: 'Home'
    }
  }
}
</script>

<style scoped>
@import './Navigation.css';
</style>