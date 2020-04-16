<template>
    <el-aside v-if="user">
        <el-menu id="top-sidebar" :collapse="isCollapsed" :router="true">
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
        pages: [
          {
            icon: 'el-icon-s-home',
            route: 'home',
            name: 'Home'
          },
          {
            icon: 'el-icon-office-building',
            route: 'clients.listing',
            name: 'Clients'
          },
          {
            icon: 'el-icon-document-copy',
            route: 'docs.listing',
            name: 'Documents'
          },
          {
            icon: 'el-icon-money',
            route: 'payments.listing',
            name: 'Payments'
          },
          {
            icon: 'el-icon-setting',
            route: 'settings.profile',
            name: 'Settings'
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