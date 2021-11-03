import Navigation from './layout/Navigation/Navigation.vue'
import Sidebar from './layout/Sidebar/Sidebar.vue'
import Layout from './layout/Layout/Main/Layout.vue'
import DefaultLayout from './layout/Layout/Default/Default.vue'
import CleanLayout from './layout/Layout/Clean/Clean.vue'
import TopNav from './layout/Public/TopNav.vue'
import CustomLayout from './layout/Layout/Public/Custom.vue'

import SystemManageBranches from './page/Admin/SysConfig/SystemEntities/Manage_Branches.vue'
import SystemManageCourses from './page/Admin/SysConfig/SystemEntities/Manage_Courses.vue'
import SystemManageDegree from './page/Admin/SysConfig/SystemEntities/Manage_Degree.vue'
import SystemManagePostTypes from './page/Admin/SysConfig/SystemEntities/Manage_PostTypes.vue'
import SystemManageIndustry from './page/Admin/SysConfig/SystemEntities/Manage_Industry.vue'

const aComponentList = [
    { component: Layout, name: 'Layout' },
    { component: DefaultLayout, name: 'default' },
    { component: CleanLayout, name: 'clean' },
    { component: CustomLayout, name: 'custom' },
    { component: Navigation, name: 'Navigation' },
    { component: Sidebar, name: 'Sidebar' },
    { component: TopNav, name: 'TopNav' },
    { component: SystemManageBranches, name: 'SystemManageBranches'},
    { component: SystemManageCourses, name: 'SystemManageCourses'},
    { component: SystemManageDegree, name: 'SystemManageDegree'},
    { component: SystemManagePostTypes, name: 'SystemManagePostTypes'},
    { component: SystemManageIndustry, name: 'SystemManageIndustry'},
]

export default aComponentList
