import React, { useEffect, useState } from 'react'
import { useNavigate, useParams } from 'react-router-dom'

export default function EditarLibro() {

    const { id } = useParams()
    const navigate = useNavigate()
    const [name, setName] = useState("")
    const [price, setPrice] = useState("")



    function updateLibro() {
        fetch(`http://127.0.0.1:8000/api/books/${id}`, {

            "method": "PUT",
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
                navigate("/");

            })
            .catch()


    }


    useEffect(() => {
        fetch('http://127.0.0.1:8000/api/books/')
            .then(response => response.json())
            .then(data => {

                setName(data.name || "")
                setPrice(data.price|| "")
            })

            .catch(error => console.error('Error'))


    }, [id]);

    return (
        <div>
            <h2>Editar Libro</h2>
            <input type="text"
                value={name}
                onChange={e => setName(e.target.value)}
                placeholder='Nombre del libro'
            />
            <input type="number"
                value={price}
                onChange={e => setPrice(e.target.value)}
                placeholder='Precio'
            />
            <button onClick={updateLibro} className="btn btn-success">
                Actualizar
            </button>

        </div>
    )
}
