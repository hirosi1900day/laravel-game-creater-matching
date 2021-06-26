import Vue from 'vue'
// ルーティングの定義をインポートする
import router from './router'
// ルートコンポーネントをインポートする
import App from './App.vue'
//vuex
import store from './store'
//bootstrapの読み込み
import bootstrap from './bootstrap'


//vueインスタンス生成前にログインをチェックする
const createApp = async () => {
  await store.dispatch('auth/currentUser')


  new Vue({
    el: '#app',
    bootstrap,
    store,
    router, // ルーティングの定義を読み込む
    components: { App }, // ルートコンポーネントの使用を宣言する
    template: '<App />' // ルートコンポーネントを描画する
  })
}
createApp()