import Navigation from './layout/Navigation/Navigation.vue'
import Sidebar from './layout/Sidebar/Sidebar.vue'
import Layout from './layout/Layout/Main/Layout.vue'
import DefaultLayout from './layout/Layout/Default/Default.vue'
import CleanLayout from './layout/Layout/Clean/Clean.vue'

const aComponentList = [
    { component: Layout, name: 'Layout' },
    { component: DefaultLayout, name: 'default' },
    { component: CleanLayout, name: 'clean' },
    { component: Navigation, name: 'Navigation' },
    { component: Sidebar, name: 'Sidebar' }
]

export default aComponentList