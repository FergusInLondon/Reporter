<template>
  <el-table :data="documents" style="width: 100%">
    <el-table-column prop="created_at" label="Created">
      <template slot-scope="colProps">
        <timeago :datetime="colProps.row.created_at"></timeago>
      </template>
    </el-table-column>
    <el-table-column prop="name" label="Name"></el-table-column>
    <el-table-column prop="" label="Client"></el-table-column>
    <el-table-column prop="status" label="Status" ></el-table-column>
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
        this.$router.push({name: 'docs.edit', params: { id }})
      },
      async deleteClick(id) {
        await axios.delete(`/api/documents/${id}`)
        this.$router.go()
      }
    },

    async created() {
      const docs = await axios.get(`/api/documents`)
      if (docs.data) {
        this.documents = docs.data;
      }
    },
    
    data() {
      return {
        documents: null
      }
    }
  }
</script>