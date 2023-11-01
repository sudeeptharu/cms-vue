<template>
    <el-container>
        <el-row class="row" >
            <el-col :span="12" >
                <el-button @click="addDrawer = true">Add Link</el-button>
            </el-col>
            <!--            <el-col :span="12">-->
            <!--                <el-input v-model="search" size="small" placeholder="Type to search" />-->
            <!--            </el-col>-->
        </el-row>
    </el-container>
    <el-table :data="links" style="width: 100%">
        <el-table-column label="Social" prop="social" />
        <el-table-column label="Icon" prop="icon" />
        <el-table-column label="URL" prop="url" />
        <el-table-column label="Action" prop="action">
            <template #default="scope">
                <el-button
                    @click="linkData.id = scope.row.id; linkData.social = scope.row.social;linkData.icon = scope.row.icon;linkData.url = scope.row.url; editDrawer = true">
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

    <el-drawer v-model="editDrawer" title="Edit Link" @keyup.enter="handleEdit" direction="rtl">

        <el-form :form="linkData" label-position="top">

            <el-form-item label="Social" required>
                <el-input v-model="linkData.social" placeholder="Social" clearable/>
            </el-form-item>
            <el-form-item label="Icon" required>
                <el-input v-model="linkData.icon" placeholder="Icon" clearable/>
            </el-form-item>
            <el-form-item label="URL" required>
                <el-input v-model="linkData.url" placeholder="URL" clearable/>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="handleEdit">Update</el-button>
                <el-button @click="editDrawer = false">Cancel</el-button>
            </el-form-item>

        </el-form>
    </el-drawer>

    <el-drawer
        v-model="addDrawer"
        title="Add Link"
        @keyup.enter="handleAdd"
        @open="resetForm"
        direction="rtl" >

        <el-form :form="linkData" label-position="top">

            <el-form-item label="Social" required>
                <el-input v-model="linkData.social" placeholder="Social" clearable/>
            </el-form-item>
            <el-form-item label="Icon" required>
                <el-input v-model="linkData.icon" placeholder="Icon" clearable/>
            </el-form-item>
            <el-form-item label="URL" required>
                <el-input v-model="linkData.url" placeholder="URL" clearable/>
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
import getLinks from "../../../services/link/getLinks.js";
import postLink from "../../../services/link/postLink.js";
import putLink from "../../../services/link/putLink.js";
import deleteLink from "../../../services/link/deleteLink.js";
import {Delete, EditPen} from "@element-plus/icons-vue";


const centerDialogVisible = ref(false)
const {links,loadLinks} = getLinks()
console.log(links);
const {addLink} = postLink()
const {updateLink} = putLink()
const {destroyLink} = deleteLink()
const router = useRouter()
const route = useRoute()

const addDrawer = ref(false)
const editDrawer = ref(false)
const linkData = reactive({
    id: '',
    social: '',
    icon:'',
    url:''
})

onMounted(() => {
    loadLinks()
})

const handleAdd = () => {
    const link = {
        social: linkData.social,
        icon: linkData.icon,
        url: linkData.url
    }

    addLink(link).then(() => {
        addDrawer.value = false
        resetForm()
        loadLinks(route.fullPath)

    }).catch()
}

const handleEdit = () => {
    const link = {
        id: linkData.id,
        social: linkData.social,
        icon: linkData.icon,
        url: linkData.url
    }

    updateLink(link).then(() => {
        editDrawer.value = false
        loadLinks(route.fullPath)
    }).catch()

}

const handleDelete = (link_id) => {
    destroyLink(link_id).then(() => {
        loadLinks(route.fullPath)
    }).catch()
}

const resetForm = () => {
    linkData.social = ''
    linkData.icon = ''
    linkData.url = ''
}

// const filterRole = role_id => links.value = links.value.filter(role => role.id !== role_id)
</script>
