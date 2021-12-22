<template>
    <div class="sysconfig">
        <div class="w-full mx-auto mt-4 ml-20 rounded">
            <p class="text-2xl">Sent Messages</p>
            <div class="separator"></div>
            <!-- TABLE -->
            <div class="bg-white w-fullx" style="border-radius: 5px">
                <div class="p-5">
                    <button type="button" class="form__button info w-2/12" @click="getMainMessageList">&nbsp;Refresh Messages&nbsp;</button>
                    <hr><br>
                    <table id="tbl_sent_main" class="stripe m-2" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Receiver</th>
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
    name: "SentMain",
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
         * Get messages (All sent messages)
         */
        getMainMessageList: function () {
            let sUrl = '/admin/message/read?in_acc_id_from=' + this.$root.sRootUserId;
            $('#tbl_sent_main').DataTable().destroy();
            $('#tbl_sent_main').DataTable({
                "ajax": {
                    url: sUrl,
                    dataSrc: function (json) {
                        var reformatted_data = [];
                        $.each(json.data, function (key, value) {
                            reformatted_data.push({
                                'receiver'  : value.receiver_username,
                                'subject'   : value.in_subject,
                                'datetime'  : value.created_at,
                                'action'    : '<div style="text-align: center"><button type="button" class="form__button w-8/12 inbox_view" data-response="'+ encodeURIComponent(JSON.stringify(value)) +'" style="background-color: #0083f6; color: white; border-radius: 6px; font-size: 14px" >View Message</button></div>'
                            });
                        });
                        return reformatted_data;
                    }
                },
                "columns": [
                    {data: 'receiver'},
                    {data: 'subject'},
                    {data: 'datetime'},
                    {data: 'action'}
                ],
                "order": [[2, "desc"]]
            });
        },

        /**
         * Initialize button modal trigger
         */
        initActionBtnModalTrigger: function () {
            /** Init behavior for modify button */
            $(document).on('click', '.inbox_view', function () {
                let mData = JSON.parse(decodeURIComponent(this.dataset.response));
                /** Redirect to message details page */
                window.location = 'sent/details?msgId=' + mData.in_id;
            });
        }
    }
}
</script>

<style scoped>
@import './Inbox.css';
</style>
