import axiosInstance from "../../config/axios/axios.js";

const putLink = () => {
    const updateLink = async (Link) => {

        await axiosInstance
            .put("/api/link/update", Link)
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {updateLink};
};

export default putLink;
