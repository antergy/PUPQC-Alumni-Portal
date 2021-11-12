<template>
    <div class="tracer_form">
        <br>
        <div class="form outline">
            <span class="form__title">General Undergraduate Tracer Survey Form</span>
            <span class="form__subtitle">Please answer the following:</span>
            <br>
            <div class="form__input-groupz">
                <div v-for="group in question_groups">
                    <h1 class="question_group_title">{{ group.fqg_sequence_no }}. {{ group.fqg_desc }}</h1>
                    <hr>
                    <div v-if="questions !== null">
                        <div v-for="question in questions" class="m-2 w-5/12" >
                            <div v-if="question.fq_fqg_id === group.fqg_id">
                                <!-- If question type is Fill in the blank -->
                                <div class="m-2" v-if="question.fq_fqt_id === question_types.fill_in_blanks">
                                    <label class="form__label"> {{ question.fq_desc }}: </label>
                                    <input type="text" :placeholder="question.fq_desc" class="form__input" :id="question.fq_id">
                                </div>
                                <!-- If question type is Dropdown -->
                                <div class="m-2" v-if="question.fq_fqt_id === question_types.dropdown">
                                    <label class="form__label"> {{ question.fq_desc }}: </label>
                                    <select name="branch" class="form__input place-self-center">
                                        <option selected disabled> -- </option>
                                        <option v-if="question.fq_id === choice.fqc_fq_id" v-for="choice in choices" v-bind:value="choice.fqc_id">
                                            {{ choice.fqc_desc }}
                                        </option>
                                    </select>
                                </div>
                                <!-- If question type is radio button -->
                                <div class="m-2" v-if="question.fq_fqt_id === question_types.radio_button">
                                    <label class="form__label"> {{ question.fq_desc }}: </label>
                                    <div v-for="choice in choices">
                                        <div v-if="question.fq_id === choice.fqc_fq_id">
                                            <input type="radio" :id="'radio-' + question.fq_id + '-' + choice.fqc_id" :name="question.fq_desc"/>
                                            <label :for="'radio-' + question.fq_id + '-' + choice.fqc_id">{{ choice.fqc_desc }}</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- If question type is checkboxes -->
                                <div class="m-2" v-if="question.fq_fqt_id === question_types.checkbox_button">
                                    <label class="form__label"> {{ question.fq_desc }}: </label>
                                    <div v-for="choice in choices">
                                        <div v-if="question.fq_id === choice.fqc_fq_id">
                                            <input type="checkbox" :id="choice.fqc_id" :name="choice.fqc_desc"/>
                                            <label :for="choice.fqc_desc">{{ choice.fqc_desc }}</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- If question type is ranking -->
                                <div class="m-2" v-if="question.fq_fqt_id === question_types.ranking.extent">
                                    <label class="form__label"> {{ question.fq_desc }}: </label>
                                    <div>-- input field pending --</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    import QuestionHelper from "../../../../../plugins/mixins/QuestionTypes";

    export default {
        mixins : [
            QuestionHelper
        ],
        data() {
            return {
                question_groups: [],
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
                /** Get the form question groups by given form id */
                this.$root.getRequest('admin/form/questions/group/read', (mResult) => {
                    this.question_groups = mResult.data
                }, {fqg_form_id: 1})

                /** Get the form questions by active status = 1 */
                this.$root.getRequest('admin/form/questions/read', (mResult) => {
                    this.questions = mResult.data
                }, {fq_active_status: 1})

                /** Get the form question choices */
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
