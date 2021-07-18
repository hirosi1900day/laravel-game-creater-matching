<template>
  <div>
    <div>{{getMessageData.user.name}}さんとのチャットルーム</div>
    <div
    v-for="message in getMessageData.message"
    :key="message.id"
    >
      <div v-if="message.user_id == partnerUserId" class="bg-blue-300 p-2 rounded-xl m-2">
        <div class="font-bold">相手</div>
        <div class="whitespace-pre">{{message.message}}</div>
      </div>
      <div v-else class="bg-green-300 p-2 rounded-xl m-2">
        <div class="font-bold">あなた</div>
        <div class="whitespace-pre">{{message.message}}</div>
      </div>

    </div>
     <form class="form fixed bottom-1 w-5/6 flex" @submit.prevent="submit">
      <textarea class="form__item flex-1 border-2 border-green-300" type="text" v-model="sendMessageData.message"></textarea>
      <div class="form__button flex-none">
        <button class="bg-green-300 p-2 m-2 rounded-lg">送信</button>
      </div>
    </form>
  </div>
</template>

<script>
import {OK,CREATED,UNPROCESSABLE_ENTITY} from '../util.js'
import {mapState} from "vuex"

export default {
  data () {
    return {
      sendMessageData: {
        message: "",
        user_id: -1,
      },
       getMessageData: [],
       authUser: [],
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
  computed: function() {
    mapState({
      authUser: state =>state.user
    })
  },
  created: function() {
    this.fetchChatRoom()
    console.log(this.authUser)
  }
}
</script>