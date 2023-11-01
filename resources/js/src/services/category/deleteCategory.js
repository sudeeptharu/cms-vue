import axiosInstance from "../../config/axios/axios.js";

const deleteCategory = () => {
    const destroyCategory = async (category_id) => {
        await axiosInstance
            .get(`api/category/delete/${category_id}`)
            .then()
            .catch((err) => {
                throw err
            });
    };
    return {destroyCategory};
};

export default deleteCategory;
