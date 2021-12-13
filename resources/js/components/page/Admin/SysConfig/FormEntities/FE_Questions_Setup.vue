<template>
    <div>
        <!-- FORM -->
        <div class="mt-6 w-full ">
            <div class="form outline w-full">
                <h1 style="font-size: 18px; font-weight: bold">Add new form question:</h1><br>
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
                    <label class="form__label">Select a Form Question Group: </label>
                    <select id="fqg_form_question_group_new" v-model="selectedQuesGroup" name="fqg_form_question_group_new" class="form__input place-self-center">
                        <option selected disabled value="0">-- Select Form Question Group --</option>
                        <option v-for="group in aQuesGroup" v-bind:value="group.fqg_id">
                            {{ group.fqg_desc }}
                        </option>
                    </select>
                </div>
                <div class="form__input-group w-11/12">
                    <label class="form__label">Question Description:</label>
                    <input id="ques_desc_new" type="text" class="form__input">
                </div>
                <div class="form__input-group w-6/12">
                    <label class="form__label">Select a Question Type (Primary): </label>
                    <select id="fqg_form_question_type_first_new" v-model="selectedQuesTypePrimary" name="fqg_form_question_type_first_new" class="form__input place-self-center">
                        <option selected disabled value="0">-- Select Form Question Type --</option>
                        <option v-for="type in aQuesType" v-bind:value="type.fqt_id">
                            {{ type.fqt_desc }}
                        </option>
                    </select>
                </div>
                <div v-if="selectedQuesTypePrimary === 2 || selectedQuesTypePrimary === 3 || selectedQuesTypePrimary === 4 || selectedQuesTypePrimary === 5" class="form__input-group w-11/12">
                    <label class="form__label">Choices [For Primary Question Type] (Separate choices by comma): </label>
                    <input id="choices_primary_new" type="text" class="form__input">
                </div>
                <div class="form__input-group w-6/12">
                    <label class="form__label">Select a Question Type (Secondary, Optional): </label>
                    <select id="fqg_form_question_type_second_new" v-model="selectedQuesTypeSecondary" name="fqg_form_question_type_first_new" class="form__input place-self-center">
                        <option selected value="0">-- Select Form Question Type --</option>
                        <option v-for="type in aQuesType" v-bind:value="type.fqt_id">
                            {{ type.fqt_desc }}
                        </option>
                    </select>
                </div>
                <div v-if="selectedQuesTypeSecondary === 2 || selectedQuesTypeSecondary === 3 || selectedQuesTypeSecondary === 4 || selectedQuesTypeSecondary === 5" class="form__input-group w-11/12">
                    <label class="form__label">Choices [For Secondary Question Type] (Separate choices by comma): </label>
                    <input id="choices_secondary_new" type="text" class="form__input">
                </div>
                <div class="form__input-group w-5/12">
                    <label class="form__label">Sequence Layout Number <br> (The Chronological arrangement of question will depend on the given numerical value)</label>
                    <input id="fq_sequence_no_new" type="number" class="form__input" min="1" max="99">
                </div>
                <div class="form__input-group w-5/12">
                    <label class="form__label">Is the question required?: </label>
                    <label class="radio-inline">
                        &nbsp;<input id="ques_required_yes" type="radio" value="1" name="ques_required"> Yes
                    </label>
                    <label class="radio-inline">
                        &nbsp;<input id="ques_required_no" type="radio"value="0" name="ques_required" checked> No
                    </label>
                </div>
                <div class="grid grid-flow-col auto-cols-max">
                    <div class="m-1">
                        <button type="button" class="form__button w-full" @click="resetForm"> Clear All Entries&nbsp;</button>
                    </div>
                    <div class="m-1">
                        <button type="button" class="form__button success w-full" @click="addQuestion">&nbsp;Save&nbsp;</button>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
</template>
<script>
import FormEntitiesFunctions from "../../../../../plugins/Modular/FormEntities/FormEntitiesFunctions";
export default {
    name: "FE_Questions_Setup",
    mixins: [
        FormEntitiesFunctions
    ],
    data() {
        return {
            aForm                     : [],
            aQuesGroup                : [],
            aQuesType                 : [],
            oModalData                : [],
            iId                       : 0,
            iRecordStatus             : 0,
            selectedForm              : 0,
            selectedQuesGroup         : 0,
            selectedQuesTypePrimary   : 0,
            selectedQuesTypeSecondary : 0,
        };
    },
    watch: {
        selectedForm () {
            this.selectedQuesGroup = 0;
            this.initFormQuestionGroup();
        }
    },
    mounted() {
        this.initForm();
        this.initFormQuestionTypes();
    },
    methods: {

        /**
         * Initialize form details
         */
        initForm: function () {
            this.$root.getRequest('admin/form/read/only', (mResult) => {
                this.aForm = mResult.data;
            });
        },

        /**
         * Initialize form question group details
         */
        initFormQuestionGroup: function () {
            let oParams = {'fqg_form_id' : this.selectedForm};
            this.$root.getRequest('admin/form/questions/group/read', (mResult) => {
                this.aQuesGroup = mResult.data;
            }, oParams);
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
         * Resets form for adding new question details
         */
        resetForm: function () {
            this.selectedForm = 0;
            this.selectedQuesGroup = 0;
            this.selectedQuesTypePrimary = 0;
            this.selectedQuesTypeSecondary = 0;
            $('#ques_desc_new').val('');
            $('#choices_primary_new').val('');
            $('#choices_secondary_new').val('');
            $('#fq_sequence_no_new').val('');
            $('#ques_required_no').prop("checked", true);
        },

        /**
         * Add new question details
         */
        addQuestion: function () {
            let mSelf = this;
            let oParam = {
                'fq_sequence_no' : $('#fq_sequence_no_new').val(),
                'fq_desc'        : $('#ques_desc_new').val(),
                'fq_fqg_id'      : this.selectedQuesGroup,
                'fq_fqt_id'      : this.selectedQuesTypePrimary,
                'fq_is_required' : $('input[name="ques_required"]:checked').val()
            };
            // Include secondary question type (optional)
            if (this.selectedQuesTypeSecondary != 0) {
                oParam = Object.assign(oParam, { 'fq_secondary_fqt_id' : this.selectedQuesTypeSecondary});
            }
            this.$root.postRequest('admin/form/questions/create', oParam, (mResponse) => {
                if (mResponse.code === 200) {
                    this.$root.showSuccessToast('Success', 'Successfully created a form question');
                    let aQuesTypeIdsWithChoices = [2, 3, 4, 5];
                    // Check if need to add choices from the primary question type
                    if (aQuesTypeIdsWithChoices.includes(this.selectedQuesTypePrimary)) {
                        mSelf.addChoices(mResponse.data);
                    }
                    // Check if need to add choices from the secondary question type
                    if (aQuesTypeIdsWithChoices.includes(this.selectedQuesTypeSecondary)) {
                        mSelf.addChoices(mResponse.data);
                    }
                    this.resetForm();
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            });
        },

        /**
         * Adds choices from the created question
         * @param iQuestionId
         */
        addChoices: function (iQuestionId) {
            let oParam = {
                'fqc_fq_id' : iQuestionId,
                'fqc_desc'  : $('#choices_primary_new').val(),
            };
            this.$root.postRequest('admin/form/questions/choices/create', oParam, (mResponse) => {});
        }
    }
}
</script>

<style scoped>
@import './../SysConfig.css';
</style>
