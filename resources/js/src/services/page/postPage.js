import axiosInstance from "../../config/axios/axios.js";

const postPage = () => {
    const addPage = async (page) => {
        await axiosInstance
            .post("/api/page/save", page)
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {addPage};
};

export default postPage;
