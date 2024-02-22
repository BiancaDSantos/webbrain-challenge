import Form from 'react-bootstrap/Form';
import './Form.css';
import { Container, Col, Row, Button, Alert} from 'react-bootstrap';
import React, { useEffect, useState } from 'react';
import MaskedFormControl from '../MaskedFormControl';
import { useNavigate } from 'react-router-dom';
import { differenceInYears, parseISO } from 'date-fns';
import Select from 'react-select';
import { getContactOptions, registerNewContact } from '../../services/ContactService';

const ContactForm = () => {
    const [formData, setFormData] = useState({
        name: "",
        birthDate: "",
        email: "",
        whatsApp: "",
        phone: "",
        options: [],
        message: "",
    });

    const [errors, setErrors] = useState({});

    const [contactOption, setContactOptions] = useState([]);
    
    const navigate = useNavigate();

    useEffect(() => {
        getContactOptions().then(response => {
            setContactOptions(JSON.parse(response.request.response))
        })
    }, [])

    const handleChange = (event) => {
        setFormData({
            ...formData,
            [event.target.name]: event.target.value
        })
    }
    
    const handleOptionsSelectChange = (selectedOptions) => {
        setFormData({
            ...formData,
            options: selectedOptions
        })
    }

    function handleSubmit(event) {
        event.preventDefault();
        const validationErrors = validate(formData);
        if (Object.keys(validationErrors).length === 0) {
            setErrors({})
            registerNewContact(
                {
                    ...formData,
                    options: formData.options.map(option => { return {contact_options_id: option.id}}),
                    birth_date: formData.birthDate
                }
            ).then(response => {
                navigate("/contact-search/", {state: JSON.parse(response.request.response)})
            })
        } else {
            setErrors(validationErrors)
        }
    }

    function validate(data) {
        const errors = {};
        if (!data.name.trim()) errors.name = "O nome é obrigatório.";
        if (!data.birthDate.trim()) errors.birthDate = "A data de nascimento é obrigatória.";
        else if (
            !isBetween(differenceInYears(new Date(), parseISO(data.birthDate)), 18, 100)
        ) errors.birthDate = "Para enviar este formulário é necessário ter entre 18 e 100 anos.";
        if (!data.email.trim()) errors.email = "O email é obrigatório.";
        else if (!/\S+@\S+\.\S+/.test(data.email)) errors.email = "Email inválido.";
        if (!data.whatsApp.trim()) errors.whatsApp = "O WhatsApp é obrigatório.";
        else if (!/^\(\d{2}\)\s\d{5}-\d{4}$/.test(data.whatsApp.trim())) errors.whatsApp = "Complete o número de WhastApp.";
        if (!data.phone.trim()) errors.phone = "O telefone é obrigatório.";
        else if (!/^\(\d{2}\)\s\d{4}-\d{4}$/.test(data.phone.trim())) errors.phone = "Complete o número de telefone.";
        if (data.options.length === 0) errors.options = "Selecione o que gostaria de comunicar.";
        if (!data.message.trim()) errors.message = "A mensagem é obrigatória.";
        return errors
    }

    function isBetween(number, lowerBound, upperBound) {
        return number >= lowerBound && number <= upperBound
    }

    return (
        <Container>
            <Form className='Container' onSubmit={handleSubmit} noValidate>
                <Row className="justify-content-center align-items-start row-cols-auto">
                    <Col
                        className="form-group mb-3"
                        xs={12}
                        sm={errors.birthDate ? 12 : 7}
                        md={12}
                        lg={errors.birthDate ? 12 : 7}
                        xxl={errors.birthDate ? 12 : 8}
                        
                    >
                        <label htmlFor="name">Nome:</label>
                        <input
                            id='name'
                            type="text"
                            name="name"
                            value={formData.name}
                            onChange={handleChange}
                            className="form-control"
                            aria-label="Recipient's username"
                            aria-describedby="basic-addon2"
                        />
                        {
                            errors.name && 
                            <Alert className='mt-1 mb-0 p-1 text-center' key={errors.name} variant="danger">
                                {errors.name}
                            </Alert>
                        }
                    </Col>
                    <Col
                        className="form-group mb-3"
                        xs={12}
                        sm={errors.birthDate ? 12 : 5}
                        md={12}
                        lg={errors.birthDate ? 12 : 5}
                        xxl={errors.birthDate ? 12 : 4}
                    >
                        <Row>
                            <Col>
                                <label htmlFor="birthdate">Data de nascimento:</label>
                                <input
                                    id='birthdate'
                                    type="date"
                                    name="birthDate"
                                    value={formData.birthDate}
                                    max={new Date().toISOString().split("T")[0]}
                                    onChange={handleChange}
                                    className="form-control"
                                    aria-label="Data de nascimento"
                                    aria-describedby="basic-addon2"
                                    onInvalid={handleSubmit}
                                />
                            </Col>
                            {
                                errors.birthDate && 
                                <Col lg={7} xl={7} xxl={8}>
                                    <Alert className='mt-1 mb-0 p-1 text-center' key={errors.birthDate} variant="danger">
                                        {errors.birthDate}
                                    </Alert>
                                </Col>
                            }
                        </Row>
                    </Col>
                </Row>
                <Row className='justify-content-center align-items-end'>
                    <Col className="form-group mb-3" md={12}>
                        <label htmlFor="email">Email:</label>
                        <input
                            id='email'
                            type="text"
                            name="email"
                            value={formData.email}
                            onChange={handleChange}
                            className="form-control"
                            placeholder="usuario@servidor.com"
                            aria-label="Email"
                            aria-describedby="basic-addon2"
                        />
                        {
                            errors.email && 
                            <Alert className='mt-1 mb-0 p-1 text-center' key={errors.email} variant="danger">
                                {errors.email}
                            </Alert>
                        }
                    </Col>
                </Row>
                <Row>
                    <Col className='pe-md-1 mb-3 mb-sm-0' xs={12} sm={6} md={6}>
                        <MaskedFormControl
                            id="whatsApp"
                            label="WhatsApp:"
                            name="whatsApp"
                            value={formData.whatsApp}
                            onChange={handleChange}
                            placeholder="(99) 99999-9999"
                            maxLength={15}
                            
                            getPhoneRegex = {(length) => {
                                let digit1 = 2
                                length -= length - digit1 < 0 ? 0 : digit1
                                let digit2 = length > 5 ? 5 : length
                                digit2 = digit2 === 0 ? 1 : digit2
                                length -= digit2
                                let digit3 = length > 4 ? 4 : length
                                length -= digit3
                                const regexPattern = `^(\\d{${digit1}})(\\d{${digit2}})(\\d{${digit3}})$`;
                                return new RegExp(regexPattern);
                            }}
                        />
                    </Col>
                    <Col className='ps-md-1' xs={12} sm={6} md={6}>
                        <MaskedFormControl 
                            id="telefone"
                            label="Telefone:"
                            name="phone"
                            value={formData.phone}
                            onChange={handleChange}
                            placeholder="(99) 9999-9999"
                            maxLength={14}
                            getPhoneRegex = {(length) => {
                                let digit1 = 2
                                length -= length - digit1 < 0 ? 0 : digit1
                                let digit2 = length > 4 ? 4 : length
                                digit2 = digit2 === 0 ? 1 : digit2
                                length -= digit2
                                let digit3 = length > 4 ? 4 : length
                                length -= digit3
                                const regexPattern = `^(\\d{${digit1}})(\\d{${digit2}})(\\d{${digit3}})$`;
                                return new RegExp(regexPattern);
                            }}
                        />
                    </Col>
                    <Col className="mb-3">
                        {
                            (errors.phone || errors.whatsApp) && 
                            <Alert className='mt-1 mb-0 p-1 text-center' key={errors.phone} variant="danger">
                                {errors.phone} 
                                {errors.phone && <br/>}
                                {errors.whatsApp}
                            </Alert>
                        }
                    </Col>
                    <Col className="align-self-end mb-3" xs={12} sm={12} md={12}>
                        <label htmlFor="options">O que deseja comunicar?</label>
                        <Select
                            id="options"
                            placeholder="Selecione..."
                            options={contactOption}
                            value={formData.options}
                            onChange={handleOptionsSelectChange}
                            isMulti
                            getOptionValue={option => option.id}
                            getOptionLabel={option => option.description}
                        />
                        {
                            errors.options && 
                            <Alert className='mt-1 mb-0 p-1 text-center' key={errors.options} variant="danger">
                                {errors.options}
                            </Alert>
                        }
                    </Col>
                </Row>
                <Row>
                    <Col className="form-group" xs={12}>
                        <textarea
                            id="message"
                            placeholder="Digite sua mensagem"
                            name="message"
                            value={formData.message}
                            onChange={handleChange}
                            className="form-control"
                            aria-label="Mensagem">
                        </textarea>
                        {
                            errors.message && 
                            <Alert className='mt-1 mb-0 p-1 text-center' key={errors.message} variant="danger">
                                {errors.message}
                            </Alert>
                        }
                    </Col>
                </Row>
                <Button id='buttonForm' className="mt-3" type="submit">
                    Enviar formulário
                </Button>
            </Form>
            
        </Container>
    )
}

export default ContactForm;