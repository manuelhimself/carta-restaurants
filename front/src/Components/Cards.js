import React, { Component } from 'react';
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faPhoneAlt } from '@fortawesome/free-solid-svg-icons';
import { faEnvelope } from '@fortawesome/free-solid-svg-icons';
import { faMapMarker } from '@fortawesome/free-solid-svg-icons';

class Cards extends React.Component {

    render() {

        if (this.props.filtre.length === 0) {
            return (
                <div className="container" id="filtre">
                    <div className="row">
                        <div className="col-12">
                            <h6>No s'han trobat restaurants amb aquests criteris</h6>
                        </div>
                    </div>
                </div>
            )
        } else {
            return (
                <div className="container">
                    <div className="row">
                        {this.props.filtre.map((establiment) => (
                            <div className="col-md-4">
                                {this.props.establiment}
                                <a href="#" className="text-decoration-none">
                                    <div className="card rounded border-0 h-100" key={establiment.id}>
                                        <img className="card-img-top" src={`https://admin.restaurat.me/images/establiment/${establiment.foto}`} style={{ height: 250 }} onError={(e) => {
                                            e.target.onerror = null
                                            e.target.src = 'http://localhost/projecte/img/error.png'
                                        }}></img>
                                        <div className="card-body p-4">
                                            <h5 className="card-title">
                                                {establiment.nom}</h5>
                                            <p className="card-title">
                                                <FontAwesomeIcon icon={faPhoneAlt} />  {establiment.telefon}
                                            </p>
                                            <p className="card-title">
                                                <FontAwesomeIcon icon={faEnvelope} />  {establiment.correu_electronic}
                                            </p>
                                            <p className="card-title">
                                                <FontAwesomeIcon icon={faMapMarker} />  {establiment.p}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        ))}
                    </div>
                </div>

            );
        }
    }


}

export default Cards