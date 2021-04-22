<template>
  <div class="profile">
    <div class="form outline">
      <span class="form__title">Title Here</span>
      <div class="form__input-group">
        <label class="form__label">Default</label>
        <input type="text" class="form__input">
      </div>

      <div class="form__input-group sm">
        <label class="form__label">Small</label>
        <input type="text" class="form__input">
      </div>

      <div class="form__input-group md">
        <label class="form__label">Medium</label>
        <input type="text" class="form__input">
      </div>

      <div class="form__input-group lg">
        <label class="form__label">Large</label>
        <input type="text" class="form__input">
      </div>

      <div class="form__input-group lg">
        <label class="form__label">Textbox</label>
        <textarea type="text" class="form__textarea" />
      </div>

      <div class="form__group row">
        <div class="form__input-group">
          <label class="form__label">Here</label>
          <input type="text" class="form__input">
        </div>

        <div class="form__input-group">
          <label class="form__label">Here</label>
          <input type="text" class="form__input">
        </div>
      </div>

      <div class="form__input-group">
        <button type="button" class="form__button">DEFAULT</button>
        <button type="button" class="form__button success">SAVE</button>
        <button type="button" class="form__button danger">DELETE</button>
        <button type="button" class="form__button warning">WARNING</button>
        <button type="button" class="form__button info">INFO</button>
      </div>

    </div>
  </div>
</template>

<script>
export default {
  craeted () {
		this.$root.sLayout = "default";
  },
  data () {
    return {
      
    }
  }
}
</script>

<style scoped>
@import './Profile.css';
</style>