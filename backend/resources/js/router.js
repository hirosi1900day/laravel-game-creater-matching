import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import Photo from './pages/Photo.vue'
import Postform from './pages/Postform.vue'
import Text from './pages/Text.vue'

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

// パスとコンポーネントのマッピング
const routes = [
  {
    path: '/post/index',
    component: Photo
  },
  {
    path: '/post/create',
    component: Postform
  },
  {
    path: '/text',
    component: Text
  }
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
  mode: 'history',
  routes
})
export default router