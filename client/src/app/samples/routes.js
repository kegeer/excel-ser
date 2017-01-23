const Samples = r => require.ensure([], () => r(require('./Main')), 'samples-bundle')
const Form = r => require.ensure([], () => r(require('./Form')), 'samples-bundle')
const Table = r => require.ensure([], () => r(require('./Table')), 'samples-bundle')

export default [
  {
    path: '/samples',
    component: Samples,
    name: 'samples.index',
    children: [
      {
        path: 'new',
        name: 'sample.new',
        component: Form
      },
      {
        path: ':id/edit',
        name: 'sample.edit',
        component: Form
      }
    ]
  },
  {
    path: '/samples/import',
    component: Table,
    name: 'sample.import'
  }
]
