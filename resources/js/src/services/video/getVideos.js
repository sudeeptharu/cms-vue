import {ref} from "vue";
import axiosInstance from "../../config/axios/axios.js";

const getVideos = () => {
    const Videos = ref([])
    const loadVideos = async (url = 'api/video') => {

        await axiosInstance
            .get('api/video')
            .then((res) => {
                Videos.value = res.data.data;
            }).catch((err) => {
                throw err
            });
    };

    return {Videos, loadVideos};
};
export default getVideos;
