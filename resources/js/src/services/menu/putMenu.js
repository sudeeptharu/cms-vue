import axiosInstance from "../../config/axios/axios.js";

const putMenu = () => {
    const updateMenu = async (Menu) => {

        await axiosInstance
            .put("/api/menu/update", Menu)
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {updateMenu};
};

export default putMenu;
