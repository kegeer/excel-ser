<template>
  <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>
          稀释数据表
          <router-link :to="{ name: 'sequences.import' }" tag="a" class="btn btn-primary pull-right">批量导入</router-link>
        </h4>
      </div>

      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
          <tr>
            <th rowspan="2">文库编号</th>
            <th rowspan="2">Qubit</th>
            <th colspan="2">Index</th>
            <th rowspan="2">片断大小</th>
            <th rowspan="2">M浓度</th>
            <th rowspan="2">取样体积</th>
            <th rowspan="2">加水量</th>
            <th rowspan="2">数据量</th>
            <th rowspan="2">比例</th>
            <th rowspan="2">混样体积</th>
            <th rowspan="2">备注(意外情况)</th>
          </tr>
          <tr>
            <th>index1</th>
            <th>index2</th>
          </tr>
          </thead>
          <tbody>
            <tr v-for="sequence in sequences">
              <td>{{ sequence.library_num }} </td>
              <td>{{ sequence.qubit }} </td>
              <td>{{ sequence.index1 }} </td>
              <td>{{ sequence.index2 }} </td>
              <td>{{ sequence.fragment_size }} </td>
              <td>{{ sequence.m_c }} </td>
              <td>{{ sequence.sample_v }} </td>
              <td>{{ sequence.water }} </td>
              <td>{{ sequence.data }} </td>
              <td>{{ sequence.ratio }} </td>
              <td>{{ sequence.mix_v }} </td>
              <td>{{ sequence.note }} </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapState, mapActions } from 'vuex'
  export default {
    computed: {
      ...mapState({
        sequences: state => state.Exps.sequences,
        sequences_pagination: state => state.Exps.sequences_pagination,
        fetching: state => state.fetching
      }),
      pagination () {
        return this.sequences_pagination
      },
      currentPage () {
        return parseInt(this.$route.query.page, 10) || 1
      }
    },
    mounted () {
      this.fetch()
    },
    watch: {
      currentPage: 'fetch'
    },
    methods: {
      ...mapActions(['sequencesSetData', 'setFetching', 'setMessage']),
      fetch () {
        this.setFetching({ fetching: true })
        this.$http.get('sequences').then(({ data }) => {
          console.log(data)
          this.sequencesSetData({
            sequences: data.data,
            sequences_pagination: data.meta.pagination
          })
          this.setFetching({ fetching: false })
        })
      },
      navigate (obj) {
        this.$route.push({
          name: 'sequences.index',
          query: {
            page: obj.page
          }
        })
      }
    }
  }
</script>
