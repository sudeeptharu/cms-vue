
import axiosInstance from "../../config/axios/axios.js";

const putSlider = () => {
    const updateSlider = async (Slider) => {

        await axiosInstance
            .put("/api/slider/update", Slider)
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {updateSlider};
};

export default putSlider;
