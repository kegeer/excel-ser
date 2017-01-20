<template>
  <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>
          稀释数据表
          <router-link :to="{ name: 'dilutions.import' }" tag="a" class="btn btn-primary pull-right">批量导入</router-link>
        </h4>
      </div>

      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
          <tr>
            <th rowspan="2">谱元编号</th>
            <th rowspan="2">扩增方案</th>
            <th colspan="4">稀释</th>
            <th rowspan="2">产物浓度</th>
            <th rowspan="2">实验批次</th>
            <th rowspan="2">项目归属</th>
            <th rowspan="2">备注(意外情况</th>
          </tr>
          <tr>
            <th>原浓度</th>
            <th>取样体积</th>
            <th>加水量</th>
            <th>终浓度</th>
          </tr>
          </thead>
          <tbody>
            <tr v-for="dilution in dilutions">
              <td>{{ dilution.sample_id }} </td>
              <td>{{ dilution.pipeline }} </td>
              <td>{{ dilution.ori_c }} </td>
              <td>{{ dilution.sample_v }} </td>
              <td>{{ dilution.water }} </td>
              <td>{{ dilution.end_c }} </td>
              <td>{{ dilution.product_c }} </td>
              <td>{{ dilution.exp_bacth }} </td>
              <td>{{ dilution.project }} </td>
              <td>{{ dilution.note }} </td>
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
        dilutions: state => state.Exps.dilutions,
        dilutions_pagination: state => state.Exps.dilutions_pagination,
        fetching: state => state.fetching
      }),
      pagination () {
        return this.dilutions_pagination
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
      ...mapActions(['dilutionsSetData', 'setFetching', 'setMessage']),
      fetch () {
        this.setFetching({ fetching: true })
        this.$http.get(`dilutions?page=${this.currentPage}`).then(({ data }) => {
          console.log(data)
          this.dilutionsSetData({
            dilutions: data.data,
            dilutions_pagination: data.meta.pagination
          })
          this.setFetching({ fetching: false })
        })
      },
      navigate (obj) {
        this.$router.push({
          name: 'dilutions.index',
          query: {
            page: obj.page
          }
        })
      }
    }
  }
</script>
