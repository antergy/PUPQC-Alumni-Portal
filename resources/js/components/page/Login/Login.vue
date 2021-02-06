<template>
  <div class="login">
    <div class="login__panel">
      <div class="login__header">
        <label class="login__header-label">PUPQC Alumni Portal</label>
      </div>
      <div class="login__content">
        <div class="login__container">
          <label class="login__label">LOGIN</label>
          <div class="login__input-group">
            <label class="login__label">Username</label>
            <input type="text" placeholder="Username" class="login__input" v-model="username">
          </div>
          <div class="login__input-group">
            <label class="login__label">Password</label>
            <input type="password" placeholder="Password" class="login__input" v-model="password">
          </div>
        </div>
        <button class="login__button" @click="doLogin()">LOGIN</button>
      </div>
      <div class="login__footer">
        <label class="login__footer-label">Developed by: ANTERGY | All rights reserved</label>
      </div>
    </div>
  </div>
</template>

<script lang="js">
export default {
  data() {
    return {
      username: '',
      password: '',
      valid: true
    }
  },
  methods: {
    doLogin () {
      this.$router.push('/home')
    }
  }
}
</script>

<style scoped>
@import './Login.css';
</style>