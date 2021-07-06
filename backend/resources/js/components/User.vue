<template>
  <div class="post-marge">
    <div style="red">
      <router-link :to="{ name: 'UserDetail', params: { userId: item.id}}">{{item.name}}</router-link>
      <div>{{item.name}}</div>
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