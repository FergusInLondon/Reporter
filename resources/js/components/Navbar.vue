<template>
  <el-header id="nav-header">
    <el-menu class="el-menu-logout" mode="horizontal" background-color="#545c64"
  text-color="#fff"
  active-text-color="#ffd04b"  :router="true">
      <template v-if="user">
        <el-menu-item id="toggleSidenav" @click="toggleSideNav">
          <i id="sidebar-toggle" :class="[ sidebarCollapsed ? 'el-icon-open' : 'el-icon-turn-off']"></i>
        </el-menu-item>
        <el-menu-item @click="logout">Logout</el-menu-item>
      </template>
      <template v-else>
        <el-menu-item index="1" :route="{ name: 'register' }">Register</el-menu-item>
        <el-menu-item index="2" :route="{ name: 'login' }">Login</el-menu-item>
      </template>
    </el-menu>
  </el-header>
</template>

<script>
  import { mapGetters } from 'vuex'

  export default {
    computed: mapGetters({
      user: 'app/user',
      sidebarCollapsed: 'app/sidebarCollapsed'
    }),
    methods: {
      async logout() {
        await this.$store.dispatch('app/logout');
        this.$router.push({ name: 'login' });
      },
      toggleSideNav() {
        this.$store.dispatch('app/showSidebar', this.sidebarCollapsed)
      }
    }
  }
</script>

<style>
#toggleSidenav {
  float:left !important;
}
#toggleSidenav > i {
  color: white;
  font-size: 2em;
}
.el-menu-logout li {
  float: right !important;
}
</style>
