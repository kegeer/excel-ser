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
                    <label for="extract_operator">提取操作人</label>
                    <input type="text" class="form-control" id="extract_operator" v-model="form.extract_operator">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="extract_time">提取时间</label>
                    <input type="date" class="form-control" id="extract_time" v-model="form.extract_time">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="purify_operator">纯化操作人</label>
                    <input type="text" class="form-control" id="purify_operator" v-model="form.purify_operator">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="purify_time">纯化时间</label>
                    <input type="date" class="form-control" id="purify_time" v-model="form.purify_time">
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
        extract_operator: '',
        extract_time: '',
        purify_operator: '',
        purify_time: '',
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
      this.$http.post('extractions', this.form).then((response) => {
        $('#saveModal').modal('hide')
        this.$router.push({
          name: 'extractions.index'
        })
        this.setMessage({
          type: 'success',
          message: '表格导入成功'
        })
      })
    },
    resetForm () {
      this.form.extract_operator = ''
      this.form.extract_time = ''
      this.form.purify_operator = ''
      this.form.purify_time = ''
      this.form.data = []
    }
  }
}
</script>

<style lang="css">
</style>
