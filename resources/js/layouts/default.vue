<template>
  <el-container id="top-container">
    <navbar id="navbar" />
    <el-container id="inner-container">
      <sidebar id="sidebar" />
      <el-main v-loading="loading">
        <child />
      </el-main>
    </el-container>
    <el-footer id="footer"></el-footer>
  </el-container>
</template>

<script>
import { mapGetters } from 'vuex'
import Navbar from '~/components/Navbar'
import Sidebar from '~/components/Sidebar'

export default {
  name: 'MainLayout',
  components: {
    Navbar, Sidebar
  },
  computed: mapGetters({
    loading: 'app/isLoading'
  })
}
</script>

<style>
#top-container {
  min-height: 100%;
}
#inner-container {
  flex: 1;
}
#navbar {
  padding: 0;
  height:60px;
  flex: 0;
}
#sidebar {
/*  max-width: 300px; */
}
#footer {
  flex: 0;
}
</style>