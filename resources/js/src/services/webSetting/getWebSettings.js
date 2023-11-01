import {ref} from "vue";
import axiosInstance from "../../config/axios/axios.js";

const getWebSettings = () => {
    const WebSettings = ref([])
    const loadWebSettings = async (url = 'api/webSetting') => {

        await axiosInstance
            .get('api/webSetting')
            .then((res) => {
                WebSettings.value = res.data.data;
            }).catch((err) => {
                throw err
            });
    };

    return {WebSettings, loadWebSettings};
};
export default getWebSettings;
