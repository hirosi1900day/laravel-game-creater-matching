<template>
  <div class="pagination">
    <RouterLink
      v-if="! isFirstPage"
      :to="`/post/index?page=${currentPage - 1}`"
      class="bg-green-300 p-2 m-2"
    >&laquo; 戻る</RouterLink>
    <RouterLink
      v-if="! isLastPage"
      :to="`/post/index?page=${currentPage + 1}`"
      class="bg-green-300 p-2 m-2"
    >次へ &raquo;</RouterLink>
  </div>
</template>

<script>
export default {
  props: {
    currentPage: {
      type: Number,
      required: true
    },
    lastPage: {
      type: Number,
      required: true
    }
  },
  computed: {
    isFirstPage () {
      return this.currentPage === 1
    },
    isLastPage () {
      return this.currentPage === this.lastPage
    }
  }
}
</script>