<template lang="html">
  <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>{{ formTitle }}</h4>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-form">
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
            <th v-show="!isEditing"></th>
          </tr>
          </thead>
          <tbody>
            <tr v-for="sample in form">
              <td>
                <input type="text" class="table-control" v-model="sample.ori_num">
              </td>
              <td>
                <input type="text" class="table-control" v-model="sample.py_num">
              </td>
              <td>
                <input type="text" class="table-control" v-model="sample.sample_type">
              </td>
              <td>
                <input type="text" class="table-control" v-model="sample.sample_amount">
              </td>
              <td>
                <input type="text" class="table-control" v-model="sample.sender">
              </td>
              <td>
                <input type="text" class="table-control" v-model="sample.sender_contact">
              </td>
              <td>
                <input type="text" class="table-control" v-model="sample.send_time">
              </td>
              <td>
                <input type="text" class="table-control" v-model="sample.receive_status">
              </td>
              <td>
                <input type="text" class="table-control" v-model="sample.sample_status">
              </td>
              <td>
                <input type="text" class="table-control" v-model="sample.express_num">
              </td>
              <td>
                <input type="text" class="table-control" v-model="sample.receive_time">
              </td>
              <td>
                <input type="text" class="table-control" v-model="sample.recipient">
              </td>
              <td>
                <input type="text" class="table-control" v-model="sample.store_location">
              </td>
              <td>
                <input type="text" class="table-control" v-model="sample.sample_batch">
              </td>
              <td>
                <input type="text" class="table-control" v-model="sample.project">
              </td>
              <td>
                <input type="text" class="table-control" v-model="sample.pipeline">
              </td>
              <td>
                <input type="text" class="table-control" v-model="sample.note">
              </td>
              <td class="table-remove" v-show="!isEditing">
                <span @click="removeLine(sample)" class="table-remove-btn"><i class="fa fa-remove"></i></span>
              </td>
            </tr>
          </tbody>
        </table>
        <a href="#" @click="addLine" class="btn btn-default btn-sm" v-show="!isEditing"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add line</a>
        <a href="#" @click="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Submit</a>
      </div>
    </div>


  </div>
</template>

<script>
import { mapActions } from 'vuex'
import { pick } from 'lodash'
export default {
  data () {
    return {
      form: [
        {
          id: 0,
          ori_num: '',
          py_num: '',
          sample_type: '',
          sample_amount: '',
          sender: '',
          sender_contact: '',
          send_time: '',
          receive_status: '',
          sample_status: '',
          express_num: '',
          receive_time: '',
          recipient: '',
          store_location: '',
          sample_batch: '',
          project: '',
          pipeline: '',
          note: ''
        }
      ]
    }
  },
  mounted () {
    this.fetch()
  },
  watch: {
    $route: 'fetch'
  },
  computed: {
    isEditing () {
      return this.$route.params.id
    },
    isValid () {
      return true
    },
    formTitle () {
      return this.$route.params.id ? '修改样品信息': '新增样品'
    }
  },
  methods: {
    ...mapActions(['setFetching', 'resetMessages', 'setMessage']),
    fetch () {
      let id = this.$route.params.id
      if (id !== undefined) {
        this.setFetching({ fetching: true })
        // this.reset()
        console.log(id)
        this.$http.get(`samples/${id}`)
        .then(({ data }) => {
          this.form[0] = {...data.data}
          console.log(this.form)
          this.setFetching({ fetching: false })
        })
      }
    },
    addLine () {
      this.form.push({
        id: 0,
        ori_num: '',
        py_num: '',
        sample_type: '',
        sample_amount: '',
        sender: '',
        sender_contact: '',
        send_time: '',
        receive_status: '',
        sample_status: '',
        express_num: '',
        receive_time: '',
        recipient: '',
        store_location: '',
        sample_batch: '',
        project: '',
        pipeline: '',
        note: ''
      })
    },
    removeLine (sample) {
      let index = this.form.indexOf(sample)
      this.form.splice(index, 1)
    },
    submit () {
      if (this.isValid) {
        this.setFetching({ fetching: true })
        if (this.isEditing) {
          this.update()
        } else {
          this.save()
        }
      }
    },
    update () {
      this.$http.put(`samples/${this.form[0].id}`, this.form[0])
        .then(() => {
          this.$bus.$emit('sample.updated')
          this.setFetching({ fetching: false })
          this.setMessage({ type:'success', message: '项目信息更新成功' })
          this.reset()
        })
    },
    save () {
      this.$http.post('samples/simple', this.form)
        .then(() => {
          this.$bus.$emit('sample.created')
          this.setFetching({ fetching: false })
          this.setMessage({ type: 'success', message: '新项目录入成功'})
          this.reset()
        })
    },
    reset () {
      this.form = [
        {
          id: 0,
          ori_num: '',
          py_num: '',
          sample_type: '',
          sample_amount: '',
          sender: '',
          sender_contact: '',
          send_time: '',
          receive_status: '',
          sample_status: '',
          express_num: '',
          receive_time: '',
          recipient: '',
          store_location: '',
          sample_batch: '',
          project: '',
          pipeline: '',
          note: ''
        }
      ]
    }
  }
}
</script>

<style lang="css">
</style>
