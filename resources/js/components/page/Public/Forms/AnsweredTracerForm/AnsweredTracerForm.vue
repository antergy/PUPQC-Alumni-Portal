<template>
    <div class="tracer_form">
        <br>
        <div class="templates">
            <h1 class="question_group_title template hidden"></h1>
            <hr class="form__hr template hidden"/>
            <div class="form__generated form__input_box template hidden">
                <label class="form__label form_error_handler"></label>
                <input type="text" class="form__input ">
            </div>
            <div class="form__generated form__select template hidden">
                <label class="form__label form_error_handler"></label>
                <select class="form__input place-self-center">
                    <option selected disabled> -- </option>
                    <option class="template hidden"> -- </option>
                </select>
            </div>

            <div class="form__generated form__button_choices template hidden">
                <label class="form__label form_error_handler"></label>
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
                    <td class="td_rank_desc form_error_handler"></td>
                    <td class="td_rank_button template hidden">
                        <input type="radio" class="form__input">
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="form outline">
            <span id="form_description" class="form__title"></span>
            <span class="form__subtitle">Please answer the following:</span>
            <br>
            <div class="form__input-group">
                <div id="form_questions">
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
                answered_form: [],
                form_group_id: this.$route.params.id ?? 0,
                form_id: 0
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
            initForm: function () {
                let oThis = this;
                /** Get the form question choices */
                oThis.$root.getRequest('admin/form/questions/choices/read', (mResult) => {
                    oThis.choices = mResult.data
                });

                /** Get the answered form */
                oThis.$root.getRequest('v1/form/questions/answers/read', (mResult) => {
                    oThis.answered_form = mResult.data;
                    oThis.form_id = mResult.data[0].fag_form_id;

                    /** Get the form question groups by given form id */
                    oThis.$root.getRequest('admin/form/questions/group/read', (mResult) => {
                        oThis.question_groups = mResult.data
                    }, {fqg_form_id: oThis.form_id})
                    /** Get the form description */

                    oThis.$root.getRequest('v1/form/read', (mResult) => {
                        $('#form_description').text(mResult.data[0].form_desc);
                    }, {form_id: oThis.form_id});

                    /** Get the form questions by active status = 1 */
                    oThis.$root.getRequest('admin/form/questions/read', (mResult) => {
                        oThis.questions = mResult.data
                    }, {fq_active_status: 1, fqg_form_id: this.form_id});

                }, {fa_fag_id: oThis.form_group_id});

            },
            initGeneration() {
                $('#form_questions').html('');
                let oThis = this;
                let iSequence = 0;
                oThis.question_groups.forEach((mQuestionGroupValue, mQuestionGroupIndex) => {
                    oThis.generateHeader(mQuestionGroupValue.fqg_sequence_no, mQuestionGroupValue.fqg_desc);
                    oThis.questions.filter(oValues => { return (oValues.fq_fqg_id ===  mQuestionGroupValue.fqg_id)}).forEach((mQuestionValue, mQuestionIndex) => {
                        let bIsRequired = mQuestionValue.fq_is_required === 1;
                        iSequence ++;
                        oThis.generateTextBoxQuestions(mQuestionValue.fq_fqt_id, mQuestionValue.fq_id, mQuestionValue.fq_sequence_no, mQuestionValue.fq_desc, bIsRequired);
                        oThis.generateButtonQuestions(mQuestionValue.fq_fqt_id, mQuestionValue.fq_id, mQuestionValue.fq_sequence_no, mQuestionValue.fq_desc, bIsRequired);
                        oThis.generateDropdownQuestions(mQuestionValue.fq_fqt_id, mQuestionValue.fq_id, mQuestionValue.fq_sequence_no, mQuestionValue.fq_desc, bIsRequired);
                        oThis.generateRankingQuestions(mQuestionValue.fq_fqt_id, mQuestionValue.fq_secondary_fqt_id, mQuestionGroupValue.fqg_id, mQuestionValue.fq_id, iSequence, mQuestionValue.fq_desc, bIsRequired);
                    });
                });
                this.showAnswers();
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
                oTempTbodyTr.attr('required', bIsRequired);
                let sCurrName = iQuestionGroupId + '-' + iQuestionType + '-' + iSecondaryQuestionType + '-' + iSequence;
                iSequence++;
                oRankSet1.forEach((oRank) => {
                    let oTdInput = oTempTbodyTr.find('.td_rank_button.template').clone().removeClass(['hidden', 'template']);
                    oTdInput.find('input').val(oRank.value);
                    oTdInput.find('input').attr('name', 'radio1-'  + sCurrName);
                    oTdInput.find('input').attr('form_question_id', iQuestionId);
                    oTdInput.find('input').attr('form_question_type', 'ranking');
                    oTdInput.find('input').attr('is_secondary', false);
                    oTempTbodyTr.find('.td_rank_desc').after(oTdInput);
                });
                oRankSet2.forEach((oRank) => {
                    let oTdInput = oTempTbodyTr.find('.td_rank_button.template').clone().removeClass(['hidden', 'template']);
                    oTdInput.find('input').val(oRank.value);
                    oTdInput.find('input').attr('name', 'radio2-'  + sCurrName);
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
            showAnswers: function() {
                this.answered_form.forEach(function(oData, iIndex) {
                    let mAnswer = oData.fa_answer;
                    $('[form_question_id=' + oData.fa_fq_id + ']').each(function(iIndex, oElement) {
                        oElement = $(oElement);
                        let sType = oElement.attr('form_question_type');
                        if (['ranking', 'checkbox', 'radio'].includes(sType) === true) {
                            (oElement.is('[value="' + mAnswer + '"]')) && oElement.prop('checked', true);
                        } else {
                            oElement.val(mAnswer);
                        }
                    });
                });
            }
        }
    }
</script>

<style scoped>
@import 'AnsweredTracerForm.css';
</style>
