import axiosInstance from "../../config/axios/axios.js";

const postMenu = () => {
    const addMenu = async (Menu) => {
        await axiosInstance
            .post("/api/menu/save", Menu)
            .then()
            .catch((err) => {
                throw err;
            });
    };
    return {addMenu};
};

export default postMenu;
