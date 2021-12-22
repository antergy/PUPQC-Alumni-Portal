<template>
    <div class="sysconfig">
        <div class="w-full mx-auto mt-4 ml-20 rounded">
            <p class="text-2xl">Message Inbox</p>
            <div class="separator"></div>
            <!-- TABLE -->
            <div class="bg-white w-fullx" style="border-radius: 5px">
                <div class="p-5">
                    <button type="button" class="form__button info w-2/12" @click="getMainMessageList">&nbsp;Refresh Messages&nbsp;</button>
                    <hr><br>
                    <table id="tbl_inbox_main" class="stripe m-2" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Sender</th>
                            <th>Subject</th>
                            <th>Date & Time Received</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "InboxMain",
    created() {
        this.$root.setUserInfo();
        this.initActionBtnModalTrigger();
    },
    mounted() {
        let mSelf = this;
        /** Set a 1 second delay before retrieving */
        setTimeout(function () {
            mSelf.getMainMessageList();
        }, 1000);
    },
    methods: {

        /**
         * Get messages (All received messages)
         */
        getMainMessageList: function () {
            let mSelf = this;
            let sUrl = '/admin/message/read?in_acc_id_to=' + this.$root.sRootUserId;
            $('#tbl_inbox_main').DataTable().destroy();
            $('#tbl_inbox_main').DataTable({
                "ajax": {
                    url: sUrl,
                    dataSrc: function (json) {
                        var reformatted_data = [];
                        $.each(json.data, function (key, value) {
                            reformatted_data.push({
                                'sender'   : mSelf.checkReadMarker(value.sender_username, value.in_is_read),
                                'subject'  : mSelf.checkReadMarker(value.in_subject, value.in_is_read),
                                'datetime' : mSelf.checkReadMarker(value.created_at, value.in_is_read),
                                'action'   : '<div style="text-align: center"><button type="button" class="form__button w-8/12 inbox_view" data-response="' + encodeURIComponent(JSON.stringify(value)) + '" style="background-color: #0083f6; color: white; border-radius: 6px; font-size: 14px" >View Message</button></div>'
                            });
                        });
                        return reformatted_data;
                    }
                },
                "columns": [
                    {data: 'sender'},
                    {data: 'subject'},
                    {data: 'datetime'},
                    {data: 'action'}
                ],
                "order": [[2, "desc"]]
            });
        },

        /**
         * Check if the message is already read or not, provide css changes
         * [DataTable]
         */
        checkReadMarker: function (mValue, bRead) {
            if (bRead === 0) {
                return "<b style='color: #7F1D1D; font-size: 17px'>" + mValue + "</b>";
            } else {
                return mValue;
            }
        },

        /**
         * Initialize button modal trigger
         */
        initActionBtnModalTrigger: function () {
            let mSelf = this;
            /** Init behavior for modify button */
            $(document).on('click', '.inbox_view', function () {
                let mData = JSON.parse(decodeURIComponent(this.dataset.response));
                let iMsgId = mData.in_id;
                let bIsRead = mData.in_is_read;
                if (bIsRead === 0) {
                    let oParam = {
                        'in_id'      : iMsgId,
                        'in_is_read' : 1
                    };
                    /** Change the read status */
                    mSelf.$root.postRequest('admin/message/change_status', oParam, (mResponse) => {
                    });
                }
                /** Redirect to message details page */
                window.location = 'inbox/details?msgId=' + iMsgId;
            });
        }
    }
}
</script>
<style scoped>
@import './Inbox.css';
</style>
