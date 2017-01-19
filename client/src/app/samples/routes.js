const Samples = r => require.ensure([], () => r(require('./Main')), 'samples-bundle')
const Table = r => require.ensure([], () => r(require('./Table')), 'samples-bundle')

export default [
  {
    path: '/samples',
    component: Samples,
    name: 'samples.index'
  },
  {
    path: '/samples/import',
    component: Table,
    name: 'sample.import'
  }
]
