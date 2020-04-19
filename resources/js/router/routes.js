function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

const appRoutes = [
  { path: '/', redirect: { name: 'login' }},

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/home', name: 'home', component: page('home.vue') },
];

const docRoutes = [
  { path: '/docs', name: 'docs.index', component: page('docs/index.vue') },
  { path: '/docs/edit/:id', name: 'docs.edit', component: page('docs/edit.vue') },
  { path: '/docs/new', name: 'docs.create', component: page('docs/create.vue') }
];

const clientRoutes = [
  { path: '/clients/', name: 'clients.index', component: page('clients/index.vue') },
  { path: '/clients/:id', name: 'clients.edit', component: page('clients/edit.vue') },
  { path: '/clients/new', name: 'clients.create', component: page('clients/create.vue') }
];

const paymentRoutes = [
  { path: '/payments', name: 'payments.index', component: page('payments/index.vue') },
  { path: '/payments/:id', name: 'payments.view', component: page('payments/view.vue') },
];

const settingRoutes = [
  { path: '/settings', redirect: { name: 'settings.account' }},
  { path: '/settings/account', name: 'settings.account', component: page('settings/account.vue') }
];

export default appRoutes.concat(
  docRoutes, clientRoutes, paymentRoutes, settingRoutes,
  [{ path: '*', component: page('errors/404.vue') }]
);
