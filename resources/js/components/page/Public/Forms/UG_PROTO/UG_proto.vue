<template>
    <div class="tracer_form">
        <br>
        <div class="templates">
            <h1 class="question_group_title template hidden"></h1>
            <hr class="form__hr template hidden"/>
            <div class="form__generated form__input_box template hidden">
                <label class="form__label"></label>
                <input type="text" class="form__input ">
            </div>
            <div class="form__generated form__select template hidden">
                <label class="form__label"></label>
                <select class="form__input place-self-center">
                    <option selected disabled> -- </option>
                    <option class="template hidden"> -- </option>
                </select>
            </div>

            <div class="form__generated form__button_choices template hidden">
                <label class="form__label"></label>
                <div class="form__choices template hidden">
                    <input />
                    <label />
                </div>
            </div>
            <table class="form__generated table_rank template hidden">
                <thead>
                    <tr class="th_rank">
                        <th class="th_desc">Description</th>
                        <th class="th_rank_desc template hidden"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="tr_rank template hidden">
                        <td class="td_rank_desc"></td>
                        <td class="td_rank_button template hidden"> <input type="radio" class="form__input"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="form outline">
            <span class="form__title">General Undergraduate Tracer Survey Form</span>
            <span class="form__subtitle">Please answer the following:</span>
            <br>
            <div class="form__input-group">
                <div id="form_questions">
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
                                <button type="button" class="form__button success w-full place-self-center" @click="save()">Save and Continue</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="js">
    import QuestionHelper from "../../../../../plugins/mixins/QuestionHelper";

    export default {
        mixins : [
            QuestionHelper
        ],
        data() {
            return {
                question_groups: [],
                questions: [],
                choices: [],
                answered_form: []
            }
        },
        created() {
            this.$root.sLayout = 'custom'
            this.initForm();
        },
        mounted() {
        },
        watch: {
            'question_groups': function () {
                this.initGeneration();
            },
            'questions': function () {
                this.initGeneration();
            },
            'choices': function () {
                this.initGeneration();
            },
        },
        methods: {
            initGeneration() {
                $('#form_questions').html('');
                let oThis = this;
                oThis.question_groups.forEach((mQuestionGroupValue, mQuestionGroupIndex) => {
                    oThis.generateHeader(mQuestionGroupValue.fqg_sequence_no, mQuestionGroupValue.fqg_desc);
                    oThis.questions.filter(oValues => { return (oValues.fq_fqg_id ===  mQuestionGroupValue.fqg_id)}).forEach((mQuestionValue, mQuestionIndex) => {
                        let bIsRequired = mQuestionValue.fq_is_required === 1;
                        oThis.generateTextBoxQuestions(mQuestionValue.fq_fqt_id, mQuestionValue.fq_id, mQuestionValue.fq_sequence_no, mQuestionValue.fq_desc, bIsRequired);
                        oThis.generateButtonQuestions(mQuestionValue.fq_fqt_id, mQuestionValue.fq_id, mQuestionValue.fq_sequence_no, mQuestionValue.fq_desc, bIsRequired);
                        oThis.generateDropdownQuestions(mQuestionValue.fq_fqt_id, mQuestionValue.fq_id, mQuestionValue.fq_sequence_no, mQuestionValue.fq_desc, bIsRequired);
                        oThis.generateRankingQuestions(mQuestionValue.fq_fqt_id, mQuestionValue.fq_secondary_fqt_id, mQuestionGroupValue.fqg_id, mQuestionValue.fq_id, mQuestionValue.fq_sequence_no, mQuestionValue.fq_desc, bIsRequired);
                    });
                })
            },
            generateHeader(iSequence, sHeaderDesc) {
                let oTemplate = $('.question_group_title.template').clone().removeClass(['hidden', 'template']);
                oTemplate.text(iSequence + '. ' + sHeaderDesc);
                $('#form_questions').append(oTemplate);
            },
            generateTextBoxQuestions(iQuestionType, iQuestionId, iSequence, sQuestionDesc, bIsRequired) {
                if (iQuestionType !== this.question_types.fill_in_blanks)
                    return false;
                let oTempMedium = $('.form__input_box.template').clone().removeClass(['hidden', 'template']);
                let oTempLabel = oTempMedium.find('.form__label');
                oTempLabel.text(this.generateTextForQuestionLabel(sQuestionDesc, bIsRequired));
                oTempMedium.attr('id', 'textBox-' + iQuestionId + '-' + iSequence);
                oTempMedium.find('input').attr('form_question_id', iQuestionId);
                oTempMedium.find('input').attr('form_question_type', 'input');
                oTempMedium.find('input').prop('required', bIsRequired);
                $('#form_questions').append(oTempMedium);
            },
            generateButtonQuestions(iQuestionType, iQuestionId, iSequence, sQuestionDesc, bIsRequired) {
                if (![this.question_types.radio_button, this.question_types.checkbox_button].includes(iQuestionType))
                    return false;
                let sButtonType = (iQuestionType === this.question_types.radio_button) ? 'radio' : 'checkbox';
                let oTempMedium = $('.form__button_choices.template').clone().removeClass(['hidden', 'template']);
                let oTempLabel = oTempMedium.find('.form__label');
                oTempLabel.text(this.generateTextForQuestionLabel(sQuestionDesc, bIsRequired));
                this.choices.filter(oValues => { return (oValues.fqc_fq_id ===  iQuestionId)}).forEach((oChoice) => {
                    let oTempChoices = oTempMedium.find('.form__choices.template').clone().removeClass(['hidden', 'template']);
                    let sCurrId = 'choice_button-' + iQuestionId + '-' + iSequence + oChoice.fqc_id;
                    oTempChoices.find('label').attr('for', sCurrId);
                    oTempChoices.find('label').text(oChoice.fqc_desc);
                    oTempChoices.find('input').attr('name', 'choice_button-' + iQuestionId);
                    oTempChoices.find('input').attr('id', sCurrId);
                    oTempChoices.find('input').attr('type', sButtonType);
                    oTempChoices.find('input').attr('value', oChoice.fqc_desc);
                    oTempChoices.find('input').prop('required', bIsRequired);
                    oTempChoices.find('input').attr('form_question_id', iQuestionId);
                    oTempChoices.find('input').attr('form_question_type', sButtonType);
                    oTempMedium.append(oTempChoices);
                });
                $('#form_questions').append(oTempMedium);
            },
            generateDropdownQuestions(iQuestionType, iQuestionId, iSequence, sQuestionDesc, bIsRequired) {
                if (iQuestionType !== this.question_types.dropdown)
                    return false;
                let oTempMedium = $('.form__select.template').clone().removeClass(['hidden', 'template']);
                let oTempSelect = oTempMedium.find('select');
                let oTempLabel = oTempMedium.find('.form__label');
                oTempLabel.text(this.generateTextForQuestionLabel(sQuestionDesc, bIsRequired));
                oTempSelect.prop('required', bIsRequired);
                oTempSelect.attr('form_question_id', iQuestionId);
                oTempSelect.attr('form_question_type', 'select');
                this.choices.filter(oValues => { return (oValues.fqc_fq_id ===  iQuestionId)}).forEach((oChoice) => {
                    let oTempChoices = oTempSelect.find('option.template').clone().removeClass(['hidden', 'template']);
                    oTempChoices.text(oChoice.fqc_desc);
                    oTempChoices.attr('value', oChoice.fqc_id);
                    oTempSelect.append(oTempChoices);
                });
                $('#form_questions').append(oTempMedium);
            },
            generateRankingQuestions(iQuestionType, iSecondaryQuestionType, iQuestionGroupId, iQuestionId, iSequence, sQuestionDesc, bIsRequired) {
                if (!Object.values(this.question_types.ranking).includes(iQuestionType))
                    return false;

                let sCurrId = 'table_rank-' + iQuestionGroupId + '-' + iQuestionType + '-' + iSecondaryQuestionType;
                let oRankSet1 = Object.values(this.ranking).find(oValues => { return oValues.value === iQuestionType });
                let oRankSet2 = Object.values(this.ranking).find(oValues => { return oValues.value === iSecondaryQuestionType });
                oRankSet1 = (oRankSet1 !== undefined) ? Object.values(oRankSet1.data) : [];
                oRankSet2 = (oRankSet2 !== undefined) ? Object.values(oRankSet2.data) : [];
                oRankSet2 = oRankSet2.sort((a, b) => { return b.value - a.value; });

                if ($('#' + sCurrId).length <= 0) {
                    let oTempTable = $('.table_rank.template').clone().removeClass(['hidden', 'template']);
                    oTempTable.attr('id', sCurrId);
                    $('#form_questions').append(oTempTable);
                    oRankSet1.forEach((oRank) => {
                        let oThead = $('#' + sCurrId).find('th.th_rank_desc.template').clone().removeClass(['hidden', 'template']);
                        oThead.text(oRank.text);
                        $('#' + sCurrId).find('th.th_desc').after(oThead);
                    });
                    oRankSet2.forEach((oRank) => {
                        let oThead = $('#' + sCurrId).find('th.th_rank_desc.template').clone().removeClass(['hidden', 'template']);
                        oThead.text(oRank.text);
                        $('#' + sCurrId).find('th.th_desc').before(oThead);
                    });
                }
                let oTempTbodyTr = $('#' + sCurrId).find('.tr_rank.template').clone().removeClass(['hidden', 'template']);
                oTempTbodyTr.find('.td_rank_desc').text(sQuestionDesc);
                oRankSet1.forEach((oRank) => {
                    let oTdInput = oTempTbodyTr.find('.td_rank_button.template').clone().removeClass(['hidden', 'template']);
                    oTdInput.find('input').val(oRank.value);
                    oTdInput.find('input').attr('name', 'radio1-'  + iQuestionGroupId + '-' + iQuestionType + '-' + iSecondaryQuestionType);
                    oTdInput.find('input').attr('form_question_id', iQuestionId);
                    oTdInput.find('input').attr('form_question_type', 'ranking');
                    oTdInput.find('input').attr('is_secondary', false);
                    oTempTbodyTr.find('.td_rank_desc').after(oTdInput);
                });
                oRankSet2.forEach((oRank) => {
                    let oTdInput = oTempTbodyTr.find('.td_rank_button.template').clone().removeClass(['hidden', 'template']);
                    oTdInput.find('input').val(oRank.value);
                    oTdInput.find('input').attr('name', 'radio2-'  + iQuestionGroupId + '-' + iQuestionType + '-' + iSecondaryQuestionType);
                    oTdInput.find('input').attr('form_question_id', iQuestionId);
                    oTdInput.find('input').attr('form_question_type', 'ranking');
                    oTdInput.find('input').attr('is_secondary', true);
                    oTempTbodyTr.find('.td_rank_desc').before(oTdInput);
                });
                $('#' + sCurrId).find('tbody').append(oTempTbodyTr);
            },
            generateTextForQuestionLabel(sQuestionDesc, bIsRequired) {
                return (bIsRequired === true) ? sQuestionDesc + '*' : sQuestionDesc;
            },
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
            save: function() {
                let oThis = this;
                oThis.answered_form = [];
                $('[form_question_id]').not('.template').each(function(iIndex, oElement) {
                    oElement = $(oElement);
                    let sType = oElement.attr('form_question_type');
                    let iQuestionId = oElement.attr('form_question_id');
                    let mAnswer = (sType === 'input' || sType === 'select') ?  oElement.val() : ((oElement.is(':checked') === true) ? oElement.val() : null);
                    let bIsSecondary = (oElement.attr('is_secondary') === "true");
                    if(mAnswer !== null) {
                        oThis.answered_form.push({
                            fa_fq_id : iQuestionId,
                            fa_answer : mAnswer,
                            fa_is_secondary_answer : bIsSecondary
                        });
                    }
                });
            }
        }
    }
</script>

<style scoped>
@import './UG_proto.css';
</style>
