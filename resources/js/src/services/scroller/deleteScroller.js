import axiosInstance from "../../config/axios/axios.js";

const deleteScroller = () => {
    const destroyScroller = async (scroller_id) => {
        await axiosInstance
            .get(`api/scroller/delete/${scroller_id}`)
            .then()
            .catch((err) => {
                throw err
            });
    };
    return {destroyScroller};
};

export default deleteScroller;
