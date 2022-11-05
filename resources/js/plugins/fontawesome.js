import Vue from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import {
  faUser,
  faHome,
  faSignOutAlt,
  faUserCircle,
    faInfo,
  faEllipsisH,
  faLightbulb,
  faComment,
  faChevronDown,
  faChevronUp,
    faEye,

} from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

const aIconList = [
  faUser,
  faHome,
  faSignOutAlt,
  faUserCircle,
  faEllipsisH,
  faLightbulb,
  faComment,
  faChevronDown,
  faChevronUp,
    faEye,
    faInfo
]

aIconList.forEach(oIcon => {
  library.add(oIcon)
})

Vue.component('font-awesome-icon', FontAwesomeIcon)
