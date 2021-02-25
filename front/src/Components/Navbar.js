import React, { Component } from 'react';
import icon from '../img/icone.png';
import Idioma from "./Idioma";
import Home from "../Contents/Home";


class Navbar extends React.Component {
    constructor(props) {
        super(props);
    }
   
    
    render() {

        return (
            
            <nav className="navbar navbar-expand-lg ">
                <a className="navbar-brand" href="" >
                    <img id="logo" src={icon} alt="Logo"></img>
                </a>
                <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul className="navbar-nav mr-auto">
                        <li className="nav-item dropdown">
                            <a className="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Idioma
                            </a>
                            <Idioma />
                        </li>
                    </ul>
                    <form className="form-inline my-2 my-lg-0">
                        <input type="submit" className="btn" value="Inicia Sessió"/>
                    </form>
                </div>
            </nav>
        )
    }
}

export default Navbar; 