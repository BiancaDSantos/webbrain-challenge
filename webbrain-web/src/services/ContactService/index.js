import api from ".."

export const registerNewContact = (contact) => {
    return api.post("/contact", contact)
}
export const getContactsList = ({currentPage, perPage, options}) => {
    return api.get("/contact",
        {params: {
            page: currentPage,
            per_page: perPage,
            options: options
        }}
    )
}

export const getContactOptions = () => {
    return api.get("/contact_option")
}