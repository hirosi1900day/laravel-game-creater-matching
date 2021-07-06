<template>
  <div>
    <header>
      <Navbar />
    </header>
    <main>
      <div class="container">
        <RouterView />
      </div>
    </main>
  </div>
</template>

<script>
import Navbar from './components/Navbar.vue'
import { INTERNAL_SERVER_ERROR, NOT_AUTH } from './util'

export default {
  components: {
    Navbar
  },
  computed: {
    errorCode () {
      return this.$store.state.error.code
    }
  },
  watch: {
    errorCode: {
      handler (val) {
        if (val === INTERNAL_SERVER_ERROR) {
          this.$router.push('/500')
        }
        if (val === NOT_AUTH) {
          this.$router.push('/401')
        }
      },
      immediate: true
    },
    $route () {
      this.$store.commit('error/setCode', null)
    }
  }
}
</script>
