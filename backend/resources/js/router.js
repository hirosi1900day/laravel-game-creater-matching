import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import PostList from './pages/PostList.vue'
import PostForm from './pages/PostForm.vue'
import Text from './pages/Text.vue'
import UserDetail from './pages/UserDetail.vue'
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
    component: PostList,
    name: 'PostIndex',
    props: route => {
      const page = route.query.page
      return { page: /^[1-9][0-9]*$/.test(page) ? page * 1 : 1 }
    }
  },
  {
    path: '/post/create',
    component: PostForm,
    name: 'PostForm',
    beforeEnter: (to, from, next) => {
      if($user) {
        next()
      }
      next('/post/index')
    }
  },
  {
    //userの詳細画面
    path: '/user/detail/:userId',
    component: UserDetail,
    name: 'UserDetail',
    props: true
  },
  {
    path: '/chat/:partnerUserId',
    component: ChatRoom,
    name: 'ChatRoom',
    props: true
  },
  {
    path: '/text',
    component: Text
  }
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
  mode: 'history',
  scrollBehavior () {
    return { x: 0, y: 0 }
  },
  routes
})
export default router