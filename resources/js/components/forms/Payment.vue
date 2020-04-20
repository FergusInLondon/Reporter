<template>
    <el-form :model="model" :inline="true">
        <el-form-item label="Due">
            <el-date-picker v-model="model.updated_at" type="date" />
        </el-form-item>
        <el-form-item label="Amount">
            <el-input placeholder="Amount" v-model="model.amount">
                <template slot="prepend">£</template>
                <i class="el-icon-money el-input__icon" slot="suffix"></i>
            </el-input>
        </el-form-item>
        <el-button type="primary" @click="clickHandler">{{ btnTitle }}</el-button>
    </el-form>
</template>

<script>
export default {
    name: 'Payment',
    props: {
        model: Object,
        btnTitle: String,
        successHandler: Function
    },
    methods: {
        clickHandler() {
            // !@todo define validations
            alert("Perform validations etc")
            this.successHandler()
        }
    },
    data: () => ({})
}
</script>