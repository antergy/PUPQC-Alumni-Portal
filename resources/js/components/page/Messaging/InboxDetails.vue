<template>
    <div class="sysconfig">
        <div class="w-full mx-auto mt-4 ml-20 rounded">
            <p class="text-2xl">Message Details</p>
            <div class="separator"></div>
            <!-- TABLE -->
            <div class="bg-white w-fullx" style="border-radius: 5px">
                <div class="p-1">
                    <div class="form outline w-full" style="display: flow-root">
                        <a v-if="sMessageType === 'inbox'" type="button" class="form__button default w-2/12" @click="redirectToInbox"><< Back to Inbox&nbsp;</a>
                        <a v-if="sMessageType === 'sent'" type="button" class="form__button default w-2/12" @click="redirectToSent"><< Back to Sent Messages&nbsp;</a>
                        <button type="button" id="btnReply" class="form__button info w-1/12" @click="reply">Reply >></button>
                    </div>
                </div>
            </div>
            <br>
            <div class="bg-white w-fullx" style="border-radius: 5px">
                <div class="p-3">
                    <div class="form outline w-full">
                       <div class="p-2">
                           <p style="font-size: 20px"><b>Subject: </b>{{ mMainMsgData.in_subject }}</p><br>
                           <p><b>Sender: </b> {{ mMainMsgData.sender_username }} <{{ mMainMsgData.sender_email }}> </p>
                           <p><b>Full Sender's Name: </b>{{ mMainMsgData.sender_name }}</p>
                           <p><b>Date and Time Received: </b>{{ mMainMsgData.created_at }}</p>
                           <br><hr><br>
                           <div v-html="mMainMsgData.in_message" class="p-2"></div>
                           <div class="separator"></div>
                           <div v-if="bWithReply === 1">
                               <div style="background-color: #718096; border-radius: 5px;">
                                   <p class="p-3" style="font-size: 20px; color: white">View previous replies:</p>
                               </div>
                               <br>
                               <div v-for="mReply in aRepliesData">
                                   <div class="form outline w-full">
                                       <div class="p-3">
                                           <p><b>Sender: </b> {{ mReply.sender_username }} <{{ mReply.sender_email }}> </p>
                                           <p><b>Full Sender's Name: </b>{{ mReply.sender_name }}</p>
                                           <p><b>Date and Time Received: </b>{{ mReply.created_at }}</p>
                                           <br><hr><br>
                                           <div v-html="mReply.in_message" class="p-2"></div>
                                       </div>
                                   </div>
                                   <br>
                               </div>
                           </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    components: {

    },
    data() {
        return {
            mMainMsgData : [],
            bWithReply   : 0,
            aRepliesData : [],
            sMessageType : '',
        };
    },
    created() {
        this.$root.setUserInfo();
        this.getMessageType();
    },
    mounted() {
        let mSelf = this;
        setTimeout(function () {
            mSelf.getMsgId();
        }, 1000);
    },
    methods: {
        getMessageType: function () {
            var sMessageType = window.location.pathname.split('/')[2];
            if (sMessageType === 'inbox' || sMessageType === 'sent') {
                this.sMessageType = sMessageType;
            } else {

            }
        },
        getMsgId: function () {
            let iMsgId = this.getUrlParameter('msgId');
            let bValid = Number.isInteger(parseInt(iMsgId));
            if (bValid === false) {
               this.redirectError('Invalid Parameters')
            } else {
                this.getMainMsg(iMsgId);
            }
        },

        redirectError: function (sCustomMsg) {
            let mSelf = this;
            let sDefMesg = this.sMessageType === 'inbox'  ? '; Redirecting to inbox page...' : '; Redirecting to sent page...';
            let sMessage = sCustomMsg + sDefMesg;
            this.$root.showErrorToast('Error', sMessage);
            setTimeout(function () {
               mSelf.sMessageType === 'inbox' ? mSelf.redirectToInbox() : mSelf.redirectToSent();
            }, 2000);
        },

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
                    }
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            }, { in_id : iMsgId});
        },

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

        redirectToInbox: function () {
            window.location = '/message/inbox';
        },

        redirectToSent: function () {
            window.location = '/message/sent';
        },

        reply: function () {

        },

        getReplies: function (iMsgId) {
            this.$root.getRequest('admin/message/read', (mResponse) => {
                if (mResponse.code === 200) {
                   let mData = mResponse.data;
                   if (mData.length !== 0) {
                       this.bWithReply = 1;
                       this.aRepliesData.push(mData[0]);
                       this.getReplies(mData[0].in_id);
                   }

                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            }, { in_inbox_id : iMsgId});
        },
    }
}
</script>

<style scoped>
@import './Inbox.css';
</style>
