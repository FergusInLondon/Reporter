<template>
  <el-container>
    <navbar />
    <el-container>
      <sidebar />
      <el-main>
        <child />
      </el-main>
    </el-container>
    <el-footer></el-footer>
  </el-container>
</template>

<script>
import Navbar from '~/components/Navbar'
import Sidebar from '~/components/Sidebar'

export default {
  name: 'MainLayout',

  components: {
    Navbar, Sidebar
  }
}
</script>
