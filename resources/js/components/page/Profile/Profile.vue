<template>
    <div class="admin">
        <div class="w-full mx-auto mt-4 ml-20 rounded">
            <p class="text-2xl">My Profile</p>
            <div class="separator"></div>
            <!-- PROFILE FORM  -->
            <div class="form outline">
                <p class="text-2xl">Update Profile Details</p>
                <div class="separator"></div>
                <div class="form__input-group x-lg">
                    <label class="form__label">Account Name</label>
                    <input id="acc_name" type="text" class="form__input" v-model="sName">
                </div>
                <div class="form__input-group x-lg">
                    <label class="form__label">Username</label>
                    <input id="acc_uname" type="text" class="form__input" v-model="sUsername">
                </div>
                <div class="form__input-group x-lg">
                    <label class="form__label">Email</label>
                    <input id="acc_email" type="email" class="form__input" v-model="sEmail">
                </div>
                <div class="form__input-group x-lg">
                    <label class="form__label">Profile Picture (Optional): </label>
                    <input id="cropzee-input" type="file" class="form__input" @click="resetImg()">
                    <br>
                    <div id="img-previewer" class="image-previewer" data-cropzee="cropzee-input"
                         style="max-height: 500px; max-width: 700px;"></div>
                </div>
                <div class="form__input-group w-8/12">
                    <div class="grid grid-flow-col auto-cols-max">
                        <div class="m-1">
                            <button type="button" id="btnClear" class="form__button w-full">&nbsp; &nbsp;
                                Clear Entries&nbsp; &nbsp;
                            </button>
                        </div>
                        <div class="m-1">
                            <button type="button" id="btnSave" class="form__button success w-full">&nbsp;&nbsp;Save&nbsp;Changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="form outline">
                <p class="text-2xl">Change Password</p>
                <div class="separator"></div>
                <div class="form__input-group x-lg">
                    <label class="form__label">Current Password</label>
                    <input id="acc_old_password" type="password" class="form__input">
                </div>
                <div class="form__input-group x-lg">
                    <label class="form__label">New Password</label>
                    <input id="acc_new_password" type="password" class="form__input">
                </div>
                <div class="form__input-group x-lg">
                    <label class="form__label">Confirm Password</label>
                    <input id="acc_confirm_password" type="password" class="form__input">
                </div>
                <div class="form__input-group w-8/12">
                    <div class="grid grid-flow-col auto-cols-max">
                        <div class="m-1">
                            <button type="button" id="btnPassClear" class="form__button w-full">&nbsp; &nbsp;
                                Clear Entries&nbsp; &nbsp;
                            </button>
                        </div>
                        <div class="m-1">
                            <button type="button" id="btnPassSave" class="form__button success w-full">&nbsp;&nbsp;Change Password
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FormEntitiesFunctions from "../../../plugins/Modular/FormEntities/FormEntitiesFunctions";
export default {
    mixins: [
        FormEntitiesFunctions
    ],
    data() {
        return {
            iId            : 0,
            sName          : '',
            sUsername      : '',
            sEmail         : '',
            sPassword      : '',
            sProfilePic    : '',
            iAtId          : '',
            iAccStatus     : '',
            iAssocDegreeId : '',
            iAssocBranchId : ''
        };
    },
    created() {
        this.$root.setUserInfo();
        this.initCropper();
    },
    mounted() {
       this.initPersonalAccDetails();
       this.initEvents();
    },
    methods: {

        initPersonalAccDetails: function () {
            let mSelf = this;
            this.$root.getRequest('getSession', (mResponse) => {
                let oUser = mResponse;
                this.iId = oUser.acc_id;
                this.sName = oUser.acc_name;
                this.sUsername = oUser.acc_username;
                this.sProfilePic = oUser.acc_picture;

                mSelf.$root.getRequest('admin/account/read', (mResponse) => {
                    let oData = mResponse.data[0];
                    mSelf.sEmail = oData.acc_email;
                    mSelf.iAtId = oData.acc_at_id;
                    mSelf.iAccStatus = oData.acc_status;
                    mSelf.iAssocBranchId = oData.acc_assoc_branch_id;
                    mSelf.iAssocDegreeId = oData.acc_assoc_degree_id;
                }, {acc_id : mSelf.iId})
            });
        },

        /** Initialize image cropper */
        initCropper: function () {
            $(document).ready(function(){
                $("#cropzee-input").cropzee({
                    aspectRatio: 1,
                    startSize: [70, 70, '%'],
                    returnImageMode:'data-url'
                });
            });
        },

        /** Reset the img only */
        resetImg: function () {
          $('#cropzee-input').val('');
        },

        /**
         * Initialize element events
         */
        initEvents: function () {
            let mSelf = this;
            $('#btnSave').click(function () {
               mSelf.updateAccount();
            });
            $('#btnClear').click(function () {
                mSelf.resetForm();
            });
            $('#btnCancelPicUpload').click(function () {
                $('#cropzee-input').val('');
                $('#img-previewer').hide();
            });
        },

        /**
         * Resets form for account creation
         */
        resetForm: function () {
            $('#acc_uname').val('');
            $('#acc_new_password').val('');
            $('#acc_confirm_password').val('');
            $('#acc_name').val('');
            $('#acc_email').val('');
            $('#cropzee-input').val('');
            $('#img-previewer').hide();
            window.cropzeeReturnImage = [];
        },

        /**
         * Update account details
         */
        updateAccount: function () {
            let oParam = {
                'acc_id'              : this.iId,
                'acc_username'        : $('#acc_uname').val(),
                'acc_email'           : $('#acc_email').val(),
                'acc_name'            : $('#acc_name').val(),
                'acc_at_id'           : this.iAtId,
                'acc_status'          : this.iAccStatus,
                'acc_assoc_degree_id' : this.iAssocDegreeId,
                'acc_assoc_branch_id' : this.iAssocBranchId
            };
            let profileImg = cropzeeGetImage('cropzee-input');
            if (profileImg !== undefined) {
                oParam = Object.assign(oParam, {'acc_picture' : profileImg});
            }
            this.$root.postRequest('admin/account/update', oParam, (mResponse) => {
                if (mResponse.code === 200) {
                    this.$root.showSuccessToast('Success', 'Successfully updated the account details! Changes will apply after re-logging in');
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            });
        },

    }

}
</script>

<style scoped>
@import './Profile.css';
img {
    max-width: 100%;
}
</style>
