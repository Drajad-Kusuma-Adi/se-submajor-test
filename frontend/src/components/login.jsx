import React from "react";
import axios from 'axios';

function Login() {
    function handleLogin(event) {
        event.preventDefault();

        const username = event.target.name.value;
        const password = event.target.password.value;

        axios.post('http://127.0.0.1:8000/api/login', {
            name: username,
            password: password
        })
            .then((response) => {
                localStorage.setItem('name', response.data.name);
                localStorage.setItem('token', response.data.token);
                window.location.href = '/dashboard'
            })
            .catch((error) => {
                localStorage.removeItem('token');
                console.log(error);
            })
    }
    return (
        <>
            <div className="container w-100 mt-5 border rounded">
                <form onSubmit={handleLogin}>
                    <div className="form-group m-2">
                        <label htmlFor="name">Nama:</label>
                        <input type="text" name="name" id="name" className="form-control" />
                    </div>
                    <div className="form-group m-2">
                        <label htmlFor="password">Password:</label>
                        <input type="password" name="password" id="password" className="form-control" />
                    </div>
                    <input type="submit" value="Login" className="btn btn-primary m-2" />
                </form>
            </div>
        </>
    );
}

export default Login;