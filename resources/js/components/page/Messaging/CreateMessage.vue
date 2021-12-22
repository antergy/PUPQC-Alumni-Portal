<template>
    <div class="sysconfig">
        <div class="w-full mx-auto mt-4 ml-20 rounded">
            <p class="text-2xl">Create a New Message</p>
            <div class="separator"></div>
            <div class="bg-white w-fullx" style="border-radius: 5px">
                <div class="p-3">
                    <div class="form outline w-full">
                        <div class="form__input-group w-9/12">
                            <label class="form__label" style="font-size: 17px">Select Recipient:</label>
                            <Dropdown
                                :options="aAccounts"
                                v-on:selected="getSelection"
                                :disabled="false"
                                name="recipient"
                                placeholder="Select / Search Recipient"
                                style="padding: 0 !important; margin: 0 !important; font-size: 18px !important;">
                            </Dropdown>
                        </div>
                        <div class="form__input-group w-8/12">
                            <label class="form__label" style="font-size: 17px">Subject:</label>
                            <input id="subject" type="text" class="form__input">
                        </div>
                        <div class="form__input-group w-12/12">
                            <label class="form__label" style="font-size: 17px">Write a message:</label>
                            <vue-editor v-model="content"></vue-editor>
                        </div>
                        <div class="grid grid-flow-col auto-cols-max">
                            <div class="m-1">
                                <button type="button" class="form__button w-full" @click="clearMessageForm"><span style="margin: 5px; font-size: 17px">Clear All</span>&nbsp;</button>
                            </div>
                            <div class="m-1">
                                <button type="button" class="form__button success w-full" @click="sendMessage">&nbsp;<span style="margin: 5px; font-size: 17px">Send</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {VueEditor} from "vue2-editor";
import Dropdown from 'vue-simple-search-dropdown';
export default {
    name: "CreateMessage",
    components: {
        VueEditor,
        Dropdown
    },
    data() {
        return {
            SelectedAccId : 0,
            aAccounts     : [],
            content       : ''
        };
    },
    created() {
        this.$root.setUserInfo();
    },
    mounted() {
        this.getAccounts();
    },
    methods: {

        /**
         * Retrieve accounts to populate dropdown list
         */
        getAccounts: function () {
            let mSelf = this;
            this.$root.getRequest('admin/account/read', (mResult) => {
                if (mResult.code === 200) {
                    let aData = mResult.data;
                    $.each(aData, function (key, value) {
                        mSelf.aAccounts.push({id:value.acc_id, name:value.acc_name});
                    });
                }
            })
        },

        /**
         * Retrieve account selection from dropdown
         */
        getSelection : function () {
            let sName = $('input[name=recipient]').val();
            let mResult = this.aAccounts.filter(function(obj) {
                return (obj.name === sName);
            });
            this.sSelectedAccId = mResult.length !== 0 ? mResult[0].id : 0;
        },

        /**
         * Send message
         */
        sendMessage: function () {
            let oParam = {
                'in_subject'     : $('#subject').val(),
                'in_message'     : this.content,
                'in_acc_id_to'   : this.sSelectedAccId,
            };
            this.$root.postRequest('admin/message/create', oParam, (mResponse) => {
                if (mResponse.code === 200) {
                    this.$root.showSuccessToast('Success', 'Successfully sent a message');
                    this.clearMessageForm();
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            });
        },

        /**
         * Clear the message creation form
         */
        clearMessageForm: function () {
            $('#subject').val('');
            $('input[name=recipient]').val('');
            this.sSelectedAccId = 0;
            this.content = '';
        }
    }
}
</script>

<style scoped>
@import './Inbox.css';
</style>
