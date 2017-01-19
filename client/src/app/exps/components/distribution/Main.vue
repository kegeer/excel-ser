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
        <table class="table table-bordered">
          <tr>
            <td  v-for="n in 12">A{{ n }}</td>
          </tr>
          <tr>
            <td  v-for="n in 12">B{{ n }}</td>
          </tr>
          <tr>
            <td  v-for="n in 12">C{{ n }}</td>
          </tr>
          <tr>
            <td  v-for="n in 12">D{{ n }}</td>
          </tr>
          <tr>
            <td  v-for="n in 12">E{{ n }}</td>
          </tr>
          <tr>
            <td  v-for="n in 12">F{{ n }}</td>
          </tr>
          <tr>
            <td  v-for="n in 12">G{{ n }}</td>
          </tr>
          <tr>
            <td  v-for="n in 12">H{{ n }}</td>
          </tr>
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
      this.fetch()
    },
    watch: {
      currentPage: 'fetch'
    },
    methods: {
      ...mapActions(['distributionsSetData', 'setFetching', 'setMessage']),
      fetch () {
        this.setFetching({ fetching: true })
        this.$http.get('distributions').then(({ data }) => {
          console.log(data)
          this.distributionsSetData({
            distributions: data.data,
            distributions_pagination: data.meta.pagination
          })
          this.setFetching({ fetching: false })
        })
      },
      navigate (obj) {
        this.$route.push({
          name: 'distributions.index',
          query: {
            page: obj.page
          }
        })
      }
    }
  }
</script>
