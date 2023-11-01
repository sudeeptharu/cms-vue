<script setup>
import {reactive} from "vue";
import {Discount} from "@element-plus/icons-vue";

const form = reactive({
    name: '',
    password: '',
    remember: false,
})
const login = () =>{
    alert("your are logged in")
}
</script>

<template>
    <el-col :lg="8" :md="10" :sm="12">
        <el-card class="box-card">
            <el-form :model="form" label-width="120px">
                <el-form-item label="Username/Email" required>
                    <el-input v-model="form.name" clearable/>
                </el-form-item>
                <el-form-item label="Password" required>
                    <el-input type="password" v-model="form.password" show-password clearable/>
                </el-form-item>
                <el-form-item label="Remember Me">
                    <el-switch v-model="form.remember" size="small"/>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="login()">Login</el-button>
                </el-form-item>
            </el-form>
        </el-card>
    </el-col>
</template>

<style scoped>

</style>
