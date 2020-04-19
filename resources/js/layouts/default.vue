<template>
  <el-container id="top-container">
    <navbar id="navbar" />
    <el-container id="inner-container">
      <sidebar id="sidebar" />
      <el-main v-loading="loading">
          <el-card class="box-card">
            <div slot="header" class="clearfix">
              <span class="module-box-holder">{{ title }}</span>
              <el-button id="btn-back" @click="goBack" type="primary">Back</el-button>
            </div>
            <transition name="fade" mode="out-in">
              <router-view />
            </transition>
          </el-card>
      </el-main>
    </el-container>
    <el-footer id="footer"></el-footer>
  </el-container>
</template>

<script>
import { mapGetters } from 'vuex'
import Navbar from '~/components/Navbar'
import Sidebar from '~/components/Sidebar'

export default {
  name: 'MainLayout',
  components: {
    Navbar, Sidebar
  },
  computed: mapGetters({
    loading: 'app/isLoading',
    title: 'app/pageTitle'
  }),
  methods: {
    goBack () {
      this.$router.go(-1);
    }
  }
}
</script>

<style>
#btn-back {
  float: right;
}
#top-container {
  min-height: 100%;
}
#inner-container {
  flex: 1;
}
#navbar {
  padding: 0;
  height:60px;
  flex: 0;
}
#sidebar {
/*  max-width: 300px; */
}
#footer {
  flex: 0;
}
.module-box-holder {
  line-height: 2em;
  font-size: 1.3em;
}
</style>