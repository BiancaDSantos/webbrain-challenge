import React from "react";
import { Col, Row } from "react-bootstrap";
import CompanyInformation from "../../components/CompanyInformation"
import ContactForm  from "../../components/ContactForm"

const ContactFormPage = () => {

    return (
        <Row>
            <Col className='mb-3 pr-md-2 gap-2' xs={12} md={6}>
                <CompanyInformation companyId={1}/>
            </Col>
            <Col className='mb-3 mb-3 pr-md-2 gap-2' xs={12} md={6}>
                <ContactForm />
            </Col>
        </Row>
    )
}

export default ContactFormPage;