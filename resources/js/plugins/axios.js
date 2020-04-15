import axios from 'axios'
import store from '~/store'
import router from '~/router'
import Swal from 'sweetalert2'

// Request interceptor
axios.interceptors.request.use(request => {
  const token = store.getters['app/token']
  if (token) {
    request.headers.common['Authorization'] = `Bearer ${token}`
  }

  // request.headers['X-Socket-Id'] = Echo.socketId()

  return request
})

// Response interceptor
axios.interceptors.response.use(response => response, error => {
  const { status } = error.response

  if (status >= 500) {
    Swal.fire({
      type: 'error',
      title: "Unable to make request",
      text: "It looks like something has gone wrong our side..",
      reverseButtons: true,
      confirmButtonText: "ok",
      cancelButtonText: "cancel"
    })
  }

  if (status === 401 && store.getters['app/check']) {
    Swal.fire({
      type: 'warning',
      title: "Your session has expired.",
      text: "You need to re-authenticate",
      reverseButtons: true,
      confirmButtonText: "ok",
      cancelButtonText: "cancel"
    }).then(() => {
      store.commit('app/LOGOUT')

      router.push({ name: 'login' })
    })
  }

  return Promise.reject(error)
})
