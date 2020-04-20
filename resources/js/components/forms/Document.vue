<template>
    <el-form :model="model">
        <el-form-item label="Document Name">
            <el-input v-model="model.name" placeholder="Client Name"></el-input>
        </el-form-item>
        <el-form-item label="Description">
            <el-input type="textarea" :rows="2" placeholder="Please input"
                v-model="model.description"></el-input>
        </el-form-item>
        <el-upload class="upload-document" drag action="https://jsonplaceholder.typicode.com/posts/" :on-preview="handlePreview"
            :on-remove="handleRemove" :file-list="fileList" :auto-upload="false">
            <i class="el-icon-upload"></i>
            <div class="el-upload__text">Drop file here or <em>click to upload</em></div>
            <div class="el-upload__tip" slot="tip">jpg/png files with a size less than 500kb</div>
        </el-upload>
        <el-form-item>
            <el-button class="btn-flright" type="primary" @click="clickHandler" :disabled="!canSubmit">{{ btnTitle }}</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
export default {
    name: 'Document',
    props: {
        model: Object,
        btnTitle: String,
        clickHandler: Function
    },
    computed: {
        canSubmit() {
            return true
        }
    },
    data: () => ({
        fileList: []
    }),
    methods: {
      handlePreview(){},
      handleRemove(){}
    }
}
</script>

<style>
.upload-document {
    border: 1px solid #ebebeb;
    border-radius: 3px;
    padding: 1.25em 0;
    background: #f7f7f7;
    text-align: center;
}
.btn-flright {
    margin-top: 2em;
}
</style>