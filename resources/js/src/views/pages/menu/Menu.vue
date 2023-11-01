<template>
    <el-container>
        <el-row class="row" >
            <el-col :span="12" >
                <el-button @click="addDrawer = true">Add Menu</el-button>
            </el-col>
            <!--            <el-col :span="12">-->
            <!--                <el-input v-model="search" size="small" placeholder="Type to search" />-->
            <!--            </el-col>-->
        </el-row>
    </el-container>
    <el-table :data="menus" style="width: 100%">
        <el-table-column label="Title" prop="title" />
        <el-table-column label="Order" prop="order" />
        <el-table-column label="URL" prop="url" />
        <el-table-column label="is_published" prop="is_published" />
        <el-table-column label="opens_in_new_tab" prop="opens_in_new_tab" />
        <el-table-column label="parent_id" prop="parent_id" />
        <el-table-column label="Action" prop="action">
            <template #default="scope">
                <el-button
                    @click="menuData.id = scope.row.id;
                    menuData.title = scope.row.title;
                    menuData.order = scope.row.order;
                    menuData.url = scope.row.url;
                    menuData.is_published = scope.row.is_published;
                    menuData.opens_in_new_tab = scope.row.opens_in_new_tab;
                    menuData.parent_id = scope.row.parent_id;
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

    <el-drawer v-model="editDrawer" title="Edit Menu" @keyup.enter="handleEdit" direction="rtl">

        <el-form :form="menuData" label-position="top">

            <el-form-item label="Title" required>
                <el-input v-model="menuData.title" placeholder="Title" clearable/>
            </el-form-item>
            <el-form-item label="Url" required>
                <el-input v-model="menuData.url" placeholder="url" clearable/>
            </el-form-item>
            <el-form-item label="order" required>
                <el-input-number v-model="menuData.order" placeholder="Order" clearable/>
            </el-form-item>
            <el-form-item label="parent_id" >
                <el-select v-model="menuData.parent_id" placeholder="Select">
                    <el-option
                        v-for="menu in menus"
                        :value="menu.id" :key="menu.id"
                    />
                </el-select>
            </el-form-item>

            <el-form-item label="is_published" >
                <el-checkbox v-model="menuData.is_published" clearable/>
            </el-form-item>
            <el-form-item label="opens_in_new_tab" >
                <el-checkbox v-model="menuData.opens_in_new_tab" clearable/>
            </el-form-item>

            <el-form-item>
                <el-button type="primary" @click="handleEdit">Update</el-button>
                <el-button @click="editDrawer = false">Cancel</el-button>
            </el-form-item>

        </el-form>
    </el-drawer>

    <el-drawer
        v-model="addDrawer"
        title="Add Menu"
        @keyup.enter="handleAdd"
        @open="resetForm"
        direction="rtl" >

        <el-form :form="menuData" label-position="top">

            <el-form-item label="Title" required>
                <el-input v-model="menuData.title" placeholder="Title" clearable/>
            </el-form-item>
            <el-form-item label="Url" required>
                <el-input v-model="menuData.url" placeholder="url" clearable/>
            </el-form-item>
            <el-form-item label="order" required>
                <el-input v-model="menuData.order" placeholder="Order" clearable/>
            </el-form-item>
            <el-form-item label="parent_id" >
                <el-select v-model="menuData.parent_id" placeholder="Select">
                    <el-option
                        v-for="menu in menus"
                        :value="menu.id" :key="menu.id"
                    />
                </el-select>
            </el-form-item>

            <el-form-item label="is_published" >
                <el-checkbox v-model="menuData.is_published" clearable/>
            </el-form-item>
            <el-form-item label="opens_in_new_tab" >
                <el-checkbox v-model="menuData.opens_in_new_tab" clearable/>
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
import getMenus from "../../../services/menu/getMenus.js";
import postMenu from "../../../services/menu/postMenu.js";
import putMenu from "../../../services/menu/putMenu.js";
import deleteMenu from "../../../services/menu/deleteMenu.js";
import {Delete, EditPen} from "@element-plus/icons-vue";


const centerDialogVisible = ref(false)
const {menus,loadMenus} = getMenus()
const {addMenu} = postMenu()
const {updateMenu} = putMenu()
const {destroyMenu} = deleteMenu()
const router = useRouter()
const route = useRoute()

const addDrawer = ref(false)
const editDrawer = ref(false)
const menuData = reactive({
    id: '',
    title: '',
    order: '',
    url:'',
    is_published:'',
    opens_in_new_tab:'',
    parent_id:''
})

onMounted(() => {
    loadMenus()

})

const handleAdd = () => {
    const menu = {
        title: menuData.title,
        url: menuData.url,
        order:menuData.order,
        is_published:menuData.is_published,
        opens_in_new_tab: menuData.opens_in_new_tab,
        parent_id:menuData.parent_id
    }
    console.log('sakjn.')
    console.log(menu)

    addMenu(menu).then(() => {
        addDrawer.value = false
        resetForm()
        loadMenus(route.fullPath)

    }).catch()
}

const handleEdit = () => {
    const menu = {
        id: menuData.id,
        title: menuData.title,
        url: menuData.url,
        order:menuData.order,
        is_published:menuData.is_published,
        opens_in_new_tab: menuData.opens_in_new_tab,
        parent_id:menuData.parent_id
    }

    updateMenu(menu).then(() => {
        editDrawer.value = false
        loadMenus(route.fullPath)
    }).catch()
}

const handleDelete = (menu_id) => {
    destroyMenu(menu_id).then(() => {
        loadMenus(route.fullPath)
    }).catch()
}

const resetForm = () => {
    menuData.title = ''
    menuData.url = ''
    menuData.order = ''
    menuData.is_published = ''
    menuData.opens_in_new_tab = ''
    menuData.parent_id = ''
}

// const filterRole = role_id => menus.value = menus.value.filter(role => role.id !== role_id)
</script>
