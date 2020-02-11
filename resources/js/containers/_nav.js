export default [
  {
    _name: 'CSidebarNav',
    _children: [
      {
        _name: 'CSidebarNavItem',
        name: 'Dashboard',
        to: '/dashboard',
        icon: 'cil-speedometer',
      },
      {
        _name: 'CSidebarNavTitle',
        _children: ['Master Data']
      },
      {
        _name: 'CSidebarNavDropdown',
        name: 'Method',
        route: '/method',
        icon: 'cil-puzzle',
        items: [
          {
            name: 'Krepline',
            to: '/method/krepline',
            icon: 'cil-chart-line'
          },
          {
            name: 'MBTI',
            to: '/method/mbti',
            icon: 'cil-line-style'
          },
          {
            name: 'Matching',
            to: '/method/matching',
            icon: 'cil-audio-description'
          },
        ]
      },
      {
        _name: 'CSidebarNavDropdown',
        name: 'Partners',
        route: '/partners',
        icon: 'cil-address-book',
        items: [
          {
            name: 'Company',
            to: '/partners/company',
            icon: 'cil-industry'
          },
          {
            name: 'Personal',
            to: '/partners/personal',
            icon: 'cil-user'
          }
        ]
      },
      {
        _name: 'CSidebarNavTitle',
        _children: ['Psikotes']
      },
      {
        _name: 'CSidebarNavDropdown',
        name: 'Kepesertaan',
        route: '/kepesertaan',
        icon: 'cil-people',
        items: [
          {
            name: 'Daftar Peserta',
            to: '/kepesertaan/list',
            icon: 'cil-list-rich'
          },
          {
            name: 'Jadwal',
            to: '/kepesertaan/jadwal',
            icon: 'cil-calendar'
          }
        ]
      },
    ]
  }
]