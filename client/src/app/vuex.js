import { isFunction } from 'lodash'
import { vuex as Samples } from './samples'
import { vuex as Exps } from './exps'

const vuex = { Exps, Samples }
const keys = Object.keys(vuex)

const modules = keys.reduce((acc, key) => ({...acc, [key]: vuex[key].module}), {})
const plugins = keys.reduce((acc, key) => [...acc, vuex[key].plugin], []).filter(isFunction)

export default { modules, plugins }
