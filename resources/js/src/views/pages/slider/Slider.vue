<template>
    <el-container>
        <el-row class="row" >
            <el-col :span="12" >
                <el-button @click="addDrawer = true">Add slider</el-button>
            </el-col>
            <!--            <el-col :span="12">-->
            <!--                <el-input v-model="search" size="small" placeholder="Type to search" />-->
            <!--            </el-col>-->
        </el-row>
    </el-container>
    <el-table :data="sliders" style="width: 100%">
        <el-table-column label="Title" prop="title" />
        <el-table-column label="image" prop="image" />
        <el-table-column label="url" prop="url" />
        <el-table-column label="description" prop="description" />
        <el-table-column label="is_published" prop="is_published" />
        <el-table-column label="order" prop="order" />
        <el-table-column label="Action" prop="action">
            <template #default="scope">
                <el-button
                    @click="sliderData.id = scope.row.id;
                    sliderData.title = scope.row.title;
                    sliderData.image = scope.row.image;
                    sliderData.url = scope.row.url;
                    sliderData.description = scope.row.description;
                    sliderData.is_published = scope.row.is_published;
                    sliderData.order = scope.row.order;
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

    <el-drawer v-model="editDrawer" title="Edit slider" @keyup.enter="handleEdit" direction="rtl">

        <el-form :form="sliderData" label-position="top">

            <el-form-item label="Title" required>
                <el-input v-model="sliderData.title" placeholder="Title" clearable/>
            </el-form-item>
            <el-form-item label="description" required>
                <el-input v-model="sliderData.description" placeholder="description" clearable/>
            </el-form-item>
            <el-form-item label="url" required>
                <el-input v-model="sliderData.url" placeholder="Title" clearable/>
            </el-form-item>
            <el-form-item label="image" required>
                <el-input v-model="sliderData.image" placeholder="Title" clearable/>
            </el-form-item>
            <el-form-item label="is_published" required>
                <el-checkbox v-model="sliderData.is_published" clearable/>
            </el-form-item>
            <el-form-item label="order" required>
                <el-input-number v-model="sliderData.order" clearable/>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="handleEdit">Update</el-button>
                <el-button @click="editDrawer = false">Cancel</el-button>
            </el-form-item>

        </el-form>
    </el-drawer>

    <el-drawer
        v-model="addDrawer"
        title="Add slider"
        @keyup.enter="handleAdd"
        @open="resetForm"
        direction="rtl" >

        <el-form :form="sliderData" label-position="top">

            <el-form-item label="Title" required>
                <el-input v-model="sliderData.title" placeholder="Title" clearable/>
            </el-form-item>
            <el-form-item label="description" required>
                <el-input v-model="sliderData.description" placeholder="description" clearable/>
            </el-form-item>
            <el-form-item label="url" required>
                <el-input v-model="sliderData.url" placeholder="Title" clearable/>
            </el-form-item>
            <el-form-item label="image" required>
                <el-input v-model="sliderData.image" placeholder="Title" clearable/>
            </el-form-item>
            <el-form-item label="is_published" required>
                <el-checkbox v-model="sliderData.is_published" clearable/>
            </el-form-item>
            <el-form-item label="order" required>
                <el-input-number v-model="sliderData.order" clearable/>
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
import getSliders from "../../../services/slider/getSliders.js";
import postSlider from "../../../services/slider/postSlider.js";
import putSlider from "../../../services/slider/putSlider.js";
import deleteSlider from "../../../services/slider/deleteSlider.js";
import {Delete, EditPen} from "@element-plus/icons-vue";


const centerDialogVisible = ref(false)
const {sliders,loadSliders} = getSliders()
console.log(sliders);
const {addSlider} = postSlider()
const {updateSlider} = putSlider()
const {destroySlider} = deleteSlider()
const router = useRouter()
const route = useRoute()

const addDrawer = ref(false)
const editDrawer = ref(false)
const sliderData = reactive({
    id: '',
    title: '',
    description:'',
    image:'',
    url:'',
    order:'',
    is_published:''
})

onMounted(() => {
    const cat=loadSliders()
    console.log(cat)
})

const handleAdd = () => {
    const slider = {
        title: sliderData.title,
        description: sliderData.description,
        url: sliderData.url,
        image: sliderData.image,
        order: sliderData.order,
        is_published: sliderData.is_published,
    }

    addSlider(slider).then(() => {
        addDrawer.value = false
        resetForm()
        loadSliders(route.fullPath)

    }).catch()
}

const handleEdit = () => {
    const slider = {
        id: sliderData.id,
        title: sliderData.title,
        description: sliderData.description,
        url: sliderData.url,
        image: sliderData.image,
        order: sliderData.order,
        is_published: sliderData.is_published,
    }

    updateSlider(slider).then(() => {
        editDrawer.value = false
        loadSliders(route.fullPath)
    }).catch()

}

const handleDelete = (slider_id) => {
    destroySlider(slider_id).then(() => {
        loadSliders(route.fullPath)
    }).catch()
}

const resetForm = () => {
    sliderData.title = ''
    sliderData.description = ''
    sliderData.image = ''
    sliderData.url = ''
    sliderData.order = ''
    sliderData.is_published = ''
}

// const filterRole = role_id => sliders.value = sliders.value.filter(role => role.id !== role_id)
</script>
