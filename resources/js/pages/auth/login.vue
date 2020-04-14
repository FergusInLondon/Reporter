<template>
  <el-row :gutter="20">
    <el-col :span="12" :offset="6">
      <el-card class="box-card">
        <div slot="header" class="clearfix">
          <span>Login</span>
          <el-link style="float: right; padding: 3px 0" type="primary" @click="reset">Reset Password</el-link>
        </div>
        <el-form ref="form" :model="form">
        <el-form-item label="Email Address">
          <el-input v-model="form.email"></el-input>
        </el-form-item>
        <el-form-item label="Password">
          <el-input v-model="form.password" type="password" autocomplete="off"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="login">Login</el-button>
        </el-form-item>
        </el-form>
      </el-card>
    </el-col>
  </el-row>
</template>

<script>
import Form from 'vform'

export default {
  middleware: 'guest',

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false
  }),

  methods: {
    async login() {
      const { data } = await this.form.post('/api/login')

      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      await this.$store.dispatch('auth/fetchUser')
      this.$router.push({ name: 'home' })
    },
    reset() {
      this.$router.push({name: 'password.request'})
    }
  }
}
</script>
