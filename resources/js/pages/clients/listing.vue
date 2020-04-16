<template>
  <el-table :data="clients" style="width: 100%">
    <el-table-column prop="name" label="Name" ></el-table-column>
    <el-table-column prop="name" label="Documents" ></el-table-column>
    <el-table-column prop="name" label="Most Recent" ></el-table-column>
    <el-table-column prop="contact_preferences" label="Contact Preference" ></el-table-column>
    <el-table-column
      fixed="right"
      label="Operations"
      width="120">
      <template slot-scope="scope">
        <el-button @click="viewClick(scope.row.id)" type="text" size="small">View</el-button>
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
        this.$router.push({name: 'docs.edit', params: { id }})
      },
      async deleteClick(id) {
        await axios.delete(`/api/clients/${id}`)
        this.$router.go()
      }
    },

    async created() {
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