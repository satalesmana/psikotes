<template>
    <div>
        <CCardBody>
            <CRow class="form-group">
                <CCol sm="3">Maping Name</CCol>
                <CCol sm="9">
                    <el-input placeholder="Maping Name" v-model="maping.label"/>
                    <small  v-if="erorrmsg.label">{{erorrmsg.label}}</small>
                </CCol>
            </CRow>

            <div class="form-group form-row">
                <label class="col-form-label col-sm-3">Dimensi A</label>
                <div class="col-sm-9">
                    <el-select  
                        v-model="maping.dimensiAid" 
                        placeholder="">
                        <el-option v-for="item in cmbdimensi"
                            :key="item.id"
                            :label="item.description"
                            :value="item.id">
                        </el-option>
                    </el-select>
                </div>
            </div>

            <div class="form-group form-row">
                <label class="col-form-label col-sm-3">Dimensi B</label>
                <div class="col-sm-9">
                    <el-select  v-model="maping.dimensiBid" placeholder="">
                        <el-option v-for="item in cmbdimensi"
                            :key="item.id"
                            :label="item.description"
                            :value="item.id">
                        </el-option>
                    </el-select>
                    <small  v-if="erorrmsg.dimensiBid">{{erorrmsg.dimensiBid}}</small>
                </div>
            </div>

        </CCardBody>
        <CCardFooter>
            <CButton type="submit" size="sm" @click="onSave()" color="primary"><CIcon name="cil-user"/> Save </CButton>
            <CButton type="button" size="sm" @click="onCancel()" color="danger"><CIcon name="cil-ban"/> Cancel </CButton>
        </CCardFooter>
    </div>
</template>

<script>
import Axios from 'axios'

export default {
    computed:{
        cmbdimensi() {
            return this.$store.state.cmbDimensi;
        }
    },
    data(){
        return{
            erorrmsg:[],
            optionsB:[],
            maping:{
                dimensiAid:"",
                dimensiBid:"",
                label:""
            }
        }
    },
    methods:{
        onCancel(){
            this.onClerForm()
            this.$parent.onClikItemPage('DimensiMaping');
        },
        onSave(){
            Axios.post(APP_PATH+"/api/mapingdimensi",this.maping)
                .then(res=>{
                    this.onClerForm();
                    this.$message({type: 'success', message: res.data.msg }); 
                    this.$parent.onClikItemPage('DimensiMaping') 
                }).catch(error => {
                    if (error.response.status == 422){
                        this.erorrmsg = error.response.data.errors
                        this.$message({type: 'warning', message: error.response.data.message }); 
                    }else
                        console.log(error.response)
           });
        },
        onClerForm(){
            this.maping.dimensiAid=""
            this.maping.dimensiBid=""
            this.maping.label=""
        }
        // onChangeDimensiA(){
        //     let filterCmb=[]
        //     for(let i=0; i<= this.cmbdimensi.length; i++){
        //         var row = this.cmbdimensi[i]
        //         if(this.maping.dimensiAid != row.id){
        //             filterCmb.push(this.cmbdimensi[i])
        //             console.log("combine", row.id)
        //         }
        //     }
        //     console.log("filter",filterCmb)
        // }
    },
    mounted: function() {
        this.$store.commit("getCmbDimensi");
        //this.$store.commit("getCmbDimensiMaping");
    }
}
</script>