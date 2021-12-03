<template>
	<div :class="['sidebar', { active: active }]">
		<div class="profile">
			<div class="profile__image">
				<font-awesome-icon far icon="user-circle" size="2x" />
			</div>
			<div class="profile__container">
				<label class="profile__label">{{ this.$root.sRootFullname }}</label>
				<label class="profile__position">{{ this.$root.sRootAccPos }}</label>
			</div>
		</div>
		<div class="section">
			<List title="Navigation Title">
				<ListItem text="Home" to="/home" />
				<ListItem text="Messaging" to="/profile" />
				<ListItem v-if="this.$root.sRootAccPos === 'Administrator' || this.$root.sRootAccPos === 'Superadmin'" text="Alumni Directory" />
                <ListItem v-if="this.$root.sRootAccPos === 'Administrator' || this.$root.sRootAccPos === 'Superadmin'" text="Accounts Management" to="/admin/accounts"/>
                <ListItem v-if="this.$root.sRootAccPos === 'Administrator' || this.$root.sRootAccPos === 'Superadmin'" text="Tracer Form Management" to="/admin/tracerForm"/>
				<ListItem v-if="this.$root.sRootAccPos === 'Administrator' || this.$root.sRootAccPos === 'Superadmin'" text="Reports" >
					<ListItem text="Post Activities" />
					<ListItem text="Alumni Tracer Study" />
					<ListItem v-if="this.$root.sRootAccPos === 'Superadmin'" text="System Logs" />
				</ListItem>
				<ListItem v-if="this.$root.sRootAccPos === 'Administrator' || this.$root.sRootAccPos === 'Superadmin'" text="System Configuration">
                    <ListItem text="Account Entities" to="/admin/sysconfig/acc_entities" />
                    <ListItem text="Form Entities" />
                    <ListItem  v-if="this.$root.sRootAccPos === 'Superadmin'" text="System Entities" to="/admin/sysconfig/sys_entities"/>
                </ListItem>
			</List>
		</div>
	</div>
</template>

<script>
import List from './List.vue'
import ListItem from './ListItem.vue'

export default {
	components: {
		List,
		ListItem
	},
	data() {
		return {
			active: false,
		};
	},
    created() {
	    this.test();
    },
    methods: {
	    test: function () {

        }
    }
};
</script>

<style scoped>
@import "./sidebar.css";
</style>
