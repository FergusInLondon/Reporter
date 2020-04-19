
<template>
  <el-form ref="client" :model="client">
      <el-form-item class="btn-view" label="Client Name">
        <el-input v-model="client.name">
           <i class="el-icon-money el-input__icon" slot="suffix"></i>
        </el-input>
      </el-form-item>
      <el-form-item class="btn-view" label="Email Address">
        <el-input v-model="client.contact_email">
           <i class="el-icon-money el-input__icon" slot="suffix"></i>
        </el-input>
      </el-form-item>
      <el-form-item class="btn-view" label="Telephone Number">
        <el-input v-model="client.contact_tel">
           <i class="el-icon-money el-input__icon" slot="suffix"></i>
        </el-input>
      </el-form-item>
      <el-form-item label="Contact Preference">
        <el-checkbox-group v-model="client.preferences">
          <el-checkbox-button key="email">Email</el-checkbox-button>
          <el-checkbox-button key="sms">Telephone (SMS)</el-checkbox-button>
        </el-checkbox-group>
      </el-form-item>
      <el-form-item>
        <el-button class="btn-search" type="info" @click="clearQuery" :disabled="searchDisabled">Save</el-button>
      </el-form-item>
  </el-form>
</template>

<script>
  import axios from 'axios';

  export default {
    async created() {
      const preferencesMap = [[], ['email'], ['sms'], ['email', 'sms']]

      this.$store.dispatch('app/updateTitle', 'Edit Client');
      const client = await axios.get(`/api/clients/${this.$route.params.id}`)
      if (client.data) {
        this.client = client.data
        this.client.preferences = preferencesMap[ parseInt(client.data.contact_preferences, 10) ]
      }
    },
    
    data: () => ({
      client: {
        preferences: []
      }
    }),

    methods: {
      async update() {
        const doc = await this.form.patch(`/api/documents/${this.$route.params.id}`)
        if (doc.data) {
          this.form.reset()
          this.form.fill(doc.data)
        }
      },

      async delete() {
        await axios.delete(`/api/documents/${this.$route.params.id}`)
      }
    }
  }
</script>