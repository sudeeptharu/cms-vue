import axiosInstance from "../../config/axios/axios.js";

const deleteService = () => {
    const destroyService = async (service_id) => {
        await axiosInstance
            .get(`api/service/delete/${service_id}`)
            .then()
            .catch((err) => {
                throw err
            });
    };
    return {destroyService};
};

export default deleteService;
