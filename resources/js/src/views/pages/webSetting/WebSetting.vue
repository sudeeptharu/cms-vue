<template>
    <el-container>
        <el-row class="row" >
            <el-col :span="12" >
                <el-button @click="addDrawer = true">Add webSetting</el-button>
            </el-col>
            <!--            <el-col :span="12">-->
            <!--                <el-input v-model="search" size="small" placeholder="Type to search" />-->
            <!--            </el-col>-->
        </el-row>
    </el-container>
    <el-table :data="WebSettings" style="width: 100%">
        <el-table-column label="key" prop="key" />
        <el-table-column label="value" prop="value" />
        <el-table-column label="value" prop="value" />
        <el-table-column label="align" prop="align" />
        <el-table-column label="Action" prop="action">
            <template #default="scope">
                <el-button
                    @click="webSettingData.id = scope.row.id;
                    webSettingData.key = scope.row.key;
                    webSettingData.value = scope.row.value;
                    webSettingData.image = scope.row.image;
                    webSettingData.align = scope.row.align;
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

    <el-drawer v-model="editDrawer" title="Edit webSetting" @keyup.enter="handleEdit" direction="rtl">

        <el-form :form="webSettingData" label-position="top">

            <el-form-item label="Social" required>
                <el-input v-model="webSettingData.key" placeholder="key" clearable/>
            </el-form-item>
            <el-form-item label="Icon" required>
                <el-input v-model="webSettingData.value" placeholder="value" clearable/>
            </el-form-item>
            <el-form-item label="URL" required>
                <el-input v-model="webSettingData.image" placeholder="image" clearable/>
            </el-form-item>
            <el-form-item label="URL" required>
                <el-input v-model="webSettingData.align" placeholder="align" clearable/>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="handleEdit">Update</el-button>
                <el-button @click="editDrawer = false">Cancel</el-button>
            </el-form-item>

        </el-form>
    </el-drawer>

    <el-drawer
        v-model="addDrawer"
        title="Add webSetting"
        @keyup.enter="handleAdd"
        @open="resetForm"
        direction="rtl" >

        <el-form :form="webSettingData" label-position="top">

            <el-form-item label="Social" required>
                <el-input v-model="webSettingData.key" placeholder="key" clearable/>
            </el-form-item>
            <el-form-item label="Icon" required>
                <el-input v-model="webSettingData.value" placeholder="value" clearable/>
            </el-form-item>
            <el-form-item label="URL" required>
                <el-input v-model="webSettingData.image" placeholder="image" clearable/>
            </el-form-item>
            <el-form-item label="URL" required>
                <el-input v-model="webSettingData.align" placeholder="align" clearable/>
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
import getWebSettings from "../../../services/webSetting/getWebSettings.js";
import postWebSetting from "../../../services/webSetting/postWebSetting.js";
import putWebSetting from "../../../services/webSetting/putWebSetting.js";
import deleteWebSetting from "../../../services/webSetting/deleteWebSetting.js";
import {Delete, EditPen} from "@element-plus/icons-vue";


const centerDialogVisible = ref(false)
const {WebSettings,loadWebSettings} = getWebSettings()
console.log(WebSettings);
const {addWebSetting} = postWebSetting()
const {updateWebSetting} = putWebSetting()
const {destroyWebSetting} = deleteWebSetting()
const router = useRouter()
const route = useRoute()

const addDrawer = ref(false)
const editDrawer = ref(false)
const webSettingData = reactive({
    id: '',
    key: '',
    value:'',
    image:'',
    align:''
})

onMounted(() => {
    loadWebSettings()
})

const handleAdd = () => {
    const webSetting = {
        key: webSettingData.key,
        value: webSettingData.value,
        image: webSettingData.image,
        align: webSettingData.align,
    }

    addWebSetting(webSetting).then(() => {
        addDrawer.value = false
        resetForm()
        loadWebSettings(route.fullPath)

    }).catch()
}

const handleEdit = () => {
    const webSetting = {
        id: webSettingData.id,
        key: webSettingData.key,
        value: webSettingData.value,
        image: webSettingData.image,
        align: webSettingData.align,
    }

    updateWebSetting(webSetting).then(() => {
        editDrawer.value = false
        loadWebSettings(route.fullPath)
    }).catch()

}

const handleDelete = (webSetting_id) => {
    destroyWebSetting(webSetting_id).then(() => {
        loadWebSettings(route.fullPath)
    }).catch()
}

const resetForm = () => {
    webSettingData.key = ''
    webSettingData.value = ''
    webSettingData.image = ''
    webSettingData.align = ''
}

// const filterRole = role_id => webSettings.value = webSettings.value.filter(role => role.id !== role_id)
</script>
