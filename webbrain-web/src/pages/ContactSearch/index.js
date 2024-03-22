import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import { useEffect, useState } from 'react';
import { Button, Form, InputGroup } from 'react-bootstrap';
import { useLocation } from 'react-router-dom';
import { getContactOptions, getContactsList } from '../../services/ContactService';
import ContactCard from '../../components/ContactCard';
import Select from 'react-select';
import PageBar from '../../components/PageBar';
import { parseISO } from 'date-fns';
import './ContactSearch.css'

const ContactSearch = () => {
    const [searchOptions, setSearchOptions] = useState([]);
    const [searchResults, setSearchResults] = useState([]);
    const [lastRegisteredContact, setLastRegisteredContact] = useState();
    const [contactOptions, setContactOptions] = useState([]);
    const [isLoading, setIsLoading] = useState(true);
    const [isSearching, setStartSearching] = useState(false)
    const [pageInfo, setPageInfo] = useState({
        currentPage: 1,
        quantity: 0,
        lastPage: 1,
        perPage: 10,
        total: 0,
    })

    const location = useLocation();

    useEffect(() => {
        const { state } = location || null;
        if (state) setLastRegisteredContact({
            ...state,
            birthDate: parseISO(state.birth_date)
        });
        getContactOptions().then(response => {
            setContactOptions(response.data)
            setIsLoading(false)
        })
    }, [window.location.pathname])

    useEffect(() => {
        if (isSearching) search()
    }, [isSearching])


    function handlePageSelected(page) {
        setPageInfo({
            ...pageInfo,
            currentPage: page
        })
        setStartSearching(true)
    }

    const handleSearchButton = () => {
        setPageInfo({
            ...pageInfo,
            currentPage: 1
        })
        setStartSearching(true)
    }

    const getOptionDescription = (option) => {
        return contactOptions
            .find(contactOption =>
                contactOption.id == option
            )?.description
    }

    const search = () => {
        const { currentPage, perPage } = pageInfo
        getContactsList({
            currentPage: currentPage,
            perPage: 
                perPage > 0 
                ?   perPage < 10
                    ?  perPage
                    : 10
                : 6,
            options: searchOptions.map(option => option.id)
        }).then(response => {
            const responseBody = response.data
            setPageInfo(
                {
                    currentPage: responseBody.current_page,
                    quantity: responseBody.quantity,
                    lastPage: responseBody.last_page,
                    perPage: responseBody.per_page,
                    total: responseBody.total
                }
            )
            setSearchResults(
                responseBody.data.map(contact => {
                    return {
                        ...contact,
                        birthDate: parseISO(contact.birth_date)
                    }
                })
            )
            setStartSearching(false)
        })
    };

    const handleSearchPerPageInput = (event) => {
        let { value } = event.target


        value = value.replace(/\D/g, "");

        setPageInfo({
            ...pageInfo,
            perPage: value
        });
    }

    const handleOptionsSelectChange = (selectedOptions) => {
        setSearchOptions(selectedOptions)
    }

    if (isLoading) return <div />

    return (
        <Container className='overflow-x-hidden'>
            <Row>
                <Col
                    className="mb-3"
                    xs={12}
                    sm={6}
                    md={7}
                    lg={8}
                    xl={9}
                >
                    <Select
                        id="options"
                        placeholder="Selecione o filtro..."
                        options={contactOptions}
                        value={searchOptions}
                        onChange={handleOptionsSelectChange}
                        isMulti
                        getOptionValue={option => option.id}
                        getOptionLabel={option => option.description}
                    />
                </Col>
                <Col
                    className="mb-3 ps-sm-0"
                    xs={12}
                    sm={6}
                    md={5}
                    lg={4}
                    xl={3}
                >
                    <Row className=''>
                        <Col className="pe-1" xs={7} sm={7}>
                            <InputGroup className="mb-3">
                                <Col xs={4}>
                                    <Form.Control
                                        type="text"
                                        inputMode="numeric"
                                        min="1"
                                        aria-label="Itens por pagina"
                                        aria-describedby="basic-addon1"
                                        value={pageInfo.perPage}
                                        onChange={handleSearchPerPageInput}
                                    />
                                </Col>
                                <Col xs={8}>
                                    <InputGroup.Text 
                                        id="basic-addon1" 
                                        className="ms-2"
                                        style={{placeContent: 'center'}}
                                    >
                                        Por página
                                    </InputGroup.Text>
                                </Col>
                            </InputGroup>
                        </Col>
                        <Col className="text-end ps-0" xs={5} sm={5}>
                            <Button onClick={handleSearchButton}>
                                Pesquisar
                            </Button>
                        </Col>
                    </Row>
                </Col>
            </Row>
            <Row>
                {
                    lastRegisteredContact &&
                    <Container>
                        <Col className='mb-3' xs={12}>
                            <ContactCard contact={lastRegisteredContact} getOptionDescription={getOptionDescription} />
                        </Col>
                        <Col className='mb-3' xs={12}>
                            =============================================================================
                        </Col>
                    </Container>
                }
                {
                    searchResults?.length > 0 &&
                    searchResults?.map(contact => {
                        return (
                            <Col className='mb-3' lg={6} key={`col_card${contact.id}`}>
                                <ContactCard contact={contact} getOptionDescription={getOptionDescription} />
                            </Col>
                        )
                    })}
            </Row>
            {
                searchResults?.length > 0 &&
                <PageBar
                    currentPage={pageInfo.currentPage}
                    lastPage={pageInfo.lastPage}
                    handlePageSelected={handlePageSelected}
                />
            }
        </Container>
    )
}

export default ContactSearch;