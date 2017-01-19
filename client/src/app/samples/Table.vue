<template>
  <div>
    <table-reader>
      <div slot="header">
        <div>
          <h4>请务必按照如下格式提交:</h4>
          <p class="help-block">如果不符合以下要求,请更改后在提交,以免数据有误</p>
          <table class="table table-bordered" style="color: #000;">
            <thead>
            <tr>
              <th>序号</th>
              <th>原始编号</th>
              <th>谱元编号</th>
              <th>样品类型</th>
              <th>样品量</th>
              <th>送样人</th>
              <th>送样人/寄件人联系方式</th>
              <th>送样时间</th>
              <th>到样状态</th>
              <th>样品状态/特征(液,固)</th>
              <th>快递单号</th>
              <th>到样时间</th>
              <th>收样人</th>
              <th>存储位置</th>
              <th>样品批次</th>
              <th>样品所属项目编号</th>
              <th>技术路线</th>
              <th>备注(意外情况)</th>
            </tr>
            </thead>
          </table>
        </div>
      </div>
    </table-reader>
  </div>
</template>
<script>
  import { mapActions } from 'vuex'
  export default {
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
        this.$http.post('samples', data).then((response) => {
          this.$router.push({
            name: 'samples.index'
          })
          this.setMessage({
            type: 'success',
            message: '表格导入成功'
          })
        })
      },
      resetForm () {
        this.form.data = []
      }
    }
  }
</script>
