import {ref} from "vue";
import axiosInstance from "../../config/axios/axios.js";

const getPages = () => {
    const pages = ref([])
    const loadPages = async (url = 'api/page') => {

        await axiosInstance
            .get('api/page')
            .then((res) => {
                pages.value = res.data.data;
            }).catch((err) => {
                throw err
            });
    };

    return {pages, loadPages};
};
export default getPages;
