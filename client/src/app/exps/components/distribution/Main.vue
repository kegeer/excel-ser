<template>
  <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>
          稀释数据表
          <router-link :to="{ name: 'distributions.import' }" tag="a" class="btn btn-primary pull-right">批量导入</router-link>
        </h4>
      </div>

      <div class="panel-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <td>板流水号</td>
              <td>板位</td>
              <td>谱元编号</td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="distribution in distributions">
              <td>{{ distribution.meta_id }}</td>
              <td>{{ plateNum(distribution.position) }}</td>
              <td>{{ distribution.py_num }}</td>
            </tr>
          </tbody>
        </table>

        <!-- <table class="table">
          <tr v-for="distribution in distributions">
            <td v-for="n in 96" v-if="distribution.position === n">{{ distribution.py_num }}</td>
          </tr>
        </table> -->
        <pagination :paginationData="pagination" :currentPage="currentPage" :maxItems="pagination.total"></pagination>
      </div>
    </div>
  </div>
</template>

<script>
  import * as plate from '../../../../utils/plate'
  import { mapState, mapActions } from 'vuex'
  export default {
    computed: {
      ...mapState({
        distributions: state => state.Exps.distributions,
        distributions_pagination: state => state.Exps.distributions_pagination,
        fetching: state => state.fetching
      }),
      pagination () {
        return this.distributions_pagination
      },
      currentPage () {
        return parseInt(this.$route.query.page, 10) || 1
      }
    },
    mounted () {
      this.$bus.$on('navigate', ({ page }) => this.navigate(page))
      this.fetch()
      console.log(plate.plate['1'])
    },
    beforeRouteLeave (to, from, next) {
      this.$bus.$off('navigate')
      next()
    },
    watch: {
      currentPage: 'fetch'
    },
    methods: {
      plateNum(num) {
        return plate.plate[num]
      },
      ...mapActions(['distributionsSetData', 'setFetching', 'setMessage']),
      fetch () {
        this.setFetching({ fetching: true })
        this.$http.get(`distributions?page=${this.currentPage}`).then(({ data }) => {
          console.log(data)
          this.distributionsSetData({
            distributions: data.data,
            distributions_pagination: data.meta.pagination
          })
          this.setFetching({ fetching: false })
        })
      },
      navigate (page) {
        this.$router.push({
          name: 'distributions.index',
          query: {
            page
          }
        })
      }
    }
  }
</script>
