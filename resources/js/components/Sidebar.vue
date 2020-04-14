<template>
    <el-aside v-if="user">
        <el-menu class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose" :collapse="isCollapse" :router="true">
          <el-menu-item v-for="(page, idx) in pages" :key="page.route" :index="idx" :route="{ name: page.route }">
            <i :class="page.icon"></i>
            <span slot="title">{{ page.name }}</span>
          </el-menu-item>
        </el-menu>
    </el-aside>
</template>

<style>
  .el-menu-vertical-demo:not(.el-menu--collapse) {
    min-height: 400px;
  }
</style>

<script>
  import { mapGetters } from 'vuex'

  export default {
    data() {
      return {
        isCollapse: false,
        pages: [
          {
            icon: 'el-icon-s-home',
            route: 'home',
            name: 'Home'
          },
          {
            icon: 'el-icon-document-copy',
            route: 'docs.listing',
            name: 'Documents'
          },
          {
            icon: 'el-icon-money',
            route: 'docs.create',
            name: 'Payments'
          },
          {
            icon: 'el-icon-user-solid',
            route: 'settings.profile',
            name: 'Users'
          }
        ]
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