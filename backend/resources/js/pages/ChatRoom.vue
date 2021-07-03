<template>
  <div>
    <div>テスト</div>
    <div>{{partnerUserId}}</div>
    <h1>メッセージ</h1>
    <div
        v-for="message in getMessageData.message"
        :key="message.id"
      >{{message.message}}</div>
     <form class="form" @submit.prevent="submit">
      <input class="form__item" type="text" v-model="sendMessageData.message">
      <div class="form__button">
        <button>submit</button>
      </div>
    </form>
  </div>
</template>

<script>
import {OK,CREATED,UNPROCESSABLE_ENTITY} from '../util.js'


export default {
  data () {
    return {
      sendMessageData: {
        message: "",
        user_id: -1,
      },
       getMessageData: [],
    }
  },
  props: ['partnerUserId'],
  methods: {
    async fetchChatRoom () {
      const response = await axios.get(`/api/chats/users/${this.partnerUserId}`)
      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }
      this.getMessageData = response.data
      console.log(this.getMessageData)
    },
    reset () {
      this.sendMessageData.message = ''
      this.sendMessageData.user_id = ''
    },
    async submit () {
      this.sendMessageData.user_id = this.partnerUserId
      const response = await axios.post('/api/chats/users', this.sendMessageData)

      switch (response.status) {
        case OK:
          this.fetchChatRoom ()
          console.log("fetchChatRoom実行")
          break
        case UNPROCESSABLE_ENTITY:
          this.$store.commit('error/setErrorMessages', response.data.errors)
          break
        default:
          this.$store.commit('error/setCode', response.status)
          break
      } 
      this.reset()
      
    }
  },
  created: function() {
    console.log("createdが実行されました")
    this.fetchChatRoom()
  }
}
</script>