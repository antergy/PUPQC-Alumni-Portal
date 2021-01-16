<template>
  <v-container fill-height>
      <v-col cols="10" md="8" lg="4" justify="center" class="login__wrapper">
          <v-card tile>
            <v-card-title>
              Login
            </v-card-title>
            <v-form
              ref="form"
              v-model="valid"
              lazy-validation
            >
              <v-text-field label="Username"></v-text-field>
              <v-text-field label="Password"></v-text-field>
            </v-form>
          </v-card>
      </v-col>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      valid: true
    }
  }
}
</script>

<style>
</style>