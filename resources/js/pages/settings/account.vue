<template>
  <el-row :gutter="40">
    <el-col :span="12">
      <div class="col-form-holder">
        <profile />
      </div>
    </el-col>
    <el-col :span="12">
      <div class="col-form-holder">
        <password />
      </div>
    </el-col>
  </el-row>
</template>

<script>
import Profile from './components/Profile'
import Password from './components/Password'

export default {
  created () {
      this.$store.dispatch('app/updateTitle', 'Account Settings');
  },

  components: {
    Profile, Password
  },

  metaInfo () {
    return { title: "User Profile" }
  }
}
</script>
