
import axiosInstance from "../../config/axios/axios.js";

const putPost = () => {
    const updatePost = async (Post) => {

        await axiosInstance
            .put("/api/post/update", Post)
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {updatePost};
};

export default putPost;
