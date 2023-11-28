import './App.css';
import {useEffect, useState} from "react";
import {BrowserRouter as Router, Outlet, Route, Routes} from "react-router-dom";
import Insert from "./Insert";
import Output from "./Output";



function App() {

        return (
            <Router>
                <Routes>
                    <Route path="/" element={<Output/>}/>
                    <Route path="/insert" element={<Insert/>}/>
                </Routes>
            </Router>
        );

}
export default App;
