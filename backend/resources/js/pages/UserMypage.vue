<template>
  <div class="photo-form">
    <h2 class="title">マイページ</h2>
    <form class="form" @submit.prevent="update">
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
        user_id: ''
      }
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
    async get() {
      const response = await axios.get('/api/user/mypage')
      if (!response.status == OK) {
        this.$store.commit('error/setCode', response.status)
      }
      console.log("get")
      console.log(response.data)
      let getData = response.data
      this.myUserData.name = getData.name
      this.myUserData.self_introduce = getData.self_introduce
    },
    async update () {
      this.myUserData.user_id = this.$store.state.auth.user.id
      const response = await axios.put('/api/user/mypage', this.myUserData)
      if (response.status === UNPROCESSABLE_ENTITY) {
        this.$store.commit('error/setErrorMessages', response.data.errors)
      } else {
        this.$store.commit('error/setCode', response.status)
      }
      console.log('update')
      console.log(response.data)
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