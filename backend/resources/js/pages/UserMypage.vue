<template>
  <div class="photo-form">
    <h2 class="title">マイページ</h2>
    <RouterLink class="navbar__brand" :to="{name: 'PostMypage'}">
        自分の投稿
    </RouterLink>
    <form class="form" @submit.prevent="update">
      <input type="file" @change="fileSelected">
      <output class="form__output" v-if="preview">
        <img :src="preview" alt=""> 
      </output>
      <input class="form__item" type="text" v-model="myUserData.name">
      <textarea class="form__item" type="text" v-model="myUserData.self_introduce"></textarea>
      <div v-if="errors" class="errors">
        <ul v-if="errors.title">
          <li v-for="msg in errors.title" :key="msg">{{ msg }}</li>
        </ul>
        <ul v-if="errors.content">
          <li v-for="msg in errors.content" :key="msg">{{ msg }}</li>
        </ul>
      </div>
      <div class="form__button">
        <button>変更する</button>
      </div>
    </form>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import {OK,UNPROCESSABLE_ENTITY } from '../util'

export default {
  data () {
    return { 
      myUserData: {
        name: '',
        seld_introduce: '',
        user_id: '',
        file: null,
      },
      preview: null
    }
  },
  computed: {
    ...mapState({
      errors: state => 
      { 
        console.log(state.error.errorMessages)
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
        this.preview.file = e.target.result
      }
      // ファイルを読み込む
      // 読み込まれたファイルはデータURL形式で受け取れる（上記onload参照）
      reader.readAsDataURL(event.target.files[0])
      // this.myUserData.file = event.target.files[0]
      this.myUserData.file = event.target.files[0]
      console.log("写真確認")
      console.log(this.myUserData.file)
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