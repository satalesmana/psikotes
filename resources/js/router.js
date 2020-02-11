import Vue from 'vue'
import Router from 'vue-router'

import TheContainer from './containers/TheContainer'

import Dashboard from './pages/Dashboard'
import Krepline from './pages/Krepline'
import Mbti from './pages/Mbti'
import Matching from './pages/Matching'
import PartnerPersonal from './pages/PartnerPersonal'
import PartnerCompany from './pages/PartnerCompany'
import DaftarPeserta from './pages/DaftarPeserta'
import JadwalPsikotes from './pages/JadwalPsikotes' 

Vue.use(Router)

export default new Router({
  mode: 'hash',
  linkActiveClass: 'active',
  scrollBehavior: () => ({ y: 0 }),
  routes: configRoutes()
})


function configRoutes () {
  return [
    {
      path: '/',
      redirect: '/dashboard',
      name: 'Home',
      component: TheContainer,
      children: [
        {
          path: 'dashboard',
          name: 'Dashboard',
          component: Dashboard
        },{
          path: 'method',
          redirect: '/method/krepline',
          name: 'Method',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'krepline',
              name: 'Krepline',
              component: Krepline
            },
            {
              path: 'mbti',
              name: 'Mbti',
              component: Mbti
            },
            {
              path: 'matching',
              name: 'Matching',
              component: Matching
            }
          ]
        },
        {
          path: 'partners',
          redirect: '/partners/company',
          name: 'Partners',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'company',
              name: 'Company',
              component: PartnerCompany
            },
            {
              path: 'personal',
              name: 'Personal',
              component: PartnerPersonal
            },
          ]
        },
        {
          path: 'kepesertaan',
          redirect: '/kepesertaan/list',
          name: 'Kepesertaan',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'list',
              name: 'Daftar Peserta',
              component: DaftarPeserta
            },
            {
              path: 'jadwal',
              name: 'Jadwal',
              component: JadwalPsikotes 
            },
          ]
        }
      ]
    }
  ]
}