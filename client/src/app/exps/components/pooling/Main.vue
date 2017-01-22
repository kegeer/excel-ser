<template>
  <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>
          稀释数据表
          <router-link :to="{ name: 'poolings.import' }" tag="a" class="btn btn-primary pull-right">批量导入</router-link>
        </h4>
      </div>

      <div class="panel-body">
        <table class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>文库名称</th>
            <th>谱元编号</th>
            <th>引物</th>
            <th>浓度(ng/ul)</th>
            <th>循环数</th>
            <th>取样体积</th>
            <th>取样量</th>
            <th>实验批次</th>
            <th>备注(意外情况)</th>
          </tr>
          </thead>
          <tbody>
            <tr v-for="pooling in poolings">
              <td>{{ pooling.library_name }} </td>
              <td>{{ pooling.py_num }} </td>
              <td>{{ pooling.primer }} </td>
              <td>{{ pooling.c }} </td>
              <td>{{ pooling.cycle }} </td>
              <td>{{ pooling.sample_v }} </td>
              <td>{{ pooling.sample_m }} </td>
              <td>{{ pooling.exp_batch }} </td>
              <td>{{ pooling.note }} </td>
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
        poolings: state => state.Exps.poolings,
        poolings_pagination: state => state.Exps.poolings_pagination,
        fetching: state => state.fetching
      }),
      pagination () {
        return this.poolings_pagination
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
      ...mapActions(['poolingsSetData', 'setFetching', 'setMessage']),
      fetch () {
        this.setFetching({ fetching: true })
        this.$http.get(`poolings?page=${this.currentPage}`).then(({ data }) => {
          console.log(data)
          this.poolingsSetData({
            poolings: data.data,
            poolings_pagination: data.meta.pagination
          })
          this.setFetching({ fetching: false })
        })
      },
      navigate (obj) {
        this.$router.push({
          name: 'poolings.index',
          query: {
            page: obj.page
          }
        })
      }
    }
  }
</script>
