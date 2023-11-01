import axiosInstance from "../../config/axios/axios.js";

const postGallery = () => {
    const addGallery = async (gallery) => {
        await axiosInstance
            .post("/api/gallery/save", gallery)
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {addGallery};
};

export default postGallery;
