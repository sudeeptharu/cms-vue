import axiosInstance from "../../config/axios/axios.js";

const postSlider = () => {
    const addSlider = async (slider) => {
        await axiosInstance
            .post("/api/slider/save", slider)
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {addSlider};
};

export default postSlider;
