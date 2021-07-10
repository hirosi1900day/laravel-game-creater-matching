<template>
  <div class="post-marge">
    <div style="red">
      <div>{{item.title}}</div>
      <div>{{item.content}}</div>
    </div>
    <router-link :to="{ name: 'PostMypageDetail', params: { postId: item.id}}">詳細を確認する</router-link>
  </div>
</template>

<script>
export default {
  props: {
    item: {
      type: Object,
      required: true
    }
  }
}
</script>

<style scoped>
.post-marge {
  margin: 20px;
}
</style>