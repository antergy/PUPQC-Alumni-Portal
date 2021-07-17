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
<!--                  <button type="button" id="btnRefresh" class="form__button info w-2/12 mb-5">&nbsp;&nbsp;Refresh Table&nbsp; &nbsp; </button>-->
                  <table id="tbl_account_list" class="cell-border m-2">
                      <thead>
                      <tr>
                          <th>Username</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Account Type</th>
                          <th>Status</th>
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
                          <label class="form__label">Account Type</label>
                          <select id="acc_type" name="acc_type" class="form__input">
                              <option value="0" disabled selected>-- Select Account Type--</option>
                              <option value="1">Administrator</option>
                              <option value="2">Alumni</option>
                          </select>
                      </div>
                      <div class="form__input-group w-8/12">
                          <div class="grid grid-flow-col auto-cols-max">
                              <div class="m-1">
                                  <button type="button" id="btnClear" class="form__button w-full">&nbsp; &nbsp; Clear All Entries&nbsp; &nbsp; </button>
                              </div>
                              <div class="m-1">
                                  <button type="button" id="btnSave" class="form__button success w-full">&nbsp;&nbsp;Save&nbsp; &nbsp; </button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
        };
    },
    created() {
        this.$root.setUserInfo();
    },
    mounted() {
        this.initTabs();
        this.initEvents();
        this.getAccountsList();
    },
    methods: {
        /**
         * Initialize events
         */
        initEvents: function () {
            let mSelf = this;
            // $('#btnRefresh').click(function () {
            //     mSelf.getAccountsList();
            // });
            $('#btnSave').click(function () {
               mSelf.createAccount();
            });
            $('#btnClear').click(function () {
                mSelf.resetForm();
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
            let mSelf = this;
            $('#tbl_account_list').DataTable({
                "ajax": {
                    url: '/admin/account/read',
                    dataSrc: function (json) {
                        var reformatted_data = [];
                        $.each(json.data, function (key, value) {
                            reformatted_data.push({
                                'acc_username': value.acc_username,
                                'acc_name': value.acc_name,
                                'acc_email': value.acc_email,
                                'acc_type': value.at_desc,
                                'acc_status': mSelf.getStatusLabel(value.acc_status)
                            })
                        });
                        return reformatted_data;
                    }
                },
                "columns": [
                    {data: 'acc_username'},
                    {data: 'acc_name'},
                    {data: 'acc_email'},
                    {data: 'acc_type'},
                    {data: 'acc_status'}
                ],
                "order": [[0, "asc"]]
            });
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
                'acc_at_id'           : parseInt($('#acc_type').val()),
                'acc_status'          : 2,
                'acc_assoc_degree_id' : 1,
                'acc_assoc_branch_id' : 2
            };
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
         * Resets form
         */
        resetForm: function () {
            $('#acc_uname').val('');
            $('#acc_password').val('');
            $('#acc_name').val('');
            $('#acc_email').val('');
            $('#acc_type').val(0)
        }
    }

}
</script>

<style scoped>
@import './Admin.css';
</style>
