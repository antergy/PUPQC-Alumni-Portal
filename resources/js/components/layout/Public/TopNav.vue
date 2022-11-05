<template>
	<div class="navigation">
		<div class="navigation__container">
			<div class="profile__image"></div>
			<span class="navigation__title" style="font-size: 20px">PUPQC Alumni Portal</span>
		</div>
	</div>
</template>

<script>
export default {
	mounted() {
		this.currentTab = this.$route.name;
	},
	data() {
		return {
			currentTab: "Login",
		};
	},
	methods: {

	},
};
</script>

<style scoped>
@import "TopNav.css";
</style>
