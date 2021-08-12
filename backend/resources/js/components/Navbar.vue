
<template>
  


<header class="text-gray-600 body-font">
  <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
    <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
      <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
      </svg>
      <span class="ml-3 text-xl">Tailblocks</span> -->
      <div>HOME</div>
    </a>
    <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
      <RouterLink class="mr-5 hover:text-gray-900" :to="{name: 'PostIndex'}">
         Home
      </RouterLink>
      <RouterLink class="mr-5 hover:text-gray-900" :to="{name: 'PostForm'}">
        投稿
      </RouterLink>
      <RouterLink class="mr-5 hover:text-gray-900" :to="{name: 'Mypage'}">
        マイページ
      </RouterLink>
      <RouterLink class="mr-5 hover:text-gray-900" :to="{name: 'ChatIndex'}">
        chatUser一覧
      </RouterLink>
      <RouterLink class="mr-5 hover:text-gray-900" :to="{name: 'UserIndex'}">
        User一覧
      </RouterLink>
      
      
    </nav>
  </div>
</header>

</template>


<script>
 

// $('.navbar-nav>li').on('click', function(){
//       $('.navbar-collapse').collapse('hide');
// });
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


</script>