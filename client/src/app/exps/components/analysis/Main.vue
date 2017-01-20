<template>
  <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>
          产物分析数据表
          <router-link :to="{ name: 'analyses.import' }" tag="a" class="btn btn-primary pull-right">批量导入</router-link>
        </h4>
      </div>

      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
          <tr>
            <th rowspan="2">谱元编号</th>
            <th rowspan="2">扩增方案</th>
            <th colspan="5">数据</th>
            <th rowspan="2">实验批次</th>
            <th rowspan="2">项目归属</th>
            <th rowspan="2">备注(意外情况)</th>
          </tr>
          <tr>
            <th>引物</th>
            <th>循环数</th>
            <th>浓度(ng/ul)</th>
            <th>体积(ul)</th>
            <th>电泳结果/电泳图名称</th>
          </tr>
          </thead>
          <tbody>
            <tr v-for="analysis in analyses">
              <td>{{ analysis.py_num }} </td>
              <td>{{ analysis.pipeline }} </td>
              <td>{{ analysis.primer }} </td>
              <td>{{ analysis.cycle }} </td>
              <td>{{ analysis.c }} </td>
              <td>{{ analysis.v }} </td>
              <td>{{ analysis.elec_result }} </td>
              <td>{{ analysis.exp_batch }} </td>
              <td>{{ analysis.project }} </td>
              <td>{{ analysis.note }} </td>
            </tr>
          </tbody>
        </table>
        <pagination :paginationData="pagination" :currentPage="currentPage" :maxItems="pagination.total"></pagination>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapState, mapActions } from 'vuex'
  export default {
    computed: {
      ...mapState({
        analyses: state => state.Exps.analyses,
        analyses_pagination: state => state.Exps.analyses_pagination,
        fetching: state => state.fetching
      }),
      pagination () {
        return this.analyses_pagination
      },
      currentPage () {
        return parseInt(this.$route.query.page, 10) || 1
      }
    },
    mounted () {
      this.$bus.$on('navigate', ({ page }) => this.navigate(page))
      this.fetch()
    },
    beforeRouteLeave (to, from, next) {
      this.$bus.$off('navigate')
      next()
    },
    watch: {
      currentPage: 'fetch'
    },
    methods: {
      ...mapActions(['analysesSetData', 'setFetching', 'setMessage']),
      fetch () {
        this.setFetching({ fetching: true })
        this.$http.get(`analyses?page=${this.currentPage}`).then(({ data }) => {
          console.log(data)
          this.analysesSetData({
            analyses: data.data,
            analyses_pagination: data.meta.pagination
          })
          this.setFetching({ fetching: false })
        })
      },
      navigate (obj) {
        this.$router.push({
          name: 'analyses.index',
          query: {
            page: obj.page
          }
        })
      }
    }
  }
</script>
