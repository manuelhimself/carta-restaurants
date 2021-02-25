import React, { Component } from 'react';

class Sercador extends React.Component {

    nom = React.createRef();

    obtenirNom = (e) => {
        e.preventDefault();
        this.props.establiment(this.nom.current.value);
    }

    render(){
        return(
            <div className="form-group col-md-3">
            <label>Nom restaurant</label>
            <input type="text" className="form-control" ref={this.nom} onChange={this.obtenirNom} />
          </div>
        )
    }
}

export default Sercador;