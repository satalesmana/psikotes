<template>
    <div>
        <CCardBody>
            <div class="form-group form-row">
                <label class="col-form-label col-sm-3">Dimensi Soal</label>
                <div class="col-sm-9">
                    <el-select @change="onChangeDimensi()" value-key="id" v-model="soal.groupdimensi" placeholder="">
                        <el-option v-for="item in cmbdimensiMap"
                            :key="item.id"
                            :label="item.label"
                            :value="item.id">
                        </el-option>
                    </el-select>
                </div>
            </div>

            <CRow class="form-group">
                <CCol sm="3">Dimensi A</CCol>
                <CCol sm="9" >
                    <div class="row">
                        <div class="col-sm-3">
                            <el-input placeholder="Code" v-model="soal.dimensiACode" readonly/>
                        </div>
                        <div class="col-sm-9" >
                            <el-input placeholder="Description" v-model="soal.dimensiAdesc" readonly/>
                        </div>
                    </div>
                    <small v-if="erorrmsg.code">{{erorrmsg.dimensiACode}}</small>
                </CCol>
            </CRow>

            <CRow class="form-group">
                <CCol sm="3">Pernyataan A</CCol>
                <CCol sm="9">
                    <CTextarea placeholder="Pernyataan A" v-model="soal.pernyataanA"/>
                    <small  v-if="erorrmsg.pernyataanA">{{erorrmsg.pernyataanA}}</small>
                </CCol>
            </CRow>
            
            
            <CRow class="form-group">
                <CCol sm="3">Dimensi B</CCol>
                <CCol sm="9" >
                    <div class="row">
                        <div class="col-sm-3">
                            <el-input placeholder="Code" v-model="soal.dimensiBCode" readonly/>
                        </div>
                        <div class="col-sm-9" readonly>
                            <el-input placeholder="Description" v-model="soal.dimensiBdesc" readonly/>
                        </div>
                    </div>
                    <small v-if="erorrmsg.code">{{erorrmsg.dimensiBCode}}</small>
                </CCol>
            </CRow>

            <CRow class="form-group">
                <CCol sm="3">Pernyataan B</CCol>
                <CCol sm="9">
                    <CTextarea placeholder="Pernyataan B" v-model="soal.pernyataanB"/>
                    <small  v-if="erorrmsg.pernyataanB">{{erorrmsg.pernyataanB}}</small>
                </CCol>
            </CRow>

        </CCardBody>
        <CCardFooter>
            <CButton type="submit" v-if="soal.id !=''" @click="onUpdate()" size="sm" color="primary"><CIcon name="cil-user"/> Update Data</CButton>
            
            <CButton type="submit" v-if="soal.id ==''" @click="onSave()" size="sm" color="primary"><CIcon name="cil-user"/> Save</CButton>
            <CButton type="button" @click="onCancel()" size="sm" color="danger"><CIcon name="cil-ban"/> Cancel</CButton>
        </CCardFooter>
        
    </div>
</template>
<script>
import Axios from 'axios';
export default {
    props:['data'],
    computed:{
        cmbdimensiMap() {
            return this.$store.state.cmbDimensiMap;
        },
        soal() {
            return this.data;
        },
    },
    data(){
        return{
            erorrmsg:[],
        }
    },
    methods:{
        onUpdate(){
            Axios.put(APP_PATH+"/api/soalmbti/"+this.soal.id,this.soal)
                .then(res=>{
                    this.onClearForm();
                    this.$message({type: 'success', message: res.data.msg }); 
                    this.$parent.onClikItemPage('ListSoal') 
                }).catch(error => {
                    if (error.response.status == 422){
                        this.erorrmsg = error.response.data.errors
                        this.$message({type: 'warning', message: error.response.data.message }); 
                    }else
                        console.log(error.response)
           });
        },
        onSave(){
            Axios.post(APP_PATH+'/api/soalmbti',this.soal)
            .then(res=>{
                this.onClearForm()
                this.$message({type: 'success', message: res.data.msg }); 
            }).catch(error => {
                if (error.response.status == 422){
                    this.erorrmsg = error.response.data.errors
                    this.$message({type: 'warning', message: error.response.data.message }) 
                }else
                    console.log(error.response)
            });
        },
        onCancel(){
            this.onClearForm()
            this.$parent.onClikItemPage('ListSoal')
        },
        onChangeDimensi(){
            if(this.soal.groupdimensi !=""){                                
                Axios.get(APP_PATH +'/api/mapingdimensi/'+this.soal.groupdimensi+'/edit')
                .then(res => {
                    this.soal.dimensiA      = res.data.data[0].dimensiAid
                    this.soal.dimensiACode  = res.data.data[0].dimensiACode
                    this.soal.dimensiAdesc  = res.data.data[0].dimensiA
                    this.soal.dimensiB      = res.data.data[0].dimensiBid
                    this.soal.dimensiBCode  = res.data.data[0].dimensiBCode
                    this.soal.dimensiBdesc  = res.data.data[0].dimensiB
                })
            }
        },
        onClearForm(){
            this.soal.dimensiA=""
            this.soal.dimensiACode=""
            this.soal.dimensiAdesc=""
            this.soal.dimensiB=""
            this.soal.dimensiBCode=""
            this.soal.dimensiBdesc=""
            this.soal.groupdimensi=""
            this.soal.pernyataanA=""
            this.soal.pernyataanB=""
        }
    },
    mounted: function() {
        this.$store.commit("getCmbDimensiMaping");
    }
}
</script>