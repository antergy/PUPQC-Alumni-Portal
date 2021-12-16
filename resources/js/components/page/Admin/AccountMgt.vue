<template>
  <div class="admin">

      <div class="w-full mx-auto mt-4 ml-20 rounded">
          <p class="text-2xl">Accounts Management</p>
          <div class="separator"></div>
          <!-- Tabs -->
          <ul id="tabs" class="inline-flex w-full mt-4 ">
              <li class="px-4 py-2 -mb-px font-semibold text-gray-800 border-b-2 border-blue-400 rounded-t opacity-50"><a id="default-tab" href="#first">Accounts List</a></li>
              <li class="px-4 py-2 font-semibold text-gray-800 rounded-t opacity-50"><a href="#second">Create an account</a></li>
          </ul>

          <!-- Tab Contents -->
          <div id="tab-contents" class="bg-white w-full">
              <div id="first" class="p-4">
                  <button type="button" id="btnRefresh" class="form__button info w-1/12 mb-5" @click="getAccountsList">&nbsp;&nbsp;Refresh Table&nbsp; &nbsp; </button>
                  <table id="tbl_account_list" class="cell-border m-2">
                      <thead>
                      <tr>
                          <th style="width: 5%">Acc Id</th>
                          <th style="width: 15%">Username</th>
                          <th style="width: 20%">Name</th>
                          <th style="width: 20%">Email</th>
                          <th style="width: 10%">Account Type</th>
                          <th style="width: 10%">Status</th>
                          <th style="width: 25%">Action</th>
                      </tr>
                      </thead>
                  </table>
              </div>
              <div id="second" class="hidden p-4">
                  <!-- INSERT FORM  -->
                  <div class="form outline">
                      <div class="form__input-group x-lg">
                          <label class="form__label">Account Name</label>
                          <input id="acc_name" type="text" class="form__input">
                      </div>
                      <div class="form__input-group x-lg">
                          <label class="form__label">Email</label>
                          <input id="acc_email" type="email" class="form__input">
                      </div>
                      <div class="form__input-group x-lg">
                          <label class="form__label">Username</label>
                          <input id="acc_uname" type="text" class="form__input">
                      </div>
                      <div class="form__input-group x-lg">
                          <label class="form__label">Password</label>
                          <input id="acc_password" type="password" class="form__input">
                      </div>
                      <div class="form__input-group x-lg">
                          <label class="form__label">Confirm Password</label>
                          <input id="acc_confirm_password" type="password" class="form__input">
                      </div>
                      <div class="form__input-group x-lg">
                          <label class="form__label">Account Type</label>
                          <select id="acc_type" v-model="selectedAccType" name="branch"
                                  class="form__input place-self-center">
                              <option selected disabled value="0">-- Select Account Type --</option>
                              <option v-for="acc_type in aAccType" v-bind:value="acc_type.at_id">
                                  {{ acc_type.at_desc }}
                              </option>
                          </select>
                      </div>
                      <div class="form__input-group x-lg">
                          <label class="form__label">Branch Last Graduated / Assoc Branch: </label>
                          <select id="branch" v-model="selectedBranch" name="branch"
                                  class="form__input place-self-center">
                              <option selected disabled value="0">-- Select Branch --</option>
                              <option v-for="branch in aBranch" v-bind:value="branch.branch_id">
                                  {{ branch.branch_name }}
                              </option>
                          </select>
                      </div>
                      <div class="form__input-group x-lg">
                          <label class="form__label">Course Last Graduated / Assoc Course: </label>
                          <select id="degree" v-model="selectedDegree" name="branch"
                                  class="form__input place-self-center">
                              <option selected disabled value="0">-- Select Degree --</option>
                              <option v-for="degree in aDegree" v-bind:value="degree.degree_id">
                                  {{ degree.degree_desc }}
                              </option>
                          </select>
                      </div>
                      <div class="form__input-group x-lg">
                          <label class="form__label">Profile Picture (Optional): </label>
                          <input id="cropzee-input" type="file" class="form__input" @click="resetImg()">
                          <br>
                          <div id="img-previewer" class="image-previewer" data-cropzee="cropzee-input" style="max-height: 500px; max-width: 700px;"></div>
                      </div>

                      <div class="form__input-group w-8/12">
                          <div class="grid grid-flow-col auto-cols-max">
                              <div class="m-1">
                                  <button type="button" id="btnClear" class="form__button w-full">&nbsp; &nbsp;
                                      Clear All Entries&nbsp; &nbsp;
                                  </button>
                              </div>
                              <div class="m-1">
                                  <button type="button" id="btnSave" class="form__button success w-full">&nbsp;&nbsp;Save&nbsp;
                                  </button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
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
                                          <p style="color: red"><b>** NOTE: Account Name and Profile Picture cannot be modified here. Details to be modified here must be only initiated upon the user's request and permission; Please exercise caution. **</b></p>
                                          <div class="form__input-group w-11/12">
                                              <label class="form__label">Email</label>
                                              <input id="edit_acc_email" type="email" class="form__input">
                                          </div>
                                          <div class="form__input-group w-11/12">
                                              <label class="form__label">Username</label>
                                              <input id="edit_acc_uname" type="text" class="form__input">
                                          </div>
                                          <div class="form__input-group w-11/12">
                                              <label class="form__label">Password</label>
                                              <input id="edit_acc_password" type="password" class="form__input">
                                          </div>
                                          <div class="form__input-group w-11/12">
                                              <label class="form__label">Confirm Password</label>
                                              <input id="edit_acc_confirm_password" type="password" class="form__input">
                                          </div>
                                          <div class="form__input-group w-11/12">
                                              <label class="form__label">Account Type</label>
                                              <select id="edit_acc_type" v-model="selectedToUpdateAccType" name="branch"
                                                      class="form__input place-self-center">
                                                  <option selected disabled value="0">-- Select Account Type --</option>
                                                  <option v-for="acc_type in aAccType" v-bind:value="acc_type.at_id">
                                                      {{ acc_type.at_desc }}
                                                  </option>
                                              </select>
                                          </div>
                                          <div class="form__input-group w-11/12">
                                              <label class="form__label">Branch Last Graduated / Assoc Branch: </label>
                                              <select id="edit_branch" v-model="selectedToUpdateBranch" name="branch"
                                                      class="form__input place-self-center">
                                                  <option selected disabled value="0">-- Select Branch --</option>
                                                  <option v-for="branch in aBranch" v-bind:value="branch.branch_id">
                                                      {{ branch.branch_name }}
                                                  </option>
                                              </select>
                                          </div>
                                          <div class="form__input-group w-11/12">
                                              <label class="form__label">Course Last Graduated / Assoc Course: </label>
                                              <select id="edit_degree" v-model="selectedToUpdateDegree" name="branch"
                                                      class="form__input place-self-center">
                                                  <option selected disabled value="0">-- Select Degree --</option>
                                                  <option v-for="degree in aDegree" v-bind:value="degree.degree_id">
                                                      {{ degree.degree_desc }}
                                                  </option>
                                              </select>
                                          </div>
                                      </div>
                                      <br>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- Modal Footer -->
                      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                          <button type="button"
                                  class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                                  @click="updateAccount">
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
                                      Deactivate this Account
                                  </h3>
                                  <!-- Modal Content -->
                                  <div class="mt-6 w-full">
                                      By deactivating this account, the user will be unable to login until you activate it again. <br>
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
                                  @click="updateAccountStatus">
                              Deactivate
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
  </div>
</template>

<script>
import FormEntitiesFunctions from "../../../plugins/Modular/FormEntities/FormEntitiesFunctions";
export default {
    mixins: [
        FormEntitiesFunctions
    ],
    data() {
        return {
            iId                     : 0,
            iRecordStatus           : 0,
            selectedAccType         : 0,
            selectedToUpdateAccType : 0,
            selectedDegree          : 0,
            selectedToUpdateDegree  : 0,
            selectedBranch          : 0,
            selectedToUpdateBranch  : 0,
            sAccToUpdateName        : '',
            oModalData              : [],
            aDegree                 : [],
            aBranch                 : [],
            aAccType                : []
        };
    },
    created() {
        this.$root.setUserInfo();
        this.initActionBtnModalTrigger();
        this.initCropper();
    },
    mounted() {
        this.initAccType();
        this.initBranch();
        this.initDegree();
        this.initTabs();
        this.initEvents();
        this.getAccountsList();
    },
    methods: {

        /** Initialize image croppper */
        initCropper: function () {
            $(document).ready(function(){
                $("#cropzee-input").cropzee({
                    aspectRatio: 1,
                    startSize: [70, 70, '%'],
                    returnImageMode:'data-url'
                });
            });
        },

        /** Reset the img only */
        resetImg: function () {
          $('#cropzee-input').val('');
        },

        /**
         * Initialize degree list
         */
        initAccType: function () {
            this.$root.getRequest('admin/system/acc_type/read', (mResult) => {
                this.aAccType = mResult.data.filter(function (e) {
                    return e.at_desc !== 'Superadmin'
                }); // Remove Superadmin privilege
            })
        },

        /**
         * Initialize degree list
         */
        initDegree: function () {
            this.$root.getRequest('admin/system/degree/read', (mResult) => {
                this.aDegree = mResult.data;
            })
        },

        /**
         * Initialize branch list
         */
        initBranch: function () {
            this.$root.getRequest('admin/system/branch/read', (mResult) => {
                this.aBranch = mResult.data;
            })
        },

        /**
         * Initialize element events
         */
        initEvents: function () {
            let mSelf = this;
            $('#btnRefresh').click(function () {
                mSelf.getAccountsList();
            });
            $('#btnSave').click(function () {
               mSelf.createAccount();
            });
            $('#btnClear').click(function () {
                mSelf.resetForm();
            });
            $('#btnCancelPicUpload').click(function () {
                $('#cropzee-input').val('');
                $('#img-previewer').hide();
            });
        },

        /**
         * Initialize tabs
         */
        initTabs: function () {
            let tabsContainer = document.querySelector("#tabs");
            let tabTogglers = tabsContainer.querySelectorAll("a");
            tabTogglers.forEach(function(toggler) {
                toggler.addEventListener("click", function(e) {
                    e.preventDefault();

                    let tabName = this.getAttribute("href");

                    let tabContents = document.querySelector("#tab-contents");

                    for (let i = 0; i < tabContents.children.length; i++) {

                        tabTogglers[i].parentElement.classList.remove("border-blue-400", "border-b",  "-mb-px", "opacity-100");  tabContents.children[i].classList.remove("hidden");
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

        /**
         * Get all registered accounts
         */
        getAccountsList: function () {
            let sUrl = '/admin/account/read';
            let mSelf = this;
            $('#tbl_account_list').DataTable().destroy();
            $('#tbl_account_list').DataTable({
                "ajax": {
                    url: sUrl,
                    dataSrc: function (json) {
                        var reformatted_data = [];
                        $.each(json.data, function (key, value) {
                            if (value.acc_id !== mSelf.$root.sRootUserId) { // Do not include own account
                                if (value.at_desc !== 'Superadmin') {
                                    reformatted_data.push({
                                        'sequence_no'  : value.acc_id,
                                        'acc_username' : value.acc_username,
                                        'acc_name'     : value.acc_name,
                                        'acc_email'    : value.acc_email,
                                        'acc_type'     : value.at_desc,
                                        'acc_status'   : mSelf.getStatusLabel(value.acc_status),
                                        'action'       : mSelf.setAccActionButton(sUrl, value, value.acc_status)
                                    });
                                }
                            }
                        });
                        return reformatted_data;
                    }
                },
                "columns": [
                    {data: 'sequence_no'},
                    {data: 'acc_username'},
                    {data: 'acc_name'},
                    {data: 'acc_email'},
                    {data: 'acc_type'},
                    {data: 'acc_status'},
                    {data: 'action'}
                ],
                "order": [[0, "asc"]]
            });
        },

        /**
         * Set account action button
         */
        setAccActionButton: function (sUrl, mValue, iStatus) {
            mValue = Object.assign({url: sUrl}, {data: mValue});
            var data_str = encodeURIComponent(JSON.stringify(mValue));
            let oEditBtn = '<button type="button" class="form__button w-5/12 sys_ent_modify" data-response="'+data_str+'" style="background-color: #F59E0B; color: white; border-radius: 10px" >Edit</button> &nbsp;&nbsp;';
            let oDisableBtn = '<button type="button" class="form__button w-5/12 sys_ent_disable" data-response="'+data_str+'" style="background-color: #EF4444; color: white; border-radius: 10px">Deactivate</button>';
            let oEnableBtn = '<button type="button" class="form__button w-5/12 sys_entenable" data-response="'+data_str+'" style="background-color: #10B981; color: white; border-radius: 10px">Activate</button>';
            let oButtons = iStatus !== 3 ? oEditBtn + oDisableBtn : oEditBtn + oEnableBtn;

            return oButtons;
        },

        /**
         * Get the status' label
         * @param iStatus
         */
        getStatusLabel: function (iStatus) {
            let oLabels = {
                1 : 'Active',
                2 : 'Offline',
                3 : 'Deactivated'
            }
            return oLabels[iStatus];
        },

        /**
         * Create account
         * - Saves to DB
         */
        createAccount: function () {
            let mSelf = this;
            let oParam = {
                'acc_username'        : $('#acc_uname').val(),
                'acc_password'        : $('#acc_password').val(),
                'acc_name'            : $('#acc_name').val(),
                'acc_email'           : $('#acc_email').val(),
                'acc_at_id'           : this.selectedAccType,
                'acc_status'          : 2,
                'acc_assoc_degree_id' : this.selectedDegree,
                'acc_assoc_branch_id' : this.selectedBranch
            };
            let profileImg = cropzeeGetImage('cropzee-input');
            if (profileImg !== undefined) {
                oParam = Object.assign(oParam, {'acc_picture' : profileImg});
            }
            this.$root.postRequest('admin/account/create', oParam, (mResponse) => {
                if (mResponse.code === 200) {
                    this.$root.showSuccessToast('Success', mResponse.message);
                    mSelf.resetForm();
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            });
        },

        /**
         * Resets form for account creation
         */
        resetForm: function () {
            $('#acc_uname').val('');
            $('#acc_password').val('');
            $('#acc_confirm_password').val('');
            $('#acc_name').val('');
            $('#acc_email').val('');
            $('#cropzee-input').val('');
            $('#img-previewer').hide();
            this.selectedBranch = 0;
            this.selectedDegree = 0;
            this.selectedAccType = 0;
            window.cropzeeReturnImage = [];
        },

        /**
         * Update account details
         */
        updateAccount: function () {
            let oParam = {
                'acc_id'              : this.iId,
                'acc_username'        : $('#edit_acc_uname').val(),
                'acc_password'        : $('#edit_acc_password').val(),
                'acc_email'           : $('#edit_acc_email').val(),
                'acc_name'            : this.sAccToUpdateName,
                'acc_at_id'           : this.selectedToUpdateAccType,
                'acc_status'          : this.iRecordStatus,
                'acc_assoc_degree_id' : this.selectedToUpdateDegree,
                'acc_assoc_branch_id' : this.selectedToUpdateBranch
            };
            this.$root.postRequest('admin/account/update', oParam, (mResponse) => {
                if (mResponse.code === 200) {
                    this.$root.showSuccessToast('Success', 'Successfully updated the account details');
                    this.getAccountsList();
                    this.closeModal();
                    $('#edit_acc_uname').val('');
                    $('#edit_acc_password').val('');
                    $('#edit_acc_name').val('');
                    $('#edit_acc_email').val('');
                    this.iId = 0;
                    this.iRecordStatus = 0;
                    this.selectedToUpdateAccType = 0;
                    this.selectedToUpdateDegree = 0;
                    this.selectedToUpdateBranch = 0;
                    this.sAccToUpdateName = '';
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            });
        },

        /**
         * Activate / Deactivate Account (Update)
         */
        updateAccountStatus: function () {
            let aActivatedAccStatus = [1, 2];
            let iChangedStatus = aActivatedAccStatus.includes(this.iRecordStatus) ? 3 : 2;
            let sMessage = iChangedStatus === 0 ? 'Successfully deactivated the account' : 'Successfully activated the account';
            let oParam = {
                'acc_id'     : this.iId,
                'acc_status' : iChangedStatus
            };
            this.$root.postRequest('admin/account/deactivate', oParam, (mResponse) => {
                if (mResponse.code === 200) {
                    this.$root.showSuccessToast('Success', sMessage);
                    this.getAccountsList();
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
                $('#edit_acc_uname').val(mSelf.oModalData.data.acc_username);
                $('#edit_acc_name').val(mSelf.oModalData.data.acc_name);
                $('#edit_acc_email').val(mSelf.oModalData.data.acc_email);
                mSelf.iId = mSelf.oModalData.data.acc_id;
                mSelf.iRecordStatus = mSelf.oModalData.data.acc_status;
                mSelf.sAccToUpdateName = mSelf.oModalData.data.acc_name;
                mSelf.selectedToUpdateAccType = mSelf.oModalData.data.acc_at_id;
                mSelf.selectedToUpdateDegree = mSelf.oModalData.data.acc_assoc_degree_id;
                mSelf.selectedToUpdateBranch = mSelf.oModalData.data.acc_assoc_branch_id;
            });
            /** Init behavior for enable button */
            $(document).on('click', '.sys_entenable', function () {
                mSelf.$root.oSystemEntityModalData = JSON.parse(decodeURIComponent(this.dataset.response));
                mSelf.iId = mSelf.$root.oSystemEntityModalData.data.acc_id;
                mSelf.iRecordStatus = mSelf.$root.oSystemEntityModalData.data.acc_status;
                mSelf.updateAccountStatus();
            });
            /** Init behavior for disable button */
            $(document).on('click', '.sys_ent_disable', function () {
                mSelf.$root.oSystemEntityModalData = JSON.parse(decodeURIComponent(this.dataset.response));
                mSelf.iId = mSelf.$root.oSystemEntityModalData.data.acc_id;
                mSelf.iRecordStatus = mSelf.$root.oSystemEntityModalData.data.acc_status;
                mSelf.showModal('Disable');
            });
        },
    }

}
</script>

<style scoped>
@import './Admin.css';
img {
    max-width: 100%;
}
</style>
