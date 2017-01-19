import * as TYPES from '../../store/types'

const state = {
  list: [],
  pagination: {}
}

const mutations = {
  [TYPES.SAMPLES_SET_DATA] (state, obj) {
    state.list = obj.samples
    state.pagination = obj.samples_pagination
  }
}
const actions = {
  samplesSetData ({ commit }, obj) {
    commit(TYPES.SAMPLES_SET_DATA, obj)
  }
}

const module = {
  state,
  mutations,
  actions
}
export default { module }
