<template>
  <el-table :data="clients" style="width: 100%">
    <el-table-column prop="name" label="Name" ></el-table-column>
    <el-table-column prop="documents_count" label="Documents" ></el-table-column>
    <el-table-column prop="outstanding_count" label="Outstanding Payments"></el-table-column>
    <el-table-column prop="contact_preferences" label="Contact Preference" ></el-table-column>
    <el-table-column
      fixed="right"
      label="Operations"
      width="120">
      <template slot-scope="scope">
        <el-button @click="editClick(scope.row.id)" type="text" size="small">Edit</el-button>
        <el-button @click="deleteClick(scope.row.id)" type="text" size="small">Delete</el-button>
      </template>
    </el-table-column>
    <template slot="empty">
      You currently have no documents.
    </template>
  </el-table>
</template>

<script>
  import axios from 'axios';

  export default {
    methods: {
      editClick(id){
        this.$router.push({name: 'clients.edit', params: { id }})
      },
      async deleteClick(id) {
        await axios.delete(`/api/clients/${id}`)
        this.$router.go()
      }
    },

    async created() {
      this.$store.dispatch('app/updateTitle', 'Clients')
      const docs = await axios.get(`/api/clients`)
      if (docs.data) {
        this.clients = docs.data;
      }
    },
    
    data() {
      return {
        clients: null
      }
    }
  }
</script>