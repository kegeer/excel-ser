<template>
  <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>样品列表
          <router-link :to="{ name: 'sample.import' }" tag="a" class="btn btn-primary pull-right">批量导入</router-link>
        </h4>
      </div>
      <div class="panel-body">
        <table class="table">
          <thead>
          <tr>
            <th>原始编号</th>
            <th>谱元编号</th>
            <th>样品类型</th>
            <th>送样人</th>
            <th>送样人/寄件人联系方式</th>
            <th>样品批次</th>
            <th>样品所属项目编号</th>
            <th>技术路线</th>
            <th>备注(意外情况)</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="sample in samples">
            <td>{{ sample.ori_num }}</td>
            <td>{{ sample.py_num }}</td>
            <td>{{ sample.sample_type }}</td>
            <td>{{ sample.sender }}</td>
            <td>{{ sample.sender_contact }}</td>
            <td>{{ sample.sample_batch }}</td>
            <td>{{ sample.project }}</td>
            <td>{{ sample.pipeline }}</td>
            <td>{{ sample.note }}</td>
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
        list: state => state.Samples.list,
        pagination: state => state.Samples.pagination,
        fetching: state => state.fetching
      }),
      samples () {
        return this.list
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
      ...mapActions(['samplesSetData', 'setFetching', 'setMessage']),
      fetch () {
        this.setFetching({ fetching: true })
        this.$http.get(`samples?page=${this.currentPage}`).then(({ data }) => {
          console.log(data)
          this.samplesSetData({
            samples: data.data,
            samples_pagination: data.meta.pagination
          })
          this.setFetching({ fetching: false })
        })
      },
      navigate (obj) {
        this.$router.push({
          name: 'samples.index',
          query: {
            page: obj.page
          }
        })
      }
    }
  }
</script>
