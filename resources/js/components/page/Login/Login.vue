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
            <input type="text" placeholder="Username" class="login__input" v-model="username" id="username">
          </div>
          <div class="login__input-group">
            <label class="login__label">Password</label>
            <input type="password" placeholder="Password" class="login__input" v-model="password" id="password">
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
  created() {
    this.$root.sLayout = 'clean'
  },
  methods: {
    doLogin: function () {
       var sUsername =  $('#username').val();
       var sPassword =  $('#password').val();

       if (sUsername === '') {
           this.$root.showErrorToast('Error', 'Username is empty', 'slow');
       } else if (sPassword === '') {
           this.$root.showErrorToast('Error', 'Password is empty', 'slow');
       } else {
           let oParam = {
               username : sUsername,
               password : sPassword
           };
           let mSelf = this;
           this.$root.postRequest('login', oParam, (mResponse) => {
               let sMessage = mResponse.message
               if (mResponse.bResult === true) {
                   mSelf.$root.showSuccessToast('Success', sMessage, 'slow');
                   let sUser = mResponse.data;
                   mSelf.$root.sRootUserId = sUser.acc_id;
                   mSelf.$root.sRootUsername = sUser.acc_username;
                   mSelf.$root.sRootFullname = sUser.acc_name;
                   mSelf.$root.sRootAccPos = sUser.at_desc;
                   mSelf.$root.sRootUserkey = sUser.user_app_key;
                   mSelf.$root.sRootUserProfPic = sUser.acc_picture;
                   this.$router.push('/home');
               } else {
                   mSelf.$root.showErrorToast('Error', sMessage, 'slow');
               }
           });
       }
    }
  }
}
</script>

<style scoped>
@import './Login.css';
</style>
