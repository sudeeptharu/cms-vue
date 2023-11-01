import axiosInstance from "../../config/axios/axios.js";

const postScroller = () => {
    const addScroller = async (Scroller) => {
        await axiosInstance
            .post("/api/scroller/save", Scroller)
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {addScroller};
};

export default postScroller;
