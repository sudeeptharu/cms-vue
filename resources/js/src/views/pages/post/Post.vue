<template>
    <el-container>
        <el-row class="row" >
            <el-col :span="12" >
                <el-button @click="addDrawer = true">Add post</el-button>
            </el-col>
            <!--            <el-col :span="12">-->
            <!--                <el-input v-model="search" size="small" placeholder="Type to search" />-->
            <!--            </el-col>-->
        </el-row>
    </el-container>
    <el-table :data="posts" style="width: 100%">
        <el-table-column label="Title" prop="title" />
        <el-table-column label="SubTitle" prop="subtitle" />
        <el-table-column label="Description" prop="description" />
        <el-table-column label="Quote" prop="quote" />
        <el-table-column label="excerpt" prop="excerpt" />
        <el-table-column label="image" prop="image" />
        <el-table-column label="draft" prop="draft" />
        <el-table-column label="Action" prop="action">
            <template #default="scope">
                <el-button
                    @click="postData.id = scope.row.id;
                    postData.title = scope.row.title;
                    postData.subtitle = scope.row.subtitle;
                    postData.description = scope.row.description;
                    postData.quote = scope.row.quote;
                    postData.excerpt = scope.row.excerpt;
                    postData.image = scope.row.image;
                    postData.draft = scope.row.draft;
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

    <el-drawer v-model="editDrawer" title="Edit post" @keyup.enter="handleEdit" direction="rtl">

        <el-form :form="postData" label-position="top">

            <el-form-item label="Title" required>
                <el-input v-model="postData.title" placeholder="Title" clearable/>
            </el-form-item>
            <el-form-item label="SubTitle" required>
                <el-input v-model="postData.subtitle" placeholder="SubTitle" clearable/>
            </el-form-item>
            <el-form-item label="Excerpt" required>
                <el-input v-model="postData.excerpt" placeholder="Excerpt" clearable/>
            </el-form-item>
            <el-form-item label="Description" required>
                <el-input v-model="postData.description" placeholder="Description" clearable/>
            </el-form-item>
            <el-form-item label="image" required>
                <el-input v-model="postData.image" placeholder="image" clearable/>
            </el-form-item>
            <el-form-item label="quote" required>
                <el-input v-model="postData.quote" placeholder="quote" clearable/>
            </el-form-item>
            <el-form-item label="draft" required>
                <el-input v-model="postData.draft" placeholder="draft" clearable/>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="handleEdit">Update</el-button>
                <el-button @click="editDrawer = false">Cancel</el-button>
            </el-form-item>

        </el-form>
    </el-drawer>

    <el-drawer
        v-model="addDrawer"
        title="Add post"
        @keyup.enter="handleAdd"
        @open="resetForm"
        direction="rtl" >

        <el-form :form="postData" label-position="top">

            <el-form-item label="Title" required>
                <el-input v-model="postData.title" placeholder="Title" clearable/>
            </el-form-item>
            <el-form-item label="SubTitle" required>
                <el-input v-model="postData.subtitle" placeholder="SubTitle" clearable/>
            </el-form-item>
            <el-form-item label="Excerpt" required>
                <el-input v-model="postData.excerpt" placeholder="Excerpt" clearable/>
            </el-form-item>
            <el-form-item label="Description" required>
                <el-input v-model="postData.description" placeholder="Description" clearable/>
            </el-form-item>
            <el-form-item label="image" required>
                <el-input v-model="postData.image" placeholder="image" clearable/>
            </el-form-item>
            <el-form-item label="quote" required>
                <el-input v-model="postData.quote" placeholder="quote" clearable/>
            </el-form-item>
            <el-form-item label="draft" required>
                <el-checkbox v-model="postData.draft" clearable/>
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
import getPosts from "../../../services/post/getPosts.js";
import postPost from "../../../services/post/postPost.js";
import putPost from "../../../services/post/putPost.js";
import deletePost from "../../../services/post/deletePost.js";
import {Delete, EditPen} from "@element-plus/icons-vue";


const centerDialogVisible = ref(false)
const {posts,loadPosts} = getPosts()
console.log(posts);
const {addPost} = postPost()
const {updatePost} = putPost()
const {destroyPost} = deletePost()
const router = useRouter()
const route = useRoute()

const addDrawer = ref(false)
const editDrawer = ref(false)
const postData = reactive({
    id: '',
    title: '',
    subtitle:'',
    excerpt:'',
    quote:'',
    image:'',
    description:'',
    draft:''
})

onMounted(() => {
    loadPosts()
})

const handleAdd = () => {
    const post = {
        title: postData.title,
        subtitle: postData.subtitle,
        excerpt: postData.excerpt,
        description: postData.description,
        quote: postData.quote,
        image: postData.image,
        draft: postData.draft,
    }

    addPost(post).then(() => {
        addDrawer.value = false
        resetForm()
        loadPosts(route.fullPath)

    }).catch()
}

const handleEdit = () => {
    const post = {
        id: postData.id,
        title: postData.title,
        subtitle: postData.subtitle,
        excerpt: postData.excerpt,
        description: postData.description,
        quote: postData.quote,
        image: postData.image,
        draft: postData.draft,
    }

    updatePost(post).then(() => {
        editDrawer.value = false
        loadPosts(route.fullPath)
    }).catch()

}

const handleDelete = (post_id) => {
    destroyPost(post_id).then(() => {
        loadPosts(route.fullPath)
    }).catch()
}

const resetForm = () => {
    postData.title = ''
    postData.subtitle = ''
    postData.excerpt = ''
    postData.draft = ''
    postData.description = ''
    postData.image = ''
    postData.quote = ''

}

// const filterRole = role_id => posts.value = posts.value.filter(role => role.id !== role_id)
</script>
