<template>
  <el-card class="box-card">
    <div slot="header" class="clearfix">
      <span class="module-box-holder">Payments</span>
    </div>
    <transition name="fade" mode="out-in">
      <router-view />
    </transition>
  </el-card>
</template>



<script>
export default {
  middleware: 'auth'
}
</script>

<style>
.module-box-holder {
  line-height: 2em;
  font-size: 1.3em;
}
</style>