<template>
    <div>
        <form>
            <div class="form-group">
                <label for="file" class="control-label"></label>
                <input type="file" @change="fileLoad">
            </div>
            <a href="#" @click="previewTable" class="btn btn-info">预览表格</a>
            <a href="#" @click="saveTable" v-show="selectedRow.length > 0" class="btn btn-primary">保存到数据库</a>

            <div v-show="isProcessing">
                <span>Processing.........</span>
            </div>

            <div v-show="showPreview">

                <ul class="list-group" style="margin-top: 20px;">
                    <li  v-for="(sheetData, sheetName) in sheets" class="list-group-item" v-html="sheetName" @click="selectedSheet(sheetName)" style="display:inline-block;cursor:pointer;">
                    </li>
                </ul>
                <span v-show="!sheetData.data">
          Empty table
        </span>
                <table class="table table-bordered">
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
        </form>


    </div>
</template>
<script>
    import { readFile } from '../services/excel'
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
                form: []
            }
        },
        updated () {
            // console.log(this.sheets)
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
            },
            checkboxInput (index) {
                return 'checkbox' + index
            },
            selectedSheet (sheetName) {
                this.sheetData = this.sheets[sheetName]
                console.log(this.sheetData)
            },
            toggleRow (index) {
                if (this.selectedRow[index]) {
                    this.selectedRow[index] === false
                }
            },
            saveTable () {
                console.log(this.sheetData)
                this.selectedRow.forEach(index => this.form.push(this.sheetData.data[index]))
                this.$http.post('api/experiments', this.form)
            }
        }
    }
</script>
<style>
    td {
        font-weight: 300;
        text-align: center;
        padding: 2px 6px;
        border:1px solid #ededed;
        word-break: keep-all;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
