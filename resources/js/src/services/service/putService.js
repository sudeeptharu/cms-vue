
import axiosInstance from "../../config/axios/axios.js";

const putService = () => {
    const updateService = async (Service) => {

        await axiosInstance
            .put("/api/service/update", Service)
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {updateService};
};

export default putService;
