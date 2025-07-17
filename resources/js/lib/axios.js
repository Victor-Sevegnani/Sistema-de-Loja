import Axios from "axios";

const axios = Axios.create({
    withCredentials: true,
    withXSRFToken: true,
    baseURL: "http://localhost:8000"
});

export default axios;