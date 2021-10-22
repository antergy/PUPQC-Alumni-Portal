<template>
    <div class="tracer_form">
        <br>
        <div class="form outline">
            <span class="form__title">General Undergraduate Tracer Survey Form</span>
            <span class="form__subtitle">Please answer the following:</span>
            <br>
            <div class="form__input-group">
                <div v-if="questions !== null">
                    <div v-for="question in questions" class="m-2 w-5/12" >
                        <div class="m-2" v-if="question.fq_fqt_id === 1">
                            <label class="form__label"> {{ question.fq_desc }} </label>
                            <input type="text" :placeholder="question.fq_desc" class="form__input" :id="question.fq_id">
                        </div>
                        <div class="m-2" v-if="question.fq_fqt_id === 2">
                            <label class="form__label"> {{ question.fq_desc }} </label>
                            <select name="branch" class="form__input place-self-center">
                                <option v-for="choice in choices" v-bind:value="choice.fqc_id">
                                    {{ choice.fqc_desc }}
                                </option>
                            </select>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <p class="form__subtitle">Form Questions are still on the process of consolidation and development...</p>
            <img src="/img/udercons.gif" style="width: 100%; height: 100%"/>
            <div>
                <br><br>
                <span class="form__title"> </span>
                <div style="text-align: center">
                    <p><b>-- End of Survey Form --</b></p><br>
                    <p class="place-self-center">Thank you for cooperation! <br><br>
                        By clicking "Save and Continue", all the details you have entered will be saved and can be seen later on on your profile,<br> and then you will be redirected your portal's homepage.<br><br>
                        Otherwise, by clicking "Cancel", all the data you have entered will be reset<br> and you will be redirected to the degree selection page.
                    </p>
                    <br><br>
                    <div class="form__input-group">
                        <div class="grid grid-flow-col auto-cols-max place-self-center">
                            <div class="m-1">
                                <button type="button" class="form__button error info w-full place-self-center" @click="doCancel()" >Cancel</button>
                            </div>
                            <div class="m-1">
                                <button type="button" class="form__button success w-full place-self-center">Save and Continue</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="js">
export default {
  data() {
    return {
        questions: [],
        choices: []
    }
  },
    created() {
        this.$root.sLayout = 'custom'
        this.initForm();
    },
    mounted() {

    },
    methods: {
        initForm: function () {
            this.$root.getRequest('admin/form/questions/read', (mResult) => {
               this.questions = mResult.data
            }, {fq_active_status:1})

            this.$root.getRequest('admin/form/questions/choices/read', (mResult) => {
                this.choices = mResult.data
            })
        },

        doCancel: function () {
            let mSelf = this;
            Swal.fire({
                title: "Are you sure you want to cancel answering the form?",
                text: "By cancelling, all your inputs will be reset and you will be redirected to homepage.",
                icon: "warning",
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
                backdrop: `rgba(128, 128, 128, 0.4)`,
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$router.push('/home');
                }
            });
        },
    }
}
</script>

<style scoped>
@import './UG_proto.css';
</style>
