import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
  songs: null
}

// getters
export const getters = {
  songs: state => state.songs
}

// mutations
export const mutations = {
  [types.FETCH_SONGS_SUCCESS] (state, { songs }) {
    state.songs = songs
  }
}

// actions
export const actions = {
  async fetchSongs ({ commit }) {
    try {
      const { data } = await axios.get('/api/songs')
      commit(types.FETCH_SONGS_SUCCESS, { songs: data })
    } catch (e) {
      commit(types.FETCH_SONGS_FAILURE)
    }
  }
}
