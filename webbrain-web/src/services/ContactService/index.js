import api from ".."

export const registerNewContact = (contact) => {
    return api.post("/registerNewContact.php", contact)
}
export const getContactsList = ({currentPage, perPage, options}) => {
    return api.get("/getContactsList.php",
        {params: {
            page: currentPage,
            per_page: perPage,
            options: options
        }}
    )
}

export const getContactOptions = () => {
    return api.get("/getContactOptions.php")
}