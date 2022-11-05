<template>
    <div class="tracer_form" style="height: auto">
        <br>

        <div class="form outline">
<!--            <span id="form_description" class="form__title"></span>-->
            <span class="form__subtitle">Please answer the following:</span>
            <br>
            <!-- Loading -->
            <div v-if="sGoogleFormUrl === ''" style="display: flex; justify-content: center; margin-top: 20px">
                <img src="/img/loading-buffering.gif" style="width: 100px; height: 100px">
            </div>
            <!-- Show iframe if done -->
            <iframe :src="sGoogleFormUrl" width="auto" height="600px" v-else></iframe>
            <div>
                <br><br>
                <span class="form__title"> </span>
                <div style="text-align: center">
                    <p><b>-- End of Survey Form --</b></p><br>
                    <p class="place-self-center">Thank you for your cooperation! </p>
                    <div class="form__input-group">
                        <div class="grid grid-flow-col auto-cols-max place-self-center">
                            <div class="m-1">
                                <button type="button" class="form__button info w-full place-self-center" @click="goToLoginPage">Go to PUPQC Alumni Portal Login Page</button>
                            </div>
                            <div class="m-1">
                                <button type="button" class="form__button w-full place-self-center" @click="goToFormSelection">Go Back to Form Selection</button>
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
                sGoogleFormUrl: ''
            }
        },
        created() {
            this.$root.sLayout = 'custom'
        },
        mounted() {
            this.initForm();
        },
        methods: {
            initForm() {
                /** Get the form description */
                let formId = this.$root.getCookie('formId');
                this.$root.getRequest('v1/form/read', (mResult) => {
                    $('#form_description').text(mResult.data[0].form_desc);
                    this.sGoogleFormUrl = mResult.data[0].form_google_embed_url + '/viewform?embedded=true';
                }, {form_id: formId});
            },
            goToFormSelection() {
                window.location.href = '/tracerIntro';
            },
            goToLoginPage() {
                window.location.href = '/';
            }
        }
    }
</script>

<style scoped>
@import 'TracerForm.css';
</style>
