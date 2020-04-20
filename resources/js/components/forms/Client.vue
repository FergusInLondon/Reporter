<template>
  <el-form :model="model">
      <el-form-item class="btn-view" label="Client Name">
        <el-input v-model="model.name">
           <i class="el-icon-money el-input__icon" slot="suffix"></i>
        </el-input>
      </el-form-item>
      <el-form-item class="btn-view" label="Email Address">
        <el-input v-model="model.contact_email">
           <i class="el-icon-money el-input__icon" slot="suffix"></i>
        </el-input>
      </el-form-item>
      <el-form-item class="btn-view" label="Telephone Number">
        <el-input v-model="model.contact_tel">
           <i class="el-icon-money el-input__icon" slot="suffix"></i>
        </el-input>
      </el-form-item>
      <el-form-item label="Contact Preference">
        <el-checkbox-group v-model="model.preferences">
          <el-checkbox-button key="email">Email</el-checkbox-button>
          <el-checkbox-button key="sms">Telephone (SMS)</el-checkbox-button>
        </el-checkbox-group>
      </el-form-item>
      <el-form-item>
        <el-button class="btn-flright" type="primary" @click="clickHandler" :disabled="!canSubmit">{{ btnTitle }}</el-button>
      </el-form-item>
  </el-form>
</template>

<script>
export default {
    name: "Client",
    props: {
        model: Object,
        btnTitle: String,
        clickHandler: Function
    },
    computed: {
        canSubmit() {
            return false
        }
    },
    data: () => ({})
}
</script>