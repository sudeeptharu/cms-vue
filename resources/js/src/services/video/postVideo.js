import axiosInstance from "../../config/axios/axios.js";

const postVideo = () => {
    const addVideo = async (Video) => {
        await axiosInstance
            .post("/api/video/save", Video)
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {addVideo};
};

export default postVideo;
