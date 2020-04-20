<template>
<div>
    <el-form :inline="true" :model="queryFilters">
      <el-form-item label="Client Name">
        <el-input v-model="queryFilters.client" placeholder="Client Name"></el-input>
      </el-form-item>
      <el-form-item label="Payment Status">
        <el-select v-model="queryFilters.status" placeholder="Payment Status">
          <el-option label="Pending" value="pending"></el-option>
          <el-option label="Failed" value="failed"></el-option>
          <el-option label="Successful" value="successful"></el-option>
        </el-select>
      </el-form-item>
      <el-form-item>
          <el-checkbox-group v-model="queryFilters.options">
          <el-checkbox-button label="overdue" key="overdue">Overdue Payments</el-checkbox-button>
          </el-checkbox-group>
      </el-form-item>
      <div class="btn-search">
        <el-form-item>
          <el-button class="btn-search" type="info" @click="clearQuery" :disabled="searchDisabled">Clear</el-button>
        </el-form-item>
        <el-form-item>
          <el-button class="btn-search" type="primary" icon="el-icon-search" @click="submitQuery" circle :disabled="searchDisabled" />
        </el-form-item>
      </div>
    </el-form>
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
</div>
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
      },
      submitQuery(){},
      clearQuery(){}
    },

    async created() {
      this.$store.dispatch('app/updateTitle', 'Clients')
      const docs = await axios.get(`/api/clients`)
      if (docs.data) {
        this.clients = docs.data;
      }
    },

    computed: {
      searchDisabled() {
        return true
      }
    },
    
    data() {
      return {
        queryFilters: {
          options: []
        },
        clients: null
      }
    }
  }
</script>