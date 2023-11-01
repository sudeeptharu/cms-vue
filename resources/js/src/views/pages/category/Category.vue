<template>
    <el-container>
        <el-row class="row" >
            <el-col :span="12" >
                <el-button @click="addDrawer = true">Add Category</el-button>
            </el-col>
<!--            <el-col :span="12">-->
<!--                <el-input v-model="search" size="small" placeholder="Type to search" />-->
<!--            </el-col>-->
        </el-row>
    </el-container>
    <el-table :data="categories" style="width: 100%">
        <el-table-column label="Title" prop="title" />
        <el-table-column label="Action" prop="action">
            <template #default="scope">
                <el-button
                    @click="categoryData.id = scope.row.id; categoryData.title = scope.row.title; editDrawer = true">
                    <el-icon>
                        <EditPen/>
                    </el-icon>
                </el-button>

                <el-popconfirm title="Remove ?" confirm-button-text="Yes" cancel-button-text="No"
                               @confirm="handleDelete(scope.row.id)">
                    <template #reference>
                        <el-button type="danger">
                            <el-icon>
                                <Delete/>
                            </el-icon>
                        </el-button>
                    </template>
                </el-popconfirm>
            </template>
        </el-table-column>
    </el-table>

    <el-drawer v-model="editDrawer" title="Edit Category" @keyup.enter="handleEdit" direction="rtl">

        <el-form :form="categoryData" label-position="top">

            <el-form-item label="Title" required>
                <el-input v-model="categoryData.title" placeholder="Title" clearable/>
            </el-form-item>

            <el-form-item>
                <el-button type="primary" @click="handleEdit">Update</el-button>
                <el-button @click="editDrawer = false">Cancel</el-button>
            </el-form-item>

        </el-form>
    </el-drawer>

        <el-drawer
            v-model="addDrawer"
            title="Add Category"
            @keyup.enter="handleAdd"
            @open="resetForm"
            direction="rtl" >

            <el-form :form="categoryData" label-position="top">

                <el-form-item label="Title" required>
                    <el-input v-model="categoryData.title" placeholder="Title" clearable/>
                </el-form-item>


                <el-form-item>
                    <el-button type="primary" @click="handleAdd">Add</el-button>
                    <el-button @click="addDrawer = false">Cancel</el-button>
                </el-form-item>

            </el-form>

        </el-drawer>

</template>

<script lang="ts" setup>
import {computed, onMounted, reactive, ref} from 'vue'
import {useRoute, useRouter} from "vue-router";
import getCategories from "../../../services/category/getCategories.js";
import postCategory from "../../../services/category/postCategory.js";
import putCategory from "../../../services/category/putCategory.js";
import deleteCategory from "../../../services/category/deleteCategory.js";
import {Delete, EditPen} from "@element-plus/icons-vue";


const centerDialogVisible = ref(false)
const {categories,loadCategories} = getCategories()
console.log(categories);
const {addCategory} = postCategory()
const {updateCategory} = putCategory()
const {destroyCategory} = deleteCategory()
const router = useRouter()
const route = useRoute()

const addDrawer = ref(false)
const editDrawer = ref(false)
const categoryData = reactive({
    id: '',
    title: ''
})

onMounted(() => {
    const cat=loadCategories()
    console.log(cat)
})

const handleAdd = () => {
    const role = {
        title: categoryData.title
    }

    addCategory(role).then(() => {
        addDrawer.value = false
        resetForm()
        loadCategories(route.fullPath)

    }).catch()
}

const handleEdit = () => {
    const category = {
        id: categoryData.id,
        title: categoryData.title
    }

    updateCategory(category).then(() => {
        editDrawer.value = false
        loadCategories(route.fullPath)
    }).catch()

}

const handleDelete = (category_id) => {
    destroyCategory(category_id).then(() => {
        loadCategories(route.fullPath)
    }).catch()
}

const resetForm = () => {
    categoryData.title = ''
}

// const filterRole = role_id => categories.value = categories.value.filter(role => role.id !== role_id)
</script>
