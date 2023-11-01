import axiosInstance from "../../config/axios/axios.js";

const deleteSlider = () => {
    const destroySlider = async (slider_id) => {
        await axiosInstance
            .get(`api/slider/delete/${slider_id}`)
            .then()
            .catch((err) => {
                throw err
            });
    };
    return {destroySlider};
};

export default deleteSlider;
