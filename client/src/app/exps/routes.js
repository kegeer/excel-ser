const Exps = r => require.ensure([], () => r(require('./Main')), 'exps-bundle')
const Split = r => require.ensure([], () => r(require('./components/split/Main')), 'exps-bundle')
const SplitTable = r => require.ensure([], () => r(require('./components/split/Table')), 'exps-bundle')
const Dilution = r => require.ensure([], () => r(require('./components/dilution/Main')), 'exps-bundle')
const DilutionTable = r => require.ensure([], () => r(require('./components/dilution/Table')), 'exps-bundle')
const Analysis = r => require.ensure([], () => r(require('./components/analysis/Main')), 'exps-bundle')
const AnalysisTable = r => require.ensure([], () => r(require('./components/analysis/Table')), 'exps-bundle')
const Distribution = r => require.ensure([], () => r(require('./components/distribution/Main')), 'exps-bundle')
const DistributionTable = r => require.ensure([], () => r(require('./components/distribution/Table')), 'exps-bundle')
const Extraction = r => require.ensure([], () => r(require('./components/extraction/Main')), 'exps-bundle')
const ExtractionTable = r => require.ensure([], () => r(require('./components/extraction/Table')), 'exps-bundle')
const Library = r => require.ensure([], () => r(require('./components/library/Main')), 'exps-bundle')
const LibraryTable = r => require.ensure([], () => r(require('./components/library/Table')), 'exps-bundle')
const Pooling = r => require.ensure([], () => r(require('./components/pooling/Main')), 'exps-bundle')
const PoolingTable = r => require.ensure([], () => r(require('./components/pooling/Table')), 'exps-bundle')
const Sequence = r => require.ensure([], () => r(require('./components/sequence/Main')), 'exps-bundle')
const SequenceTable = r => require.ensure([], () => r(require('./components/sequence/Table')), 'exps-bundle')

export default [
  {
    path: '/exps',
    component: Exps,
    name: 'exps.index',
    children: [
      {
        name: 'splits.index',
        path: 'splits',
        component: Split
      },
      {
        name: 'splits.import',
        path: 'splits/import',
        component: SplitTable
      },
      {
        name: 'dilutions.index',
        path: 'dilutions',
        component: Dilution
      },
      {
        name: 'dilutions.import',
        path: 'dilutions/import',
        component: DilutionTable
      },
      {
        name: 'distributions.import',
        path: 'distributions/import',
        component: DistributionTable
      },
      {
        name: 'distributions.index',
        path: 'distributions',
        component: Distribution
      },
      {
        name: 'extractions.import',
        path: 'extractions/import',
        component: ExtractionTable
      },
      {
        name: 'extractions.index',
        path: 'extractions',
        component: Extraction
      },
      {
        name: 'libraries.import',
        path: 'libraries/import',
        component: LibraryTable
      },
      {
        name: 'libraries.index',
        path: 'libraries',
        component: Library
      },
      {
        name: 'analyses.import',
        path: 'analyses/import',
        component: AnalysisTable
      },
      {
        name: 'analyses.index',
        path: 'analyses',
        component: Analysis
      },
      {
        name: 'poolings.import',
        path: 'poolings/import',
        component: PoolingTable
      },
      {
        name: 'poolings.index',
        path: 'poolings',
        component: Pooling
      },
      {
        name: 'sequences.import',
        path: 'sequences/import',
        component: SequenceTable
      },{
        name: 'sequences.index',
        path: 'sequences',
        component: Sequence
      }
    ]
  }
]
