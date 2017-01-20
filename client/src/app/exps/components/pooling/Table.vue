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
                    <label for="sample_amount">样本数</label>
                    <input type="text" class="form-control" id="sample_amount" v-model="form.sample_amount">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="theoretic_c">理论浓度</label>
                    <input type="text" class="form-control" id="theoretic_c" v-model="form.theoretic_c">
                  </div>
                </div>
              </div>
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
                    <label for="actual_c">实测浓度</label>
                    <input type="text" class="form-control" id="actual_c" v-model="form.actual_c">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="sample_v">取样体积</label>
                    <input type="text" class="form-control" id="sample_v" v-model="form.sample_v">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="mb_v">磁珠体积</label>
                    <input type="text" class="form-control" id="mb_v" v-model="form.mb_v">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="after_c_c">浓缩后浓度</label>
                    <input type="text" class="form-control" id="after_c_c" v-model="form.after_c_c">
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
        sample_amount: '',
        theoretic_c: '',
        operator: '',
        operate_time: '',
        actual_c: '',
        sample_v: '',
        mb_v: '',
        after_c_c: '',
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
      this.$http.post('poolings', this.form).then((response) => {
        $('#saveModal').modal('hide')
        this.$router.push({
          name: 'poolings.index'
        })
        this.setMessage({
          type: 'success',
          message: '表格导入成功'
        })
      })
    },
    resetForm () {
      this.form.sample_amount = ''
      this.form.theoretic_c = ''
      this.form.operator = ''
      this.form.operate_time = ''
      this.form.actual_c = ''
      this.form.sample_v = ''
      this.form.mb_v = ''
      this.form.after_c_c = ''
      this.form.data = []
    }
  }
}
</script>

<style lang="css">
</style>
