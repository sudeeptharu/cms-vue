import {ref} from "vue";
import axiosInstance from "../../config/axios/axios.js";

const getPosts = () => {
    const posts = ref([])
    const loadPosts = async (url = 'api/post') => {

        await axiosInstance
            .get('api/post')
            .then((res) => {
                posts.value = res.data.data;
            }).catch((err) => {
                throw err
            });
    };

    return {posts, loadPosts};
};
export default getPosts;
