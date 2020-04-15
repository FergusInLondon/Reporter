
<template>
  <card title="Edit Document">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" message="Document Updated!" />

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
          <v-button :loading="form.busy" type="success">
            Update
          </v-button>
          <v-button :loading="form.busy" type="danger">
            Delete
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
    async created() {
      const doc = await axios.get(`/api/documents/${this.$route.params.id}`)
      if (doc.data) {
        this.form.fill(doc.data)
      }
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
        const doc = await this.form.patch(`/api/documents/${this.$route.params.id}`)
        if (doc.data) {
          this.form.reset()
          this.form.fill(doc.data)
        }
      },

      async delete() {
        await axios.delete(`/api/documents/${this.$route.params.id}`)
      },

      async delete() {
          console.log('deletin deletin deletin')
      }
    }
  }
</script>