import axiosInstance from "../../config/axios/axios.js";

const postPost = () => {
    const addPost = async (Post) => {
        await axiosInstance
            .post("/api/post/save", Post)
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {addPost};
};

export default postPost;
