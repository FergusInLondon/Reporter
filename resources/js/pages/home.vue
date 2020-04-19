<template>
  <span>
    You're now logged in; this space will be an area for statistics and metrics.
  </span>
</template>

<script>
export default {
  middleware: 'auth',

  created() {
    this.$store.dispatch('app/updateTitle', 'Welcome')
  },

  metaInfo () {
    return { title: "Home" }
  }
}
</script>
