import * as TYPES from '../../store/types'

const state = {
  dilutions: [],
  dilutions_pagination: {},
  analyses: [],
  analyses_pagination: {},
  distributions: [],
  distributions_pagination: {},
  extractions: [],
  extractions_pagination: {},
  libraries: [],
  libraries_pagination: {},
  poolings: [],
  poolings_pagination: {},
  sequences: [],
  sequences_pagination: {},
  splits: [],
  splits_pagination: {},
}

const mutations = {
  [TYPES.DILUTIONS_SET_DATA] (state, obj) {
    state.dilutions = obj.dilutions
    state.dilutions_pagination = obj.dilutions_pagination
  },
  [TYPES.ANALYSES_SET_DATA] (state, obj) {
    state.analyses = obj.analyses
    state.analyses_pagination = obj.analyses_pagination
  },
  [TYPES.DISTRIBUTIONS_SET_DATA] (state, obj) {
    state.distributions = obj.distributions
    state.distributions_pagination = obj.distributions_pagination
  },
  [TYPES.EXTRACTIONS_SET_DATA] (state, obj) {
    state.extractions = obj.extractions
    state.extractions_pagination = obj.extractions_pagination
  },
  [TYPES.LIBRARIES_SET_DATA] (state, obj) {
    state.libraries = obj.libraries
    state.libraries_pagination = obj.libraries_pagination
  },
  [TYPES.POOLINGS_SET_DATA] (state, obj) {
    state.poolings = obj.poolings
    state.poolings_pagination = obj.poolings_pagination
  },
  [TYPES.SEQUENCES_SET_DATA] (state, obj) {
    state.sequences = obj.sequences
    state.sequences_pagination = obj.sequences_pagination
  },
  [TYPES.SPLITS_SET_DATA] (state, obj) {
    state.splits = obj.splits
    state.splits_pagination = obj.splits_pagination
  }
}
const actions = {
  dilutionsSetData ({ commit }, obj) {
    commit(TYPES.DILUTIONS_SET_DATA, obj)
  },
  analysesSetData ({ commit }, obj) {
    commit(TYPES.ANALYSES_SET_DATA, obj)
  },
  distributionsSetData ({ commit }, obj) {
    commit(TYPES.DISTRIBUTIONS_SET_DATA, obj)
  },
  extractionsSetData ({ commit }, obj) {
    commit(TYPES.EXTRACTIONS_SET_DATA, obj)
  },
  librariesSetData ({ commit }, obj) {
    commit(TYPES.LIBRARIES_SET_DATA, obj)
  },
  poolingsSetData ({ commit }, obj) {
    commit(TYPES.POOLINGS_SET_DATA, obj)
  },
  sequencesSetData ({ commit }, obj) {
    commit(TYPES.SEQUENCES_SET_DATA, obj)
  },
  splitsSetData ({ commit }, obj) {
    commit(TYPES.SPLITS_SET_DATA, obj)
  }
}

const module = {
  state,
  mutations,
  actions
}
export default { module }
