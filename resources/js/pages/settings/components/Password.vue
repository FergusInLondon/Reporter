<template>
  <el-form ref="form" :model="form" label-width="10em">
    <el-form-item label="Password">
      <el-input v-model="form.password" type="password" autocomplete="off"></el-input>
    </el-form-item>
    <el-form-item label="Confirm Password">
      <el-input v-model="form.password_confirmation" type="password" autocomplete="off"></el-input>
    </el-form-item>
    <el-form-item>
      <el-button class="btn-flright" type="primary" @click="update">Update Password</el-button>
    </el-form-item>
  </el-form>
</template>

<script>
import Form from 'vform'

export default {
  data: () => ({
    form: new Form({
      password: '',
      password_confirmation: ''
    })
  }),

  methods: {
    async update () {
      await this.form.patch('/api/settings/password')
      this.form.reset()
    }
  }
}
</script>
