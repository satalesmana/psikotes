<template>
    <CDropdown inNav class="c-header-nav-items" placement="bottom-end" add-menu-classes="pt-0">
        <template #toggler>
            <CHeaderNavLink>
                <CIcon name="cil-envelope-open"/>
                <CBadge color="danger" class="ml-auto" v-if="itemsCount > 0">{{ itemsCount }}</CBadge>
            </CHeaderNavLink>
        </template>
        <CDropdownHeader tag="div" class="text-left dropdown-menu-lg pt-0" color="light" >
            <strong>Account</strong>
        </CDropdownHeader>
        <CDropdownItem>
            <div class="message">
                <div class="py-3 mfe-3 float-left">
                    <div class="c-avatar">
                        <img class="c-avatar-img" src="assets/img/avatars/6.jpg">
                        <span class="c-avatar-status bg-warning"></span>
                    </div>
                </div>
                <div><small class="text-muted">John Doe</small><small class="text-muted float-right mt-1">5 minutes ago</small></div>
                <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>
            </div>
        </CDropdownItem>
        <CDropdownItem>
            <div class="message">
                <div class="py-3 mfe-3 float-left">
                    <div class="c-avatar">
                        <img class="c-avatar-img" src="assets/img/avatars/6.jpg">
                        <span class="c-avatar-status bg-warning"></span>
                    </div>
                </div>
                <div><small class="text-muted">John Doe</small><small class="text-muted float-right mt-1">5 minutes ago</small></div>
                <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>
            </div>
        </CDropdownItem>
    </CDropdown>
</template>


<script>
export default {
  name: 'TheMsgNotif',
  data () {
    return { 
      itemsCount: 2
    }
  }
}
</script>