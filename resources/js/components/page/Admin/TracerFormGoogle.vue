<template>
  <div class="admin">
      <div class="w-full mx-auto mt-4 ml-20 rounded">
          <p class="text-2xl">Tracer Form Management</p>
          <div class="separator"></div>
          <!-- Tab Contents -->
          <div class="bg-white w-full">

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
        // this.getTracerList();
        this.checkGoogleAuth();
    },
    methods: {
        checkGoogleAuth() {
            this.$root.getRequest('checkGoogleAuth', (mResponse) => {
                if (mResponse.message === 'You are finally redirected') {
                    alert('Authenticated!');
                    this.$root.getRequest('getForms', (mResponse) => {
                       console.log(mResponse);
                    });
                } else {
                    window.open(mResponse.data.url);
                }
            });
        },
        getTracerList() {
            let sUrl = '/v1/form/questions/answers/group/read';
            let mSelf = this;
            $('#tbl_tracer_list').DataTable().destroy();
            $('#tbl_tracer_list').DataTable({
                "ajax": {
                    url: sUrl,
                    dataSrc: function (json) {
                        var reformatted_data = [];
                        $.each(json.data, function (key, value) {
                            reformatted_data.push({
                                'reference_no' : value.fag_reference_no,
                                'name'         : (value.fag_name !== null && value.fag_name.length > 0) ? value.fag_name : 'Anonymous',
                                'form_desc'    : value.form_desc,
                                'email'        : (value.acc_email !== null) ? value.acc_email : value.fag_email,
                                'remarks'      : value.fag_remarks,
                                'status'       : value.fag_status,
                                'fag_id'       : '<a type="button" class="form__button w-5/12 sys_ent_modify" style="text-align:center; background-color: #F59E0B; color: white; width:100%; border-radius: 10px"  href="/tracerForm/answer/' + value.fag_id + '"> View</a>',
                            });
                        });
                        return reformatted_data;
                    }
                },
                "columns": [
                    {data: 'reference_no'},
                    {data: 'name'},
                    {data: 'form_desc'},
                    {data: 'email'},
                    {data: 'remarks'},
                    {data: 'status'},
                    {data: 'fag_id'},
                ],
                "order": [[0, "asc"]]
            });
        }
    }

}
</script>

<style scoped>
@import './Admin.css';
</style>
