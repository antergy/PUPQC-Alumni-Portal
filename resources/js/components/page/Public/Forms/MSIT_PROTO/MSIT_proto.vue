<template>
    <div class="tracer_form">
        <div class="form outline">
            <div class="form__input-group xx-lg">
                <label class="form__label">Select the program you previously graduated from:</label>
                <select id="program" name="branch" class="form__input" v-model="selectedCourse">
                    <option selected disabled value="0">-- Select Program --</option>
                    <option value="1">Master of Science in Information Technology</option>
                </select>
            </div>
        </div>
        <br>
        <div class="form outline" id="msit_form" style="display: none">
            <span class="form__title">MSIT Tracer Survey Form</span>
            <span class="form__subtitle">Please answer the following:</span>
            <br>
            <div>
                <span class="form__subtitle">I. Basic Information:</span>
                <div class="form__input-group">
                    <div class="grid grid-flow-col auto-cols-max place-self-center">
                        <div class="m-2">
                            <label class="form__label">Last Name</label>
                            <input type="text" class="form__input">
                        </div>
                        <div class="m-2">
                            <label class="form__label">Middle Name</label>
                            <input type="text" class="form__input">
                        </div>
                        <div class="m-2">
                            <label class="form__label">First Name</label>
                            <input type="text" class="form__input">
                        </div>
                    </div>
                </div>

                <div class="form__input-group x-lg">
                    <label class="form__label">Date Admitted in MSIT/MIT Program</label>
                    <input type="date" class="form__input">
                </div>

                <div class="form__input-group x-lg">
                    <label class="form__label">Name of Department Section</label>
                    <input type="text" class="form__input">
                </div>

                <div class="form__input-group x-lg">
                    <label class="form__label">Job Title (current)</label>
                    <input type="text" class="form__input">
                </div>

                <div class="form__input-group x-lg">
                    <label class="form__label">Organization/Company (before studying MSIT program)</label>
                    <input type="text" class="form__input">
                </div>

                <div class="form__input-group x-lg">
                    <label class="form__label">Name of Department/Section (before studying MSIT program)</label>
                    <input type="text" class="form__input">
                </div>

                <div class="form__input-group md">
                    <label class="form__label">Age (at present)</label>
                    <input type="number" class="form__input">
                </div>

                <div class="form__input-group md">
                    <label class="form__label">Age (at time of admission)</label>
                    <input type="number" class="form__input">
                </div>

                <div class="form__input-group lg">
                    <label class="form__label">Gender</label>
                    <select id="branch" name="branch" class="form__input">
                        <option selected disabled>-- Select Gender --</option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                    </select>
                </div>

                <div class="form__input-group xx-lg">
                    <label class="form__label">Thesis Title (if any)</label>
                    <input type="text" class="form__input">
                </div>

                <div class="form__input-group x-lg">
                    <label class="form__label">Name of Adviser</label>
                    <input type="text" class="form__input">
                </div>

                <div class="form__input-group x-lg">
                    <label class="form__label">Date completed the program</label>
                    <input type="date" class="form__input">
                </div>

                <div class="form__input-group x-lg">
                    <label class="form__label">Email Address</label>
                    <input type="email" class="form__input">
                </div>
                <br>
                <span class="form__subtitle">II. Before Enrolling to PUP:</span>
                <table class="table-auto">
                    <thead>
                    <tr>
                        <th>To what degree did the following factors affect your decision to study in PUP?</th>
                        <th>Strongly Disagree</th>
                        <th>Somewhat Disagree</th>
                        <th>Neutral</th>
                        <th>Somewhat Agree</th>
                        <th>Strongly Agree</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>I required new knowledge and skills in performing my job.</td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                    </tr>
                    <tr class="bg-emerald-200">
                        <td>For my future promotion.</td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                    </tr>
                    <tr>
                        <td>I wanted to obtain master degree.</td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                    </tr>
                    <tr>
                        <td>Colleagues and/or friends also studied in PUP.</td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                    </tr>
                    <tr>
                        <td>My supervisor/organization advised me to enroll in PUP.</td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                    </tr>
                    <tr>
                        <td>My supervisor also enrolled in PUP.</td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                    </tr>
                    <tr>
                        <td>Others (Please Specify).</td>
                        <td colspan="5"> <input type="text" class="form__input"></td>
                    </tr>
                    </tbody>
                </table>
                <br><br>
                <table class="table-auto" style="width: 100%">
                    <thead>
                    <tr>
                        <th>Orientation Evaluation</th>
                        <th>Poor</th>
                        <th>Below Average</th>
                        <th>Average</th>
                        <th>Good</th>
                        <th>Excellent</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>How do you evaluate the orientation before studying in PUP?</td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                    </tr>
                    <tr>
                        <td>How do you evaluate the orientation after studying in PUP?</td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                    </tr>
                    </tbody>
                </table>
                <br><br>
                <table class="table-auto">
                    <thead>
                    <tr>
                        <th>Importance / Relevance of Enrolling to MSIT</th>
                        <th>Not at all</th>
                        <th>Slightly</th>
                        <th>Somewhat</th>
                        <th>Considerably</th>
                        <th>Greatly</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Were the lectures of the university good enough for you to understand clearly? </td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                    </tr>
                    <tr>
                        <td>Were the courses offered by the university relevant to your research topic?</td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                    </tr>
                    <tr>
                        <td>Were you satisfied with your university's support?</td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                    </tr>
                    <tr>
                        <td>Did your Adviser guide you well in your research?</td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                    </tr>
                    <tr>
                        <td>Did your Adviser understand the IT development issues in your organization? </td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                    </tr>
                    <tr>
                        <td>Does your master thesis have a close connection with the issues of your organization or sector?</td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                    </tr>
                    <tr>
                        <td>Is your master thesis regarded as significant by your organization?</td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                    </tr>
                    <tr>
                        <td>Do you think the MSIT fellows are influential?</td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                    </tr>
                    <tr>
                        <td>Did you achieve your initial objectives and goals through your participation in MSIT program?</td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                    </tr>

                    </tbody>
                </table>
                <br><br>
                <span class="form__subtitle">III. Change in Your Position and Annual Income:</span>
                <div class="form__input-group x-lg">
                    <label class="form__label">How many rank(s), has your position in your workplace become higher compared with the time before enrolling in MSIT?
                    <br>(If you are at the same rank, please write "0". )
                    </label>
                    <select id="rank" name="rank" class="form__input">
                        <option selected disabled>-- Select Rank --</option>
                        <option value="1">Same</option>
                        <option value="2">1</option>
                        <option value="2">2</option>
                        <option value="2">3</option>
                        <option value="2">4</option>
                        <option value="2">5</option>
                        <option value="2">6</option>
                        <option value="2">Others</option>
                    </select>
                </div>

                <div class="form__input-group x-lg">
                    <label class="form__label">Are you currently/Have you been in a position of making decisions?</label>
                    <select id="decision" name="decision" class="form__input">
                        <option selected value="1">Yes</option>
                        <option value="2">No</option>

                    </select>
                </div>

                <div class="form__input-group x-lg">
                    <label class="form__label">Have you been assigned to supervise subordinates?</label>
                    <select id="subor" name="subor" class="form__input">
                        <option selected value="1">Yes</option>
                        <option value="2">No</option>
                    </select>
                </div>

                <div class="form__input-group x-lg">
                    <label class="form__label">Have you been assigned to a position involved in policy planning and institutional development related to the field of your study? </label>
                    <select id="position" name="position" class="form__input">
                        <option selected value="1">Yes</option>
                        <option value="2">No</option>
                    </select>
                </div>

                <div class="form__input-group x-lg">
                    <label class="form__label">If your annual income at the time before the MSIT is set at "1", how much volume is your current annual income?   </label>
                    <select id="income" name="income" class="form__input">
                        <option selected disabled>-- Select Increase Volume --</option>
                        <option value="1">Same</option>
                        <option value="2">up to 1.5 times</option>
                        <option value="2">1.5 to 2 times</option>
                        <option value="2">2 to 2.5 times</option>
                        <option value="2">2.5 to 3 times</option>
                        <option value="2">3 to 3.5 times</option>
                        <option value="2">Others</option>
                    </select>
                </div>

                <div class="form__input-group x-lg">
                    <label class="form__label">To what degree (as a percentage) do you believe that your participation in the MSIT program contributed to change in your position in the workplace and in annual income?</label>
                    <input type="number" class="form__input">
                </div>

                <div class="form__input-group x-lg">
                    <label class="form__label">In above question, why do you think so? Please explain the reason.</label>
                    <input type="textarea" class="form__input">
                </div>

                <div class="form__input-group x-lg">
                    <label class="form__label">After you participated in the MSIT program, did you change departments inside your workplace or changed employers?</label>
                    <select id="changed" name="changed" class="form__input">
                        <option selected value="1">Did Change</option>
                        <option value="2">Didn't Change</option>
                    </select>
                </div>

                <div class="form__input-group x-lg">
                    <label class="form__label">If you changed your job, what was the reason to change your job?</label>
                    <input type="textarea" class="form__input">
                </div>

                <div class="form__input-group x-lg">
                    <label class="form__label">If you changed your department or your employer, is it possible for you to apply the knowledge and skills your acquired in the MSIT Program to your new work?</label>
                    <select id="deptchng" name="deptchng" class="form__input">
                        <option selected disabled>-- Select Answer --</option>
                        <option value="2">Not at all</option>
                        <option value="2">Slightly</option>
                        <option value="2">Somewhat</option>
                        <option value="2">Considerably</option>
                        <option value="2">Totally</option>
                    </select>
                </div>

                <br><br>
                <span class="form__subtitle">IV. Admission to Doctoral Course:</span>
                <table class="table-auto" style="width: 100%">
                    <thead>
                    <tr>
                        <th>Description</th>
                        <th>Yes</th>
                        <th>No</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>I have been/was admitted to doctoral course after completing MSIT program.</td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                    </tr>
                    <tr>
                        <td>Name of University:</td>
                        <td colspan="2"> <input type="text" class="form__input"></td>
                    </tr>
                    <tr>
                        <td>Name of Country: </td>
                        <td colspan="2"> <input type="text" class="form__input"></td>
                    </tr>
                    <tr>
                        <td>Name of Scholarship (If you applied):</td>
                        <td colspan="2"> <input type="text" class="form__input"></td>
                    </tr>
                    <tr>
                        <td>I have obtained doctoral degree</td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                    </tr>
                    <tr>
                        <td>I am planning to apply but I have not yet applied.</td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                    </tr>
                    <tr>
                        <td>I am not planning to apply.</td>
                        <td> <input type="radio" class="form__input"></td>
                        <td> <input type="radio" class="form__input"></td>
                    </tr>
                    </tbody>
                </table>
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
                                <button type="button" class="form__button error info w-full place-self-center" @click="doCancel()">Cancel</button>
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
            selectedCourse: 0
        }
    },
    created() {
        this.$root.sLayout = 'custom'
    },
    watch: {
        selectedCourse: function () {
            $('#msit_form').css('display', '');
        }
    },
    methods: {
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
@import './MSIT_proto.css';
</style>
