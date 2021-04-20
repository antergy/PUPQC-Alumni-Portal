
require('./bootstrap');

import Vue from 'vue'
import vueRouter from './plugins/router'
import uiKit from './plugins/uiKit'
import './plugins/fontawesome'
import "tailwindcss/tailwind.css"

const app = new Vue({
    el: '#app',
    router: vueRouter.router,
    data : {
        oToast    : null,
        sRootUserId   : '',
        sRootUsername : '',
        sRootFullname : '',
        sRootAccPos   : '',
        sRootUserkey  : '',
        sRootUserProfPic : '',
        sLayout: ''
    },
    created(){
        uiKit()
        this.oToast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 2000
        });
    },
    methods: {

        /**
         * Sets user info
         * (Retrieved from session)
         */
        setUserInfo: function () {
            this.getRequest('getSession', (mResponse) => {
                let sUser = mResponse;
                this.sRootUserId = sUser.acc_id;
                this.sRootUsername = sUser.acc_username;
                this.sRootFullname = sUser.acc_name;
                this.sRootAccPos = sUser.at_desc;
                this.sRootUserkey = sUser.user_app_key;
                this.sRootUserProfPic = sUser.acc_picture;
            });
            this.$forceUpdate();
        },

        /**
         * Axios GET request
         *
         * @param sUrl  string
         * @param mThen mixed
         * @param oParam mixed
         */
        getRequest: function (sUrl, mThen, oParam = []) {
            sUrl = '/' + sUrl;
            return new Promise((mResolve) => {
                axios({
                    method: 'get',
                    url   : sUrl,
                    params: oParam
                })
                    .then((oResponse) => {
                        mThen(oResponse.data);
                    })
                    .catch(this.catchRequest);
                mResolve();
            });
        },

        /**
         * Axios POST request
         *
         * @param sUrl   string
         * @param oParam object
         * @param mThen  mixed
         * @return {Promise<any>}
         */
        postRequest: function (sUrl, oParam, mThen) {
            let oHeaders = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            };
            sUrl = '/' + sUrl;
            return new Promise((mResolve) => {
                axios.post(sUrl, oParam, {headers: oHeaders})
                    .then((oResponse) => {
                        mThen(oResponse.data);
                    })
                    .catch(this.catchRequest);
                mResolve();
            });
        },

        /**
         * Show success toast
         * @param sTitle   string
         * @param sMessage string
         */
        showSuccessToast : function(sTitle, sMessage) {
            this.fireToast(sTitle, sMessage, 'success');
        },

        /**
         * Show error toast
         * @param sTitle   string
         * @param sMessage string
         */
        showErrorToast : function(sTitle, sMessage) {
            this.fireToast(sTitle, sMessage, 'error');
        },

        /**
         *
         * @param sTitle
         * @param sMessage
         * @param sType
         * @param sTransitionSpeed
         */
        fireToast : function (sTitle, sMessage, sType, sTransitionSpeed) {
            let sHtml = '<h1 id="swal2-title" class="swal2-title" style="text-align: left; font-weight: bold">' + sTitle + '</h1>' +
                '<p style="text-align: left; margin-left: 10px">' + sMessage + '</p>';
            this.oToast.fire({
                icon: sType,
                html: sHtml,
                customClass: {
                    popup: 'toast__popup',
                    header: 'toast__header',
                    title: 'toast__title toast__content--title',
                    content: 'toast__content toast__content--' + sType,
                    icon: 'toast__icon',
                },
                showClass: {
                    popup: 'toast__popup fadeInDown animated ' + sTransitionSpeed,
                    icon: 'flipInX animated'
                },
                hideClass: {
                    popup: 'toast__popup fadeOutUp animated ' + sTransitionSpeed,
                }
            });
        },
    }
});
