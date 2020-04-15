import store from '~/store'

export default async (to, from, next) => {
  if (!store.getters['app/check'] && store.getters['app/token']) {
    try {
      await store.dispatch('app/fetchUser')
    } catch (e) { }
  }

  next()
}
