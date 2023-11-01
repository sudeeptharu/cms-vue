import axiosInstance from "../../config/axios/axios.js";

const deleteWebSetting = () => {
    const destroyWebSetting = async (webSetting_id) => {
        await axiosInstance
            .get(`api/webSetting/delete/${webSetting_id}`)
            .then()
            .catch((err) => {
                throw err
            });
    };
    return {destroyWebSetting};
};

export default deleteWebSetting;
