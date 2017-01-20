<template>
  <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>
          稀释数据表
          <router-link :to="{ name: 'extractions.import' }" tag="a" class="btn btn-primary pull-right">批量导入</router-link>
        </h4>
      </div>

      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
          <tr>
            <th rowspan="2">谱元编号</th>
            <th rowspan="2">样品类型</th>
            <th colspan="4">技术路线(16S/ITS/WGS)</th>
            <th rowspan="4">提取结果</th>
            <th rowspan="2">实验批次</th>
            <th rowspan="2">所属项目</th>
            <th rowspan="2">备注(意外情况</th>
          </tr>
          <tr>
            <th>浓度(ng/ul)</th>
            <th>体积(ul)</th>
            <th>总量(ng)</th>
            <th>电泳结果</th>
          </tr>
          </thead>
          <tbody>
            <tr v-for="extraction in extractions">
              <td>{{ extraction.py_num }} </td>
              <td>{{ extraction.sample_type }} </td>
              <td>{{ extraction.pipeline }} </td>
              <td>{{ extraction.c }} </td>
              <td>{{ extraction.v }} </td>
              <td>{{ extraction.total }} </td>
              <td>{{ extraction.elec_result }} </td>
              <td>{{ extraction.exp_batch }} </td>
              <td>{{ extraction.project }} </td>
              <td>{{ extraction.note }} </td>
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
        extractions: state => state.Exps.extractions,
        extractions_pagination: state => state.Exps.extractions_pagination,
        fetching: state => state.fetching
      }),
      pagination () {
        return this.extractions_pagination
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
      ...mapActions(['extractionsSetData', 'setFetching', 'setMessage']),
      fetch () {
        this.setFetching({ fetching: true })
        this.$http.get(`extractions?page=${this.currentPage}`).then(({ data }) => {
          console.log(data)
          this.extractionsSetData({
            extractions: data.data,
            extractions_pagination: data.meta.pagination
          })
          this.setFetching({ fetching: false })
        })
      },
      navigate (obj) {
        this.$router.push({
          name: 'extractions.index',
          query: {
            page: obj.page
          }
        })
      }
    }
  }
</script>
