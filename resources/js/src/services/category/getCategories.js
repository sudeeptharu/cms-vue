import {ref} from "vue";
import axiosInstance from "../../config/axios/axios.js";

const getCategories = () => {
    const categories = ref([])
    const loadCategories = async (url = 'api/category') => {

        await axiosInstance
            .get('api/category')
            .then((res) => {
                categories.value = res.data.data;
            }).catch((err) => {
                throw err
            });
    };

    return {categories, loadCategories};
};
export default getCategories;
