import React, { Component } from 'react';
import { BrowserRouter as Router, Route } from "react-router-dom";
import 'bootstrap/dist/css/bootstrap.min.css';
import './App.css';
import Home from "./Contents/Home";
import Navbar from "./Components/Navbar";
import Footer from "./Components/Footer";





class App extends Component {

  constructor(props) {
    super(props);

  };

  render() {

    return (
      <Router>
        <div className="App">
            <Navbar/>
            <Home/>
        </div>
        <div className="Footer">
              <Footer/>
        </div>
      </Router>

    );
  }

}

export default App;
