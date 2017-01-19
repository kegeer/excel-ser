<template>
  <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>
          稀释数据表
          <router-link :to="{ name: 'libraries.import' }" tag="a" class="btn btn-primary pull-right">批量导入</router-link>
        </h4>
      </div>

      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
          <tr>
            <th rowspan="2">文库名称</th>
            <th rowspan="2">建库方案</th>
            <th rowspan="2">操作人</th>
            <th rowspan="2">时间</th>
            <th rowspan="2">所属项目</th>
            <th colspan="2">建库前</th>
            <th colspan="5">建库后</th>
            <th rowspan="2">备注(意外情况</th>
          </tr>
          <tr>
            <th>体积</th>
            <th>浓度</th>
            <th>Index</th>
            <th>体积</th>
            <th>浓度</th>
            <th>电泳结果</th>
            <th>文库片段大小</th>
          </tr>
          </thead>
          <tbody>
            <tr v-for="library in libraries">
              <td>{{ library.name }} </td>
              <td>{{ library.method }} </td>
              <td>{{ library.operator }} </td>
              <td>{{ library.operate_time }} </td>
              <td>{{ library.project }} </td>
              <td>{{ library.pre_v }} </td>
              <td>{{ library.pre_c }} </td>
              <td>{{ library.after_index }} </td>
              <td>{{ library.after_v }} </td>
              <td>{{ library.after_c }} </td>
              <td>{{ library.after_elec }} </td>
              <td>{{ library.after_size }} </td>
              <td>{{ library.note }} </td>
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
        libraries: state => state.Exps.libraries,
        libraries_pagination: state => state.Exps.libraries_pagination,
        fetching: state => state.fetching
      }),
      pagination () {
        return this.libraries_pagination
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
      ...mapActions(['librariesSetData', 'setFetching', 'setMessage']),
      fetch () {
        this.setFetching({ fetching: true })
        this.$http.get('libraries').then(({ data }) => {
          console.log(data)
          this.librariesSetData({
            libraries: data.data,
            libraries_pagination: data.meta.pagination
          })
          this.setFetching({ fetching: false })
        })
      },
      navigate (obj) {
        this.$route.push({
          name: 'libraries.index',
          query: {
            page: obj.page
          }
        })
      }
    }
  }
</script>
