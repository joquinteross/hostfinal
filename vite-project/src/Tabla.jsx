import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom'


//UseEffect




export default function Tabla() {

    const [libros, setLibros] = useState([])
    const [name, setName] = useState("")
    const [price, setPrice] = useState("")

    function llamarDatos() {


        fetch('http://127.0.0.1:8000/api/books/')
            .then(response => response.json())
            .then(data => setLibros(data))
            .catch(error => console.error('Error'))



    }
    function guardarLibro() {
        fetch('http://127.0.0.1:8000/api/books/', {

            "method": "post",
            "headers": {
                "Content-type": "application/json"

            },
            body: JSON.stringify({
                name: name,
                price: price


            })

        })
            .then(function (response) {
                return response.json()
            })
            .then(function (data) {
                llamarDatos();
                setName("");
                setPrice("");

            })
            .catch()


    }

    function eliminarLibro(id) {
        fetch(`http://127.0.0.1:8000/api/books/${id}`, {

            "method": "delete",

        })
            .then(function (response) {
                llamarDatos();
            })
            .catch()


    }




    useEffect(() => {
        llamarDatos()

    }, []);



    return (


        <div>
            <h1>Libros</h1>

            <h4>Crear Libros</h4>
            <input
                type="text"
                value={name}
                onChange={(event) => setName(event.target.value)}
                placeholder="Nombre"
            />
            <input
                type="number"
                value={price}
                onChange={(event) => setPrice(event.target.value)}
                placeholder="Precio"
            />
            <button type="button" className="btn btn-primary" onClick={guardarLibro}>
                Guardar
            </button>

            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Modificar</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody>
                    {libros.map((libro) => (
                        <tr key={libro.id}>
                            <td>{libro.name}</td>
                            <td>{libro.price}</td>
                            <td>
                                <button
                                    type="button"
                                    className="btn btn-danger"
                                    onClick={() => eliminarLibro(libro.id)}
                                >
                                    Eliminar
                                </button>
                            </td>
                            <td>
                                <Link to={`/editar/${libro.id}`} className="btn btn-warning">
                                    Editar
                                </Link>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};


