import {ref} from "vue";
import axiosInstance from "../../config/axios/axios.js";

const getScrollers = () => {
    const Scrollers = ref([])
    const loadScrollers = async (url = 'api/scroller') => {

        await axiosInstance
            .get('api/scroller')
            .then((res) => {
                Scrollers.value = res.data.data;
            }).catch((err) => {
                throw err
            });
    };

    return {Scrollers, loadScrollers};
};
export default getScrollers;
