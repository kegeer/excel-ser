<template>
  <div>
    <router-view></router-view>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>样品列表</h4>
        <div class="btn btn-group pull-right">
          <a href="#" @click="addNew" class="btn btn-default">手动录入</a>
          <a href="#" @click="addBatch" class="btn btn-default">批量导入</a>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>原始编号</th>
            <th>谱元编号</th>
            <th>样品类型</th>
            <th>样品量</th>
            <th>送样人</th>
            <th>送样人/寄件人联系方式</th>
            <th>寄送时间</th>
            <th>收样状态</th>
            <th>样品状态</th>
            <th>快递单号</th>
            <th>收样时间</th>
            <th>收样人</th>
            <th>存储位置</th>
            <th>样品批次</th>
            <th>样品所属项目编号</th>
            <th>技术路线</th>
            <th>备注(意外情况)</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="sample in samples">
            <td>{{ sample.ori_num }}</td>
            <td>{{ sample.py_num }}</td>
            <td>{{ sample.sample_type }}</td>
            <td>{{ sample.sample_amount }}</td>
            <td>{{ sample.sender }}</td>
            <td>{{ sample.sender_contact }}</td>
            <td>{{ sample.send_time }}</td>
            <td>{{ sample.receive_status }}</td>
            <td>{{ sample.sample_status }}</td>
            <td>{{ sample.express_num }}</td>
            <td>{{ sample.receive_time }}</td>
            <td>{{ sample.recipient }}</td>
            <td>{{ sample.store_location }}</td>
            <td>{{ sample.sample_batch }}</td>
            <td>{{ sample.project }}</td>
            <td>{{ sample.pipeline }}</td>
            <td>{{ sample.note }}</td>
            <td>
              <a href="#" @click="edit(sample)" class="text-primary"><i class="fa fa-edit"></i></a>
              <a href="#" @click="askRemove(sample)" class="text-danger"><i class="fa fa-remove"></i></a>
            </td>
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
      // $route: 'addNew',
      // $route: 'edit'
    },
    methods: {
      ...mapActions(['samplesSetData', 'setFetching', 'setMessage']),
      addNew () {
        this.$router.push({
          name: 'sample.new',
          params: {
            page: this.currentPage
          }
        })
      },
      addBatch () {
        this.$router.push({
          name: 'sample.import',
          params: {
            page: this.currentPage
          }
        })
      },
      edit (sample) {
        let id = sample.id
        this.$router.push({
          name: 'sample.edit',
          params: {
            id
          }
        })
      },
      askRemove (sample) {
        swal({
          title: '你确定吗',
          text: '样品{$sample.py_num}将会被删除',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#dd6b55',
          confirmButtonText: '确定',
          closeOnConfirm: false
        }, () => this.remove(sample))
      },
      remove (sample) {
        this.$http.delete(`samples/${sample.id}`)
        .then(() => {
          swal('完成', '样品删除成功', 'success')
        })
      },
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
      navigate (page) {
        this.$router.push({
          name: 'samples.index',
          query: {
            page: page
          }
        })
      }
    }
  }
</script>
