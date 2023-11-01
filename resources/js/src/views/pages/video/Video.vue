<template>
    <el-container>
        <el-row class="row" >
            <el-col :span="12" >
                <el-button @click="addDrawer = true">Add video</el-button>
            </el-col>
            <!--            <el-col :span="12">-->
            <!--                <el-input v-model="search" size="small" placeholder="Type to search" />-->
            <!--            </el-col>-->
        </el-row>
    </el-container>
    <el-table :data="Videos" style="width: 100%">
        <el-table-column label="Title" prop="title" />
        <el-table-column label="URL" prop="url" />
        <el-table-column label="Action" prop="action">
            <template #default="scope">
                <el-button
                    @click="videoData.id = scope.row.id;
                    videoData.title = scope.row.title;
                    videoData.url = scope.row.url; editDrawer = true">
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

    <el-drawer v-model="editDrawer" title="Edit video" @keyup.enter="handleEdit" direction="rtl">

        <el-form :form="videoData" label-position="top">

            <el-form-item label="Title" required>
                <el-input v-model="videoData.title" placeholder="Title" clearable/>
            </el-form-item>
            <el-form-item label="URL" required>
                <el-input v-model="videoData.url" placeholder="URL" clearable/>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="handleEdit">Update</el-button>
                <el-button @click="editDrawer = false">Cancel</el-button>
            </el-form-item>

        </el-form>
    </el-drawer>

    <el-drawer
        v-model="addDrawer"
        title="Add video"
        @keyup.enter="handleAdd"
        @open="resetForm"
        direction="rtl" >

        <el-form :form="videoData" label-position="top">
            <el-form-item label="Title" required>
                <el-input v-model="videoData.title" placeholder="Title" clearable/>
            </el-form-item>
            <el-form-item label="URL" required>
                <el-input v-model="videoData.url" placeholder="URL" clearable/>
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
import getVideos from "../../../services/video/getVideos.js";
import postVideo from "../../../services/video/postVideo.js";
import putVideo from "../../../services/video/putVideo.js";
import deleteVideo from "../../../services/video/deleteVideo.js";
import {Delete, EditPen} from "@element-plus/icons-vue";


const centerDialogVisible = ref(false)
const {Videos,loadVideos} = getVideos()
console.log(Videos);
console.log(loadVideos());
const {addVideo} = postVideo()
const {updateVideo} = putVideo()
const {destroyVideo} = deleteVideo()
const router = useRouter()
const route = useRoute()

const addDrawer = ref(false)
const editDrawer = ref(false)
const videoData = reactive({
    id: '',
    title:'',
    url:''
})

onMounted(() => {
    loadVideos()
})

const handleAdd = () => {
    const video = {
        title: videoData.title,
        url: videoData.url
    }

    addVideo(video).then(() => {
        addDrawer.value = false
        resetForm()
        loadVideos(route.fullPath)

    }).catch()
}

const handleEdit = () => {
    const video = {
        id: videoData.id,
        title: videoData.title,
        url: videoData.url
    }

    updateVideo(video).then(() => {
        editDrawer.value = false
        loadVideos(route.fullPath)
    }).catch()

}

const handleDelete = (video_id) => {
    destroyVideo(video_id).then(() => {
        loadVideos(route.fullPath)
    }).catch()
}

const resetForm = () => {
videoData.title=''
    videoData.url = ''
}

// const filterRole = role_id => videos.value = videos.value.filter(role => role.id !== role_id)
</script>
