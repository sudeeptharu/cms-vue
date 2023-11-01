import {ref} from "vue";
import axiosInstance from "../../config/axios/axios.js";

const getMenus = () => {
    const menus = ref([])
    const loadMenus = async (url = 'api/menu') => {

        await axiosInstance
            .get('api/menu')
            .then((res) => {
                menus.value = res.data.data;
            }).catch((err) => {
                throw err
            });
    };

    return {menus, loadMenus};
};
export default getMenus;
