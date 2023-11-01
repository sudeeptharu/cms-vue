import {ref} from "vue";
import axiosInstance from "../../config/axios/axios.js";

const getServices = () => {
    const Services = ref([])
    const loadServices = async (url = 'api/service') => {

        await axiosInstance
            .get('api/service')
            .then((res) => {
                Services.value = res.data.data;
            }).catch((err) => {
                throw err
            });
    };

    return {Services, loadServices};
};
export default getServices;
