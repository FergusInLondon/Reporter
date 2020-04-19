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
          <el-checkbox-button label="overdue" key="overdue">Overdue</el-checkbox-button>
          <el-checkbox-button label="cancelled" key="cancelled">Cancelled</el-checkbox-button>
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
  <el-table :data="payments" style="width: 100%">
    <el-table-column prop="created_at" label="Requested At">
      <template slot-scope="colProps">
        <timeago :datetime="colProps.row.created_at"></timeago>
      </template>
    </el-table-column>
    <el-table-column prop="client_name" label="Client" ></el-table-column>
    <el-table-column prop="amount" label="Amount">
      <template slot-scope="colProps">
        {{currencyDisplay(colProps.row.amount)}}
      </template>
    </el-table-column>
    <el-table-column prop="status" label="Status" ></el-table-column>
    <el-table-column prop="updated_at" label="Updated At" ></el-table-column>    
    <el-table-column
      fixed="right"
      width="120">
      <template slot-scope="scope">
        <el-button @click="view(scope.row.id)" type="text" size="small">View</el-button>
      </template>
    </el-table-column>
    <template slot="empty">
      You currently have no Payments.
    </template>
  </el-table>
</div>
</template>

<script>
  import axios from 'axios';

  export default {
    async created() {
      this.$store.dispatch('app/updateTitle', 'Payments');
      this.$store.dispatch('app/setLoading', true);
      const docs = await axios.get(`/api/payments`)
      if (docs.data) {
        this.payments = docs.data;
        this.$store.dispatch('app/setLoading', false);
      }
    },
    methods: {
      currencyDisplay(currencyString) {
        return '£' + parseFloat(currencyString).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
      },
      view(paymentId) {
        this.$router.push({name: `payments.view`, params: { id: paymentId }})
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
    computed: {
      searchDisabled() {
        return Object.keys(this.queryFilters).length === 0
      }
    },
    data() {
      return {
        payments: null,
        queryFilters: {
          options: [],
        }
      }
    }
  }
</script>