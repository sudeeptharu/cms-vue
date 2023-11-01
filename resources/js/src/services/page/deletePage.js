import axiosInstance from "../../config/axios/axios.js";

const deletePage = () => {
    const destroyPage = async (page_id) => {
        await axiosInstance
            .get(`api/page/delete/${page_id}`)
            .then()
            .catch((err) => {
                throw err
            });
    };
    return {destroyPage};
};

export default deletePage;
