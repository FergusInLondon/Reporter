import axios from 'axios'
import Cookies from 'js-cookie'
import * as types from '../mutation-types'

// state
export const state = {
  user: null,
  token: Cookies.get('token'),
  isLoading: false,
  showSidebar: true,
  pageTitle: 'Welcome'
}

// getters
export const getters = {
  user: state => state.user,
  token: state => state.token,
  check: state => state.user !== null,
  isLoading: state => state.isLoading,
  sidebarCollapsed: state => !state.showSidebar,
  pageTitle: state => state.pageTitle
}

// mutations
export const mutations = {
  [types.SAVE_TOKEN] (state, { token, remember }) {
    state.token = token
    Cookies.set('token', token, { expires: remember ? 365 : null })
  },

  [types.FETCH_USER_SUCCESS] (state, { user }) {
    state.user = user
  },

  [types.FETCH_USER_FAILURE] (state) {
    state.token = null
    Cookies.remove('token')
  },

  [types.LOGOUT] (state) {
    state.user = null
    state.token = null

    Cookies.remove('token')
  },

  [types.UPDATE_USER] (state, { user }) {
    state.user = user
  },

  [types.IS_LOADING] (state) {
    state.isLoading = true
  },

  [types.FINISHED_LOADING] (state) {
    state.isLoading = false
  },

  [types.SIDEBAR_COLLAPSED] (state) {
    state.showSidebar = false
  },

  [types.SIDEBAR_VISIBLE] (state) {
    state.showSidebar = true
  },

  [types.UPDATE_TITLE] (state, title) {
    state.pageTitle = title
  }
}

// actions
export const actions = {
  saveToken ({ commit }, payload) {
    commit(types.SAVE_TOKEN, payload)
  },

  async fetchUser ({ commit }) {
    try {
      const { data } = await axios.get('/api/user')

      commit(types.FETCH_USER_SUCCESS, { user: data })
    } catch (e) {
      commit(types.FETCH_USER_FAILURE)
    }
  },

  updateUser ({ commit }, payload) {
    commit(types.UPDATE_USER, payload)
  },

  async logout ({ commit }) {
    try {
      await axios.post('/api/logout')
    } catch (e) { }

    commit(types.LOGOUT)
  },

  setLoading({ commit }, payload) {
    commit(payload ? types.IS_LOADING : types.FINISHED_LOADING)
  },

  showSidebar({ commit }, payload) {
    commit(payload ? types.SIDEBAR_VISIBLE : types.SIDEBAR_COLLAPSED)
  },

  updateTitle({ commit }, payload) {
    commit(types.UPDATE_TITLE, payload)
  }
}
