<template>
    <CRow>
      <CCol lg="12">
        <transition name="fade">
          <CCard v-if="show">
            <CCardHeader>
              <CIcon name="cil-pencil"/> Form Elements
              <div class="card-header-actions">
                <CLink href="#" class="card-header-action btn-setting">
                  <CIcon name="cil-settings"/>
                </CLink>
                <CLink
                  class="card-header-action btn-minimize"
                  @click="formCollapsed=!formCollapsed"
                >
                  <CIcon :name="`cil-chevron-${formCollapsed ? 'bottom' : 'top'}`"/>
                </CLink>
                <CLink href="#" class="card-header-action btn-close" v-on:click="show = !show">
                  <CIcon name="cil-x-circle"/>
                </CLink>
              </div>
            </CCardHeader>
            <CCollapse :show="formCollapsed">
              <CCardBody>
                <CInput
                  label="Prepended text"
                  description="Here's some help text"
                  type="email"
                  autocomplete="email"
                  prepend="@"
                />
                <CInput
                  label="Appended text"
                  append=".00"
                  description="Here's some help text"
                />
                <CInput
                  label="Appended and prepended text"
                  append=".00"
                  description="Here's some help text"
                  prepend="$"
                />
                <CInput
                  label="Append with button"
                  description="Here's some help text"
                >
                  <template #append>
                    <CButton color="primary">Go!</CButton>
                  </template>
                </CInput>
                <CInput label="Two-buttons append">
                  <template #append>
                    <CButton color="primary">Search</CButton>
                    <CButton color="danger">Options</CButton>
                  </template>
                </CInput>
                <div class="form-actions">
                  <CButton type="submit" color="primary">Save changes</CButton>
                  <CButton color="secondary">Cancel</CButton>
                </div>
              </CCardBody>
            </CCollapse>
          </CCard>
        </transition>
      </CCol>
    </CRow>
</template>
<script>
export default {
    data(){
        return {
            show: true,
            formCollapsed: true,
        }
    }
}
</script>