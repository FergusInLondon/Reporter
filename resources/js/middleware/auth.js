import store from '~/store'

export default async (to, from, next) => {
  if (!store.getters['app/check']) {
    next({ name: 'login' })
  } else {
    next()
  }
}
