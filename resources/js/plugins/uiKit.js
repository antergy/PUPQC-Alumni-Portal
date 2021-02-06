import Vue from 'vue'
import aComponentList from '../components/index'

export default () => {
    aComponentList.forEach(oComponentItem => {
        Vue.component(oComponentItem.name, oComponentItem.component)
    })
}