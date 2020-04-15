import store from '~/store'

export default (to, from, next) => {
  if (store.getters['app/user'].role !== 'admin') {
    next({ name: 'home' })
  } else {
    next()
  }
}
