import axiosInstance from "../../config/axios/axios.js";

const deleteGallery = () => {
    const destroyGallery = async (gallery_id) => {
        await axiosInstance
            .get(`api/gallery/delete/${gallery_id}`)
            .then()
            .catch((err) => {
                throw err
            });
    };
    return {destroyGallery};
};

export default deleteGallery;
