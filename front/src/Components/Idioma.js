import React, {Component} from 'react'

class Idioma extends Component {

    render(){
        const {canviIdioma} = this.props;
        return (
            <div className="dropdown-menu" aria-labelledby="navbarDropdown">
                <button id="ca" className="dropdown-item" onClick={canviIdioma}>Català</button>
                <button id="es" className="dropdown-item"  onClick={canviIdioma}>Castellà</button>
                <button id="en" className="dropdown-item" onClick={canviIdioma}>Anglès</button>
            </div>
        )
    }
}

export default Idioma;