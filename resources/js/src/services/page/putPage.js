
import axiosInstance from "../../config/axios/axios.js";

const putPage = () => {
    const updatePage = async (Page) => {

        await axiosInstance
            .put("/api/page/update", Page)
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {updatePage};
};

export default putPage;
