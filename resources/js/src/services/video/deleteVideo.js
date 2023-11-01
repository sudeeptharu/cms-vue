import axiosInstance from "../../config/axios/axios.js";

const deleteVideo = () => {
    const destroyVideo = async (video_id) => {
        await axiosInstance
            .get(`api/video/delete/${video_id}`)
            .then()
            .catch((err) => {
                throw err
            });
    };
    return {destroyVideo};
};

export default deleteVideo;
