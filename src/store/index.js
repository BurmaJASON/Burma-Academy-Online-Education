import { createStore } from 'vuex'

export default createStore({
  state: {
    userData : {},
    token : '',
  },
  
  getters: {
    token (state) {
      return state.token;
    },

    userData : state => state.userData,


  },

  mutations: {
  },

  actions: {
    setToken : ({state},value) => state.token = value,

    setUserData : ({state},value) => state.userData = value,

  },

  modules: {
  }

})
