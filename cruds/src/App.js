
import './App.css';
import { Routes, Route } from 'react-router-loading';
import Nav from './components/Nav';
import Home from './components/Home';
import Create from './components/Create';
import Update from './components/Update';





function App() {
  return (
    
    <div className="App">
      <Nav/>
     <Routes>
      <Route path="/" element={<Home />} />
      <Route path="/create" element={< Create/>} />
      <Route path="/update/:id/" element={< Update/>} />
     </Routes>
    </div>
  );
}

export default App;
