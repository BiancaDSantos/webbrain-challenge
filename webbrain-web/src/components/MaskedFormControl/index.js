import React, { useState } from 'react';
import { Form } from 'react-bootstrap';

const MaskedFormControl = (props) => {

    const [phoneNumber, setPhoneNumber] = useState(props.value);

    function formatPhoneNumber(value) {
        const cleaned = value.replace(/\D/g, '');
        const regex = props.getPhoneRegex(cleaned.length)
        const match = cleaned.match(regex);
        if (match) {
            return `(${match[1]}) ${match[2]}${match[3] ? `-${match[3]}` : ''}`;
        }
        return cleaned;
    }


    function handleChange(event) {
        const inputValue = event.target.value;
        const formattedValue = formatPhoneNumber(inputValue);
        setPhoneNumber(formattedValue);
        props.onChange(event);
    }

    return (
        <Form.Group controlId={props.id}>
            <label>{props.label}</label>
            <Form.Control
                minLength={props.minLength}
                name={props.name}
                className="px-2"
                type="tel"
                maxLength={props.maxLength}
                placeholder={props.placeholder}
                value={phoneNumber}
                onChange={handleChange}
            />
        </Form.Group>
    );
}

export default MaskedFormControl;