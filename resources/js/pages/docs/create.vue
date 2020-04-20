
<template>
  <div>
    <el-steps :active="active" align-center>
      <el-step title="Step 1" description="Select recipient client." icon="el-icon-user"></el-step>
      <el-step title="Step 2" description="Upload document." icon="el-icon-upload"></el-step>
      <el-step title="Step 3" description="Create payment terms." icon="el-icon-bank-card"></el-step>
      <el-step title="Summary" description="" icon="el-icon-circle-check"></el-step>
    </el-steps>

    <template v-if="showClientSelection">
      <client-autocomplete :model="clientModel" btn-title="Select Client" :clickHandler="next"></client-autocomplete>
      <el-divider></el-divider>
      <client :model="clientModel" btn-title="Save New Client" :clickHandler="next"></client>
    </template>

    <template v-if="showDocumentUpload">
      <document :model="documentModel" btn-title="Save Document" :clickHandler="next"></document>
    </template>

    <template v-if="showPaymentCreation">
      <payment :model="paymentModel" btn-title="Dispatch Payment Request" :successHandler="next"></payment>
    </template>

    <template v-if="showDocumentSummary">
      Document Summary
    </template>
  </div>
</template>

<script>
  import axios from 'axios';
  import Form from 'vform'

  const clientSelection = 0
  const documentUpload = 1
  const paymentCreation = 2
  const documentSummary = 4

  export default {
    created() {
      this.$store.dispatch('app/updateTitle', 'New Document')
    },

    computed: {
      showClientSelection() {
        return this.active == clientSelection
      },
      showDocumentUpload() {
        return this.active == documentUpload
      },
      showPaymentCreation() {
        return this.active == paymentCreation
      },
      showDocumentSummary() {
        return this.active == documentSummary
      } 
    },

    data: () => ({
      clientModel: {
        id: '',
        preferences: []
      },
      documentModel: {},
      paymentModel: {},
      canSubmit: true,
      active: clientSelection,
      clientId: ""
    }),

    methods: {
      async update() {
        await this.form.post(`/api/documents`)
        this.$router.push({name: 'docs.listing'})
        this.form.reset()
      },

      next() {
        if (this.active < 4) {
          this.active++
        }

        if (this.active == 3) {
          this.active++
          this.canSubmit = false
        }
      }
    }
  }
</script>