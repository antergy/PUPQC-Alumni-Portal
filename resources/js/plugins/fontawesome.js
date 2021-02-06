import Vue from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { 
  faUser,
  faHome,
  faSignOutAlt,
  faUserCircle,
  faEllipsisH,
  faLightbulb,
  faComment
} from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

const aIconList = [
  faUser,
  faHome,
  faSignOutAlt,
  faUserCircle,
  faEllipsisH,
  faLightbulb,
  faComment
]

aIconList.forEach(oIcon => {
  library.add(oIcon)
})

Vue.component('font-awesome-icon', FontAwesomeIcon)
