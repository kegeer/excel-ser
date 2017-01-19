<template lang="html">
  <div>

    <table-reader>
      <div slot="header">
        <div>
          <h4>请务必按照如下格式提交:</h4>
          <p class="help-block">如果不符合以下要求,请更改后在提交,以免数据有误</p>
          <table class="table table-bordered" style="color: #000;">
            <thead>
            <tr>
              <th rowspan="2">文库编号</th>
              <th rowspan="2">Qubit</th>
              <th colspan="2">Index</th>
              <th rowspan="2">片断大小</th>
              <th rowspan="2">M浓度</th>
              <th rowspan="2">取样体积</th>
              <th rowspan="2">加水量</th>
              <th rowspan="2">数据量</th>
              <th rowspan="2">比例</th>
              <th rowspan="2">混样体积</th>
              <th rowspan="2">备注(意外情况)</th>
            </tr>
            <tr>
              <th>index1</th>
              <th>index2</th>
            </tr>
            </thead>
          </table>
        </div>
      </div>
    </table-reader>

    <div class="modal fade" id="saveModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">请填写信息提交</h4>
          </div>
          <div class="modal-body">
            <form>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="operator">操作人</label>
                    <input type="text" class="form-control" id="operator" v-model="form.operator">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="operate_time">操作时间</label>
                    <input type="date" class="form-control" id="operate_time" v-model="form.operate_time">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="run_regent">上机试剂</label>
                    <input type="text" class="form-control" id="run_regent" v-model="form.run_regent">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="sample_sheet">Sample Sheet</label>
                    <input type="date" class="form-control" id="sample_sheet" v-model="form.sample_sheet">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="phix_ratio">Phix比例</label>
                    <input type="text" class="form-control" id="phix_ratio" v-model="form.phix_ratio">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="run_c">上机浓度</label>
                    <input type="date" class="form-control" id="run_c" v-model="form.run_c">
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <button type="button" class="btn btn-primary" @click.prevent="saveTable">确认并提交</button>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import { mapActions } from 'vuex'
export default {
  data () {
    return {
      form: {
        operator: '',
        operate_time: '',
        run_regent: '',
        sample_sheet: '',
        phix_ratio: '',
        run_c: '',
        data: []
      }
    }
  },
  mounted () {
    this.$bus.$on('sendTableData', (data) => {
      this.dealData(data)
    })
  },
  beforeRouteLeave (to, from, next) {
    this.$bus.$off('sendTableData')
    next()
  },
  methods: {
    ...mapActions(['setMessage']),
    dealData (data) {
      $('#saveModal').modal('show')
      this.resetForm()
      this.form.data = data
    },
    saveTable () {
      console.log(this.form)
      this.$http.post('sequences', this.form).then((response) => {
        $('#saveModal').modal('hide')
        this.$router.push({
          name: 'sequences.index'
        })
        this.setMessage({
          type: 'success',
          message: '表格导入成功'
        })
      })
    },
    resetForm () {
      this.form.operator = ''
      this.form.operate_time = ''
      this.form.run_regent = ''
      this.form.sample_sheet = ''
      this.form.phix_ratio = ''
      this.form.run_c = ''
      this.form.data = []
    }
  }
}
</script>

<style lang="css">
</style>
