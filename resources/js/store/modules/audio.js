import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
  podcasts: null
}

// getters
export const getters = {
  podcasts: state => state.podcasts
}

// mutations
export const mutations = {
  [types.FETCH_PODCASTS_SUCCESS] (state, { podcasts }) {
    state.podcasts = podcasts
  }
}

// actions
export const actions = {
  async fetchPodcasts ({ commit }) {
    try {
      const { data } = await axios.get('/api/podcasts')
      commit(types.FETCH_PODCASTS_SUCCESS, { podcasts: data })
    } catch (e) {
      commit(types.FETCH_PODCASTS_FAILURE)
    }
  }
}
