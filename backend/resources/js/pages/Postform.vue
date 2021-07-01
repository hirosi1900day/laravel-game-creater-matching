<template>
  <div class="photo-form">
    <h2 class="title">投稿</h2>
    <form class="form" @submit.prevent="submit">
      <input class="form__item" type="text" v-model="postData.title">
      <input class="form__item" type="text" v-model="postData.content">
      <div v-if="errors" class="errors">
        <ul v-if="errors.title">
          <li v-for="msg in errors.title" :key="msg">{{ msg }}</li>
        </ul>
        <ul v-if="errors.content">
          <li v-for="msg in errors.content" :key="msg">{{ msg }}</li>
        </ul>
      </div>
      <div class="form__button">
        <button>submit</button>
      </div>
    </form>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import { UNPROCESSABLE_ENTITY } from '../util'

export default {
  data () {
    return { 
      postData: {
        title: "",
        content: "",
      },
      validationCheck: false
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
    reset () {
      this.postData.title = ""
      this.postData.content = ""
      console.log("リセット")
    },
    async submit () {
      console.log("確認")
      const response = await axios.post('/api/post', this.postData)
      if (response.status === UNPROCESSABLE_ENTITY) {
        this.$store.commit('error/setErrorMessages', response.data.errors)
      } else {
        this.$store.commit('error/setCode', response.status)
      }
      this.reset()
      this.$router.push({name: 'PostIndex'})
      console.log("確認")
    }
  }
}
</script>