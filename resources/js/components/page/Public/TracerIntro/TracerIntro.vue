<template>
    <div class="profile" style="width: 60%">
        <div class="form outline">
            <span class="form__title place-self-center">Welcome to PUP Alumni Portal!</span>
            <span class="form__subtitle place-self-center">PUP is concerned for each of its students' future</span>
            <br>
            <div class="m-3">
                <p style="text-align: center">
                    To ensure quality education to our students, PUP conducts a survey to its every alumni to know their
                    current whereabouts
                    after graduating.
                    <br><br>
                    PUP will analyze the collected data from the survey by doing a "Tracer Study", and will use it to
                    formulate the best recommendations and actions plans to
                    further improve the quality of education that can be provided for the future students.
                    <br><br>
                    In line with this, PUP needs your help by participating to this survey.
                    You will be redirected to the appropriate tracer survey form for you by selecting the degree/program
                    you have last graduated from.
                    <br><br>
                    Otherwise you can skip for now and participate later.
                </p>
            </div>
            <div>
                <div class="m-2">
                    <div class="form__input-group xxx-lg">
                        <label class="form__label">Degree / Program Graduated: </label>
                        <select id="branch" v-model="selectedDegree" name="branch"
                                class="form__input place-self-center">
                            <option selected disabled value="0">-- Select Degree --</option>
                            <option v-for="degree in aDegree" v-bind:value="degree.degree_id">
                                {{ degree.degree_desc }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="m-2">
                    <div class="form__input-group xxx-lg">
                        <label class="form__label">Email: (required, in able for you to participate in survey, you need to have your valid email address)</label>
                        <input placeholder="Email" v-model="sEmail" type="email" class="form__input">
                    </div>
                </div>
                <br>
                <div class="form__input-group">
                    <div class="grid grid-flow-col auto-cols-max place-self-center">
                        <div class="m-1">
                            <button type="button" id="btnRedirect" class="form__button info w-full place-self-center">Go
                                to Tracer Form
                            </button>
                        </div>
                        <div class="m-1">
                            <button type="button" class="form__button w-full place-self-center"
                                    @click="$root.redirect('home')">Skip for Now
                            </button>
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
                aDegree: [],
                selectedDegree: 0,
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
            this.initDegree();
            this.initEvents();
        },
        methods: {
            initEvents: function () {
                let mSelf = this;
                $('#btnRedirect').click(function () {
                    mSelf.redirectForm();
                });
            },
            redirectForm: function () {
                if (this.validateEmail(this.sEmail) !== null) {
                    (this.selectedDegree > 0) && this.$root.redirect('tracerForm/' + this.selectedDegree);
                } else {
                    Swal.fire({
                        title: "Error",
                        text: 'Invalid email address, please input correct one, and try again',
                        icon: "error",
                        showDenyButton: false,
                        showConfirmButton: false,
                    });
                }
            },
            initDegree: function () {
                this.$root.getRequest('admin/system/degree/read', (mResult) => {
                    this.aDegree = mResult.data;
                })
            },
            selectDegree: function () {

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
