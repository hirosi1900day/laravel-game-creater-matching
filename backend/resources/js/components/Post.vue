<template>
  <div class="post-marge">
    <div style="red">
      <router-link :to="{ name: 'UserDetail', params: { userId: item.user.id}}">{{item.user.name}}</router-link>
      <div>{{item.title}}</div>
      <div>{{item.content}}</div>
      
      <router-link :to="{ name: 'ChatRoom', params: { partnerUserId: item.user.id}}">チャットでメッセージを送る</router-link>
    </div>
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