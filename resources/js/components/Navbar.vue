<template>
  <el-header id="nav-header">
    <el-menu class="el-menu-logout" mode="horizontal" background-color="#545c64"
  text-color="#fff"
  active-text-color="#ffd04b"  :router="true">
      <template v-if="user">
        <el-menu-item id="toggleSidenav" @click="toggleSideNav">
          <i :class="[ navOpened ? 'el-icon-turn-off' : 'el-icon-open' ]"></i>
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
      user: 'auth/user'
    }),
    data: () => ({
      navOpened: false
    }),
    methods: {
      async logout() {
        await this.$store.dispatch('auth/logout');
        this.$router.push({ name: 'login' });
      },
      toggleSideNav() {
        // ! @todo - really belongs in the vuex store, so sidenav can access it.
        this.navOpened = !this.navOpened
      }
    }
  }
</script>

<style>
#toggleSidenav {
  float:left !important;
}
#toggleSidenav > i {
  font-size: 2em;
}
#nav-header {
  padding: 0;
}
.el-menu-logout li {
  float: right !important;
}
</style>
