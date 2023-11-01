
import axiosInstance from "../../config/axios/axios.js";

const deleteMenu = () => {
    const destroyMenu = async (menu_id) => {
        await axiosInstance
            .get(`api/menu/delete/${menu_id}`)
            .then()
            .catch((err) => {
                throw err
            });
    };
    return {destroyMenu};
};

export default deleteMenu;
