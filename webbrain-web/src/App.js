import { Container } from 'react-bootstrap';
import './App.css';
import ContactFormPage from './pages/ContactFormPage';
import { RouterProvider, createBrowserRouter } from 'react-router-dom';
import ContactSearch from './pages/ContactSearch';


function App() {
    const router = createBrowserRouter([
        {
            path: "/",
            element: <ContactFormPage />
        },
        {
            path: "/contact-search",
            element: <ContactSearch/>
        }
    ])

    return (
        <div className="align-items-center justify-content-center">
            <Container className='my-5' >
                <RouterProvider router={router} />
            </Container>
        </div>
    );
}

export default App;
