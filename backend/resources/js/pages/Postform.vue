<template>
  <div class="photo-form">
    <h2 class="title">投稿</h2>
    <form class="form" @submit.prevent="submit">    
    <ul>
      <li class="text-decoration">
        <label for="title">タイトル</label>
        <input class="form__item" type="text"  id="title" v-model="postData.title">
      </li>
      <li class="text-decroation">
        <label for="content">内容</label>
        <input class="form__item" type="text" id="content" v-model="postData.content">
      </li>
      <li class="text-decoration">
         <label for="resources_required">募集分野</label>
         <input class="form__item" type="text" id="resources_required" v-model="postData.resources_required">
      </li>
      <li class="text-decoration">
         <label for="resources_required">募集分野</label>
         <input class="form__item" type="text" id="resources_required" v-model="postData.resources_required">
      </li>
      <li class="text-decoration">
      <label for="qualification">応募資格</label>
      <input class="form__item" type="text" id="qualification" v-model="postData.qualification">
      </li>
      <li class="text-decoration">
        <label for="area">募集地域</label>
        <input class="form__item" type="text" id="area" v-model="postData.area">
      </li>
    </ul>
      <div v-if="errors" class="errors">
        <ul v-if="errors">
          <li v-for="msg in errors" :key="msg[0]">{{ msg[0] }}</li>
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
        qualification: "",
        resources_required: "",
        area: "",
      },
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
    reset () {
      this.postData.title = ""
      this.postData.content = ""
    },
    async submit () {
      console.log(this.routeStop)
      if(this.submitCheck) {
        this.submitCheck = false
        const response = await axios.post('/api/posts', this.postData)
      if (response.status === UNPROCESSABLE_ENTITY) {
        this.$store.commit('error/setErrorMessages', response.data.errors)
        this.routeStop = true
      } else {
        this.$store.commit('error/setCode', response.status)
      }
      this.submitCheck = true
      if(!this.routeStop)
        this.reset()
        this.$router.push({name: 'PostIndex'})
        this.routeStop = false
      } 
    }
  },
}
</script>
<style scoped>
.text-decoration{
  text-decoration: none;
}
</style>