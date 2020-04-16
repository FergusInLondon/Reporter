function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', redirect: { name: 'login' }},

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/home', name: 'home', component: page('home.vue') },

  { path: '/docs',
    component: page('docs/index.vue'),
    children: [
      { path: '', redirect: { name: 'docs.listing' } },
      { path: 'all', name: 'docs.listing', component: page('docs/listing.vue') },
      { path: 'edit/:id', name: 'docs.edit', component: page('docs/edit.vue') },
      { path: 'new', name: 'docs.create', component: page('docs/create.vue') }
    ] },

  { path: '/clients',
    component: page('clients/index.vue'),
    children: [
      { path: '', redirect: { name: 'clients.listing' } },
      { path: 'all', name: 'clients.listing', component: page('clients/listing.vue') },
      { path: 'edit/:id', name: 'clients.edit', component: page('clients/edit.vue') },
      { path: 'new', name: 'clients.create', component: page('clients/create.vue') }
    ] },

  { path: '/payments',
    component: page('payments/index.vue'),
    children: [
      { path: '', redirect: { name: 'payments.listing' } },
      { path: 'all', name: 'payments.listing', component: page('payments/listing.vue') },
    ] },

  { path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') }
    ] },

    { path: '*', component: page('errors/404.vue') }
]
