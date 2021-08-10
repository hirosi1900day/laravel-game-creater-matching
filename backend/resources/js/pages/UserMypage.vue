<template>
  <div class="photo-form">
    <h2 class="title">マイページ</h2>
    <RouterLink class="navbar__brand" :to="{name: 'PostMypage'}">
        自分の投稿
    </RouterLink>
    <!-- <form class="form" @submit.prevent="update">
      <input type="file" @change="fileSelected">
      <output class="form__output" v-if="preview">
        <img :src="preview" alt=""> 
      </output>
      <li class="list-style m-2">
        <label for="name py-2 block">名前</label>
        <textarea class="form__item border-2 border-green-300 block" type="text" v-model="myUserData.name" id="name"></textarea>
      </li>
      <li class="list-style m-2">
        <label for="self_introduce py-2 block">自己紹介</label>
        <textarea class="form__item border-2 border-green-300 block" type="text" v-model="myUserData.self_introduce" id="self_introduce"></textarea>
      </li>
      
      <div v-if="errors" class="errors">
        <ul v-if="errors.title">
          <li v-for="msg in errors.title" :key="msg">{{ msg }}</li>
        </ul>
        <ul v-if="errors.content">
          <li v-for="msg in errors.content" :key="msg">{{ msg }}</li>
        </ul>
      </div>
      <div class="form__button">
        <button class="bg-green-300 rounded-xl p-2 m-2">変更する</button>
      </div>
    </form> -->

 <section class="text-gray-600 body-font relative">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-12">
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">マイページ</h1>
    </div>
    <form @submit.prevent="update">    
    <div class="lg:w-1/2 md:w-2/3 mx-auto">
      <div class="flex flex-wrap -m-2">
        <div class="p-2 w-full">
          <div class="relative">
            <label for="name" class="leading-7 text-sm text-gray-600" >名前</label>
            <textarea  v-model="myUserData.name" id="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
          </div>
        </div>

        <div class="p-2 w-full">
          <div class="relative">
            <label for="name" class="leading-7 text-sm text-gray-600">自己紹介</label>
            <textarea type="text" v-model="myUserData.self_introduce" id="self_introduce" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
          </div>
        </div>
        <div class="p-2 w-full">
          <div class="relative">
            <label for="file" class="leading-7 text-sm text-gray-600">イメージ画像を選択してくだい</label>
            <input type="file" id="file" @change="fileSelected">
            <output class="form__output" v-if="preview">
              <img :src="preview" alt=""> 
            </output>
          </div>
        </div>
        <div class="p-2 w-full">
          <div class="relative">
            <label for="occupation" class="leading-7 text-sm text-gray-600">職種</label>
               <select name="occupation" id="occupation" v-model="myUserData.occupation">
               <option v-for="(list ,index) in resourcesRequiredArray" :key="index" :value="list">
                   {{ list }}
               </option>
               </select> 
          </div>
        </div>
        <div v-if="errors" class="errors">
          <ul v-if="errors">
            <li v-for="msg in errors" :key="msg[0]">{{ msg[0] }}</li>
          </ul>
        </div>
        <div class="p-2 w-full">
          <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg" @click="submit">Button</button>
          <button @click="test">確認</button>
        </div>
        <div class="p-2 w-full pt-8 mt-8 border-t border-gray-200 text-center">
          <a class="text-indigo-500"></a>
          <p class="leading-normal my-5">
            <br>
          </p>
          <span class="inline-flex">
            <a class="text-gray-500">
              <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
              </svg>
            </a>
            <a class="ml-4 text-gray-500">
              <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
              </svg>
            </a>
            <a class="ml-4 text-gray-500">
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
              </svg>
            </a>
            <a class="ml-4 text-gray-500">
              <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
              </svg>
            </a>
          </span>
        </div> 
      </div>
    </div>
    </form>
  </div>
 </section>
</div>
</template>

<script>
import { mapState } from 'vuex'
import {OK,UNPROCESSABLE_ENTITY } from '../util'
import { resourcesRequiredArray } from '../const'


export default {
  data () {
    return { 
      myUserData: {
        name: '',
        seld_introduce: '',
        user_id: '',
        file: null,
        occupation:  ''
      },
      preview: null,
      resourcesRequiredArray
    }
  },
  computed: {
    ...mapState({
      errors: state => 
      { 
        return state.error.errorMessages
      }
    })
  },
  methods: {
    fileSelected(event){
      if (event.target.files.length === 0) {
        this.reset()
        return false
      }
      // ファイルが画像ではなかったら処理中断
      if (! event.target.files[0].type.match('image.*')) {
        this.reset()
        return false
      }
      // FileReaderクラスのインスタンスを取得
      const reader = new FileReader()
      // ファイルを読み込み終わったタイミングで実行する処理
      reader.onload = e => {
        // previewに読み込み結果（データURL）を代入する
        // previewに値が入ると<output>につけたv-ifがtrueと判定される
        // また<output>内部の<img>のsrc属性はpreviewの値を参照しているので
        // 結果として画像が表示される
        this.preview = e.target.result
      }
      // ファイルを読み込む
      // 読み込まれたファイルはデータURL形式で受け取れる（上記onload参照）
      reader.readAsDataURL(event.target.files[0])
      // this.myUserData.file = event.target.files[0]
      this.myUserData.file = event.target.files[0]
    },
    reset () {
    this.preview = ''
    this.$el.querySelector('input[type="file"]').value = null
    this.myUserData.file = null
    },
    async get() {
      const response = await axios.get('/api/user/mypage')
      if (!response.status == OK) {
        this.$store.commit('error/setCode', response.status)
      }
      let getData = response.data
      this.myUserData.name = getData.name
      this.myUserData.self_introduce = getData.self_introduce
    },
    async update () {
      console.log("updateでの写真確認")
      console.log(this.myUserData)

      const formData = new FormData()

      formData.append('file',this.myUserData.file)
      formData.append('name',this.myUserData.name)
      formData.append('self_introduce',this.myUserData.self_introduce)
      formData.append('occupation', this.myUserData.occupation)
      formData.append('user_id',this.$store.state.auth.user.id)
      formData.append('myUserData', this.myUserData)

      this.myUserData.user_id = this.$store.state.auth.user.id
      const headers = { "content-type": "multipart/form-data" }
      const response = await axios.post('/api/user/mypage', formData, {headers})
      if (response.status === UNPROCESSABLE_ENTITY) {
        this.$store.commit('error/setErrorMessages', response.data.errors)
      } else {
        this.$store.commit('error/setCode', response.status)
      }
      let returnData = response.data
      this.myUserData.name = returnData.name 
      this.myUserData.self_introduce = returnData.self_introduce
    }
  },
  created: function() {
    this.get()
  }
}
</script>

<style scoped>
.list-style{
  list-style: none;
}
</style>