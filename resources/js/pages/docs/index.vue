<template>
  <div>
    <el-form :inline="true" :model="queryFilters">
      <el-form-item label="Client Name">
        <el-input v-model="queryFilters.client" placeholder="Client Name"></el-input>
      </el-form-item>
      <el-form-item label="Document Name">
        <el-input v-model="queryFilters.name" placeholder="Document Name"></el-input>
      </el-form-item>
      <el-form-item label="Payment Status">
        <el-select v-model="queryFilters.status" placeholder="Payment Status">
          <el-option label="Pending" value="pending"></el-option>
          <el-option label="Failed" value="failed"></el-option>
          <el-option label="Successful" value="successful"></el-option>
        </el-select>
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
    <el-divider></el-divider>
    <el-table :data="documents" style="width: 100%">
      <el-table-column prop="created_at" label="Created">
        <template slot-scope="colProps">
          <timeago :datetime="colProps.row.created_at"></timeago>
        </template>
      </el-table-column>
      <el-table-column prop="name" label="Name"></el-table-column>
      <el-table-column prop="client_name" label="Client"></el-table-column>
      <el-table-column prop="status" label="Payment Status" ></el-table-column>
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
        No documents matching current filters.
      </template>
    </el-table>
  </div>
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
      },
      clearQuery() {
        this.queryFilters = {}
        this.submitQuery()
      },
      async submitQuery() {
        this.$store.dispatch('app/setLoading', true);
        const docs = await axios.get(`/api/documents`, {
          params: this.queryFilters
        })
        if (docs.data) {
          this.documents = docs.data;
          this.$store.dispatch('app/setLoading', false);
        }
      }
    },

    async created() {
      this.$store.dispatch('app/updateTitle', "Documents");
      this.$store.dispatch('app/setLoading', true);
      const docs = await axios.get(`/api/documents`)
      if (docs.data) {
        this.documents = docs.data;
        this.$store.dispatch('app/setLoading', false);
      }
    },

    computed: {
      searchDisabled() {
        return Object.keys(this.queryFilters).length === 0
      }
    },

    data() {
      return {
        queryFilters: {},
        documents: null
      }
    }
  }
</script>
