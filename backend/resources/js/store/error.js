const state = {
  code: null,
  errorMessages: null
}

const mutations = {
  setCode (state, code) {
    state.code = code
  },
  setErrorMessages (state, messages) {
    state.errorMessages = messages
  }
}

export default {
  namespaced: true,
  state,
  mutations
}