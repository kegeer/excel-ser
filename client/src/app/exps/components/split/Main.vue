<template>
  <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>
          稀释数据表
          <router-link :to="{ name: 'splits.import' }" tag="a" class="btn btn-primary pull-right">批量导入</router-link>
        </h4>
      </div>

      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
          <tr>
            <th rowspan="2">谱元编号</th>
            <th rowspan="2">样品类型</th>
            <th rowspan="2">样品状态</th>
            <th rowspan="2">技术路线(16S/ITS/WGS)</th>
            <th colspan="3">取样结果</th>
            <th rowspan="2">实验批次</th>
            <th rowspan="2">所属项目</th>
            <th rowspan="2">备注(意外情况)</th>
          </tr>
          <tr>
            <th>质量</th>
            <th>体积(ul)</th>
            <th>余量</th>
          </tr>
          </thead>
          <tbody>
            <tr v-for="dilution in splits">
              <td>{{ dilution.py_num }} </td>
              <td>{{ dilution.sample_type }} </td>
              <td>{{ dilution.sample_status }} </td>
              <td>{{ dilution.pipeline }} </td>
              <td>{{ dilution.m }} </td>
              <td>{{ dilution.v }} </td>
              <td>{{ dilution.left }} </td>
              <td>{{ dilution.exp_batch }} </td>
              <td>{{ dilution.project }} </td>
              <td>{{ dilution.note }} </td>
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
        splits: state => state.Exps.splits,
        splits_pagination: state => state.Exps.splits_pagination,
        fetching: state => state.fetching
      }),
      pagination () {
        return this.splits_pagination
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
      ...mapActions(['splitsSetData', 'setFetching', 'setMessage']),
      fetch () {
        this.setFetching({ fetching: true })
        this.$http.get('splits').then(({ data }) => {
          console.log(data)
          this.splitsSetData({
            splits: data.data,
            splits_pagination: data.meta.pagination
          })
          this.setFetching({ fetching: false })
        })
      },
      navigate (obj) {
        this.$route.push({
          name: 'splits.index',
          query: {
            page: obj.page
          }
        })
      }
    }
  }
</script>
