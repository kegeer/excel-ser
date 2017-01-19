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
              <th rowspan="2">文库名称</th>
              <th rowspan="2">建库方案</th>
              <th colspan="4">操作人</th>
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
      this.$http.post('libraries', data).then((response) => {
        $('#saveModal').modal('hide')
        this.$router.push({
          name: 'libraries.index'
        })
        this.setMessage({
          type: 'success',
          message: '表格导入成功'
        })
      })
    }
  }
}
</script>

<style lang="css">
</style>
