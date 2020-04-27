<template>
<el-form :model="model" :inline="true">
    <el-form-item label="Select Client">
        <el-select v-model="model.id" placeholder="Select">
            <el-option v-for="item in options" :key="item.id"
                :label="item.name" :value="item.id"></el-option>
        </el-select>
        <el-button type="primary" @click="clickHandler">{{ btnTitle }}</el-button>
    </el-form-item>
</el-form>
</template>

<script>
import axios from 'axios';

export default {
    name: 'ClientAutocomplete',
    props: {
        model: Object,
        btnTitle: String,
        clickHandler: Function
    },
    async created() {
        const clients = await axios.get('/api/clients/autocomplete')
        if (clients.data) {
            this.options = clients.data
        }
    },
    data: () => ({
        options: []
    })
}
</script>