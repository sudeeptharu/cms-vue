<template>
    <el-container>
        <el-row class="row" >
            <el-col :span="12" >
                <el-button @click="addDrawer = true">Add gallery</el-button>
            </el-col>
            <!--            <el-col :span="12">-->
            <!--                <el-input v-model="search" size="small" placeholder="Type to search" />-->
            <!--            </el-col>-->
        </el-row>
    </el-container>
    <el-table :data="galleries" style="width: 100%">
        <el-table-column label="Title" prop="title" />
        <el-table-column label="Description" prop="description" />
        <el-table-column label="is_published" prop="is_published" />
        <el-table-column label="Action" prop="action">
            <template #default="scope">
                <el-button
                    @click="galleryData.id = scope.row.id;
                    galleryData.title = scope.row.title;
                    galleryData.description = scope.row.description;
                    galleryData.is_published = scope.row.is_published;
                    editDrawer = true">
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

    <el-drawer v-model="editDrawer" title="Edit gallery" @keyup.enter="handleEdit" direction="rtl">

        <el-form :form="galleryData" label-position="top">

            <el-form-item label="Title" required>
                <el-input v-model="galleryData.title" placeholder="Title" clearable/>
            </el-form-item>
            <el-form-item label="Description" required>
                <el-input v-model="galleryData.description" placeholder="description" clearable/>
            </el-form-item>
            <el-form-item label="is_published" >
                <el-checkbox v-model="galleryData.is_published"  clearable/>
            </el-form-item>

            <el-form-item>
                <el-button type="primary" @click="handleEdit">Update</el-button>
                <el-button @click="editDrawer = false">Cancel</el-button>
            </el-form-item>

        </el-form>
    </el-drawer>

    <el-drawer
        v-model="addDrawer"
        title="Add gallery"
        @keyup.enter="handleAdd"
        @open="resetForm"
        direction="rtl" >

        <el-form :form="galleryData" label-position="top">

            <el-form-item label="Title" required>
                <el-input v-model="galleryData.title" placeholder="Title" clearable/>
            </el-form-item>
            <el-form-item label="Description" required>
                <el-input v-model="galleryData.description" placeholder="description" clearable/>
            </el-form-item>
            <el-form-item label="Title" >
                <el-checkbox v-model="galleryData.is_published"  clearable/>
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
import getGalleries from "../../../services/gallery/getGalleries.js";
import postGallery from "../../../services/gallery/postGallery.js";
import putGallery from "../../../services/gallery/putGallery.js";
import deleteGallery from "../../../services/gallery/deleteGallery.js";
import {Delete, EditPen} from "@element-plus/icons-vue";


const centerDialogVisible = ref(false)
const {galleries,loadGalleries} = getGalleries()
console.log(galleries);
const {addGallery} = postGallery()
const {updateGallery} = putGallery()
const {destroyGallery} = deleteGallery()
const router = useRouter()
const route = useRoute()

const addDrawer = ref(false)
const editDrawer = ref(false)
const galleryData = reactive({
    id: '',
    title: '',
    description:'',
    is_published:''
})

onMounted(() => {
    const cat=loadGalleries()
    console.log(cat)
})

const handleAdd = () => {
    const gallery = {
        title: galleryData.title,
        description: galleryData.description,
        is_published: galleryData.is_published
    }

    addGallery(gallery).then(() => {
        addDrawer.value = false
        resetForm()
        loadGalleries(route.fullPath)

    }).catch()
}

const handleEdit = () => {
    const gallery = {
        id: galleryData.id,
        title: galleryData.title,
        description: galleryData.description,
        is_published: galleryData.is_published
    }

    updateGallery(gallery).then(() => {
        editDrawer.value = false
        loadGalleries(route.fullPath)
    }).catch()

}

const handleDelete = (gallery_id) => {
    destroyGallery(gallery_id).then(() => {
        loadGalleries(route.fullPath)
    }).catch()
}

const resetForm = () => {
    galleryData.title = ''
    galleryData.description = ''
    galleryData.is_published = ''
}

// const filterRole = role_id => galleries.value = galleries.value.filter(role => role.id !== role_id)
</script>
