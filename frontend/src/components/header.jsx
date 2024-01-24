import React, { useEffect, useState } from "react";
import axios from 'axios';

function Header() {
    const [name, setName] = useState(false);
    useEffect(() => {
        if (localStorage.getItem('name')) {
            if (window.location.pathname === '/') {
                window.location.href = '/dashboard';
            }
            setName(localStorage.getItem('name'))
        } else {
            if (window.location.pathname === '/dashboard') {
                window.location.href = '/';
            }
        }
    }, []);

    function logout(event) {
        event.preventDefault();
        const token = localStorage.getItem('token');

        axios.post('http://127.0.0.1:8000/api/logout', {
            token: token
        })
            .then((response) => {
                localStorage.removeItem('name');
                localStorage.removeItem('token');
                window.location.href = '/'
            })
            .catch((error) => {
                localStorage.removeItem('name');
                localStorage.removeItem('token');
                console.log(error);
            })
    }
    return (
        <>
            <div className="container-fluid w-100 bg-primary">
                <div className="d-flex justify-content-between align-items-center p-3">
                    <p className="fs-1 fw-bold text-light">Library App</p>
                    {
                        name ? (
                            <div>
                                <p className="fs-4 text-light">{name}</p>
                                <button onClick={logout} className="btn btn-warning w-100">Logout</button>
                            </div>
                        ) : (
                            <></>
                        )
                    }
                </div>
            </div>
        </>
    );
}

export default Header;