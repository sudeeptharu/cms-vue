import axiosInstance from "../../config/axios/axios.js";

const postService = () => {
    const addService = async (Service) => {
        await axiosInstance
            .post("/api/service/save", Service)
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {addService};
};

export default postService;
