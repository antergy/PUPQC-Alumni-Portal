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
        this.initTabs();
    },
    methods: {

        /**
         * Check btn permission if admin / superadmin
         * @param sUrl
         * @param mValue
         * @param iStatus
         * @returns {string}
         */
        checkBtnPermission: function (sUrl, mValue, iStatus) {
            if (this.$root.sRootAccPos === 'Superadmin') {
                return this.setActionButton(sUrl, mValue, iStatus);
            } else {
                return 'Not Permitted';
            }
        },

        /**
         * Shows modal
         * @param sAction
         */
        showModal: function (sAction) {
            if (sAction === 'Modify') {
                this.$root.isModalModifyVisible = true;
            } else if (sAction === 'Disable') {
                this.$root.isModalDisableVisible = true;
            }
        },

        /**
         * Close and reset modal data
         */
        closeModal: function () {
            this.$root.oSystemEntityModalData = [];
            this.$root.isModalModifyVisible = false;
            this.$root.isModalDisableVisible = false;
        },

        /**
         * Set action button
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

        /**
         * Initialize tabs
         */
        initTabs: function () {
            let tabsContainer = document.querySelector("#tabs");
            let tabTogglers = tabsContainer.querySelectorAll("a");
            tabTogglers.forEach(function (toggler) {
                toggler.addEventListener("click", function (e) {
                    e.preventDefault();
                    let tabName = this.getAttribute("href");
                    let tabContents = document.querySelector("#tab-contents");
                    for (let i = 0; i < tabContents.children.length; i++) {

                        tabTogglers[i].parentElement.classList.remove("border-blue-400", "border-b", "-mb-px", "opacity-100");
                        tabContents.children[i].classList.remove("hidden");
                        if ("#" + tabContents.children[i].id === tabName) {
                            continue;
                        }
                        tabContents.children[i].classList.add("hidden");
                    }
                    e.target.parentElement.classList.add("bg-white", "border-blue-400", "border-b-4", "-mb-px", "opacity-100");
                });
            });
            document.getElementById("default-tab").click();
        },

    }

}
