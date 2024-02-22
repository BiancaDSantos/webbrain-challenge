import api from ".."

export const getCompanyInfo = (id) => {
    return api.get(`/company-info/${id}`)
}