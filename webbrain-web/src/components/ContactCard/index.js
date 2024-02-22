import { format } from "date-fns";
import { Card } from "react-bootstrap";


const ContactCard = ({contact, getOptionDescription}) => {
    return (
        <Card>
            <Card.Body>
                <Card.Title>
                    {
                        contact.options?.map(getOptionDescription).join(" | ")
                    }
                </Card.Title>
                <blockquote className="blockquote mb-0">
                    <Card.Text>
                        {contact.message}
                    </Card.Text>
                    <footer className="blockquote-footer">
                        {contact.name} <br/>
                        Email: {contact.email}<br/>
                        Data de nascimento: 
                        {contact.birthDate ? format(contact.birthDate, " dd/MM/yyyy"): ""}<br/>
                        WhatsApp: {contact.whatsApp} Telefone: {contact.phone}
                    </footer>
                    <Card.Footer className="text-muted">
                        {contact.createdAt ? format(contact.createdAt, "dd/MM/yyyy HH:mm"): ""}
                    </Card.Footer>
                </blockquote>
            </Card.Body>
        </Card>
    )
}

export default ContactCard;