import axiosInstance from "../../config/axios/axios.js";

const postCategory = () => {
    const addCategory = async (Category) => {
        await axiosInstance
            .post("/api/category/save", Category)
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {addCategory};
};

export default postCategory;
