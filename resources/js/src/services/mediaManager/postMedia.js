import axiosInstance from "../../config/axios/axios.js";

const postMedia = () => {
    const addMedia = async (file) => {
        console.log(file)
        await axiosInstance
            .post("api/mediaManager/uploadMedia")
            .then()
            .catch((err) => {
                throw err;
            });
    };

    return {addMedia};
};

export default postMedia;
