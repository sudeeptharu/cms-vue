import axiosInstance from "../../config/axios/axios.js";

const putCategory = () => {
    const updateCategory = async (Category) => {

        await axiosInstance
            .put("/api/category/update", Category)
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {updateCategory};
};

export default putCategory;
