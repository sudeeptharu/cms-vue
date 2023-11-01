<template>
    <el-container>
        <el-row class="row" >
            <el-col :span="12" >
                <el-button @click="addDrawer = true">Add service</el-button>
            </el-col>
            <!--            <el-col :span="12">-->
            <!--                <el-input v-model="search" size="small" placeholder="Type to search" />-->
            <!--            </el-col>-->
        </el-row>
    </el-container>
    <el-table :data="Services" style="width: 100%">
        <el-table-column label="title" prop="title" />
        <el-table-column label="Icon" prop="icon" />
        <el-table-column label="image" prop="image" />
        <el-table-column label="description" prop="description" />
        <el-table-column label="excerpt" prop="excerpt" />
        <el-table-column label="Action" prop="action">
            <template #default="scope">
                <el-button
                    @click="serviceData.id = scope.row.id;
                    serviceData.title = scope.row.title;
                    serviceData.icon = scope.row.icon;
                    serviceData.image = scope.row.image;
                    serviceData.description = scope.row.description;
                    serviceData.excerpt = scope.row.excerpt;editDrawer = true">
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

    <el-drawer v-model="editDrawer" title="Edit service" @keyup.enter="handleEdit" direction="rtl">

        <el-form :form="serviceData" label-position="top">

            <el-form-item label="title" required>
                <el-input v-model="serviceData.title" placeholder="title" clearable/>
            </el-form-item>
            <el-form-item label="Icon" required>
                <el-input v-model="serviceData.icon" placeholder="Icon" clearable/>
            </el-form-item>
            <el-form-item label="image" required>
                <el-input v-model="serviceData.image" placeholder="image" clearable/>
            </el-form-item>
            <el-form-item label="image" required>
                <el-input v-model="serviceData.description" placeholder="description" clearable/>
            </el-form-item>

            <el-form-item label="excerpt" required>
                <el-input v-model="serviceData.excerpt" placeholder="excerpt" clearable/>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="handleEdit">Update</el-button>
                <el-button @click="editDrawer = false">Cancel</el-button>
            </el-form-item>

        </el-form>
    </el-drawer>

    <el-drawer
        v-model="addDrawer"
        title="Add service"
        @keyup.enter="handleAdd"
        @open="resetForm"
        direction="rtl" >

        <el-form :form="serviceData" label-position="top">

            <el-form-item label="title" required>
                <el-input v-model="serviceData.title" placeholder="title" clearable/>
            </el-form-item>
            <el-form-item label="Icon" required>
                <el-input v-model="serviceData.icon" placeholder="Icon" clearable/>
            </el-form-item>
            <el-form-item label="image" required>
                <el-input v-model="serviceData.image" placeholder="image" clearable/>
            </el-form-item>
            <el-form-item label="image" required>
                <el-input v-model="serviceData.description" placeholder="description" clearable/>
            </el-form-item>

            <el-form-item label="excerpt" required>
              <el-input v-model="serviceData.excerpt" placeholder="excerpt" clearable/>
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
import getServices from "../../../services/service/getServices.js";
import postService from "../../../services/service/postService.js";
import putService from "../../../services/service/putService.js";
import deleteService from "../../../services/service/deleteService.js";
import {Delete, EditPen} from "@element-plus/icons-vue";


const centerDialogVisible = ref(false)
const {Services,loadServices} = getServices()
console.log(Services);
const {addService} = postService()
const {updateService} = putService()
const {destroyService} = deleteService()
const router = useRouter()
const route = useRoute()

const addDrawer = ref(false)
const editDrawer = ref(false)
const serviceData = reactive({
    id: '',
    title: '',
    icon:'',
    image:'',
    description:'',
    excerpt:''
})

onMounted(() => {
    loadServices()
})

const handleAdd = () => {
    const service = {
        title: serviceData.title,
        icon: serviceData.icon,
        image: serviceData.image,
        description:serviceData.description,
        excerpt:serviceData.excerpt,

    }

    addService(service).then(() => {
        addDrawer.value = false
        resetForm()
        loadServices(route.fullPath)

    }).catch()
}

const handleEdit = () => {
    const service = {
        id: serviceData.id,
        title: serviceData.title,
        icon: serviceData.icon,
        image: serviceData.image,
        description: serviceData.description,
        excerpt: serviceData.excerpt,

    }

    updateService(service).then(() => {
        editDrawer.value = false
        loadServices(route.fullPath)
    }).catch()

}

const handleDelete = (service_id) => {
    destroyService(service_id).then(() => {
        loadServices(route.fullPath)
    }).catch()
}

const resetForm = () => {
    serviceData.title = ''
    serviceData.icon = ''
    serviceData.image = ''
    serviceData.description = ''
    serviceData.excerpt = ''
}

// const filterRole = role_id => services.value = services.value.filter(role => role.id !== role_id)
</script>
