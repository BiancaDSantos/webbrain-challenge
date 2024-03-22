import axios from "../"

export const getCompanyInfo = (id) => {
    return axios.get(`getCompanyInfo.php?id=${id}`)
}