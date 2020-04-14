
<template>
  <card title="New Document">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" message="Document Saved!" />

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('name') }}</label>
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

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('document_uri') }}</label>
        <div class="col-md-7">
          <input v-model="form.document_uri" :class="{ 'is-invalid': form.errors.has('document_uri') }" class="form-control" type="text" name="document_uri">
          <has-error :form="form" field="document_uri" />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="form-group row">
        <div class="col-md-9 ml-md-auto">
          <v-button :loading="form.busy" type="success">
            {{ $t('Save') }}
          </v-button>
        </div>
      </div>
    </form>
  </card>
</template>

<script>
  import axios from 'axios';
  import Form from 'vform'

  export default {
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