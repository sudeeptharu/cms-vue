import {ref} from "vue";
import axiosInstance from "../../config/axios/axios.js";

const getLinks = () => {
    const links = ref([])
    const loadLinks = async (url = 'api/link') => {

        await axiosInstance
            .get('api/link')
            .then((res) => {
                links.value = res.data.data;
            }).catch((err) => {
                throw err
            });
    };

    return {links, loadLinks};
};
export default getLinks;
