
import axiosInstance from "../../config/axios/axios.js";

const putVideo = () => {
    const updateVideo = async (Video) => {

        await axiosInstance
            .put("/api/video/update", Video)
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {updateVideo};
};

export default putVideo;
