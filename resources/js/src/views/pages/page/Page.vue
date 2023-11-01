<template>
    <el-container>
        <el-row class="row" >
            <el-col :span="12" >
                <el-button @click="addDrawer = true">Add Page</el-button>
            </el-col>
            <!--            <el-col :span="12">-->
            <!--                <el-input v-model="search" size="small" placeholder="Type to search" />-->
            <!--            </el-col>-->
        </el-row>
    </el-container>
    <el-table :data="pages" style="width: 100%">
        <el-table-column label="Title" prop="title" />
        <el-table-column label="SubTitle" prop="subtitle" />
        <el-table-column label="Description" prop="description" />
        <el-table-column label="Quote" prop="quote" />
        <el-table-column label="excerpt" prop="excerpt" />
        <el-table-column label="image" prop="image" />
        <el-table-column label="draft" prop="draft" />
        <el-table-column label="slug" prop="slug" />
        <el-table-column label="Action" prop="action">
            <template #default="scope">
                <el-button
                    @click="pageData.id = scope.row.id;
                    pageData.title = scope.row.title;
                    pageData.subtitle = scope.row.subtitle;
                    pageData.description = scope.row.description;
                    pageData.quote = scope.row.quote;
                    pageData.excerpt = scope.row.excerpt;
                    pageData.image = scope.row.excerpt;
                    pageData.draft = scope.row.draft;
                    pageData.slug = scope.row.slug;
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

    <el-drawer v-model="editDrawer" title="Edit Page" @keyup.enter="handleEdit" direction="rtl">

        <el-form :form="pageData" label-position="top">

            <el-form-item label="Title" required>
                <el-input v-model="pageData.title" placeholder="Title" clearable/>
            </el-form-item>
            <el-form-item label="SubTitle" required>
                <el-input v-model="pageData.subtitle" placeholder="SubTitle" clearable/>
            </el-form-item>
            <el-form-item label="Excerpt" required>
                <el-input v-model="pageData.excerpt" placeholder="Excerpt" clearable/>
            </el-form-item>
            <el-form-item label="Description" required>
            <el-input v-model="pageData.description" placeholder="Description" clearable/>
        </el-form-item>
            <el-form-item label="slug" required>
            <el-input v-model="pageData.slug" placeholder="slug" clearable/>
        </el-form-item>
            <el-form-item label="image" required>
            <el-input v-model="pageData.image" placeholder="image" clearable/>
        </el-form-item>
            <el-form-item label="quote" required>
                <el-input v-model="pageData.quote" placeholder="quote" clearable/>
            </el-form-item>
            <el-form-item label="draft" required>
                <el-input v-model="pageData.draft" placeholder="draft" clearable/>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="handleEdit">Update</el-button>
                <el-button @click="editDrawer = false">Cancel</el-button>
            </el-form-item>

        </el-form>
    </el-drawer>

    <el-drawer
        v-model="addDrawer"
        title="Add Page"
        @keyup.enter="handleAdd"
        @open="resetForm"
        direction="rtl" >

        <el-form :form="pageData" label-position="top">

            <el-form-item label="Title" required>
                <el-input v-model="pageData.title" placeholder="Title" clearable/>
            </el-form-item>
            <el-form-item label="SubTitle" required>
                <el-input v-model="pageData.subtitle" placeholder="SubTitle" clearable/>
            </el-form-item>
            <el-form-item label="Excerpt" required>
                <el-input v-model="pageData.excerpt" placeholder="Excerpt" clearable/>
            </el-form-item>
            <el-form-item label="Description" required>
                <el-input v-model="pageData.description" placeholder="Description" clearable/>
            </el-form-item>
            <el-form-item label="slug" required>
                <el-input v-model="pageData.slug" placeholder="slug" clearable/>
            </el-form-item>
            <el-form-item label="image" required>
                <el-input v-model="pageData.image" placeholder="image" clearable/>
            </el-form-item>
            <el-form-item label="quote" required>
                <el-input v-model="pageData.quote" placeholder="quote" clearable/>
            </el-form-item>
            <el-form-item label="draft" required>
                <el-checkbox v-model="pageData.draft" clearable/>
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
import getPages from "../../../services/page/getPages.js";
import postPage from "../../../services/page/postPage.js";
import putPage from "../../../services/page/putPage.js";
import deletePage from "../../../services/page/deletePage.js";
import {Delete, EditPen} from "@element-plus/icons-vue";


const centerDialogVisible = ref(false)
const {pages,loadPages} = getPages()
console.log(pages);
const {addPage} = postPage()
const {updatePage} = putPage()
const {destroyPage} = deletePage()
const router = useRouter()
const route = useRoute()

const addDrawer = ref(false)
const editDrawer = ref(false)
const pageData = reactive({
    id: '',
    title: '',
    subtitle:'',
    excerpt:'',
    quote:'',
    image:'',
    description:'',
    slug:'',
    draft:''
})

onMounted(() => {
    loadPages()
})

const handleAdd = () => {
    const page = {
        title: pageData.title,
        subtitle: pageData.subtitle,
        excerpt: pageData.excerpt,
        slug: pageData.slug,
        description: pageData.description,
        quote: pageData.quote,
        image: pageData.image,
        draft: pageData.draft,
    }

    addPage(page).then(() => {
        addDrawer.value = false
        resetForm()
        loadPages(route.fullPath)

    }).catch()
}

const handleEdit = () => {
    const Page = {
        id: pageData.id,
        title: pageData.title,
        subtitle: pageData.subtitle,
        excerpt: pageData.excerpt,
        slug: pageData.slug,
        description: pageData.description,
        quote: pageData.quote,
        image: pageData.image,
        draft: pageData.draft,
    }

    updatePage(Page).then(() => {
        editDrawer.value = false
        loadPages(route.fullPath)
    }).catch()

}

const handleDelete = (page_id) => {
    destroyPage(page_id).then(() => {
        loadPages(route.fullPath)
    }).catch()
}

const resetForm = () => {
    pageData.title = ''
    pageData.subtitle = ''
    pageData.excerpt = ''
    pageData.slug = ''
    pageData.draft = ''
    pageData.description = ''
    pageData.image = ''
    pageData.quote = ''

}

// const filterRole = role_id => pages.value = pages.value.filter(role => role.id !== role_id)
</script>
