import axiosInstance from "../../config/axios/axios.js";

const postWebSetting = () => {
    const addWebSetting = async (webSetting) => {
        await axiosInstance
            .post("/api/webSetting/save", webSetting)
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {addWebSetting};
};

export default postWebSetting;
