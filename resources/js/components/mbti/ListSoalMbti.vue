<template>
    <div>
        <div class="toolbar alert alert-info" style="margin-bottom:0px !important; border-radius:0px !important;">
            <el-button  size="small" @click="onEdit()" round>Edit</el-button>
            <el-button  size="small" @click="onDelete()" round>Delete</el-button>
        </div>
        <div class="c-messages">
            <kendo-datasource ref="datasource1"
                :schema-model-id="'id'"
                :schema-model-fields="schemaModelFields"
                :batch='true'
                :transport-read-url="urlGetData"
                :transport-parameter-map="parameterMap"
                :transport-read-data-type="'jsonp'"
                :server-filtering="true"
                :schema-data="'result'"
                :page-size='20'/>

            <kendo-grid ref="gridSoal"
                :height="400"
                :data-source-ref="'datasource1'"
                :sortable="true"
                :resizable="true"
                :filterable-mode="'row'"
                :pageable-refresh="true"
                :pageable-page-sizes="true"
                :filterable-operators-string-contains="'Containt'"
                :filterable-operators-string-eq="'Is equal to'"
                :filterable-operators-string-neq="'Not equal to'"
                :pageable-button-count="20">
           
                <kendo-grid-column :filterable="{ cell: {enabled: false}}" :title="' '"     :template="CkbItemTemplate" :width="30" />
                <kendo-grid-column :filterable="{ cell: {enabled: false}}" :field="'dimensiACode'" :title="'DIMENSI A'" :width="80"/>
                <kendo-grid-column :filterable-cell-operator="'eq'" :field="'pernyataanA'" :title="'PERNYATAAN A'" :width="200"/>
                <kendo-grid-column :filterable="{ cell: {enabled: false}}" :field="'dimensiBCode'" :title="'DIMENSI B'" :width="80"/>
                <kendo-grid-column :filterable-cell-operator="'eq'" :field="'pernyataanB'" :title="'PERNYATAAN B'" :width="200"/>
            </kendo-grid>
        </div>
    </div>
</template>
<script>
import Axios from 'axios'
export default {
    data(){
        return{
            CkbItemTemplate: `<input type="checkbox" value="#:id#" class="itemSelectd"/>`,
            urlGetData:APP_PATH +'/api/soalmbti',
            schemaModelFields: {
                dimensiA: { editable: false },
                dimensiACode: { editable: false },
                pernyataanA: { editable: false },
                dimensiB: { editable: false },
                dimensiBCode: { editable: false },
                pernyataanB: { editable: false }
            },
            erorrmsg:[],
            itemChecked:""
        }
    },
    methods:{
        setSelectedItem(){
            this.itemChecked = $(".itemSelectd:checkbox:checked")
            .map(function() {
                return this.value;
            }).get();
        },
        onEdit(){
            this.setSelectedItem()
            var spl_val = this.itemChecked.toString().split(",")

            if(this.itemChecked=="")
                this.$message({ type: 'warning', message: 'No data selected' })
            else if(spl_val.length > 1)
                this.$message({ type: 'warning', message: 'Please Select One data only to edit' })
            else{
                Axios.get(APP_PATH +'/api/soalmbti/'+spl_val[0]+'/edit')
                .then(res => {
                    this.$emit('soalEdit', res.data.data)
                    this.$parent.onClikItemPage('editData')
                })
                
            }
        },
        onDelete(){
            this.setSelectedItem()
            var spl_val = this.itemChecked.toString().split(",")

            if(this.itemChecked=="")
                this.$message({ type: 'warning', message: 'No data selected' });
            else{
                Axios.delete(APP_PATH +'/api/soalmbti/id',{params:{delid:spl_val}})
                .then(res => {
                    let grid = this.$refs.gridSoal.kendoWidget();
                    grid.dataSource.read();
                    
                    this.$message({type: 'success', message: res.data.msg });  
                }).catch(error => {
                    if (error.response.status == 422){
                        this.erorrmsg = error.response.data.errors
                        this.$message({type: 'warning', message: error.response.data.message }); 
                    }else
                        console.log(error.response)
                });
            }
        },
        parameterMap: function(options, operation) {
            if (operation !== 'read' && options.models) {
                return { models: kendo.stringify(options.models) };

            }else if (operation === 'read' && typeof options.filter !== 'undefined')
                return { filter: options.filter.filters};
        },
    }
}
</script>