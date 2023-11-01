import axiosInstance from "../../config/axios/axios.js";

const deleteLink = () => {
    const destroyLink = async (link_id) => {
        await axiosInstance
            .get(`api/link/delete/${link_id}`)
            .then()
            .catch((err) => {
                throw err
            });
    };
    return {destroyLink};
};

export default deleteLink;
