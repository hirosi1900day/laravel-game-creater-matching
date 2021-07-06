import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import PostList from './pages/PostList.vue'
import PostForm from './pages/PostForm.vue'
import UserIndex from './pages/UserIndex.vue'
import UserDetail from './pages/UserDetail.vue'
import UserMypage from './pages/UserMypage.vue'
import ChatRoom from './pages/ChatRoom.vue'
import ChatIndex from './pages/ChatIndex.vue'
import Store from './store'
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
  { path: '/signIn', redirect: to => {
    return window.location.href = "/login"
  }},
  {
    path: '/',
    redirect: '/post/index'
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
  },
  {
    path: '/user/index',
    component: UserIndex,
    name: "UserIndex",
  },
  {
    //userの詳細画面
    path: '/user/detail/:userId',
    component: UserDetail,
    name: 'UserDetail',
    props: true
  },
  {
    path: '/user/mypage',
    component: UserMypage,
    name: "Mypage",
    beforeEnter: (to, from, next) => {
      if(!Store.getters['auth/check']){
        next('/signIn')
      }
      next()
    }
  },
  {
    path: '/chat/index',
    component: ChatIndex,
    name: 'ChatIndex',
    props: true,
    beforeEnter: (to, from, next) => {
      if(!Store.getters['auth/check']){
        next('/signIn')
      }
      next()
    }
  },
  
  {
    path: '/chat/room/:partnerUserId',
    component: ChatRoom,
    name: 'ChatRoom',
    props: true,
    beforeEnter: (to, from, next) => {
      if(!Store.getters['auth/check']){
        next('/signIn')
      }
      next()
    }
  },
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