<template>
    <div>
        <!-- FORM -->
        <div class="mt-6 w-full ">
            <div class="form outline w-full">
                <h1 style="font-size: 18px; font-weight: bold">Add new form:</h1><br>
                <div class="form__input-group w-7/12">
                    <label class="form__label">Form Description</label>
                    <input id="form_desc_new" type="text" class="form__input">
                </div>
                <div class="form__input-group w-7/12">
                    <label class="form__label">Associated Degree: </label>
                    <select id="branch" v-model="selectedDegree" name="branch" class="form__input place-self-center">
                        <option selected disabled value="0">-- Select Degree --</option>
                        <option v-for="degree in aDegree" v-bind:value="degree.degree_id">
                            {{ degree.degree_desc }}
                        </option>
                    </select>
                </div>
                <div class="form__input-group w-7/12">
                    <label class="form__label">Associated Course: (Do not select any if none)</label>
                    <select id="course" v-model="selectedCourse" name="course" class="form__input place-self-center">
                        <option selected value="0">-- Select Course --</option>
                        <option v-for="course in aCourses" v-bind:value="course.course_id">
                            {{ course.course_desc }}
                        </option>
                    </select>
                </div>
                <div class="grid grid-flow-col auto-cols-max">
                    <div class="m-1">
                        <button type="button" class="form__button w-full" @click="resetForm"> Clear All Entries&nbsp;</button>
                    </div>
                    <div class="m-1">
                        <button type="button" class="form__button success w-full" @click="addForm">&nbsp;Save&nbsp;</button>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <!-- TABLE -->
        <table id="tbl_form_list" class="cell-border m-2">
            <thead>
            <tr>
                <th style="width: 5%">Sequence Id</th>
                <th style="width: 25%">Form Description</th>
                <th style="width: 20%">Assoc. Degree</th>
                <th style="width: 25%">Assoc. Course</th>
                <th style="width: 40%">Action</th>
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
                                            <label class="form__label">Form Description</label>
                                            <input id="form_desc" type="text" class="form__input">
                                        </div>
                                        <div class="form__input-group w-11/12">
                                            <label class="form__label">Associated Degree: </label>
                                            <select id="selectToUpdateDegree" v-model="selectedToUpdateDegree" name="edit_degree" class="form__input place-self-center">
                                                <option selected disabled value="0">-- Select Degree --</option>
                                                <option v-for="degree in aDegree" v-bind:value="degree.degree_id">
                                                    {{ degree.degree_desc }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form__input-group w-11/12">
                                            <label class="form__label">Associated Course: (Do not select any if none) </label>
                                            <select id="selectToUpdateCourse" v-model="selectedToUpdateCourse" name="edit_course" class="form__input place-self-center">
                                                <option selected value="0">-- Select Course --</option>
                                                <option v-for="course in aCourses" v-bind:value="course.course_id">
                                                    {{ course.course_desc }}
                                                </option>
                                            </select>
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
                                @click="updateForm">
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
                                @click="switchUpdateForm()">
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
    name: "FE_Basic_General",
    mixins: [
        FormEntitiesFunctions
    ],
    data() {
        return {
            selectedDegree         : 0,
            selectedCourse         : 0,
            aDegree                : [],
            aCourses               : [],
            oModalData             : [],
            iId                    : 0,
            iRecordStatus          : 0,
            selectedToUpdateDegree : 0,
            selectedToUpdateCourse : 0,
        };
    },
    created() {
        this.initActionBtnModalTrigger();
    },
    mounted() {
        this.initDegree();
        this.initCourse();
        this.getFormList();
    },
    methods: {

        /**
         * Initialize degree details
         */
        initDegree: function () {
            this.$root.getRequest('admin/system/degree/read', (mResult) => {
                this.aDegree = mResult.data;
            })
        },

        /**
         * Initialize course details
         */
        initCourse: function () {
            this.$root.getRequest('admin/system/course/read', (mResult) => {
                this.aCourses = mResult.data;
            })
        },

        /**
         * Get Form list
         */
        getFormList: function () {
            let mSelf = this;
            let sUrl = '/admin/form/read/only';
            $('#tbl_form_list').DataTable().destroy();
            $('#tbl_form_list').DataTable({
                "ajax": {
                    url: sUrl,
                    dataSrc: function (json) {
                        var reformatted_data = [];
                        $.each(json.data, function (key, value) {
                            reformatted_data.push({
                                'sequence'    : value.form_id,
                                'form_desc'   : value.form_desc,
                                'form_degree' : value.degree_desc,
                                'form_course' : value.course_desc !== null ? value.course_desc : 'N/A',
                                'action'      : mSelf.checkBtnPermission(sUrl, value, value.form_active_status),
                            })
                        });
                        return reformatted_data;
                    }
                },
                "columns": [
                    {data: 'sequence'},
                    {data: 'form_desc'},
                    {data: 'form_degree'},
                    {data: 'form_course'},
                    {data: 'action'}
                ],
                "order": [[0, "asc"]]
            });
        },

        /**
         * Resets form for adding new form details
         */
        resetForm: function () {
            $('#form_desc_new').val('');
            this.selectedDegree = 0;
            this.selectedCourse = 0;
        },

        /**
         * Add new form details
         */
        addForm: function () {
            let oParam = {
                'form_desc'      : $('#form_desc_new').val(),
                'form_degree_id' : this.selectedDegree,
                'form_course_id' : this.selectedCourse
            };
            this.$root.postRequest('admin/form/create', oParam, (mResponse) => {
                if (mResponse.code === 200) {
                    this.$root.showSuccessToast('Success', 'Successfully created a form');
                    this.resetForm();
                    this.getFormList();
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            });
        },

        /**
         * Update form details
         */
        updateForm: function () {
            let oParam = {
                'form_id'        : this.iId,
                'form_desc'      : $('#form_desc').val(),
                'form_degree_id' : $("#selectToUpdateDegree :selected").val(),
                'form_course_id' : $("#selectToUpdateCourse :selected").val(),
            };
            this.$root.postRequest('admin/form/update', oParam, (mResponse) => {
                if (mResponse.code === 200) {
                    this.$root.showSuccessToast('Success', 'Successfully updated the form details');
                    this.getFormList();
                    this.closeModal()
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            });
        },

        /**
         * Enable / Disable Form (Update)
         */
        switchUpdateForm: function () {
            let iChangedStatus = this.iRecordStatus === 1 ? 0 : 1;
            let sMessage = iChangedStatus === 0 ? 'Successfully disabled the record' : 'Successfully enabled the record';
            let oParam = {
                'form_id'            : this.iId,
                'form_active_status' : iChangedStatus,
            };
            console.log(oParam);
            this.$root.postRequest('admin/form/switch', oParam, (mResponse) => {
                if (mResponse.code === 200) {
                    this.$root.showSuccessToast('Success', sMessage);
                    this.getFormList();
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
                mSelf.iId = mSelf.oModalData.data.form_id;
                $('#form_desc').val(mSelf.oModalData.data.form_desc);
                mSelf.selectedToUpdateDegree = mSelf.oModalData.data.form_degree_id
                mSelf.selectedToUpdateCourse = mSelf.oModalData.data.form_course_id
            });
            /** Init behavior for enable button */
            $(document).on('click', '.sys_entenable', function () {
                mSelf.$root.oSystemEntityModalData = JSON.parse(decodeURIComponent(this.dataset.response));
                mSelf.iId = mSelf.$root.oSystemEntityModalData.data.form_id;
                mSelf.iRecordStatus = mSelf.$root.oSystemEntityModalData.data.form_active_status;
                mSelf.switchUpdateForm();
            });
            /** Init behavior for disable button */
            $(document).on('click', '.sys_ent_disable', function () {
                mSelf.$root.oSystemEntityModalData = JSON.parse(decodeURIComponent(this.dataset.response));
                mSelf.iId = mSelf.$root.oSystemEntityModalData.data.form_id;
                mSelf.iRecordStatus = mSelf.$root.oSystemEntityModalData.data.form_active_status;
                mSelf.showModal('Disable');
            });
        },
    }
}
</script>

<style scoped>
@import './../SysConfig.css';
</style>
