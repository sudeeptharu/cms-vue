import {ref} from "vue";
import axiosInstance from "../../config/axios/axios.js";

const getSliders = () => {
    const sliders = ref([])
    const loadSliders = async (url = 'api/slider') => {

        await axiosInstance
            .get('api/slider')
            .then((res) => {
                sliders.value = res.data.data;
            }).catch((err) => {
                throw err
            });
    };

    return {sliders, loadSliders};
};
export default getSliders;
