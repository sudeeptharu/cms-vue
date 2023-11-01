<template>
    <el-container>
        <el-row class="row" >
            <el-col :span="12" >
                <el-button @click="addDrawer = true">Add scroller</el-button>
            </el-col>
            <!--            <el-col :span="12">-->
            <!--                <el-input v-model="search" size="small" placeholder="Type to search" />-->
            <!--            </el-col>-->
        </el-row>
    </el-container>
    <el-table :data="scrollers" style="width: 100%">
        <el-table-column label="title" prop="title" />
        <el-table-column label="URL" prop="url" />
        <el-table-column label="Action" prop="action">
            <template #default="scope">
                <el-button
                    @click="scrollerData.id = scope.row.id; scrollerData.title = scope.row.title;
                    scrollerData.url = scope.row.url; editDrawer = true">
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

    <el-drawer v-model="editDrawer" title="Edit scroller" @keyup.enter="handleEdit" direction="rtl">

        <el-form :form="scrollerData" label-position="top">

            <el-form-item label="title" required>
                <el-input v-model="scrollerData.title" placeholder="title" clearable/>
            </el-form-item>

            <el-form-item label="URL" required>
                <el-input v-model="scrollerData.url" placeholder="URL" clearable/>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="handleEdit">Update</el-button>
                <el-button @click="editDrawer = false">Cancel</el-button>
            </el-form-item>

        </el-form>
    </el-drawer>

    <el-drawer
        v-model="addDrawer"
        title="Add scroller"
        @keyup.enter="handleAdd"
        @open="resetForm"
        direction="rtl" >

        <el-form :form="scrollerData" label-position="top">
            <el-form-item label="title" required>
                <el-input v-model="scrollerData.title" placeholder="title" clearable/>
            </el-form-item>

            <el-form-item label="URL" required>
                <el-input v-model="scrollerData.url" placeholder="URL" clearable/>
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
import getScrollers from "../../../services/scroller/getScrollers.js";
import postScroller from "../../../services/scroller/postScroller.js";
import putScroller from "../../../services/scroller/putScroller.js";
import deleteScroller from "../../../services/scroller/deleteScroller.js";
import {Delete, EditPen} from "@element-plus/icons-vue";


const centerDialogVisible = ref(false)
const {scrollers,loadScrollers} = getScrollers()
console.log(scrollers);
const {addScroller} = postScroller()
const {updateScroller} = putScroller()
const {destroyScroller} = deleteScroller()
const router = useRouter()
const route = useRoute()

const addDrawer = ref(false)
const editDrawer = ref(false)
const scrollerData = reactive({
    id: '',
    title: '',
    url:''
})

onMounted(() => {
    loadScrollers()
})

const handleAdd = () => {
    const scroller = {
        title: scrollerData.title,
        url: scrollerData.url
    }

    addScroller(scroller).then(() => {
        addDrawer.value = false
        resetForm()
        loadScrollers(route.fullPath)

    }).catch()
}

const handleEdit = () => {
    const scroller = {
        id: scrollerData.id,
        title: scrollerData.title,
        url: scrollerData.url
    }

    updateScroller(scroller).then(() => {
        editDrawer.value = false
        loadScrollers(route.fullPath)
    }).catch()

}

const handleDelete = (scroller_id) => {
    destroyScroller(scroller_id).then(() => {
        loadScrollers(route.fullPath)
    }).catch()
}

const resetForm = () => {
    scrollerData.title = ''
    scrollerData.url = ''
}

// const filterRole = role_id => scrollers.value = scrollers.value.filter(role => role.id !== role_id)
</script>
