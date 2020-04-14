<template>
  <el-card class="box-card">
    <div slot="header" class="clearfix">
      <span class="module-box-holder">Documents</span>
      <el-button @click="goCreate" style="float: right;" type="primary" icon="el-icon-edit"></el-button>
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
    goCreate() {
      this.$router.push({name: 'docs.create'})
    }
  },

  computed: {
    tabs () {
      return [
        {
          icon: 'user',
          name: 'All Documents',
          route: 'documents.index'
        }
      ]
    }
  }
}
</script>

<style>
.module-box-holder {
  line-height: 2em;
  font-size: 1.3em;
}
</style>