<template>
    <el-aside v-if="user">
        <el-menu id="top-sidebar" class="el-menu-vertical-demo" :collapse="isCollapsed" :router="true">
          <el-menu-item v-for="(page, idx) in pages" :key="page.route" :index="idx" :route="{ name: page.route }">
            <i :class="page.icon"></i>
            <span slot="title">{{ page.name }}</span>
          </el-menu-item>
        </el-menu>
    </el-aside>
</template>

<script>
  import { mapGetters } from 'vuex'

  export default {
    data() {
      return {
        sidebarCollapsed: true,
        pages: [
          {
            icon: 'el-icon-s-home',
            route: 'home',
            name: 'Home'
          },
          {
            icon: 'el-icon-user',
            route: 'settings.profile',
            name: 'Users'
          },
          {
            icon: 'el-icon-office-building',
            route: 'settings.profile',
            name: 'Clients'
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
          }
        ]
      };
    },
    computed: mapGetters({
      user: 'app/user',
      isCollapsed: 'app/sidebarCollapsed'
    })
  }
</script>

<style>
#top-sidebar {
  min-height:100%;
/*  padding-right: 5em; */
}
</style>