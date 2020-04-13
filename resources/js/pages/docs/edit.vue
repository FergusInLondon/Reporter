
<template>
    <card title="Documents">
        <div v-if="documents">
            <a v-for="document in documents" href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ document.name }}</h5>
                    <small class="text-muted">Status</small>
                </div>
                <p class="mb-1">{{ document.description }}</p>
                <small class="text-muted">{{ document.created_at }}</small>
            </a>
        </div>
    </card>
</template>

<script>
  import axios from 'axios';

  export default {
    async created() {
      const doc = await axios.get(`/api/documents/${this.$route.params.id}`)
      if (doc.data) {
        this.document = [doc.data];
      }
    },
    
    data() {
      return {
        doc: null
      }
    }
  }
</script>