import React from 'react';
import './WhatsApp.css'

const WhatsAppLink = (props) => {

    return (
        <a className='AncoraWhatsApp' href={`https://api.whatsapp.com/send?phone=${props.phone}`}>
            <img 
                src='../img/iconWhatsapp.png'
                alt='Simbolo do whatsApp'
                style={{ width: '40px', height: 'auto' }}
            /> 
        </a>
    );
};

export default WhatsAppLink;