<template>
	<div :class="['sidebar', { active: active }]">
		<div class="profile">
			<div class="profile__image" v-if="$root.sRootUserProfPic === null">
				<font-awesome-icon far icon="user-circle" size="2x" />
			</div>
            <img v-if="$root.sRootUserProfPic !== null" :src="$root.sRootUserProfPic" style="width: 50px; height: 50px; border-radius: 50%; border: 3px solid #6E6E6E" alt="Profile"/>
			<div class="profile__container">
				<label class="profile__label">{{ this.$root.sRootFullname }}</label>
				<label class="profile__position">{{ this.$root.sRootAccPos }}</label>
			</div>
		</div>
		<div class="section">
			<List>
				<ListItem text="Home" to="/home" />
				<ListItem text="Messaging">
                    <ListItem text="Create Message" to="/message/create"/>
                    <ListItem text="Inbox" to="/message/inbox"/>
                    <ListItem text="Sent" to="/message/sent"/>
                </ListItem>
<!--				<ListItem v-if="this.$root.sRootAccPos === 'Administrator' || this.$root.sRootAccPos === 'Superadmin'" text="Alumni Directory" />-->
                <ListItem v-if="this.$root.sRootAccPos === 'Administrator' || this.$root.sRootAccPos === 'Superadmin'" text="Accounts Management" to="/admin/accounts"/>
                <ListItem v-if="this.$root.sRootAccPos === 'Administrator' || this.$root.sRootAccPos === 'Superadmin'" text="Tracer Form Management" to="/admin/tracerFormGoogle"/>
				<ListItem v-if="this.$root.sRootAccPos === 'Administrator' || this.$root.sRootAccPos === 'Superadmin'" text="Reports" >
					<ListItem text="Post Activities" to="/admin/reports/posts"/>
					<ListItem text="Alumni Tracer Study" to="/admin/reports/tracer"/>
					<ListItem v-if="this.$root.sRootAccPos === 'Superadmin'" text="System Logs" to="/admin/reports/logs"/>
				</ListItem>
				<ListItem v-if="this.$root.sRootAccPos === 'Administrator' || this.$root.sRootAccPos === 'Superadmin'" text="System Configuration">
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
