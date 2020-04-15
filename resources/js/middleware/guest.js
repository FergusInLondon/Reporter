import store from '~/store'

export default (to, from, next) => {
  if (store.getters['app/check']) {
    next({ name: 'home' })
  } else {
    next()
  }
}
