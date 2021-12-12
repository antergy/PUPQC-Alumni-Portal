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

import FormEntityBasicGeneral from './page/Admin/SysConfig/FormEntities/FE_Basic_General.vue'
import FormEntityBasicTypes from './page/Admin/SysConfig/FormEntities/FE_Basic_Types.vue'
import FormEntityQuestionGroupSetup from './page/Admin/SysConfig/FormEntities/FE_Questions_Group.vue'
import FormEntityQuestionSetup from './page/Admin/SysConfig/FormEntities/FE_Questions_Setup.vue'
import FormEntityQuestionList from './page/Admin/SysConfig/FormEntities/FE_Questions_List.vue'

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
    { component: FormEntityBasicGeneral, name: 'FormEntityBasicGeneral'},
    { component: FormEntityBasicTypes, name: 'FormEntityBasicTypes'},
    { component: FormEntityQuestionGroupSetup, name: 'FormEntityQuestionGroupSetup'},
    { component: FormEntityQuestionSetup, name: 'FormEntityQuestionSetup'},
    { component: FormEntityQuestionList, name: 'FormEntityQuestionList'},
]

export default aComponentList
