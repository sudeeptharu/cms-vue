<template>
    <el-button @click="openDrag">open</el-button>
    <el-upload class="upload-demo" v-if="showDrag">
        <div class="upload-files">
            <el-icon class="el-icon--upload"><upload-filled /></el-icon>
            <div class="el-upload__text" v-bind="getRootProps()">
                <input v-bind="getInputProps()" />
                <p v-if="isDragActive">Drop the files here ...</p>
                <p v-else>Drag 'n' drop some files here, or click to select files</p>
            </div>
        </div>
    </el-upload>
    <el-row :gutter="20">
        <div v-for="image in images.uploads" :key="image">
            <el-col :span="6"><div class="grid-content ep-bg-purple" />
                <a @click="showImage(image)">
                <el-image
                        style="width: 100px; height: 100px"
                        :zoom-rate="1.2"
                        :max-scale="7"
                        :min-scale="0.2"
                        :initial-index="4"
                        fit="cover"
                        :src="getImageUrl(image)"
                        alt="Image" class="imageThumbnail" /></a>
            </el-col>
        </div>
    </el-row>
    <el-dialog v-model="visible" :show-close="false">
        <template #header="{ close, titleId, titleClass }">
            <div class="my-header">
                <h4 :id="titleId" :class="titleClass">File:{{selectedImage}}</h4>
                <el-button type="danger" @click="close">
                    <el-icon class="el-icon--left"><CircleCloseFilled /></el-icon>
                    Close
                </el-button>
            </div>
        </template>
        <el-row :gutter="20">
            <el-col :span="14">
                <el-image
                    style="width: 100%; "
                    :zoom-rate="1.2"
                    :max-scale="7"
                    :min-scale="0.2"
                    :initial-index="4"
                    fit="cover"
                    :src="getImageUrl(selectedImage)"
                    alt="Image" class="imageThumbnail" />
            </el-col>
            <el-col :span="10">
                <el-form>
                    <el-form-item label="File Name">
                        <el-input v-model="selectedImage"></el-input>
                    </el-form-item>
                    <el-form-item label="Url">
                        <el-input v-model="imgUrl"></el-input>
                    </el-form-item>
                    <el-form-item label="Caption">
                        <el-input ></el-input>
                    </el-form-item>
                </el-form>

            </el-col>
        </el-row>
        <template #footer>
            <div class="footer">
                <el-button type="primary" >
                    <el-icon class="el-icon--left"><CircleCloseFilled /></el-icon>
                    Download
                </el-button>
                <el-button type="danger" @click="deleteFile(selectedImage)">
                    <el-icon class="el-icon--left"><CircleCloseFilled /></el-icon>
                    Delete
                </el-button>
                <el-button type="danger" @click="visible = false">
                    <el-icon class="el-icon--left"><CircleCloseFilled /></el-icon>
                    Close
                </el-button>

            </div>
        </template>
    </el-dialog>

</template>

<script>
import { useDropzone } from "vue3-dropzone";
import axios from "axios";
import {CircleCloseFilled, UploadFilled} from "@element-plus/icons-vue";
import {ref, onMounted} from "vue";
import { ElButton, ElDialog } from 'element-plus'

const visible = ref(false)
const showDrag = ref(false)
const selectedImage=ref('')
const imgUrl=ref('')

export default {
    name: "UseDropzoneDemo",
    components: {CircleCloseFilled, UploadFilled},
    setup() {
        const url = "api/mediaManager/uploadMedia"; // Your url on the server side
        const images = ref({uploads:[]});
        const fetchImages = () => {
            console.log("akjshd");
            axios
                .get("api/mediaManager/image") // Replace with the actual endpoint
                .then((response) => {
                    images.value = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
            console.log(getImageUrl(images))
            console.log("akjshd");
        };
        const saveFiles = (files) => {
            console.log(files)
            const formData = new FormData(); // pass data as a form
            for (var x = 0; x < files.length; x++) {
                // append files as array to the form, feel free to change the array name
                formData.append("images[]", files[x]);
            }
            console.log(formData.get("images[]"));
            // post the formData to your backend where storage is processed. In the backend, you will need to loop through the array and save each file through the loop.
            axios
                .post(url, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    console.info(response.data);
                    fetchImages()
                })
                .catch((err) => {
                    console.error(err);
                });
        };
        const deleteFile = (file) =>{
            axios
                .get('/api/mediaManager/destroyImage/'+file)
                .then((response)=>{
                    console.log("file deleted successfully")
                })
                .catch((err)=>{
                    console.error(err)
                })
            visible.value=false
            fetchImages();
        }
        function onDrop(acceptFiles, rejectReasons) {
            saveFiles(acceptFiles); // saveFiles as callback
            console.log(rejectReasons);
        }
        const { getRootProps, getInputProps, ...rest } = useDropzone({ onDrop });
        onMounted(() => {
            fetchImages();
        });
        const getImageUrl = (fileName) => {
            // Assuming the images are stored in the public directory
            imgUrl.value=`/storage/uploads/${fileName}`
            return `/storage/uploads/${fileName}`;
        };
        function showImage(image){
             selectedImage.value=image
            visible.value = true
        }
        const openDrag =()=>{
            showDrag.value=!showDrag.value
        }
        return {
            getRootProps,
            getInputProps,
            ...rest,
            images,
            showImage,
            getImageUrl,
            visible,
            selectedImage,
            deleteFile,
            imgUrl,
            openDrag,
            showDrag
        };
    },
};
</script>
<style>
el-row {
    margin-bottom: 20px;
}
.el-row:last-child {
    margin-bottom: 0;
}
.el-col {
    border-radius: 4px;
}

.grid-content {
    border-radius: 4px;
    min-height: 36px;
}
a{
    cursor: pointer;
}
.my-header {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}
.upload-demo{
    border: 1px dashed #ccc; /* Add a dashed border */
    text-align: center; /* Center the content */
    padding: 20px; /* Add padding for better styling */
}
.upload-files{
    display: flex;
    flex-direction: column;
    align-items: center;
}
</style>
