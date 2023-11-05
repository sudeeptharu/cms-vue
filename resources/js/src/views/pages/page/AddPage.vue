<template>
    <el-form  :model="pageData" ref="registrationRef" label-position="top">

        <el-row :gutter="20">

            <el-col :sm="24" :md="16">
                <el-form-item label="Title No." prop="title">
                    <el-input type="text" v-model="pageData.title" clearable/>
                </el-form-item>
                <el-form-item label="Subtitle" prop="subTitle">
                    <el-input type="text" v-model="pageData.subtitle" placeholder="sub title"  clearable/>
                </el-form-item>
                <el-form-item label="Slug" prop="slug">
                    <el-input type="text" v-model="pageData.slug" clearable/>
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
            </el-col>

            <el-col :sm="24" :md="8" :xl="3">
                <el-card class="box-card">
                    <template #header>
                        <div class="card-header">
                            <span>Status</span>
                        </div>
                    </template>
                    <el-form-item label="draft" >
                        <el-checkbox v-model="pageData.draft" clearable/>
                    </el-form-item>
                    <el-button type="primary" @click="handleAdd" class="btn-publish">Publish</el-button>
                </el-card>
                <el-card class="box-card">
                    <template #header>
                        <div class="card-header">
                            <span>Featured Image</span>
                        </div>
                    </template>

                        <el-image
                            style="width: 100px; height: 100px"
                            :zoom-rate="1.2"
                            :max-scale="7"
                            :min-scale="0.2"
                            :initial-index="4"
                            fit="cover"
                            :src="selectedImageUrl"
                            alt="Image"
                            class="imageThumbnail"
                            v-model="imageVisible"
                        />
                    <a @click="mediaList" >click here to choose image</a>
                </el-card>
            </el-col>
        </el-row>

    </el-form>

    <el-dialog v-model="outerVisible" title="Outer">
            <el-row :gutter="20">
                <div v-for="(url, index) in imageUrl" :key="index">
                    <el-col :span="6">
                        <div class="grid-content ep-bg-purple" />
                        <a @click="selectedImage(url)">
                            <el-image
                                style="width: 100px; height: 100px"
                                :zoom-rate="1.2"
                                :max-scale="7"
                                :min-scale="0.2"
                                :initial-index="4"
                                fit="cover"
                                :src="url"
                                alt="Image"
                                class="imageThumbnail"
                            />
                        </a>
                    </el-col>
                </div>
            </el-row>

        <template #footer>
            <div class="dialog-footer">
                <el-button @click="outerVisible = false">Cancel</el-button>
            </div>
        </template>
    </el-dialog>



</template>
<script setup>
import { reactive, ref} from "vue";
import axios from "axios";
const outerVisible = ref(false)
const imageVisible = ref(false)
const images = ref({uploads:[]});
const imageUrl=ref(['']);
const selectedImageUrl=ref(['']);
import postPage from "../../../services/page/postPage.js";
import router from "../../../router/index.js";
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
const {addPage} = postPage()

const fetchImages = () => {
    console.log("akjshd");
    axios
        .get("/api/mediaManager/image") // Replace with the actual endpoint
        .then((response) => {
            console.log(response.data)
            imageUrl.value = response.data.uploads.map(fileName => `/storage/uploads/${fileName}`);
            console.log(imageUrl.value)
        })
        .catch((error) => {
            console.error(error);
        });

};


const mediaList = () =>{
    fetchImages();
    outerVisible.value=true

}
const selectedImage=(url)=>{
    outerVisible.value=false
    selectedImageUrl.value=url
    pageData.image=url
    imageVisible.value= true
}

// function getImageUrl(fileName){
//     // Assuming the images are stored in the public directory
//     imageUrl.value=`/storage/uploads/${fileName}`
//     console.log(imageUrl.value)
//     return `/storage/uploads/${fileName}`;
// }
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
        router.push({name: 'page'})
        resetForm()

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
</script>
<style scoped>
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.box-card {
    width: 100%;
}
.btn-publish{
    width: 100%;
}
a{
    cursor: pointer;
}
</style>
