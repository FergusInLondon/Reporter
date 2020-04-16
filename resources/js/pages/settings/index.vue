<template>
  <el-card class="box-card">
    <div slot="header" class="clearfix">
      <span class="module-box-holder">Settings</span>
    </div>
    <transition name="fade" mode="out-in">
      <router-view />
    </transition>
  </el-card>
</template>

<script>
export default {
  middleware: 'auth',
  methods: {
    updateProfile() {
      this.$router.push({name: 'settings.profile'})
    },
    updatePassword() {
      this.$router.push({name: 'settings.password'})
    }
  }
}
</script>
