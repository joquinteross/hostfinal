import { BrowserRouter as Router, Routes, Route} from 'react-router-dom'
import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'
import EditarLibro from './assets/EditarLibro'
import Tabla from './Tabla'


function App() {
  const [count, setCount] = useState(0)

  return (
    <Routes>
      <Route path="/" element={<Tabla />} ></Route>
      <Route path="/editar/:id" element={<EditarLibro/>} ></Route>
    </Routes>
  )
}

export default App
