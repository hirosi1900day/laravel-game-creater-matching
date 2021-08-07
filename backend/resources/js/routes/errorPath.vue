//エラーハンドリング
<script>

import SystemError from '../pages/errors/System.vue'

export default {
  { path: '/401', redirect: to => {
    return window.location.href = "/login"
  }},
  {
    path: '/500',
    component: SystemError
  },
}
</script>
