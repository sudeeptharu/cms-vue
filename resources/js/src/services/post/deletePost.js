import axiosInstance from "../../config/axios/axios.js";

const deletePost = () => {
    const destroyPost = async (post_id) => {
        await axiosInstance
            .get(`api/post/delete/${post_id}`)
            .then()
            .catch((err) => {
                throw err
            });
    };
    return {destroyPost};
};

export default deletePost;
