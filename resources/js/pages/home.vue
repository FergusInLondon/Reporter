<template>
  <el-card class="box-card">
    You are logged in!
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
