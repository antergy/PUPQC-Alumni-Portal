<template>
    <div class="sysconfig">
        <div class="w-full mx-auto mt-4 ml-20 rounded">
            <p class="text-2xl">Sent Messages</p>
            <div class="separator"></div>
            <!-- TABLE -->
            <div class="bg-white w-fullx" style="border-radius: 5px">
                <div class="p-5">
                    <table id="tbl_sent_main" class="stripe m-2" style="width: 100%;">
                        <thead>
                        <tr>
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
    components: {

    },
    data() {
        return {

        };
    },
    created() {
        this.$root.setUserInfo();
        this.initActionBtnModalTrigger();
    },
    mounted() {
        let mSelf = this;
        setTimeout(function () {
            mSelf.getMainMessageList();
        }, 1000);
    },
    methods: {
        /**
         * Get messages (Main messages; non-reply)
         */
        getMainMessageList: function () {
            let sUrl = '/admin/message/read?in_acc_id_from=' + this.$root.sRootUserId + '&in_is_reply=0';
            $('#tbl_sent_main').DataTable().destroy();
            $('#tbl_sent_main').DataTable({
                "ajax": {
                    url: sUrl,
                    dataSrc: function (json) {
                        var reformatted_data = [];
                        $.each(json.data, function (key, value) {
                            reformatted_data.push({
                                'subject'   : value.in_subject,
                                'datetime'  : value.created_at,
                                'action'    : '<div style="text-align: center"><button type="button" class="form__button w-8/12 inbox_view" data-response="'+ encodeURIComponent(JSON.stringify(value)) +'" style="background-color: #0083f6; color: white; border-radius: 6px; font-size: 14px" >View Message</button></div>'
                            });
                        });
                        return reformatted_data;
                    }
                },
                "columns": [
                    {data: 'subject'},
                    {data: 'datetime'},
                    {data: 'action'}
                ],
                "order": [[1, "desc"]]
            });
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
                        'in_id'     : iMsgId,
                        'in_is_read': 1
                    };
                    // Change the read status
                    mSelf.$root.postRequest('admin/message/change_status', oParam, (mResponse) => {});
                }
                window.location = 'sent/details?msgId=' + iMsgId;
            });
        }
    }
}
</script>

<style scoped>
@import './Inbox.css';
</style>
