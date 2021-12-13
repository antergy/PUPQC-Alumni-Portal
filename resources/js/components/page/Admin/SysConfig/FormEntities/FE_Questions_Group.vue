<template>
    <div>
        <!-- FORM -->
        <div class="mt-6 w-full ">
            <div class="form outline w-full">
                <h1 style="font-size: 18px; font-weight: bold">Add new form question group:</h1><br>
                <div class="form__input-group w-7/12">
                    <label class="form__label">Select a Form: </label>
                    <select id="fqg_form_new" v-model="selectedForm" name="fqg_form_new" class="form__input place-self-center">
                        <option selected disabled value="0">-- Select Form --</option>
                        <option v-for="form in aForm" v-bind:value="form.form_id">
                            {{ form.form_desc }}
                        </option>
                    </select>
                </div>
                <div class="form__input-group w-7/12">
                    <label class="form__label">Question Group Description</label>
                    <input id="fqg_desc_new" type="text" class="form__input">
                </div>
                <div class="form__input-group w-5/12">
                    <label class="form__label">Sequence Layout Number <br> (The Chronological arrangement of question group will depend on the given numerical value)</label>
                    <input id="fqg_sequence_no_new" type="number" class="form__input" min="1" max="99">
                </div>
                <div class="grid grid-flow-col auto-cols-max">
                    <div class="m-1">
                        <button type="button" class="form__button w-full" @click="resetForm"> Clear All Entries&nbsp;</button>
                    </div>
                    <div class="m-1">
                        <button type="button" class="form__button success w-full" @click="addQuesGroup">&nbsp;Save&nbsp;</button>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <!-- TABLE -->
        <table id="tbl_ques_group_list" class="cell-border m-2">
            <thead>
            <tr>
                <th style="width:30%">Form</th>
                <th style="width:10%">Sequence Layout #</th>
                <th style="width:40%">Question Group Description</th>
                <th style="width:20%">Action</th>
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
                                            <label class="form__label">Modify Dedicated Form: </label>
                                            <select id="fqg_form" v-model="selectedToUpdateForm" name="fqg_form" class="form__input place-self-center">
                                                <option selected disabled value="0">-- Select Form --</option>
                                                <option v-for="form in aForm" v-bind:value="form.form_id">
                                                    {{ form.form_desc }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form__input-group w-11/12">
                                            <label class="form__label">Question Group Description</label>
                                            <input id="fqg_desc" type="text" class="form__input">
                                        </div>
                                        <div class="form__input-group w-5/12">
                                            <label class="form__label">Sequence Layout Number</label>
                                            <input id="fqg_sequence_no" type="number" class="form__input" min="1" max="99">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                                @click="updateQuesGroup">
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
                                style="background-color: #EF4444; color: white; border-radius: 10px"
                                @click="switchUpdateQuesGroup()">
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
import FormEntitiesFunctions from "../../../../../plugins/Modular/FormEntities/FormEntitiesFunctions";
export default {
    name: "FE_Questions_Group",
    mixins: [
        FormEntitiesFunctions
    ],
    data() {
        return {
            oModalData            : [],
            aForm                 : [],
            iId                   : 0,
            iRecordStatus         : 0,
            selectedForm          : 0,
            selectedToUpdateForm  : 0,
        };
    },
    created() {
        this.initActionBtnModalTrigger();
    },
    mounted() {
        this.initForms();
        this.getQuestionGroupList();
    },
    methods: {

        /**
         * Initialize form details
         */
        initForms: function () {
            this.$root.getRequest('admin/form/read/only', (mResult) => {
                this.aForm = mResult.data;
            })
        },

        /**
         * Get form question group list
         */
        getQuestionGroupList: function () {
            let mSelf = this;
            let sUrl = '/admin/form/questions/group/read';
            $('#tbl_ques_group_list').DataTable().destroy();
            $('#tbl_ques_group_list').DataTable({
                "ajax": {
                    url: sUrl,
                    dataSrc: function (json) {
                        var reformatted_data = [];
                        $.each(json.data, function (key, value) {
                            reformatted_data.push({
                                'form_desc'   : value.form_desc,
                                'sequence_no' : value.fqg_sequence_no,
                                'fqg_desc'    : value.fqg_desc,
                                'action'      : mSelf.setActionButton(sUrl, value, value.status),
                            })
                        });
                        return reformatted_data;
                    }
                },
                "columns": [
                    {data: 'form_desc'},
                    {data: 'sequence_no'},
                    {data: 'fqg_desc'},
                    {data: 'action'}
                ],
                "order": [[0, "asc"]]
            });
        },

        /**
         * Resets form for adding new question group details
         */
        resetForm: function () {
            $('#fqg_desc_new').val('');
            $('#fqg_sequence_no_new').val('');
            this.selectedForm = 0;
        },

        /**
         * Add new form question group details
         */
        addQuesGroup: function () {
            let oParam = {
                'fqg_desc'        : $('#fqg_desc_new').val(),
                'fqg_sequence_no' : $('#fqg_sequence_no_new').val(),
                'fqg_form_id'     : this.selectedForm,
            };
            this.$root.postRequest('admin/form/questions/group/create', oParam, (mResponse) => {
                if (mResponse.code === 200) {
                    this.$root.showSuccessToast('Success', 'Successfully created a new question group');
                    this.resetForm();
                    this.getQuestionGroupList();
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            });
        },

        /**
         * Update question group details
         */
        updateQuesGroup: function () {
            let oParam = {
                'fqg_id'          : this.iId,
                'fqg_desc'        : $('#fqg_desc').val(),
                'fqg_sequence_no' : $('#fqg_sequence_no').val(),
                'fqg_form_id'     : this.selectedToUpdateForm,
            };
            this.$root.postRequest('admin/form/questions/group/update', oParam, (mResponse) => {
                if (mResponse.code === 200) {
                    this.$root.showSuccessToast('Success', 'Successfully updated the question group details');
                    this.getQuestionGroupList();
                    this.closeModal()
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            });
        },

        /**
         * Enable / Disable question group (Update)
         */
        switchUpdateQuesGroup: function () {
            let iChangedStatus = this.iRecordStatus === 1 ? 0 : 1;
            let sMessage = iChangedStatus === 0 ? 'Successfully disabled the record' : 'Successfully enabled the record';
            let oParam = {
                'fqg_id' : this.iId,
                'status' : iChangedStatus,
            };
            this.$root.postRequest('admin/form/questions/group/switch', oParam, (mResponse) => {
                if (mResponse.code === 200) {
                    this.$root.showSuccessToast('Success', sMessage);
                    this.getQuestionGroupList();
                    this.closeModal()
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
                mSelf.iId = mSelf.oModalData.data.fqg_id;
                $('#fqg_desc').val(mSelf.oModalData.data.fqg_desc);
                $('#fqg_sequence_no').val(mSelf.oModalData.data.fqg_sequence_no);
                mSelf.selectedToUpdateForm = mSelf.oModalData.data.fqg_form_id;
            });
            /** Init behavior for enable button */
            $(document).on('click', '.sys_entenable', function () {
                mSelf.$root.oSystemEntityModalData = JSON.parse(decodeURIComponent(this.dataset.response));
                mSelf.iId = mSelf.$root.oSystemEntityModalData.data.fqg_id;
                mSelf.iRecordStatus = mSelf.$root.oSystemEntityModalData.data.status;
                mSelf.switchUpdateQuesGroup();
            });
            /** Init behavior for disable button */
            $(document).on('click', '.sys_ent_disable', function () {
                mSelf.$root.oSystemEntityModalData = JSON.parse(decodeURIComponent(this.dataset.response));
                mSelf.iId = mSelf.$root.oSystemEntityModalData.data.fqg_id;
                mSelf.iRecordStatus = mSelf.$root.oSystemEntityModalData.data.status;
                mSelf.showModal('Disable');
            });
        },
    }
}
</script>

<style scoped>
@import './../SysConfig.css';
</style>
