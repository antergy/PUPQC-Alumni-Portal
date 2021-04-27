<template>
    <div class="profile">
        <div class="form outline">
            <span class="form__title">Create Account</span>
            <span class="form__subtitle">Enter your account details:</span>
            <br>
            <div>
                <div class="form__input-group xx-lg">
                    <label class="form__label">Username</label>
                    <input type="text" class="form__input">
                </div>

                <div class="form__input-group xx-lg">
                    <label class="form__label">Account Name</label>
                    <input type="text" class="form__input">
                </div>

                <div class="form__input-group xx-lg">
                    <label class="form__label">Email Address</label>
                    <input type="text" class="form__input">
                </div>

                <div class="form__input-group xx-lg">
                    <label class="form__label">Campus/Branch Graduated From: (Latest)</label>
                    <select id="branch" name="branch" class="form__input">
                        <option selected disabled>-- Select Campus/Branch --</option>
                        <option value="1">PUP Main Campus</option>
                        <option value="2">PUP Quezon City</option>
                    </select>
                </div>
                <div class="form__input-group xx-lg">
                    <label class="form__label">Password</label>
                    <input type="password" class="form__input">
                </div>

                <div class="form__input-group xx-lg">
                    <label class="form__label">Confirm Password</label>
                    <input type="password" class="form__input">
                </div>

                <div class="form__input-group xx-lg">
                    <label class="form__label">Profile Picture</label>
                    <input type="file" class="form__input"/>
                </div>
                <br>
                <div class="form__input-group">
                    <div class="grid grid-flow-col auto-cols-max place-self-center">
                        <div class="m-1">
                            <button type="button" class="form__button w-full place-self-center">Clear All Entries</button>
                        </div>
                        <div class="m-1">
                            <button type="button" class="form__button danger w-full place-self-center">Cancel</button>
                        </div>
                        <div class="m-1">
                            <button type="button" class="form__button success w-full place-self-center" @click="$root.redirect('tracerIntro')">Create Account</button>
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

    }
  },
  created() {
    this.$root.sLayout = 'custom'
  },
  methods: {

  }
}
</script>

<style scoped>
@import './Registration.css';
</style>
