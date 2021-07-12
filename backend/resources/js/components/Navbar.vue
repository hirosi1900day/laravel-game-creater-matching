
<template>
  <header style="margin: 40px"> 
    <!-- ナビゲーションバー -->
    <nav class="navbar fixed-top navbar-expand-xl navbar-light bg-color">
      <div class="container-fluid">

        <!-- ホームリンク -->
        <a href="/" class="navbar-brand" aria-label="ホーム">
          <div>アイコン</div>
        </a>

        <!-- 画面幅が狭い時に表示されるハンバーガーメニュー -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
          aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- メニュー -->
        <div class="collapse navbar-collapse" id="navbar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <RouterLink class="navbar__brand" :to="{name: 'PostIndex'}">
                Home
              </RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="navbar__brand" :to="{name: 'PostForm'}">
                投稿
              </RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="navbar__brand" :to="{name: 'Mypage'}">
                マイページ
               </RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="navbar__brand" :to="{name: 'ChatIndex'}">
                chatUser一覧
              </RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="navbar__brand" :to="{name: 'UserIndex'}">
                User一覧
              </RouterLink>
            </li>  
          </ul>
        </div>
        <!--/.nav-collapse -->
      </div>
      <!--/.container-fluid -->
    </nav>

</header>
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