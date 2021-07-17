<template>
    <div class="profile">
        <div class="form outline">
            <span class="form__title place-self-center">Welcome to PUP Alumni Portal!</span>
            <span class="form__subtitle place-self-center">PUP is concerned for each of its students' future</span>
            <br>
            <div class="m-3">
                <p style="text-align: center">
                    To ensure quality education to our students, PUP conducts a survey to its every alumni to know their current whereabouts
                    after graduating.
                    <br><br>
                    PUP will analyze the collected data from the survey by doing a "Tracer Study", and will use it to formulate the best recommendations and actions plans to
                    further improve the quality of education that can be provided for the future students.
                    <br><br>
                    In line with this, PUP needs your help by participating to this survey.
                    You will be redirected to the appropriate tracer survey form for you by selecting the degree/program you have last graduated from.
                    <br><br>
                    Otherwise you can skip for now and participate later.
                </p>
            </div>
            <div>
                <div class="m-2">
                    <div class="form__input-group xx-lg">
                        <label class="form__label">Degree / Program Graduated: </label>
                        <select id="branch" v-model="selectedDegree" name="branch" class="form__input place-self-center">
                            <option selected disabled value="0">-- Select Degree --</option>
                            <option v-for="degree in aDegree" v-bind:value="degree.degree_id">
                                {{ degree.degree_desc }}
                            </option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form__input-group">
                    <div class="grid grid-flow-col auto-cols-max place-self-center">
                        <div class="m-1">
                            <button type="button" id="btnRedirect" class="form__button info w-full place-self-center">Go to Tracer Form</button>
                        </div>
                        <div class="m-1">
                            <button type="button" class="form__button w-full place-self-center" @click="$root.redirect('home')">Skip for Now</button>
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
        aDegree : [],
        selectedDegree: 0,
    }
  },
  created() {
    this.$root.sLayout = 'custom'
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
          if (this.selectedDegree === 1) {
              this.$root.redirect('ug_tracerForm')
          } else if (this.selectedDegree === 2) {
              this.$root.redirect('tracerForm')
          }
      },
      initDegree: function () {
          this.$root.getRequest('admin/system/degree/read', (mResult) => {
             this.aDegree = mResult.data;
          })
      },
      selectDegree: function () {

      }
  }
}
</script>

<style scoped>
@import './TraceIntro.css';
</style>
