import React from 'react';
import './map.css'
import { Image, Col, Row } from 'react-bootstrap';

const Map = (props) => {
    
    return (
            <Row>
                <Col xs='auto'>
                    <Image
                        src="../img/iconMap.png"   alt='Ìcone do google maps'
                        style={{ width: '40px', height: 'auto' }}
                    />
                </Col>
                <Col className="align-content-center" xs='auto'>
                    <a id="AncoraMaps" className='btn' href={props.href}>
                        {props.label}                
                    </a>
                </Col>
            </Row>
    )
}

export default Map;