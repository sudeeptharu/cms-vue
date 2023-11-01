
import axiosInstance from "../../config/axios/axios.js";

const putScroller = () => {
    const updateScroller = async (Scroller) => {

        await axiosInstance
            .put("/api/scroller/update", Scroller)
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {updateScroller};
};

export default putScroller;
