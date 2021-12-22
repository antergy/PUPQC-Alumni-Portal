<template>
    <div class="sysconfig">
        <div class="w-full mx-auto mt-4 ml-20 rounded">
            <p class="text-2xl">Message Details</p>
            <div class="separator"></div>
            <!-- Navbar for page actions -->
            <div class="bg-white w-fullx" style="border-radius: 5px">
                <div class="p-1">
                    <div class="form outline w-full" style="display: flow-root">
                        <a v-if="sMessageType === 'inbox'" type="button" class="form__button default w-2/12" @click="redirectToInbox" style="text-align: center">Back to Inbox&nbsp;</a>
                        <a v-if="sMessageType === 'sent'" type="button" class="form__button default w-2/12" @click="redirectToSent" style="text-align: center">Back to Sent Messages</a>
                        <button type="button" id="btnReply" class="form__button info w-1/12" @click="bToReply = 1">Reply</button>
                        <button v-if="bToReply === 1" type="button" id="btnCancel" class="form__button default w-1/12" @click="clearReply">Cancel</button>
                    </div>
                </div>
            </div>
            <br>
            <!-- Container for create message (If bToReply is equals to 1) -->
            <div v-if="bToReply === 1" class="bg-white w-fullx">
                <div class="p-3">
                    <div class="form outline w-full">
                        <div class="form__input-group w-12/12">
                            <label class="form__label" style="font-size: 17px">Write a message:</label>
                            <vue-editor v-model="content"></vue-editor>
                        </div>
                        <div class="grid grid-flow-col auto-cols-max">
                            <div class="m-1">
                                <button type="button" class="form__button w-full" @click="clearReply"> Clear All&nbsp;</button>
                            </div>
                            <div class="m-1">
                                <button type="button" class="form__button info w-full" @click="sendReply">&nbsp;Send&nbsp;Reply </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container for displaying messages -->
            <div class="bg-white w-fullx" style="border-radius: 5px">
                <div class="p-3">
                    <div class="form outline w-full">
                        <div class="p-2" >
                            <!-- Display subject of main message -->
                            <p style="font-size: 20px"><b>Subject: </b>{{ mMainMsgData.in_subject }}</p><br>
                            <!-- Display message replies if there are replies -->
                            <div v-if="bWithReply === 1">
                                <div style="background-color: #718096; border-radius: 5px; margin-bottom: 20px">
                                    <p class="p-3" style="font-size: 20px; color: white">Replies:</p>
                                </div>
                                <div v-for="mReply in aRepliesData">
                                    <div class="form outline w-full">
                                        <div class="p-3">
                                            <div v-if="sMessageType === 'inbox'">
                                                <p><b>Sender: </b> {{ mReply.sender_username }} <{{
                                                        mReply.sender_email
                                                    }}> </p>
                                                <p><b>Full Sender's Name: </b>{{ mReply.sender_name }}</p>
                                                <p><b>Date and Time Received: </b>{{ mReply.created_at }}</p>
                                            </div>
                                            <div v-if="sMessageType === 'sent'">
                                                <p><b>Sender: </b> {{ mReply.sender_username }} <{{
                                                        mReply.sender_email
                                                    }}> </p>
                                                <p><b>Full Sender's Name: </b>{{ mReply.sender_name }}</p>
                                                <p><b>Receiver: </b> {{ mReply.receiver_username }}
                                                    <{{ mReply.receiver_email }}> </p>
                                                <p><b>Full Receiver's Name: </b>{{ mReply.receiver_name }}</p>
                                                <p><b>Date and Time Sent: </b>{{ mReply.created_at }}</p>
                                            </div>
                                            <br>
                                            <hr>
                                            <br>
                                            <vue-editor
                                                v-model="mReply.in_message"
                                                :disabled="true"
                                            >
                                            </vue-editor>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="separator"></div>
                            <!-- Display original message if the message has replies -->
                            <div v-if="bWithReply === 1" style="background-color: #718096; border-radius: 5px; margin-bottom: 10px">
                                <p class="p-3" style="font-size: 20px; color: white">Original Message:</p>
                            </div>
                            <!-- Display the following main message's details if message type is inbox -->
                            <div v-if="sMessageType === 'inbox'">
                                <p><b>Sender's Username: </b> {{ mMainMsgData.sender_username }}</p>
                                <p><b>Sender's Full Name: </b>{{ mMainMsgData.sender_name }}</p>
                                <p><b>Sender's Personal Email: </b>{{ mMainMsgData.sender_email }}</p>
                                <p><b>Date and Time Received: </b>{{ mMainMsgData.created_at }}</p>
                            </div>
                            <!-- Display the following main message's details if message type is sent -->
                            <div v-if="sMessageType === 'sent'">
                                <p><b>Full Receiver's Name: </b>{{ mMainMsgData.receiver_name }}</p>
                                <p><b>Receiver's Username: </b> {{ mMainMsgData.receiver_username }}</p>
                                <p><b>Receiver's Full Name: </b>{{ mMainMsgData.receiver_name }}</p>
                                <p><b>Receiver's Personal Email: </b>{{ mMainMsgData.receiver_email }}</p>
                                <p><b>Date and Time Sent: </b>{{ mMainMsgData.created_at }}</p>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <vue-editor
                                v-model="mMainMsgData.in_message"
                                :disabled="true"
                            >
                            </vue-editor>
                            <div v-if="bWithOrigMsg === 1" style="background-color: #718096; border-radius: 5px; margin-top: 15px; margin-bottom: 10px">
                                <p class="p-3" style="font-size: 20px; color: white">Original Message:</p>
                            </div>
                            <!-- Display original message if the main message is a reply -->
                            <div v-if="bWithOrigMsg === 1">
                                <!-- Display the following original message's details if message type is inbox -->
                                <div v-if="sMessageType === 'inbox'">
                                    <p><b>Sender's Username: </b> {{ mOrigMsgData.sender_username }}</p>
                                    <p><b>Sender's Full Name: </b>{{ mOrigMsgData.sender_name }}</p>
                                    <p><b>Sender's Personal Email: </b>{{ mOrigMsgData.sender_email }}</p>
                                    <p><b>Date and Time Received: </b>{{ mOrigMsgData.created_at }}</p>
                                </div>
                                <!-- Display the following original message's details if message type is sent -->
                                <div v-if="sMessageType === 'sent'">
                                    <p><b>Full Receiver's Name: </b>{{ mOrigMsgData.receiver_name }}</p>
                                    <p><b>Receiver's Username: </b> {{ mOrigMsgData.receiver_username }}</p>
                                    <p><b>Receiver's Full Name: </b>{{ mOrigMsgData.receiver_name }}</p>
                                    <p><b>Receiver's Personal Email: </b>{{ mOrigMsgData.receiver_email }}</p>
                                    <p><b>Date and Time Sent: </b>{{ mOrigMsgData.created_at }}</p>
                                </div>
                                <br>
                                <hr>
                                <br>
                                <vue-editor
                                    v-model="mOrigMsgData.in_message"
                                    :disabled="true"
                                >
                                </vue-editor>
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
export default {
    name: "InboxDetails",
    components: {
        VueEditor
    },
    data() {
        return {
            mMainMsgData : [],
            mOrigMsgData : [],
            aRepliesData : [],
            bWithReply   : 0,
            bWithOrigMsg : 0,
            bToReply     : 0,
            content      : '',
            sMessageType : '',
        };
    },
    created() {
        this.$root.setUserInfo();
        this.getMessageType();
    },
    mounted() {
        /** Hide the toolbar for displaying dynamic content */
        $('.ql-toolbar').hide();
        let mSelf = this;
        /** Set a 1 second delay before retrieving the message details */
        setTimeout(function () {
            mSelf.getMsgId();
        }, 1000);
    },
    methods: {

        /**
         * Get URL parameters
         */
        getUrlParameter: function (sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
            return false;
        },

        /**
         * Get message type if "inbox" or "sent"
         */
        getMessageType: function () {
            var sMessageType = window.location.pathname.split('/')[2];
            if (sMessageType === 'inbox' || sMessageType === 'sent') {
                this.sMessageType = sMessageType;
            } else {
                this.$root.showErrorToast('Error', "Something went wrong; <br>You will now be redirected to message inbox page");
                window.location = '/message/inbox';
            }
        },

        /**
         * Get message id from the url
         */
        getMsgId: function () {
            let iMsgId = this.getUrlParameter('msgId');
            let bValid = Number.isInteger(parseInt(iMsgId));
            if (bValid === false) {
               this.redirectError('Invalid Parameters')
            } else {
                this.getMainMsg(iMsgId);
            }
        },

        /**
         * Manage error redirection
         */
        redirectError: function (sCustomMsg) {
            let mSelf = this;
            let sDefMsg = this.sMessageType === 'inbox'  ? '; Redirecting to inbox page...' : '; Redirecting to sent page...';
            let sMessage = sCustomMsg + sDefMsg;
            this.$root.showErrorToast('Error', sMessage);
            /** Set 2 seconds delay before redirection */
            setTimeout(function () {
               mSelf.sMessageType === 'inbox' ? mSelf.redirectToInbox() : mSelf.redirectToSent();
            }, 2000);
        },

        /**
         * Redirects to message inbox page
         */
        redirectToInbox: function () {
            window.location = '/message/inbox';
        },

        /**
         * Redirects to sent messages page
         */
        redirectToSent: function () {
            window.location = '/message/sent';
        },

        /**
         * Get main message details
         */
        getMainMsg: function (iMsgId) {
            this.$root.getRequest('admin/message/read', (mResponse) => {
                if (mResponse.code === 200) {
                    let mData = mResponse.data[0];
                    let iAccIdentifier = this.sMessageType === 'inbox' ? mData.in_acc_id_to : mData.in_acc_id_from;
                    if (mData === []) {
                        this.redirectError("Message doesn't exist");
                    } else if (this.$root.sRootUserId !== parseInt(iAccIdentifier)) {
                        this.redirectError("Permission Invalid");
                    } else {
                        this.mMainMsgData = mData;
                        this.getReplies(iMsgId);
                        if (mData.in_is_reply === 1) { // Check if the main message is a reply
                            /** Retrieve original message */
                            this.getOriginalMessage(mData.in_inbox_id);
                        }
                    }
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            }, { in_id : iMsgId});
        },

        /**
         * Send a reply message
         */
        sendReply: function () {
            let iAccIdentifier = this.sMessageType === 'inbox' ? this.mMainMsgData.in_acc_id_from : this.mMainMsgData.in_acc_id_tom;
            let oParam = {
                'in_subject'   : this.mMainMsgData.in_subject,
                'in_message'   : this.content,
                'in_acc_id_to' : iAccIdentifier,
                'in_is_reply'  : 1,
                'in_inbox_id'  : this.mMainMsgData.in_id
            };
            this.$root.postRequest('admin/message/create', oParam, (mResponse) => {
                if (mResponse.code === 200) {
                    this.$root.showSuccessToast('Success', 'Successfully sent your reply');
                    this.clearReply();
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            });
        },

        /**
         * Clears the reply (In the message creation container)
         */
        clearReply: function () {
            this.bToReply = 0;
            this.content = '';
        },

        /**
         * Retrieves original message details
         * @param iMsgId
         */
        getOriginalMessage: function (iMsgId) {
            this.$root.getRequest('admin/message/read', (mResponse) => {
                if (mResponse.code === 200) {
                    this.mOrigMsgData = mResponse.data[0];
                    this.bWithOrigMsg = 1;
                    /** Set 1 second delay before hiding toolbar */
                    setTimeout(function () {
                        $('.ql-toolbar').hide();
                    }, 10);
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            }, { in_id : iMsgId});
        },

        /**
         * Retrieves all message replies
         */
        getReplies: function (iMsgId) {
            this.$root.getRequest('admin/message/read', (mResponse) => {
                if (mResponse.code === 200) {
                    let mData = mResponse.data;
                    if (mData.length !== 0) {
                        this.bWithReply = 1;
                        this.aRepliesData.push(mData[0]);
                        this.getReplies(mData[0].in_id);
                        /** Set 1 second delay before hiding toolbar */
                        setTimeout(function () {
                            $('.ql-toolbar').hide();
                        }, 10);
                    }
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            }, {in_inbox_id: iMsgId});
        },
    }
}
</script>
<style>
@import './Inbox.css';
</style>
