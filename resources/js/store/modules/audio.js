import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
  podcast: null,
  podcasts: null
}

// getters
export const getters = {
  podcast: state => state.podcast,
  podcasts: state => state.podcasts
}

// mutations
export const mutations = {
  [types.FETCH_PODCAST_SUCCESS] (state, { podcast }) {
    state.podcast = podcast
  },
  [types.FETCH_PODCASTS_SUCCESS] (state, { podcasts }) {
    state.podcasts = podcasts
  }
}

// actions
export const actions = {
  async fetchPodcast ({ commit }, id) {
    try {
      const { data } = await axios.get('/api/podcast/' + id)
      commit(types.FETCH_PODCAST_SUCCESS, { podcast: data })
    } catch (e) {
      commit(types.FETCH_PODCAST_FAILURE)
    }
  },
  async fetchPodcasts ({ commit }) {
    try {
      const { data } = await axios.get('/api/podcasts')
      commit(types.FETCH_PODCASTS_SUCCESS, { podcasts: data })
    } catch (e) {
      commit(types.FETCH_PODCASTS_FAILURE)
    }
  }
}
