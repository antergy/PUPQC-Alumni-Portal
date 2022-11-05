<template>
    <div class="profile" style="width: 60%">
        <div class="form outline">
            <span class="form__title place-self-center">Welcome to PUPQC Alumni Portal!</span>
            <span class="form__subtitle place-self-center">PUPQC is concerned for each of its students' future</span>
            <br>
            <div class="m-3">
                <p style="text-align: center">
                    To ensure quality education to our students, PUPQC conducts a survey to its every alumni to know their
                    current whereabouts
                    after graduating.
                    <br><br>
                    PUPQC will analyze the collected data from the survey by doing a "Tracer Study", and will use it to
                    formulate <br> the best recommendations and actions plans to
                    further improve the quality of education <br> that can be provided for the future students.
                    <br><br>
                    In line with this, PUPQC needs your help by participating to this survey.
                    Below is the selection of tracer forms, please choose the appropriate form for you.
                    <br><br>
                    For Data Privacy Act Statement, click the button below:
                    <br>
                    <button @click="showDPAStatement" class="form__button success w-3/12 place-self-center">View DPA Statement</button>
                </p>
            </div>
            <div>
                <div class="w-6/12" style="margin: 0 auto">
                    <div class="form__input-group xxx-lg">
                        <label class="form__label">Select Tracer Form: </label>
                        <select id="branch" v-model="selectedForm" name="branch"
                                class="form__input place-self-center">
                            <option selected disabled value="0">-- Select Form --</option>
                            <option v-for="form in aForms" v-bind:value="form.form_id">
                                {{ form.form_desc }}
                            </option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="w-6/12" style="margin: 0 auto">
                    <div class="g-recaptcha"
                         data-sitekey="6LcLrSEiAAAAACYKaBtfRcuQ5ZY6V4A6EQdT0CxC"
                         data-callback="onSubmit"
                         data-expired-callback="onExpire"
                         data-error-callback="onExpire"
                         style="margin-left: 15%"
                    ></div>
                </div>
                <br>
                <div class="form__input-group">
                    <div class="grid grid-flow-col auto-cols-max place-self-center">
                        <div class="m-1">
                            <button type="button" id="btnRedirect" class="form__button w-full place-self-center" style="background-color: #B5B5B5" disabled>
                                Go to Tracer Form
                            </button>
                        </div>
                        <div class="m-1">
                            <button type="button" id="btnCancel" class="form__button w-full place-self-center">Cancel</button>
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
                aForms: [],
                selectedForm: 0,
                sEmail : ''
            }
        },
        created() {
            this.$root.sLayout = 'custom'
            this.sEmail = window.localStorage.getItem('tracer.email');
        },
        watch: {
            sEmail : function(sEmail) {
                if (this.validateEmail(this.sEmail) !== null) {
                    window.localStorage.setItem('tracer.email', sEmail);
                }
            }
        },
        mounted() {
            this.initForms();
            this.initEvents()
        },
        methods: {
            test: function () {
                console.log('saasasas')
            },
            showDPAStatement: function () {
                Swal.fire({
                    // imageUrl: '/img/rop-npc.png',
                    width: '1000px',
                    height: '400px',
                    html:
                       '<div class="col-md-12" style="text-align: center; margin-bottom: 10px; color: black; width: auto; height: 400px; overflow: scroll">\n' +
                        '                            <img src="/img/rop-npc.png" style="width: 30%; margin: 0 auto" alt="">\n' +
                        '                            <h4>Republic of the Philippines<br><b style="font-size: 20px">National Privacy Commission</b></h4>\n' +
                        '                            <h3>Implementing Rules and Regulations of the Data Privacy Act of 2012</h3>\n' +
                        '                            <p style="text-align: justify; font-size: 15px; margin: 10px">\n' +
                        '                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n' +
                        '                                Pursuant to the mandate of the National Privacy Commission to administer and implement the provisions of the Data Privacy Act of 2012, and to monitor and ensure compliance of the country with international standards set for data protection, the following rules and regulations are hereby promulgated to effectively implement the provisions of the Act:\n' +
                        '                            </p>\n' +
                        '                            <b style="font-size: 17px;">\n' +
                        '                                This modal discusses only the Section 19: Principles in Collection, Processing and Retention,<br> under the Rule IV: Data Privacy Principles\n' +
                        '                            </b>\n' +
                        '<div class="col-md-12" style="text-align: justify; margin-bottom: 10px; color: black">\n' +
                        '                            <p style="font-size: 15px; margin-left: 5%">\n' +
                        '                                Section 19. General principles in collection, processing and retention. The processing of personal data shall adhere to the following general principles in the collection, processing, and retention of personal data:\n' +
                        '                            </p>\n' +
                        '                            <p style="font-size: 15px; margin-left: 8%; font-weight: bold">\n' +
                        '                                a. Collection must be for a declared, specified, and legitimate purpose.\n' +
                        '                            </p>\n' +
                        '                            <p style="font-size: 15px; margin-left: 10%">\n' +
                        '                                1. Consent is required prior to the collection and processing of personal data, subject to exemptions provided by the Act and other applicable laws and regulations. When consent is required, it must be time-bound in relation to the declared, specified and legitimate purpose. Consent given may be withdrawn.\n' +
                        '                                <br><br>\n' +
                        '                                2. The data subject must be provided specific information regarding the purpose and extent of processing, including, where applicable, the automated processing of his or her personal data for profiling, or processing for direct marketing, and data sharing.\n' +
                        '                                <br><br>\n' +
                        '                                3. Purpose should be determined and declared before, or as soon as reasonably practicable, after collection.\n' +
                        '                                <br><br>\n' +
                        '                                4. Only personal data that is necessary and compatible with declared, specified, and legitimate purpose shall be collected.\n' +
                        '                            </p>\n' +
                        '                            <p style="font-size: 15px; margin-left: 8%; font-weight: bold">\n' +
                        '                                b. Personal data shall be processed fairly and lawfully.\n' +
                        '                            </p>\n' +
                        '                            <p style="font-size: 15px; margin-left: 10%">\n' +
                        '                                1. Processing shall uphold the rights of the data subject, including the right to refuse, withdraw consent, or object. It shall likewise be transparent, and allow the data subject sufficient information to know the nature and extent of processing.\n' +
                        '                                <br><br>\n' +
                        '                                2. Information provided to a data subject must always be in clear and plain language to ensure that they are easy to understand and access.\n' +
                        '                                <br><br>\n' +
                        '                                3. Processing must be in a manner compatible with declared, specified, and legitimate purpose.\n' +
                        '                                <br><br>\n' +
                        '                                4. Processed personal data should be adequate, relevant,  and limited to what is necessary in relation to the purposes for which they are processed.\n' +
                        '                                <br><br>\n' +
                        '                                5. Processing shall be undertaken in a manner that ensures appropriate privacy and security safeguards.\n' +
                        '                            </p>\n' +
                        '                            <p style="font-size: 15px; margin-left: 8%; font-weight: bold">\n' +
                        '                                c. Processing should ensure data quality.\n' +
                        '                            </p>\n' +
                        '                            <p style="font-size: 15px; margin-left: 10%">\n' +
                        '                                1. Personal data should be accurate and where necessary for declared, specified and legitimate purpose, kept up to date.\n' +
                        '                                <br><br>\n' +
                        '                                2. Inaccurate or incomplete data must be rectified, supplemented, destroyed or their further processing restricted.\n' +
                        '                            </p>\n' +
                        '                            <p style="font-size: 15px; margin-left: 8%; font-weight: bold">\n' +
                        '                                d. Personal Data shall not be retained longer than necessary.\n' +
                        '                            </p>\n' +
                        '                            <p style="font-size: 15px; margin-left: 10%">\n' +
                        '                                1.           Retention of personal data shall only for as long as necessary:\n' +
                        '                                <br><br>\n' +
                        '                                <i style="font-size: 13px;">\n' +
                        '                                    (a) for the fulfillment of the declared, specified, and legitimate purpose, or when the processing relevant to the purpose has been terminated;\n' +
                        '                                    <br>\n' +
                        '                                    (b) for the establishment, exercise or defense of legal claims; or\n' +
                        '                                    <br>\n' +
                        '                                    (c) for legitimate business purposes, which must be consistent with standards followed by the applicable industry or approved by appropriate government agency.\n' +
                        '                                </i>\n' +
                        '                                <br><br>\n' +
                        '                                2.           Retention of personal data shall be allowed in cases provided by law.\n' +
                        '                                <br><br>\n' +
                        '                                3.           Personal data shall be disposed or discarded in a secure manner that would prevent further processing,   unauthorized access, or disclosure to any other party or the public, or prejudice the interests of the data subjects.\n' +
                        '                            </p>\n' +
                        '                            <p style="font-size: 15px; margin-left: 8%; font-weight: bold">\n' +
                        '                                e. Any authorized further processing shall have adequate safeguards.\n' +
                        '                            </p>\n' +
                        '                            <p style="font-size: 15px; margin-left: 10%">\n' +
                        '                                1. Personal data originally collected for a declared, specified, or legitimate purpose may be processed further for historical, statistical, or scientific purposes, and, in cases laid down in law, may be stored for longer periods, subject to implementation of the appropriate organizational, physical, and technical security measures required by the Act in order to safeguard the rights and freedoms of the data subject.\n' +
                        '                                <br><br>\n' +
                        '                                2. Personal data which is aggregated or kept in a form which does not permit identification of data subjects may be kept longer than necessary for the declared, specified, and legitimate purpose.\n' +
                        '                                <br><br>\n' +
                        '                                3. Personal data shall not be retained in perpetuity in contemplation of a possible future use yet to be determined.\n' +
                        '                            </p>\n' +
                        '                        </div>                        ' +
                        '</div>',
                    showCloseButton: false,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText: 'Okay, I understand'
                });
            },
            initEvents: function () {
                let mSelf = this;
                $('#btnRedirect').click(function () {
                    mSelf.redirectForm();
                });
                $('#btnCancel').click(function () {
                    window.location.href =  '/';
                });
            },
            redirectForm: function () {
                if (this.selectedForm > 0) {
                    document.cookie = "formId="+this.selectedForm;
                    this.$root.redirect('tracerForm');
                } else {
                    Swal.fire({
                        title: "Error",
                        text: 'There is no form selected! Please one and try again.',
                        icon: "error",
                        showDenyButton: false,
                        showConfirmButton: false,
                    });
                }
            },
            initForms: function () {
                this.$root.getRequest('admin/form/read', (mResult) => {
                    this.aForms = mResult.data;
                }, {form_active_status: 1});
            },
            validateEmail: function (sEmail) {
                return String(sEmail)
                    .toLowerCase()
                    .match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
            }
        }
    }
</script>

<style scoped>
    @import './TraceIntro.css';
</style>
