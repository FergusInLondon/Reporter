<template>
  <div>
    <el-popover placement="bottom" title="Status" width="200" trigger="hover">
      This payment is currently <strong>{{ payment.status }}</strong>.
      <el-progress slot="reference" :percentage="50" status="warning"></el-progress>
    </el-popover>
    <el-form ref="payment" :model="payment">
      <el-form-item class="btn-view" label="Client Name">
        <el-input v-model="payment.client_name" disabled>
           <template slot="append"><span @click="handleClick">View</span></template>
           <i class="el-icon-money el-input__icon" slot="suffix"></i>
        </el-input>
      </el-form-item>
      <el-form-item class="btn-view" label="Document Name">
        <el-input v-model="payment.document_name" disabled>
           <template slot="append"><span @click="handleClick">View</span></template>
           <i class="el-icon-money el-input__icon" slot="suffix"></i>
        </el-input>
      </el-form-item>
      <el-row :gutter="40">
        <el-col :span="12">
          <el-form-item label="Sent">
            <el-date-picker v-model="payment.created_at" type="date" disabled />
          </el-form-item>
          <el-form-item label="Due">
            <el-date-picker v-model="payment.updated_at" type="date" disabled />
          </el-form-item>
        </el-col>
        <el-col :span="12">
          <el-input placeholder="Amount" v-model="payment.amount" disabled>
            <template slot="prepend">£</template>
            <i class="el-icon-money el-input__icon" slot="suffix"></i>
          </el-input>
        </el-col>
      </el-row>
      <el-row>
        <el-button class="btn-fr" type="danger" :disabled="disableCancel" @click="cancelPayment">Cancel Payment</el-button>
      </el-row>
    </el-form>
  </div>
</template>

<script>
  import axios from 'axios';

  export default {
    async created() {
      this.$store.dispatch('app/setLoading', true);
      const payment = await axios.get(`/api/payments/${this.$route.params.id}`)
      if (payment.data) {
        this.payment = payment.data;
      }
      this.$store.dispatch('app/updateTitle', `Payment: ${this.payment.client_name} (£${this.payment.amount})`);
      this.$store.dispatch('app/setLoading', false);
    },
    methods: {
      handleClick() {
        this.$router.go(-1);
      },
      cancelPayment() {
        this.$confirm('Once cancelled, the payment cannot be reinstated. Continue?', 'Warning', {
          confirmButtonText: 'OK',
          cancelButtonText: 'Cancel',
          type: 'warning'
        }).then(() => {
          this.$message({
            type: 'success',
            message: 'Delete completed'
          });
        }).catch(() => {
          this.$message({
            type: 'info',
            message: 'Delete canceled'
          });          
        });
      }
    },
    computed: {
      disableCancel() {
        return this.payment.status == 'successful'
      }
    },
    data() {
      return {
        payment: {},
        form: {}
      }
    }
  }
</script>

<style>
.btn-view .el-input-group__append {
  cursor: pointer;
  color: #409EFF !important;
}
.btn-fr {
  float: right;
}
</style>