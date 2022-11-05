<template>
    <div class="login">
        <div style="width: 100%; height: 100%; display: flex;">
            <div style="width: 70%; display: inline-block; box-shadow: 5px 10px 8px #888888; background-color: #ffffff; background-image: url('/img/wallpaper.jpg'); background-size: cover;">
                <div style="margin-top: 30%; width: 100%; height: 40%; background-color: #e2e8f0; display: flex; opacity: 0.9">
<!--                    <div style="width: 50%;">-->
<!--                        <p style="text-align: center; margin: 10%; font-size: 17px">Are you an alumni and don't have an account?<br>-->
<!--                            Register now by creating an account <br>-->
<!--                            so you can be updated to the latest <br>-->
<!--                            happenings of your alma mater!-->
<!--                            <br><br>-->
<!--                            <button class="form__button success w-4/12;" @click="$root.redirect('register')">Register Now</button>-->
<!--                        </p>-->
<!--                    </div>-->
<!--                    <div style="width: 50%;">-->
<!--                        <p style="text-align: center; margin: 10%; font-size: 17px">-->
<!--                            Test Tracer Sign Up-->
<!--                            <br><br>-->
<!--                            <button class="form__button success w-4/12;" @click="signUpGoogleForm">Test Tracer Google Sign Up</button>-->
<!--                        </p>-->
<!--                    </div>-->
                    <div style="width: 100%">
                        <p style="text-align: center; margin: 10%; font-size: 17px">Also, we want to hear more about your current whereabouts and
                            achievements after you graduated from us,
                            so if you want to share your details with us, please access our alumni tracer form!
                        <br><br>
                        <button class="form__button success w-4/12;" @click="signUpGoogleForm">Go to Tracer</button>
                        </p>
                    </div>
                </div>
            </div>
            <div style="width: 30%; display: inline-block; text-align: left; background-color: #lightgrey;">
                <div class="login__panel" style="width: 60%; margin-left: 20%; margin-top: 25%">
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
                           <p style="text-align: center">or<br>
                           Login using your Google account</p>
                           <button class="login__button" style="background-color: #3085d6; margin-top: 10px" @click="doGoogleLogin">Login using Google</button>
                       </div>
                    <div class="login__footer">
                    </div>
                </div>
                <br><br>
                <div class="login__footer">
                    <label class="login__footer-label">Copyright 2022 | All rights reserved</label>
                </div>
                <div style="display: flex; justify-content: center; margin-top: 5%;">
                    <img id="buffer_img" src="/img/loading-buffering.gif"
                         style="width: 70px; height: 70px; display: none">
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
        doGoogleLogin: function () {
            this.$root.getRequest('loginGoogle', (mResponse) => {
                console.log(mResponse);
                if (mResponse.bResult === true) {
                    console.log(mResponse);
                    // if (sLogType === 'home') {
                    //     window.location.href = 'home';
                    // } else {
                    //     window.location.href = 'tracerIntro';
                    // }
                } else {
                    window.location.href = mResponse.data.url;
                }
            });
        },

        signUpGoogleForm: function () {
            this.$root.getRequest('signUpGoogleByForm', (mResponse) => {
                console.log(mResponse);
                if (mResponse.bResult === true) {
                    console.log(mResponse);
                    // if (sLogType === 'home') {
                    //     window.location.href = 'home';
                    // } else {
                    //     window.location.href = 'tracerIntro';
                    // }
                } else {
                    window.location.href = mResponse.data.url;
                }
            });
        },

        doLogin: function () {
            var sUsername = $('#username').val();
            var sPassword = $('#password').val();

            if (sUsername === '') {
                this.$root.showErrorToast('Error', 'Username is empty', 'slow');
            } else if (sPassword === '') {
                this.$root.showErrorToast('Error', 'Password is empty', 'slow');
            } else {
                $('#buffer_img').css('display', '');
                let oParam = {
                    username: sUsername,
                    password: sPassword
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
