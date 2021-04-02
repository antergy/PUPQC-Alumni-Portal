<template>
    <div class="navigation">
        <div class="navigation__container">
            <div class="profile__image">
            </div>
            <span class="navigation__title">PUPQC Alumni Portal</span>
        </div>
        <div class="navigation__container mr-20">
            <div class="navigation__item">
                <button
                    @click="currentTab = 'Home'"
                    :class="['navigation__button', { active: currentTab === 'Home' }]"
                >
                    <font-awesome-icon fas icon="home"/>
                </button>
            </div>
            <div class="navigation__item">
                <button
                    @click="currentTab = 'Profile'"
                    :class="['navigation__button', { active: currentTab === 'Profile' }]"
                >
                    <font-awesome-icon fas icon="user"/>
                </button>
            </div>
            <div class="navigation__item">
                <button
                    @click="doLogout()"
                    :class="['navigation__button', { active: currentTab === 'Logout' }]"
                >
                    <font-awesome-icon fas icon="sign-out-alt"/>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.currentTab = this.$route.name
    },
    data() {
        return {
            currentTab: 'Home'
        }
    },
    methods: {

        /**
         * Prompts user logout
         */
        doLogout: function () {
            this.currentTab = 'Logout';
            let oParam = {};
            let mSelf = this;
            Swal.fire({
                title: 'Are you sure you want to logout?',
                icon: 'warning',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
                backdrop: `rgba(128, 128, 128, 0.4)`
            }).then((result) => {
                if (result.isConfirmed) {
                    mSelf.$root.postRequest('logout', oParam, () => {
                        window.location.href = "/";
                    });
                }
            })

        }
    }
}
</script>

<style scoped>
@import './Navigation.css';
</style>
