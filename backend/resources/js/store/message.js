
const state = {
   content: ''
 }
 
 const mutations = {
   setContent (state, {content, timeout}) {
     state.content = content
     if(typeof timeout == 'undefined') {
        timeout = 3000
     }

     console.log(`messageの内容家訓${this.state.content} `)
     
     setTimeout(() => {
        state.content = ''
     })
   }
 }
 

 export default {
   namespaced: true,
   state,
   mutations
 }