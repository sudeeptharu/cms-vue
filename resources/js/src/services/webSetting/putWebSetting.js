
import axiosInstance from "../../config/axios/axios.js";

const putWebSetting = () => {
    const updateWebSetting = async (WebSetting) => {

        await axiosInstance
            .put("/api/webSetting/update", WebSetting)
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {updateWebSetting};
};

export default putWebSetting;
