import axios from 'axios';

const baseURL = '/';

const BaseAxiosInstance = axios.create({ baseURL });

BaseAxiosInstance.interceptors.response.use(
    ({ data }) => data,
    ({ response: { data } }) => {
        return Promise.reject(data);
    },
);

export default BaseAxiosInstance;
