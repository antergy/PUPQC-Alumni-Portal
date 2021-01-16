import Vue from 'vue'
import Navigation from './layout/Navigation/Navigation.vue'

const componentList = [
    { component: Navigation, name: 'Navigation' }
]

export default () => {
    componentList.forEach(componentItem => {
        Vue.component(componentItem.name, componentItem.component)
    })
}