<template>
    <div>
        <!-- FORM -->
        <div class="mt-6 w-full ">
            <div class="form outline w-full">
                <h1 style="font-size: 18px; font-weight: bold">Add new course record:</h1><br>
                <div class="form__input-group w-7/12">
                    <label class="form__label">Course Description</label>
                    <input id="course_desc_new" type="text" class="form__input">
                </div>
                <div class="form__input-group w-7/12">
                    <label class="form__label">Course Acronym</label>
                    <input id="course_acronym_new" type="text" class="form__input">
                </div>
                <div class="grid grid-flow-col auto-cols-max">
                    <div class="m-1">
                        <button type="button" class="form__button w-full" @click="resetForm"> Clear All Entries&nbsp;</button>
                    </div>
                    <div class="m-1">
                        <button type="button" class="form__button success w-full" @click="addBranch">&nbsp;Save&nbsp;</button>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <!-- TABLE -->
        <table id="tbl_course_list" class="cell-border m-2" style="width: 100%">
            <thead>
            <tr>
                <th>Course Desc</th>
                <th>Course Acronym</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>

        <!-- MODIFY MODAL -->
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
                                            <label class="form__label">Course Description</label>
                                            <input id="course_desc" type="text" class="form__input">
                                        </div>
                                        <div class="form__input-group w-11/12">
                                            <label class="form__label">Course Acronym</label>
                                            <input id="course_acronym" type="text" class="form__input">
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
        <!-- DISABLE MODAL -->
        <div v-show="$root.isModalDisableVisible" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
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
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Disable this record
                                </h3>
                                <!-- Modal Content -->
                                <div class="mt-6 w-full">
                                    By disabling this record, it will not be seen in the public pages and records. <br>
                                    Are you sure you want to proceed?
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                                style="background-color: #EF4444; color: white; border-radius: 10px">
                            Disable
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
            oModalData: [],
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
        this.getCourseList();
    },
    methods: {
        /**
         * Get all registered accounts
         */
        getCourseList: function () {
            let mSelf = this;
            let sUrl = '/admin/system/course/read';
            $('#tbl_course_list').DataTable().destroy();
            $('#tbl_course_list').DataTable({
                "ajax": {
                    url: sUrl,
                    dataSrc: function (json) {
                        var reformatted_data = [];
                        $.each(json.data, function (key, value) {
                            reformatted_data.push({
                                'course_desc': value.course_desc,
                                'course_acronym': value.course_acronym,
                                'action': mSelf.setActionButton(sUrl, value, value.status),
                            })
                        });
                        return reformatted_data;
                    }
                },
                "columns": [
                    {data: 'course_desc'},
                    {data: 'course_acronym'},
                    {data: 'action'}
                ],
                "order": [[0, "asc"]]
            });
        },

        /**
         * Resets form for adding new branch details
         */
        resetForm: function () {
            $('#course_desc_new').val('');
            $('#course_acronym_new').val('');
        },

        /**
         * Add new branch details
         */
        addBranch: function () {
            let oParam = {
                'course_desc'   : $('#course_desc_new').val(),
                'branch_address': $('#course_acronym_new').val()
            };
            this.$root.postRequest('admin/system/course/create', oParam, (mResponse) => {
                if (mResponse.code === 200) {
                    this.$root.showSuccessToast('Success', 'Successfully created a course record');
                    this.resetForm();
                    this.getCourseList();
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            });
        },

        /**
         * Initialize button modal trigger
         */
        initActionBtnModalTrigger: function () {
            let mSelf = this;
            /** Init behavior for modify button */
            $(document).on('click', '.sys_ent_modify', function () {
                mSelf.showModal('Modify');
                mSelf.oModalData = JSON.parse(decodeURIComponent(this.dataset.response));
                $('#course_desc').val(mSelf.oModalData.data.course_desc);
                $('#course_acronym').val(mSelf.oModalData.data.course_acronym);
            });
            /** Init behavior for disable button */
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
