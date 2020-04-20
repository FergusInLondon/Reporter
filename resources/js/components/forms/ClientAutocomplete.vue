<template>
<el-form :model="model" :inline="true">
    <el-form-item label="Select Client">
        <el-select v-model="model.id" placeholder="Select">
            <el-option v-for="item in options" :key="item.value"
                :label="item.label" :value="item.value"></el-option>
        </el-select>
        <el-button type="primary" @click="clickHandler">{{ btnTitle }}</el-button>
    </el-form-item>
</el-form>
</template>

<script>
export default {
    name: 'ClientAutocomplete',
    props: {
        model: Object,
        btnTitle: String,
        clickHandler: Function
    },
    // ! @todo request mapping from backend.
    data: () => ({
        options: [
            {
                label: "Asswipe",
                value: "1"
            }
        ]
    })
}
</script>