<template>
  <el-table :data="payments" style="width: 100%">
    <el-table-column prop="created_at" label="Requested At">
      <template slot-scope="colProps">
        <timeago :datetime="colProps.row.created_at"></timeago>
      </template>
    </el-table-column>
    <el-table-column prop="name" label="Client" ></el-table-column>
    <el-table-column prop="amount" label="Amount"></el-table-column>
    <el-table-column prop="status" label="Status" ></el-table-column>
    <el-table-column prop="status" label="Updated At" ></el-table-column>    
    <el-table-column
      fixed="right"
      label="Operations"
      width="120">
      <template slot-scope="scope">
        <el-button @click="view(scope.row.id)" type="text" size="small">View</el-button>
      </template>
    </el-table-column>
    <template slot="empty">
      You currently have no Payments.
    </template>
  </el-table>
</template>

<script>
  import axios from 'axios';

  export default {
    async created() {
      const docs = await axios.get(`/api/payments`)
      if (docs.data) {
        this.payments = docs.data;
      }
    },
    methods: {
      view(paymentId) {
        console.log(paymentId)
      }
    },
    data() {
      return {
        payments: null
      }
    }
  }
</script>