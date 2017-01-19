<template>
  <div>
    <slot name="header"></slot>
    <form>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group" style="padding: 6px 40px;">
                <label for="file" class="control-label"></label>
                <input type="file" @change="fileLoad">
              </div>
            </div>
            <div class="col-md-6">
              <ul class="list-group" style="margin-top: 20px;">
                <li v-for="(sheetData, sheetName) in sheets" class="list-group-item" @click="selectedSheet(sheetName)" style="cursor:pointer;">
                  {{ sheetName }}<i class="fa fa-angle-down pull-right"></i></li>
              </ul>
            </div>
          </div>

        </div>
        <div class="panel-footer">
          <a href="#" @click="previewTable" class="btn btn-info"><i class="fa fa-eye">&nbsp;&nbsp;</i>预览表格</a>
          <a href="#" @click="sendTable" v-show="selectedRow.length > 0" class="btn btn-primary"><i class="fa fa-save">&nbsp;&nbsp;</i>保存到数据库</a>
        </div>
      </div>

      <div v-show="isProcessing">
        <span class="fa fa-spin fa-spinner fa-2x"></span>
      </div>

      <div class="panel panel-primary" v-show="showPreview">
        <div class="panel-heading">
          <h4>请逐行选择和添加你要上传的数据<i class="fa fa-level-down"></i></h4>
        </div>
        <div class="panel-body">
          <span v-show="!sheetData.data">
            <p class="text-danger">该表格里面没有数据</p>
          </span>
          <table class="table">
            <tr v-for="(row, index) in sheetData.data" class="text-center">
              <td>
                <div class="checkbox" v-show="index">
                  <input type="checkbox" :id="checkboxInput(index)" v-model="selectedRow" :value="index">
                  <label :for="checkboxInput(index)"></label>
                </div>
              </td>
              <td v-for="(col, index) in row" v-html="col"></td>
            </tr>
          </table>
        </div>
      </div>
    </form>
    <slot name="modal"></slot>
  </div>
</template>
<script>
  import {
    readFile
  } from '../../services/reader'
  import $ from 'jquery'
  export default {
    data () {
      return {
        excelFile: '',
        showPreview: false,
        isProcessing: false,
        sheets: [],
        json_string: '',
        sheetData: {},
        selectedRow: [],
        data: []
      }
    },
    updated () {
      console.log(this.selectedRow)
    },
    methods: {
      fileLoad (e) {
        this.excelFile = e.target.files[0]
      },
      previewTable () {
        this.isProcessing = true
        this.sheets = []
        this.showJson = false
        this.showPreview = true
        if (this.excelFile) {
          readFile(this.excelFile, this.showPreview, false).then((data) => {
            this.sheets = data.sheets
            this.isProcessing = false
          })
        }
        console.log(this.sheets)
      },
      checkboxInput (index) {
        return 'checkbox' + index
      },
      selectedSheet (sheetName) {
        this.sheetData = this.sheets[sheetName]
      },
      sendTable () {
        this.resetData()
        this.selectedRow.forEach(index => this.data.push(this.sheetData.data[index]))
        this.$bus.$emit('sendTableData', this.data)
        console.log(this.data)
      },
      resetData () {
        this.data = []
      }
    }
  }
</script>
<style>
  .table-list {
    padding:3px 6px;
    background-color: #000;
    color: #fff;
  }
  .list-header {
    margin-top: 24px;
  }
</style>
