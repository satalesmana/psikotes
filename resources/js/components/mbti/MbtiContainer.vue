<template>
    <div class="c-fade-in">
      <div class="c-email-app  mb-4">
        <div class="c-body">
          <div class="c-sidebar c-sidebar-light c-sidebar-show">
            <ul class="c-sidebar-nav">
              <li class="c-sidebar-nav-item" style="padding:10px !important">
                <CCol col="6" sm="4" md="2" xl class="mb-3 mb-xl-0">
                  <CButton @click="onClikItemPage('addNew')" block color="success" shape="pill">Add New</CButton>
                </CCol>
              </li>
              <li class="c-sidebar-nav-item">
                <a href="javascript:void(0)" @click="onClikItemPage('ListSoal')" class="c-sidebar-nav-link">
                  <CIcon name="cil-envelope-open"/> &nbsp; Soal
                  <CBadge color="danger" class="ml-auto" v-if="itemsCount > 0">{{ itemsCount }}</CBadge>
                </a>
              </li>
              <li class="c-sidebar-nav-item">
                <a href="javascript:void(0)" @click="onClikItemPage('DimensiList')" class="c-sidebar-nav-link">
                  <CIcon name="cil-envelope-open"/> &nbsp; Dimensi
                  <CBadge color="danger" class="ml-auto" v-if="itemsCount > 0">{{ itemsCount }}</CBadge>
                </a>
              </li>
              <li class="c-sidebar-nav-item">
                <a href="javascript:void(0)" @click="onClikItemPage('DimensiMaping')" class="c-sidebar-nav-link">
                  <CIcon name="cil-envelope-open"/> &nbsp; Maping Dimensi
                  <CBadge color="danger" class="ml-auto" v-if="itemsCount > 0">{{ itemsCount }}</CBadge>
                </a>
              </li>
            </ul>
          </div>
          <main class="c-main" style="padding-top:0px !important">
            <component 
              :is="BodyComponent" 
              :data="componentData"
              v-on:dimensiEdit="onDimensiEdit"
              v-on:soalEdit="onSoalEdit"/>
          </main>
        </div>
      </div>
    </div>
</template>

<script>
import FormSoalMbti from './FormSoalMbti'
import FormDimensiMbti from './FormDimensiMbti'
import ListSoalMbti from './ListSoalMbti'
import ListDimensi from './ListDimensiMbti'
import DimensiMaping from './MapingDimensi'
import DimensiMapingForm from './FormMapingDimensi'

export default {
    components:{
        FormSoalMbti,
        FormDimensiMbti,
        ListSoalMbti,
        ListDimensi,
        DimensiMaping,
        DimensiMapingForm
    },
    data(){
      return {
        BodyComponent:ListSoalMbti,
        itemsCount:0,
        selectedMode:'ListSoal',
        componentData:{},
        dimensiData:{
          id:"",
          code:"",
          description:""
        },
        soal:{
            id:'',
            groupdimensi:'',
            dimensiA:"",
            dimensiACode:"",
            dimensiAdesc:"",
            pernyataanA:"",
            dimensiB:"",
            dimensiBCode:"",
            dimensiBdesc:"",
            pernyataanB:"",
        },
      }
    },
    methods:{
      onDimensiEdit(data){
        this.dimensiData.id= data.id
        this.dimensiData.code= data.code
        this.dimensiData.description= data.description

        this.componentData = this.dimensiData
      },
      onSoalEdit(data){
            this.soal.id= data[0].id
            this.soal.groupdimensi= data[0].groupdimensi
            this.soal.dimensiA = data[0].dimensiA
            this.soal.dimensiACode= data[0].dimensiACode
            this.soal.dimensiAdesc = data[0].dimensiAdesc
            this.soal.pernyataanA=data[0].pernyataanA
            this.soal.dimensiB=data[0].dimensiB	
            this.soal.dimensiBCode=data[0].dimensiBCode	
            this.soal.dimensiBdesc= data[0].dimensiBdesc
            this.soal.pernyataanB=data[0].pernyataanB

          this.componentData = this.soal
      },
      onClikItemPage(mode){
        switch (mode) {
          case 'addNew':
            this.BodyComponent=FormSoalMbti
            break;

          case 'editData':
            this.BodyComponent=FormSoalMbti
            break;

          case 'ListSoal':
            this.BodyComponent=ListSoalMbti
            break;

          case 'DimensiForm':
            this.BodyComponent=FormDimensiMbti
            break;

          case 'DimensiList':
            this.BodyComponent=ListDimensi
            break;

          case 'DimensiMaping':
            this.BodyComponent=DimensiMaping
            break;

          case 'DimensiMapingForm':
            this.BodyComponent=DimensiMapingForm
            break;

          default:
            this.BodyComponent = ListSoalMbti
            break;
        }
        this.selectedMode=mode
      },
      onClickDimensiBtn(key){
        switch (key) {
          case 'addNew':
              this.onClikItemPage('DimensiForm')
            break;

          case 'edit':
              this.onClikItemPage('DimensiForm')
            break;

          default:
            this.onClikItemPage('DimensiList')
            break;
        }
      },
      onClickMapingBtn(key){
        switch (key) {
          case 'addNew':
            this.onClikItemPage('DimensiMapingForm')
            break;
        
          default:
              this.onClikItemPage('DimensiMapingForm')
            break;
        }
      }
      
    }
}
</script>