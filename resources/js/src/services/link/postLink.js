import axiosInstance from "../../config/axios/axios.js";

const postLink = () => {
    const addLink = async (Link) => {
        await axiosInstance
            .post("/api/link/save", Link)
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {addLink};
};

export default postLink;
