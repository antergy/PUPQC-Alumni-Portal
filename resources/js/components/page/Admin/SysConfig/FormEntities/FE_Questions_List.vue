<template>
    <div>
        <!-- FORM -->
        <div class="mt-6 w-full ">
            <div class="form outline w-full">
                <div class="form__input-group w-5/12">
                    <label class="form__label" style="font-size: 15px;">Select a form to view: </label>
                    <select id="fqg_form_new" v-model="selectedForm" name="fqg_form_new" class="form__input place-self-center">
                        <option selected disabled value="0">-- Select Form --</option>
                        <option v-for="form in aForm" v-bind:value="form.form_id">
                            {{ form.form_desc }}
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <br>
        <!-- TABLE -->
        <table id="tbl_custom_ques_list" class="cell-border m-2" style="width: 100% !important;">
            <thead>
            <tr>
                <th style="width:10%">ID</th>
                <th style="width:30%">Question Group</th>
                <th style="width:10%">Sequence Number</th>
                <th style="width:20%">Primary Question Type</th>
                <th style="width:40%">Description</th>
                <th style="width:10%">Action</th>
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
                                <div class="mt-10 w-full">
                                    <div class="form outline w-full">
                                        <div class="form__input-group w-11/12">
                                            <label class="form__label">Modify Dedicated Question Group: </label>
                                            <select id="fq_fqg_id" v-model="selectedToUpdateQueGroup" name="fq_fqg_id" class="form__input place-self-center">
                                                <option selected disabled value="0">-- Select Form Question Group --</option>
                                                <option v-for="group in aQuesGroup" v-bind:value="group.fqg_id">
                                                   [{{ group.form_desc }}] {{ group.fqg_desc }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form__input-group w-11/12">
                                            <label class="form__label">Question Description</label>
                                            <input id="fq_desc" type="text" class="form__input">
                                        </div>
                                        <div class="form__input-group w-11/12">
                                            <label class="form__label">Modify Question Type (Primary): </label>
                                            <select id="fq_fqt_id_primary" v-model="selectedToUpdateQueTypePrimary" name="fq_fqt_id_primary" class="form__input place-self-center">
                                                <option selected disabled value="0">-- Select Form Question Group --</option>
                                                <option v-for="type in aQuesType" v-bind:value="type.fqt_id">
                                                    {{ type.fqt_desc }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form__input-group w-11/12">
                                            <label class="form__label">Modify Question Type (Secondary, Optional): </label>
                                            <select id="fq_fqt_id_secondary" v-model="selectedToUpdateQueTypeSecondary" name="fq_fqt_id_secondary" class="form__input place-self-center">
                                                <option selected disabled value="0">-- Select Form Question Group --</option>
                                                <option v-for="type in aQuesType" v-bind:value="type.fqt_id">
                                                    {{ type.fqt_desc }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form__input-group w-5/12">
                                            <label class="form__label">Sequence Number</label>
                                            <input id="fq_sequence_no" type="number" class="form__input" min="1" max="99">
                                        </div>
                                        <div class="form__input-group w-5/12">
                                            <label class="form__label">Is the question required?: </label>
                                            <label class="radio-inline">
                                                &nbsp;<input id="ques_required_yes_modify" type="radio" value="1" name="ques_required"> Yes
                                            </label>
                                            <label class="radio-inline">
                                                &nbsp;<input id="ques_required_no_modify" type="radio"value="0" name="ques_required"> No
                                            </label>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- CHOICES [PRIMARY] -->
                                    <div v-if="this.aQuesTypeIdsWithChoices.includes(selectedToUpdateQueTypePrimary) === true" class="form outline w-full">
                                        <div class="form__input-group w-11/12">
                                            <label class="form__label">Choices (Primary)</label>
                                            <input id="fq_choices_primary" type="text" class="form__input">
                                        </div>
                                    </div>
                                    <br>
                                    <!-- CHOICES [SECONDARY] -->
                                    <div v-if="this.aQuesTypeIdsWithChoices.includes(selectedToUpdateQueTypeSecondary) === true" class="form outline w-full">
                                        <div class="form__input-group w-11/12">
                                            <label class="form__label">Choices (Secondary)</label>
                                            <input id="fq_choices_secondary" type="text" class="form__input">
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
                                @click="updateQuestion">
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
                                @click="switchUpdateQuestion">
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
    name: "FE_Questions_List",
    mixins: [
        FormEntitiesFunctions
    ],
    data() {
        return {
            oModalData                       : [],
            aForm                            : [],
            aQuesGroup                       : [],
            aQuesType                        : [],
            selectedToUpdateQueGroup         : 0,
            selectedToUpdateQueTypePrimary   : 0,
            selectedToUpdateQueTypeSecondary : 0,
            selectedForm                     : 0,
            iRecordStatus                    : 0,
            iId                              : 0,
            bWithChoicesPrimary              : false,
            aQuesTypeIdsWithChoices          : [2, 3, 4, 5]
        };
    },
    watch: {
        selectedForm () {
            this.getCustomQuestionList();
        }
    },
    created() {
      this.initActionBtnModalTrigger();
    },
    mounted() {
        this.initForms();
        this.initFormQuestionGroup();
        this.initFormQuestionTypes();
        this.getCustomQuestionList();
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
         * Initialize form question group details
         */
        initFormQuestionGroup: function () {
            this.$root.getRequest('admin/form/questions/group/read', (mResult) => {
                this.aQuesGroup = mResult.data;
            });
        },

        /**
         *  Initialize form question type details
         */
        initFormQuestionTypes: function () {
            this.$root.getRequest('admin/form/questions/type/read', (mResult) => {
                this.aQuesType = mResult.data;
            });
        },

        /**
         * Get form question list by form id
         */
        getCustomQuestionList: function () {
            let mSelf = this;
            let sUrl = '/admin/form/questions/read?fqg_form_id=' + this.selectedForm;
            $('#tbl_custom_ques_list').DataTable().destroy();
            $('#tbl_custom_ques_list').DataTable({
                "ajax": {
                    url: sUrl,
                    dataSrc: function (json) {
                        var reformatted_data = [];
                        $.each(json.data, function (key, value) {
                            reformatted_data.push({
                                'fqg_id'         : value.fq_id,
                                'fqg_desc'       : value.fqg_desc,
                                'fq_sequence_no' : value.fq_sequence_no,
                                'fqt_desc'       : value.fqt_desc,
                                'fq_desc'        : value.fq_desc,
                                'action'         :  mSelf.setActionButton(sUrl, value, value.fq_active_status),
                            })
                        });
                        return reformatted_data;
                    }
                },
                "columns": [
                    {data: 'fqg_id'},
                    {data: 'fqg_desc'},
                    {data: 'fq_sequence_no'},
                    {data: 'fqt_desc'},
                    {data: 'fq_desc'},
                    {data: 'action'}
                ],
                "order": [[0, "asc"]]
            });
        },

        /**
         * Initialize button modal trigger
         */
        initActionBtnModalTrigger: function () {
            let mSelf = this;
            /** Init behavior for modify button */
            $(document).on('click', '.sys_ent_modify', function () {
                $('#fq_choices_primary').val('');
                $('#fq_choices_secondary').val('');
                mSelf.showModal('Modify');
                mSelf.oModelData = JSON.parse(decodeURIComponent(this.dataset.response));
                mSelf.iId = mSelf.oModelData.data.fq_id;
                mSelf.selectedToUpdateQueGroup = mSelf.oModelData.data.fq_fqg_id;
                mSelf.selectedToUpdateQueTypePrimary = mSelf.oModelData.data.fq_fqt_id;
                mSelf.selectedToUpdateQueTypeSecondary = mSelf.oModelData.data.fq_secondary_fqt_id != null ? mSelf.oModelData.data.fq_secondary_fqt_id : 0;
                $('#fq_desc').val(mSelf.oModelData.data.fq_desc);
                $('#fq_sequence_no').val(mSelf.oModelData.data.fq_sequence_no);
                $('input:radio[name=ques_required]').val([mSelf.oModelData.data.fq_is_required]);

                let sUrl = 'admin/form/questions/choices/read?fqc_fq_id=' + mSelf.iId;
                /** Retrieve choices for primary question type */
                if (mSelf.aQuesTypeIdsWithChoices.includes(mSelf.selectedToUpdateQueTypePrimary) === true) {
                    mSelf.$root.getRequest(sUrl, (mResult) => {
                        let sText = '';
                        $.each(mResult.data, function (key, value) {
                            sText === '' ? sText += value.fqc_desc : sText += ',' + value.fqc_desc;
                        });
                        $('#fq_choices_primary').val(sText);
                    });
                }
                /** Retrieve choices for secondary question type */
                if (mSelf.aQuesTypeIdsWithChoices.includes(mSelf.selectedToUpdateQueTypeSecondary) === true) {
                    mSelf.$root.getRequest(sUrl, (mResult) => {
                        let sText = '';
                        $.each(mResult.data, function (key, value) {
                            sText === '' ? sText += value.fqc_desc : sText += ',' + value.fqc_desc;
                        });
                        $('#fq_choices_secondary').val(sText);
                    });
                }
            });
            /** Init behavior for enable button */
            $(document).on('click', '.sys_entenable', function () {
                mSelf.$root.oSystemEntityModalData = JSON.parse(decodeURIComponent(this.dataset.response));
                mSelf.iId = mSelf.$root.oSystemEntityModalData.data.fq_id;
                mSelf.iRecordStatus = mSelf.$root.oSystemEntityModalData.data.fq_active_status;
                mSelf.switchUpdateQuestion();
            });
            /** Init behavior for disable button */
            $(document).on('click', '.sys_ent_disable', function () {
                mSelf.$root.oSystemEntityModalData = JSON.parse(decodeURIComponent(this.dataset.response));
                mSelf.iId = mSelf.$root.oSystemEntityModalData.data.fq_id;
                mSelf.iRecordStatus = mSelf.$root.oSystemEntityModalData.data.fq_active_status;
                mSelf.showModal('Disable');
            });
        },

        /**
         * Enable / Disable question (Update)
         */
        switchUpdateQuestion: function () {
            let iChangedStatus = this.iRecordStatus === 1 ? 0 : 1;
            let sMessage = iChangedStatus === 0 ? 'Successfully disabled the record' : 'Successfully enabled the record';
            let oParam = {
                'fq_id'            : this.iId,
                'fq_active_status' : iChangedStatus,
            };
            this.$root.postRequest('admin/form/questions/switch', oParam, (mResponse) => {
                if (mResponse.code === 200) {
                    this.$root.showSuccessToast('Success', sMessage);
                    this.getCustomQuestionList();
                    this.closeModal()
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            });
        },

        /**
         * Update question details
         */
        updateQuestion: function () {
            let mSelf = this;
            let oParam = {
                'fq_id'          : this.iId,
                'fq_sequence_no' : $('#fq_sequence_no').val(),
                'fq_desc'        : $('#fq_desc').val(),
                'fq_fqg_id'      : this.selectedToUpdateQueGroup,
                'fq_fqt_id'      : this.selectedToUpdateQueTypePrimary,
                'fq_is_required' : $('input[name="ques_required"]:checked').val()
            };
            // Include secondary question type (optional)
            if (this.selectedToUpdateQueTypeSecondary != 0) {
                oParam = Object.assign(oParam, { 'fq_secondary_fqt_id' : this.selectedToUpdateQueTypeSecondary});
            }
            this.$root.postRequest('admin/form/questions/update', oParam, (mResponse) => {
                if (mResponse.code === 200) {
                    this.$root.showSuccessToast('Success', 'Successfully updated the form question');
                    // Check if need to update choices from the primary question type
                    if (this.aQuesTypeIdsWithChoices.includes(this.selectedToUpdateQueTypePrimary)) {
                        mSelf.updateChoices(this.iId, 1);
                    }
                    // Check if need to update choices from the secondary question type
                    if (this.aQuesTypeIdsWithChoices.includes(this.selectedToUpdateQueTypeSecondary)) {
                        mSelf.updateChoices(this.iId, 2);
                    }
                    mSelf.closeModal();
                    mSelf.getCustomQuestionList();
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            });
        },

        /**
         * Update choices from the created question
         * @param iQuestionId
         * @param iType
         */
        updateChoices: function (iQuestionId, iType) {
            let oParam = {
                'fqc_fq_id' : iQuestionId,
                'fqc_desc'  : iType === 1 ? $('#fq_choices_primary').val() : $('#fq_choices_secondary').val(),
            };
            this.$root.postRequest('admin/form/questions/choices/update_by_question', oParam, (mResponse) => {});
        }
    }
}
</script>

<style scoped>
@import './../SysConfig.css';
</style>
