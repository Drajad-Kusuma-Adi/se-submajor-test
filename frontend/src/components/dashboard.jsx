import React, { useEffect, useState } from "react";
import axios from 'axios';

function Dashboard() {
    const [books, setBooks] = useState([]);
    useEffect(() => {
        getBooks()
    }, []);

    function getBooks() {
        const token = localStorage.getItem('token');
        axios.get('http://127.0.0.1:8000/api/books', {
            token: token
        })
            .then((response) => {
                setBooks([]);
                response.data.books.forEach((value) => {
                    setBooks(prevBooks => [...prevBooks, value]);
                });
            })
            .catch((error) => {
                console.log(error);
            })
    }

    function borrowBook(event) {
        const token = localStorage.getItem('token');
        let id = event.target.value;
        axios.put('http://127.0.0.1:8000/api/books', {
            token: token,
            id: id
        })
            .then((response) => {
                window.location.reload();
            })
            .catch((error) => {
                console.log(error);
            })
    }
    return (
        <>
            <div className="container w-100">
                <p className="fs-1 fw-bold mt-5 text-center">Books List</p>
                <table className="table border rounded text-center">
                    <thead>
                        <tr>
                            <th className="border">No.</th>
                            <th>Judul Buku</th>
                            <th>Dipinjam?</th>
                            <th>Pinjam</th>
                        </tr>
                    </thead>
                    <tbody>
                        {
                            books.map((value, index) => {
                                index += 1;
                                return (
                                    <tr>
                                        <td className="border">{index}</td>
                                        <td className="text-start">{value.title}</td>
                                        <td>{value.is_borrow ? <>Ya</> : <>Tidak</>}</td>
                                        <td>{value.is_borrow ? (
                                            <form onSubmit={borrowBook}>
                                                <div className="form-group">
                                                    <input type="text" name="id" id="id" hidden />
                                                </div>
                                                <input type="submit" className="btn btn-primary disabled" value="Pinjam" />
                                            </form>
                                        ) : (
                                            <button className="btn btn-primary">Pinjam</button>
                                        )}</td>
                                    </tr>
                                )
                            })
                        }
                    </tbody>
                </table>
            </div>
        </>
    );
}

export default Dashboard;