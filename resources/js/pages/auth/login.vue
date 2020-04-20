<template>
  <el-row :gutter="20">
    <el-col :span="12" :offset="6">
      <el-card class="box-card">
        <div slot="header" class="clearfix">
          <span>Login</span>
          <el-link style="float: right; padding: 3px 0" type="primary" @click="reset">Reset Password</el-link>
        </div>
        <el-alert v-if="!canSubmit" title="Please enter a valid username and password." type="info" :closable="false" show-icon></el-alert>
        <el-alert v-if="loginFailed" title="Incorrect login credentials!" type="error" show-icon :closable="false"></el-alert>
        <el-form ref="form" :model="form">
        <el-form-item label="Email Address">
          <el-input v-model="form.email"></el-input>
        </el-form-item>
        <el-form-item label="Password">
          <el-input v-model="form.password" type="password" autocomplete="off"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button class="btn-flright" type="primary" @click="login" :disabled="!canSubmit">Login</el-button>
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
    remember: false,
    loginFailed: false
  }),

  computed: {
    canSubmit() {
      return this.form.email.length > 0 && this.form.password.length > 0
    }
  },

  methods: {
    async login() {
      let response
      try {
        response = await this.form.post('/api/login')
      } catch(e) {
        this.loginFailed = true
        return
      }

      this.$store.dispatch('app/saveToken', {
        token: response.data.token,
        remember: this.remember
      })

      await this.$store.dispatch('app/fetchUser')
      this.$router.push({ name: 'home' })
    },
    reset() {
      this.$router.push({name: 'password.request'})
    }
  }
}
</script>
