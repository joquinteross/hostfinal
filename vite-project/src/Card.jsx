import React, { useEffect, useState } from 'react';

export default function Card() {

    const [chiste, setChiste] = useState([])

    useEffect(() => {
        fetch('https://api.chucknorris.io/jokes/random')
            .then(response => response.json())
            .then(data => setChiste(data))
            .catch(error => console.error('Error'))


    }, []);
    return (
        <div>

            <h1>
                Chistes
            </h1>
            


            <div className="card" style={{ width: '18rem' }}>
                <img src={chiste.icon_url} className="card-img-top" alt="Icono" />
                <div className="card-body">
                    <h5 className="card-title">Chiste</h5>
                    <p className="card-text">{chiste.value}</p>
                    <a href="#" className="btn btn-primary">Reir</a>
                </div>
            </div>
        </div>
    )
}
