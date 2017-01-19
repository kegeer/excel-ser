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
              <th>[A-H]01</th>
              <th>[A-H]02</th>
              <th>[A-H]03</th>
              <th>[A-H]04</th>
              <th>[A-H]05</th>
              <th>[A-H]06</th>
              <th>[A-H]07</th>
              <th>[A-H]08</th>
              <th>[A-H]09</th>
              <th>[A-H]10</th>
              <th>[A-H]11</th>
              <th>[A-H]12</th>
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
                    <label for="sample_source">样品来源</label>
                    <input type="text" class="form-control" id="sample_source" v-model="form.sample_source" placeholder="XX项目">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="sample_plate_num">样品板编号</label>
                    <input type="date" class="form-control" id="sample_plate_num" v-model="form.sample_plate_num">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="serial_num">流水号</label>
                    <input type="text" class="form-control" id="serial_num" v-model="form.serial_num">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="pipeline">扩增类型</label>
                    <input type="date" class="form-control" id="pipeline" v-model="form.pipeline">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="operate_time">操作日期</label>
                    <input type="date" class="form-control" id="operate_time" v-model="form.operate_time">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="lister">制表人</label>
                    <input type="text" class="form-control" id="lister" v-model="form.lister">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="sample_add_operator">加样操作人</label>
                    <input type="text" class="form-control" id="sample_add_operator" v-model="form.sample_add_operator">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="sample_add_auditor">加样核对人</label>
                    <input type="text" class="form-control" id="sample_add_auditor" v-model="form.sample_add_auditor">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="pcr_cycle">PCR循环数</label>
                    <input type="text" class="form-control" id="pcr_cycle" v-model="form.pcr_cycle">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="combine_transfer_operator">合并转管操作人</label>
                    <input type="text" class="form-control" id="combine_transfer_operator" v-model="form.combine_transfer_operator">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="combine_transfer_autitor">合并转管核对人</label>
                    <input type="text" class="form-control" id="combine_transfer_autitor" v-model="form.combine_transfer_autitor">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="note">备注</label>
                    <input type="text" class="form-control" id="note" v-model="form.note">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="elec_operator">电泳操作人</label>
                    <input type="text" class="form-control" id="elec_operator" v-model="form.elec_operator">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="elec_name">电泳图命名</label>
                    <input type="text" class="form-control" id="elec_name" v-model="form.elec_name">
                  </div>
                </div>
              </div>
            <form>
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
        sample_source: '',
        sample_plate_num: '',
        serial_num: '',
        pipeline: '',
        lister: '',
        sample_add_operator: '',
        sample_add_auditor: '',
        pcr_cycle: '',
        combine_transfer_operator: '',
        combine_transfer_autitor: '',
        note: '',
        elec_operator: '',
        elec_name: '',
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
      console.log(data)
      this.form.data = data
    },
    saveTable () {
      console.log(this.form)
      this.$http.post('distributions', this.form).then((response) => {
        $('#saveModal').modal('hide')
        this.$router.push({
          name: 'distributions.index'
        })
        this.setMessage({
          type: 'success',
          message: '表格导入成功'
        })
      })
    },
    resetForm () {
      this.form.sample_source= '',
      this.form.sample_plate_num= '',
      this.form.serial_num= '',
      this.form.pipeline= '',
      this.form.lister= '',
      this.form.sample_add_operator= '',
      this.form.sample_add_auditor= '',
      this.form.pcr_cycle= '',
      this.form.combine_transfer_operator= '',
      this.form.combine_transfer_autitor= '',
      this.form.note= '',
      this.form.elec_operator= '',
      this.form.elec_name= '',
      this.form.data = []
    }
  }
}
</script>

<style lang="css">
</style>
