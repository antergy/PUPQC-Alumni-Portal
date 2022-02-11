<template>
        <div class="login">
           <div style="width: 100%; height: 100%; display: flex;">
               <div style="width: 70%; display: inline-block; box-shadow: 5px 10px 8px #888888; background-color: #ffffff">
                   <img src="/img/wallpaper.jpg" style="width: 100%; height: 100%"/>
               </div>
               <div style="width: 30%; display: inline-block; text-align: left; background-color: #lightgrey;">
                   <div class="login__panel" style="width: 60%; margin-left: 20%; margin-top: 15%">
                       <div class="login__header">
                           <label class="login__header-label">Login</label>
                       </div>
                       <div class="login__content">
                           <div class="login__container">
                               <div class="login__input-group">
                                   <label class="login__label">Username</label>
                                   <input type="text" placeholder="Username" class="login__input" v-model="username"
                                          id="username">
                               </div>
                               <div class="login__input-group">
                                   <label class="login__label">Password</label>
                                   <input type="password" placeholder="Password" class="login__input" v-model="password"
                                          id="password">
                               </div>
                           </div>
                           <button class="login__button" @click="doLogin()">LOGIN</button>
                       </div>
                       <div class="login__footer">
<!--                           <label class="login__footer-label">Developed by: ANTERGY | All rights reserved</label>-->
                       </div>
                   </div>
                   <div style="display: flex; justify-content: center; margin-top: 5%;">
                       <img id="buffer_img" src="/img/loading-buffering.gif" style="width: 70px; height: 70px; display: none">
                   </div>
                   <div style="margin: 5%">
                       <p style="text-align: center">Are you an alumni and don't have an account?<br>
                           Register now by creating an account so you can be updated to the latest happenings of your <br> alma matter!</p>
                       <br>
                       <button class="login__button" @click="$root.redirect('register')">Register Now</button>
                   </div>
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
    this.$root.sLayout = 'custom'
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
           $('#buffer_img').css('display', '');
           let oParam = {
               username : sUsername,
               password : sPassword
           };
           let mSelf = this;
           this.$root.postRequest('login', oParam, (mResponse) => {
               let sMessage = mResponse.message
               if (mResponse.bResult === true) {
                   $('#buffer_img').css('display', 'none');
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
                   $('#buffer_img').css('display', 'none');
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
