<template>
  <div class="admin">
      <div class="w-full mx-auto mt-4 ml-20 rounded">
          <p class="text-2xl">Tracer Form Management</p>
          <div class="separator"></div>
          <!-- Tab Contents -->
          <div class="bg-white w-full">
              <div v-if="bGoogleAuthenticated === false" style="text-align: center; padding-top: 10%">
                  <div
                      style="background-color: #add8e6; width: 50%; margin: 0 auto; border-radius: 10px">
                      <br>
                      <font-awesome-icon fas icon="info" size="2x" />
                      <p>This page requires you to authenticate to your google workspace account.</p>
                  </div>
                  <br>
                  <img src="/img/google_workspace.png" style="width: 30%; height: 30%; margin: 0 auto"/>
                  <br>
                  <button type="button" class="form__button info w-3/12" @click="authenticateToGoogle">&nbsp;<span style="margin: 5px; font-size: 17px">Authenticate</span></button>
                  <br>
              </div>
              <div v-else-if="bGoogleAuthenticated === true">
                  <ul id="tabs" class="inline-flex w-full mt-4 ">
                      <li class="px-4 py-2 -mb-px font-semibold text-gray-800 border-b-2 border-blue-400 rounded-t opacity-50">
                          <a id="default-tab" href="#first">Manage Google Forms</a>
                      </li>
                      <li class="px-4 py-2 font-semibold text-gray-800 rounded-t opacity-50" @click="refreshGoogleForms">
                          <a href="#second">Set System Forms</a>
                      </li>
                  </ul>
                  <!-- Tab Contents -->
                  <div id="tab-contents" class="bg-white w-fullx">
                      <!-- FIRST TAB CONTENT -->
                      <div id="first" class="p-4">
                          <!-- FORM -->
                          <div class="mt-6 w-full ">
                              <div class="form outline w-full">
                                  <h1 style="font-size: 18px; font-weight: bold">Add new Google form:</h1><br>
                                  <div class="form__input-group w-7/12">
                                      <label class="form__label">Google Form Name</label>
                                      <input id="google_form_name_new" type="text" class="form__input">
                                  </div>
                                  <div class="grid grid-flow-col auto-cols-max">
                                      <div class="m-1">
                                          <button type="button" class="form__button w-full" @click="resetGoogleForm"> Clear Entries&nbsp;</button>
                                      </div>
                                      <div class="m-1">
                                          <button type="button" class="form__button success w-full" @click="addGoogleForm">&nbsp;Save&nbsp;</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <br>
                          <button type="button" class="form__button info w-2/12" @click="getTracerList"> Refresh Table&nbsp;</button>
                          <br>
                          <!-- TABLE -->
                          <table id="tbl_google_forms" class="cell-border m-2" width="100%">
                              <thead>
                              <tr>
                                  <th style="width: 35%">Name</th>
                                  <th style="width: 15%">Created At</th>
                                  <th style="width: 15%">Last Modified</th>
                                  <th style="width: 20%">Action</th>
                              </tr>
                              </thead>
                          </table>
                      </div>
                      <!-- SECOND TAB CONTENT -->
                      <div id="second" class="hidden p-4">
                          <FE_Basic_General />
                      </div>
                  </div>
              </div>
              <div v-else>

              </div>
          </div>
      </div>
  </div>
</template>

<script>
import {AppBus} from "../../../appBus";
import FE_Basic_General from "./SysConfig/FormEntities/FE_Basic_General";
export default {
    components: {
        FE_Basic_General
    },
    data() {
        return {
            bGoogleAuthenticated : '',
            sRedirectUrl : ''
        };
    },
    created() {
        this.$root.setUserInfo();
    },
    mounted() {
        this.checkGoogleAuth();
    },
    methods: {
        refreshGoogleForms() {
            AppBus.$emit('refresh');
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
        checkGoogleAuth() {
            let mSelf = this;
            this.$root.getRequest('checkGoogleAuth', (mResponse) => {
                if (mResponse.message === 'You are finally redirected') {
                    this.bGoogleAuthenticated = true;
                    setTimeout(function () {
                        mSelf.initTabs();
                        mSelf.getTracerList();
                    }, 1000)
                } else {
                    this.sRedirectUrl = mResponse.data.url;
                    this.bGoogleAuthenticated = false;
                }
            });
        },
        authenticateToGoogle() {
            window.location.href = this.sRedirectUrl;
        },
        getTracerList() {
            let sUrl = '/getForms';
            $('#tbl_google_forms').DataTable().destroy();
            $('#tbl_google_forms').DataTable({
                "ajax": {
                    url: sUrl,
                    dataSrc: function (json) {
                        var reformatted_data = [];
                        $.each(json, function (key, value) {
                            reformatted_data.push({
                                'name'     : value.name,
                                'created'  : new Date(value.createdTime).toLocaleString(),
                                'modified' : new Date(value.modifiedTime).toLocaleString(),
                                'url'      : '<a type="button" class="form__button w-5/12 sys_ent_modify" style="text-align:center; background-color: #F59E0B; color: white; width:40%; border-radius: 10px" target="_blank" href="' + value.webViewLink + '"> Modify Form</a>' +
                                             '&nbsp;<a type="button" class="form__button w-5/12" style="text-align:center; background-color: #1876ff; color: white; width:50%; border-radius: 10px" target="_blank" href="' + value.webViewLink + '#responses"> Check Responses </a>',
                            });
                        });
                        return reformatted_data;
                    }
                },
                "columns": [
                    {data: 'name'},
                    {data: 'created'},
                    {data: 'modified'},
                    {data: 'url'},
                ],
                "order": [[2, "desc"]]
            });
        },
        /**
         * Resets google form for adding new form details
         */
        resetGoogleForm: function () {
            $('#google_form_name_new').val('');
        },
        /**
         * Add new form details
         */
        addGoogleForm: function () {
            let oParam = {
                'google_form_name' : $('#google_form_name_new').val()
            };
            let mSelf = this;
            this.$root.postRequest('google/form/create', oParam, (mResponse) => {
                if (mResponse.code === 200) {
                    mSelf.resetGoogleForm();
                    mSelf.getTracerList();
                    Swal.fire({
                        title: "Successfully created a google form!",
                        text: "Do you want to edit your newly created form now?",
                        icon: "success",
                        showDenyButton: false,
                        showCancelButton: true,
                        confirmButtonText: `Yes`,
                        denyButtonText: `No`,
                        backdrop: `rgba(128, 128, 128, 0.4)`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.open(mResponse.data.webViewLink);
                        }
                    });
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            });
        },
    }

}
</script>

<style scoped>
@import './Admin.css';
</style>
