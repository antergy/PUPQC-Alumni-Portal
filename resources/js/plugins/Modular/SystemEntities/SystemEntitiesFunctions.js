export default {
    data() {
        return {

        }
    },
    watch : {

    },
    created() {

    },
    mounted() {

    },
    methods: {

        showModal: function (sAction) {
            if (sAction === 'Modify') {
                this.$root.isModalModifyVisible = true;
            } else if (sAction === 'Disable') {
                this.$root.isModalDisableVisible = true;
            }
        },

        closeModal: function () {
            this.$root.oSystemEntityModalData = [];
            this.$root.isModalModifyVisible = false;
            this.$root.isModalDisableVisible = false;
        },

        /**
         *
         */
        setActionButton: function (sUrl, mValue, iStatus) {
            mValue = Object.assign({url: sUrl}, {data: mValue});
            var data_str = encodeURIComponent(JSON.stringify(mValue));
            let oEditBtn = '<button type="button" class="form__button w-5/12 sys_ent_modify" data-response="'+data_str+'" style="background-color: #F59E0B; color: white; border-radius: 10px" >Edit</button> &nbsp;&nbsp;';
            let oDisableBtn = '<button type="button" class="form__button w-5/12 sys_ent_disable" data-response="'+data_str+'" style="background-color: #EF4444; color: white; border-radius: 10px">Disable</button>';
            let oEnableBtn = '<button type="button" class="form__button w-5/12 sys_entenable" data-response="'+data_str+'" style="background-color: #10B981; color: white; border-radius: 10px">Enable</button>';
            let oButtons = iStatus === 1 ? oEditBtn + oDisableBtn : oEditBtn + oEnableBtn;

            return oButtons;
        },



    }

}
