import PostList from '../pages/PostList.vue'
import PostForm from '../pages/PostForm.vue'

export default {
  path: '/post',
  component: Company,
  children: [
    {
      path: 'index',
      component: PostList,
      name: 'PostIndex',
      props: route => {
        const page = route.query.page
        return { page: /^[1-9][0-9]*$/.test(page) ? page * 1 : 1 }
      }
    },
    {
      path: 'create',
      component: PostForm,
      name: 'PostForm',
    },
  ]
}
