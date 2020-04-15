<template>
  <el-card class="box-card">
    You're now logged in; this space will be an area for statistics and metrics.
  </el-card>
</template>

<script>
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: "Home" }
  }
}
</script>
