import axiosInstance from "../../config/axios/axios.js";

const getPage = () => {
    const getPageById = async (page_id) => {
        console.log(page_id)
        try {
            const response = await axiosInstance.get("/api/page/getPageById/" + page_id);
            console.log(response.data); // Log the data obtained from the API
            return response.data; // Return the data
        } catch (err) {
            throw err;
        }
    };
    console.log(getPageById)

    return {getPageById};
};

export default getPage;
