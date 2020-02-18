<template>
    <CCol sm="6" md="12">
        <CCard accent-color="info">
          <CCardHeader><CIcon name="cil-check"/> MBTI Master Data</CCardHeader>
          <div style="padding:0px !importent">
              <MbtiContainer/>
          </div>
        </CCard>
      </CCol>
</template>

<script>
import MbtiContainer from '../components/mbti/MbtiContainer';
export default {
    components:{MbtiContainer}
}
</script>