<template>
    <div>
        <div class="toolbar alert alert-info" style="margin-bottom:0px !important; border-radius:0px !important;">
            <el-button  size="small" @click="onAddNew()" round>Add New</el-button>
            <el-button  size="small" @click="onDelete()" round>Delete</el-button>
        </div>
        <div class="c-messages">
            <kendo-datasource ref="datasource1"
                :schema-model-id="'id'"
                :schema-model-fields="schemaModelFields"
                :batch='true'
                :transport-read-url="gridUrl"
                :transport-parameter-map="parameterMap"
                :transport-read-data-type="'jsonp'"
                :server-filtering="true"
                :schema-data="'result'"
                :page-size='20'/>

            <kendo-grid ref="gridMapingDimensi"
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
                <kendo-grid-column :filterable-cell-operator="'eq'" :field="'label'" :title="'Dimension name'" :width="200"/>
                <kendo-grid-column :filterable="{ cell: {enabled: false}}" :field="'dimensiA'"  :title="'Dimension A'" :width="150" />
                <kendo-grid-column :filterable="{ cell: {enabled: false}}" :field="'dimensiB'" :title="'Dimension B'" :width="150"/>
            </kendo-grid>

        </div>
    </div>
</template>
<script>
import Axios from 'axios'
export default {
    data(){
        return {
            gridUrl:APP_PATH +'/api/mapingdimensi',
            CkbItemTemplate: `<input type="checkbox" value="#:id#" class="itemSelectd"/>`,
            schemaModelFields: {
                id: { editable: false },
                dimensiAid: { editable: false, filterable:false },
                dimensiBid: { editable: false},
                label: { editable: false},
                created_at: { editable: false},
                updated_at: { editable: false},
            },
            itemChecked:""
        }
    },
    methods:{
        onAddNew(){
            this.$parent.onClickMapingBtn('addNew')
        },
        onDelete(){
            this.setSelectedItem()
            var spl_val = this.itemChecked.toString().split(",")
            if(this.itemChecked=="")
                    this.$message({ type: 'warning', message: 'No data selected' })
            else{
                Axios.delete(APP_PATH +'/api/mapingdimensi/id',{params:{delid:spl_val}})
                .then(res => {
                    let grid = this.$refs.gridMapingDimensi.kendoWidget();
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
        setSelectedItem(){
            this.itemChecked = $(".itemSelectd:checkbox:checked")
            .map(function() {
                return this.value;
            }).get();
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