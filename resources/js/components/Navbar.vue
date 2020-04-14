<template>
  <el-header>
    <el-menu class="el-menu-logout" mode="horizontal" :router="true">
      <template v-if="user">
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
    methods: {
      async logout() {
        await this.$store.dispatch('auth/logout');
        this.$router.push({ name: 'login' });
      }
    }
  }
</script>

<style>
.el-menu-logout li {
  float: right !important;
}
</style>