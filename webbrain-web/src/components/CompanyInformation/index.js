import { Col, Container, Row } from 'react-bootstrap'
import WhatsAppLink from '../WhatsAppLink'
import Map from '../Map'
import { useEffect, useState } from 'react'
import { getCompanyInfo } from "../../services/CompanyService"


const CompanyInformation = ({companyId}) => {

    const [company, setCompany] = useState({});
    
    useEffect(() => {
       getCompanyInfo(companyId).then(response => {
            setCompany(JSON.parse(response.request.response))
        }).catch(error => {
            alert(JSON.parse(error.request.response).message)
        })     
    }, [companyId])

    return (
        <Container>
            <h1>{company.name}</h1>
            <h2>Entre em contato conosco</h2>
            <h5>Horário de atendimento</h5>
            <p>{company.OfficeHours}</p>
            <Row >
                <Col xs={12} md={5} lg={4} >
                    <h5>Telefone</h5>
                    <p>{company.numberPhone}</p>
                </Col>
                <Col className='pe-0' xs={5} md={5} lg={4}>
                    <h5>WhatsApp</h5>
                    <p>{company.whatsapp}</p>
                </Col>
                <Col className='ps-0' xs={4} md={2}>
                    <WhatsAppLink phone={company.whatsappLink} />
                </Col>
            </Row>
            <h5>Endereço</h5>
            <address>
                <span>
                    {`Logradouro: ${company.street}`} <br />
                    {`Bairro: ${company.district}`} <br />
                    {`Cidade: ${company.city} / ${company.state}`} <br />
                    {`CEP: ${company.zipCode}`} <br />
                    <div className='mt-3'>
                        <Map label="Ver localização no mapa" href={company.mapsLink}/>
                    </div>
                </span>
            </address>
        </Container>
    )
}

export default CompanyInformation; 