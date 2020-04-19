
<template>
  <div>
    <el-steps :active="4" align-center>
      <el-step title="Step 1" description="Select recipient client." icon="el-icon-user"></el-step>
      <el-step title="Step 2" description="Upload document." icon="el-icon-upload"></el-step>
      <el-step title="Step 3" description="Create payment terms." icon="el-icon-bank-card"></el-step>
      <el-step title="Summary" description="" icon="el-icon-circle-check"></el-step>
    </el-steps>
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" message="Document Saved!" />

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">Name</label>
        <div class="col-md-7">
          <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name">
          <has-error :form="form" field="name" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">Description</label>
        <div class="col-md-7">
          <textarea v-model="form.description" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name"></textarea>
          <has-error :form="form" field="description" />
        </div>
      </div>
      <!-- Submit Button -->
      <div class="form-group row">
        <div class="col-md-9 ml-md-auto">
        <el-button type="primary" @click="update">Create</el-button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
  import axios from 'axios';
  import Form from 'vform'

  export default {
    created() {
      this.$store.dispatch('app/updateTitle', 'New Document')
    },

    data: () => ({
      form: new Form({
        name: '',
        description: '',
        document_uri: ''
      })
    }),

    methods: {
      async update() {
        await this.form.post(`/api/documents`)
        this.$router.push({name: 'docs.listing'})
        this.form.reset()
      }
    }
  }
</script>