<template>
  <el-row :gutter="20">
    <el-col :span="12" :offset="6">
      <el-card class="box-card">
        <div slot="header" class="clearfix">
          <span>Reset Password</span>
        </div>
        <el-form ref="form" :model="form">
        <el-form-item label="Email Address">
          <el-input v-model="form.email"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="send">Send Password Reset</el-button>
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

  metaInfo () {
    return { title: this.$t('reset_password') }
  },

  data: () => ({
    status: '',
    form: new Form({
      email: ''
    })
  }),

  methods: {
    async send () {
      const { data } = await this.form.post('/api/password/email')
      this.status = data.status
      this.form.reset()
    }
  }
}
</script>
