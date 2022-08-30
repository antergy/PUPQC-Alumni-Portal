<template>
    <div class="profile">
        <div class="form outline">
            <span class="form__title">Create Account</span>
            <span class="form__subtitle">Enter your account details:</span>
            <br>
            <div>
                <div class="form__input-group xx-lg">
                    <label class="form__label">Username</label>
                    <input id="acc_uname" type="text" class="form__input">
                </div>

                <div class="form__input-group xx-lg">
                    <label class="form__label">Account Name</label>
                    <input id="acc_name" type="text" class="form__input">
                </div>

                <div class="form__input-group xx-lg">
                    <label class="form__label">Email Address</label>
                    <input id="acc_email" type="email" class="form__input">
                </div>

                <div class="form__input-group xx-lg">
                    <label class="form__label">Campus/Branch Graduated From: (Latest)</label>
                    <select id="acc_branch" name="branch" class="form__input">
                        <option selected disabled value="0">-- Select Campus/Branch --</option>
                        <option value="1">PUP Main Campus</option>
                        <option value="5">PUP Quezon City</option>
                    </select>
                </div>
                <div class="form__input-group xx-lg">
                    <label class="form__label">Password</label>
                    <input id="acc_password" type="password" class="form__input">
                </div>

                <div class="form__input-group xx-lg">
                    <label class="form__label">Confirm Password</label>
                    <input id="acc_conf_password" type="password" class="form__input">
                </div>

<!--                <div class="form__input-group xx-lg">-->
<!--                    <label class="form__label">Profile Picture</label>-->
<!--                    <input type="file" class="form__input"/>-->
<!--                </div>-->
                <br>
                <div class="form__input-group">
                    <div class="grid grid-flow-col auto-cols-max place-self-center">
                        <div class="m-1">
                            <button type="button" id="btnClear" class="form__button w-full place-self-center">Clear All Entries</button>
                        </div>
                        <div class="m-1">
                            <button type="button" id="btnCancel" class="form__button danger w-full place-self-center">Cancel</button>
                        </div>
                        <div class="m-1">
                            <button type="button" id="btnSave" class="form__button success w-full place-self-center" @click="">Create Account</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="js">
export default {
    data() {
        return {}
    },
    created() {
        this.$root.sLayout = 'custom'
    },
    mounted() {
        this.initEvents();
    },
    methods: {
        /**
         * Initialize events
         */
        initEvents: function () {
            let mSelf = this;
            $('#btnSave').click(function () {
                mSelf.createAccount();
            });
            $('#btnClear').click(function () {
                mSelf.resetForm();
            });
            $('#btnCancel').click(function () {
                mSelf.cancelRegister();
            });
        },

        /**
         * Create account
         * - Saves to DB
         */
        createAccount: function () {
            let mSelf = this;
            let oParam = {
                'acc_username'        : $('#acc_uname').val(),
                'acc_password'        : $('#acc_password').val(),
                'acc_name'            : $('#acc_name').val(),
                'acc_email'           : $('#acc_email').val(),
                'acc_at_id'           : 2,
                'acc_status'          : 2,
                'acc_assoc_degree_id' : 1,
                'acc_assoc_branch_id' : parseInt($('#acc_branch').val())
            };
            this.$root.postRequest('alumni/account/create', oParam, (mResponse) => {
                if (mResponse.code === 200) {
                    this.$root.showSuccessToast('Success', 'Successfully registered an account');
                    mSelf.resetForm();
                    this.$root.redirect('tracerIntro');
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            });
        },

        cancelRegister: function () {
            this.resetForm();
            this.$root.redirect('');
        },

        /**
         * Resets form
         */
        resetForm: function () {
            $('#acc_uname').val('');
            $('#acc_password').val('');
            $('#acc_conf_password').val('');
            $('#acc_name').val('');
            $('#acc_email').val('');
            $('#acc_branch').val(0)
        }
    }
}
</script>

<style scoped>
@import './Registration.css';
</style>
