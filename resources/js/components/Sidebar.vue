<template>
    <el-aside v-if="user">
        <el-menu default-active="2" class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose" :collapse="isCollapse">
            <el-menu-item index="1">
                <i class="el-icon-document"></i>
                <span slot="title">Home</span>
            </el-menu-item>

            <el-menu-item index="2">
                <i class="el-icon-document"></i>
                <span slot="title">Documents</span>
            </el-menu-item>

            <el-menu-item index="3">
                <i class="el-icon-menu"></i>
                <span slot="title">Payments</span>
            </el-menu-item>


            <el-menu-item index="4">
                <i class="el-icon-setting"></i>
                <span slot="title">User Management</span>
            </el-menu-item>
        </el-menu>
    </el-aside>
</template>

<style>
  .el-menu-vertical-demo:not(.el-menu--collapse) {
    width: 200px;
    min-height: 400px;
  }
</style>

<script>
  import { mapGetters } from 'vuex'

  export default {
    data() {
      return {
        isCollapse: false
      };
    },
    computed: mapGetters({
      user: 'auth/user'
    }),
    methods: {
      handleOpen(key, keyPath) {
        console.log(key, keyPath);
      },
      handleClose(key, keyPath) {
        console.log(key, keyPath);
      }
    }
  }
</script>