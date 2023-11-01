import {ref} from "vue";
import axiosInstance from "../../config/axios/axios.js";

const getGalleries = () => {
    const galleries = ref([])
    const loadGalleries = async (url = 'api/gallery') => {

        await axiosInstance
            .get('api/gallery')
            .then((res) => {
                galleries.value = res.data.data;
            }).catch((err) => {
                throw err
            });
    };

    return {galleries, loadGalleries};
};
export default getGalleries;
