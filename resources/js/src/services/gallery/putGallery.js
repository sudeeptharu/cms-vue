import axiosInstance from "../../config/axios/axios.js";

const putGallery = () => {
    const updateGallery = async (gallery) => {

        await axiosInstance
            .put("/api/gallery/update", gallery)
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {updateGallery};
};

export default putGallery;
