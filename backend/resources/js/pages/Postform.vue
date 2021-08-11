<template>
<section class="text-gray-600 body-font relative">
  <div v-show="loading" class="panel">
    <Loader>Sending your photo...</Loader>
  </div>
  <div class="container px-5 py-24 mx-auto" v-show="!loading">
    <div class="flex flex-col text-center w-full mb-12">
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">募集投稿</h1>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base">募集したい求人情報を入力してくだい</p>
    </div>
    <form @submit.prevent="submit">    
    <div class="lg:w-1/2 md:w-2/3 mx-auto">
      <div class="flex flex-wrap -m-2">
        <div class="p-2 w-full">
          <div class="relative">
            <label for="title" class="leading-7 text-sm text-gray-600" >タイトル</label>
            <textarea type="text"  id="title" v-model="postData.title" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
          </div>
        </div>

        <div class="p-2 w-full">
          <div class="relative">
            <label for="content" class="leading-7 text-sm text-gray-600">内容</label>
            <textarea type="text" id="content" v-model="postData.content" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
          </div>
        </div>
        <div class="p-2 w-full">
          <div class="relative">
            <label for="file" class="leading-7 text-sm text-gray-600">投稿イメージ画像を選択してくだい</label>
            <input type="file" id="file" @change="fileSelected">
            <output class="form__output" v-if="preview">
              <img :src="preview" alt=""> 
            </output>
          </div>
        </div>
        <div class="p-2 w-full">
          <div class="relative">
            <label for="qualification" class="leading-7 text-sm text-gray-600">応募資格</label>
            <textarea type="text" id="qualification" v-model="postData.qualification" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
          </div>
        </div>
        <div class="p-2 w-full">
          <div class="relative">
            <label for="message" class="leading-7 text-sm text-gray-600">募集職種</label>
               <select name="resources_require" id="resources_required" v-model="postData.resources_required">
               <option v-for="(list ,index) in resourcesRequiredArray" :key="index" :value="list">
                   {{ list }}
               </option>
               </select> 
          </div>
        </div>
        <div class="p-2 w-full">
          <div class="relative">
            <label for="area" class="leading-7 text-sm text-gray-600">募集地域</label>
               <select name="area" id="area" v-model="postData.area">
                 <option v-for="(list ,index) in prefectureArray" :key="index" :value="list">
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
</template>

<script>
import { mapState } from 'vuex'
import { UNPROCESSABLE_ENTITY } from '../util'
import { prefectureArray, resourcesRequiredArray } from '../const'
import Loader from '../components/Loader.vue'



export default {
  components: {
    Loader,
  },
  data () {
    return { 
      postData: {
        file: null,
        title: "",
        content: "",
        qualification: "",
        resources_required: "",
        area: "",
      },
      loading: false,
      preview: null,
      prefectureArray: prefectureArray,
      resourcesRequiredArray: resourcesRequiredArray,
      submitCheck: true,
      routeStop: false
    }
  },
  computed: {
    ...mapState({
      errors: state => 
      { 
        console.log(state.error.errorMessages)
        return state.error.errorMessages
      }
    }),
  },
  methods: {
    test() {
      console.log(this.postData.area)
    },
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
        this.preview.file = e.target.result
      }
      // ファイルを読み込む
      // 読み込まれたファイルはデータURL形式で受け取れる（上記onload参照）
      reader.readAsDataURL(event.target.files[0])
      // this.myUserData.file = event.target.files[0]
      this.postData.file = event.target.files[0]
    },
    reset () {
      this.postData.title = ""
      this.postData.content = ""
      this.preview = null
      this.loading = false
    },
    async submit () {
      console.log(this.routeStop)
      if(this.submitCheck) {
      this.loading = true
      const formData = new FormData()

      formData.append('file',this.postData.file)
      formData.append('title',this.postData.title)
      formData.append('content',this.postData.content)
      formData.append('qualification',this.postData.qualification)
      formData.append('resources_required', this.postData.resources_required)
      formData.append('area', this.postData.area)
      console.log(formData)

      this.submitCheck = false
      const headers = { "content-type": "multipart/form-data" }
      const response = await axios.post('/api/posts', formData, {headers})
      if (response.status === UNPROCESSABLE_ENTITY) {
        this.$store.commit('error/setErrorMessages', response.data.errors)
        this.loading = false
        this.routeStop = false
        console.log('バリデーションエラー')
      } else {
        this.$store.commit('error/setCode', response.status)
        this.loading = false
      }
      this.submitCheck = true
       // メッセージ登録
      await this.$store.commit('message/setContent', {
         content: '写真が投稿されました！',
         timeout: 6000
       })
      if(this.routeStop == false)
      {
        this.reset()
        console.log('確認')
        this.$router.push({name: 'PostIndex'})
        this.routeStop = false
      }
      }
    },
  },

}
</script>

<style scoped>
.list-style{
  list-style: none;
}
.margin{
  margin: 20px;
}
.back-white{
  background: white;
}
</style>