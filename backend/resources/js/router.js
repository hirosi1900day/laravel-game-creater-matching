import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import Photo from './pages/Photo.vue'
import PostForm from './pages/Postform.vue'
import Text from './pages/Text.vue'
//エラーハンドリング
import SystemError from './pages/errors/System.vue'


// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

// パスとコンポーネントのマッピング
const routes = [
  { path: '/401', redirect: to => {
    return window.location.href = "/login"
  }},
  {
    path: '/500',
    component: SystemError
  },
  {
    path: '/post/index',
    component: Photo
  },
  {
    path: '/post/create',
    component: PostForm
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