<template>
    <div>
        <!-- TABLE -->
        <table id="tbl_branch_list" class="cell-border m-2">
            <thead>
            <tr>
                <th>Branch Name</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
        <!-- MODAL -->
        <div v-show="$root.isModalModifyVisible" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
             aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay, show/hide based on modal state.-->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <!-- Modal Container -->
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 lg:align-middle lg:max-w-lg lg:w-full">
                    <!-- Modal Body -->
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <!-- Modal Header -->
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Edit Details
                                </h3>
                                <!-- Modal Content -->
                                <div class="mt-6 w-full">
                                    <div class="form outline w-full">
                                        <div class="form__input-group w-11/12">
                                            <label class="form__label">Branch Name</label>
                                            <input id="branch_name" type="text" class="form__input">
                                        </div>
                                        <div class="form__input-group w-11/12">
                                            <label class="form__label">Branch Address</label>
                                            <input id="branch_addr" type="text" class="form__input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Save
                        </button>
                        <button type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                @click="closeModal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SystemEntitiesFunctions from "../../../../../plugins/Modular/SystemEntities/SystemEntitiesFunctions";
export default {
    name: "Manage_Branches",
    mixins: [
        SystemEntitiesFunctions
    ],
    data() {
        return {
            aBranchesData    : [],
            oModalData       : [],
        };
    },
    watch: {
        oSystemEntityModalData (data) {
            console.log(data);
        }
    },
    created() {
        this.initActionBtnModalTrigger();
    },
    mounted() {
        this.getBranchList();
    },
    methods: {
        /**
         * Get all registered accounts
         */
        getBranchList: function () {
            let mSelf = this;
            let sUrl = '/admin/system/branch/read';
            $('#tbl_branch_list').DataTable({
                "ajax": {
                    url: sUrl,
                    dataSrc: function (json) {
                        var reformatted_data = [];
                        $.each(json.data, function (key, value) {
                            reformatted_data.push({
                                'branch_name': value.branch_name,
                                'branch_address': value.branch_address,
                                'action': mSelf.setActionButton(sUrl, value, value.status),
                            })
                        });
                        return reformatted_data;
                    }
                },
                "columns": [
                    {data: 'branch_name'},
                    {data: 'branch_address'},
                    {data: 'action'}
                ],
                "order": [[0, "asc"]]
            });
        },

        /**
         *
         */
        initActionBtnModalTrigger: function () {
            let mSelf = this;
            $(document).on('click', '.sys_ent_modify', function () {
                mSelf.showModal('Modify');
                mSelf.oModalData = JSON.parse(decodeURIComponent(this.dataset.response));
                $('#branch_name').val(mSelf.oModalData.data.branch_name);
                $('#branch_addr').val(mSelf.oModalData.data.branch_address);
            });


            $(document).on('click', '.sys_ent_disable', function () {
                mSelf.$root.oSystemEntityModalData = JSON.parse(decodeURIComponent(this.dataset.response));
                mSelf.showModal('Disable');
            });
        },
    }
}
</script>

<style scoped>
@import './../SysConfig.css';
</style>
