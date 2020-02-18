<template>
    <div>
        <CCardBody>
            <CRow class="form-group">
                <CCol sm="3">Dimensi Code</CCol>
                <CCol sm="5">
                    <el-input placeholder="Please input" v-model="dimensi.code"/>
                    <small v-if="erorrmsg.code">{{erorrmsg.code}}</small>
                </CCol>
            </CRow>

            <CRow class="form-group">
                <CCol sm="3">Dimensi Name</CCol>
                <CCol sm="9">
                    <el-input placeholder="Please input" v-model="dimensi.description"/>
                    <small  v-if="erorrmsg.code">{{erorrmsg.description}}</small>
                </CCol>
            </CRow>
        </CCardBody>
        <CCardFooter>
            <CButton v-if="dimensi.id !=''" type="submit" size="sm" @click="onUpdate()" color="primary"><CIcon name="cil-user"/> Update Data</CButton>
            
            <CButton v-if="dimensi.id ==''" type="submit" size="sm" @click="onSave()" color="primary"><CIcon name="cil-user"/> Add Data</CButton>
            <CButton type="button" size="sm" @click="onCancel()" color="danger"><CIcon name="cil-ban"/> Cancel</CButton>
        </CCardFooter>
    </div>
</template>
<script>
import Axios from 'axios';
export default {
    props:['data'],
    computed:{
        dimensi() {
            return this.data;
        },
    },
    data(){
       return{
           erorrmsg:[]
       }
    },
    methods:{
        onSave(){
            
           Axios.post(APP_PATH+"/api/dimensi",this.dimensi)
           .then(res => {
                this.onClerForm();
                this.$message({type: 'success', message: res.data.msg }); 
                
           }).catch(error => {
                if (error.response.status == 422){
                    this.erorrmsg = error.response.data.errors
                    this.$message({type: 'warning', message: error.response.data.message }); 
                }else
                    console.log(error.response)
           });
        },
        onUpdate(){
            Axios.put(APP_PATH+"/api/dimensi/"+this.dimensi.id,this.dimensi)
                .then(res=>{
                    this.onClerForm();
                    this.$message({type: 'success', message: res.data.msg }); 
                    this.$parent.onClikItemPage('DimensiList') 
                }).catch(error => {
                    if (error.response.status == 422){
                        this.erorrmsg = error.response.data.errors
                        this.$message({type: 'warning', message: error.response.data.message }); 
                    }else
                        console.log(error.response)
           });
        },
        onClerForm(){
            this.dimensi.code=""
            this.dimensi.description=""
        },
        onCancel(){
            this.onClerForm()
            this.$parent.onClikItemPage('DimensiList')
        }
    }
}
</script>