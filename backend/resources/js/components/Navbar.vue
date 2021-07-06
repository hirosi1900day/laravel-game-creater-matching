<template>
  <nav class="navbar">
    <RouterLink class="navbar__brand" :to="{name: 'PostIndex'}">
      Home
    </RouterLink>
    <div class="navbar__menu">
      <div class="navbar__item">
        <RouterLink class="navbar__brand" :to="{name: 'PostForm'}">
          投稿
        </RouterLink>
      </div>
      <div class="navbar__item">
        <RouterLink class="navbar__brand" :to="{name: 'Mypage'}">
          マイページ
        </RouterLink>
      </div>
      <div class="navbar__item">
        <RouterLink class="navbar__brand" :to="{name: 'ChatIndex'}">
          chatUser一覧
        </RouterLink>
      </div>
      <div class="navbar__item">
        <RouterLink class="navbar__brand" :to="{name: 'UserIndex'}">
          User一覧
        </RouterLink>
      </div>
      <span class="navbar__item">
      </span>
    </div>
  
  </nav>
</template>

<script>


export default {
 


//   data () {
//     return {
//       showForm: false
//     }
//   },
//   computed: {
//     isLogin () {
//       return this.$store.getters['auth/check']
//     },
//     username () {
//       return this.$store.getters['auth/username']
//     }
//   }
}

</script>