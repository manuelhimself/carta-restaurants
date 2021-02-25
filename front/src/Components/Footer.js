import React, { Component } from 'react';

class Footer extends React.Component {
    constructor(props) {
        super(props);

    }

    render() {
        return (
            <footer className="mt-5 pt-5 pb-5 footer ">
                <div className="container">
                    <div className="row">
                        <div className="col-lg-6 col-xs-12 portal-restaurants links text-center">
                            <h4>Portal Restaurants</h4>
                            <ul className="m-0 p-0">
                                <li>- <a href="login.html">Inici sessió</a></li>
                                <li>- <a href="reserves.html">Consulta reserva</a></li>
                                <li>- <a href="editarPerfil.html">Edita perfil</a></li>
                                <li>- <a href="editarCarta.html">Edita cartes</a></li>
                            </ul>
                        </div>
                        <div className="col-lg-6 col-xs-12 portal-clients links text-center">
                            <h4 className="mt-lg-0 mt-sm-3">Portal Clients</h4>
                            <ul className="m-0 p-0">
                                <li>- <a href="#">Inicia sessió</a></li>
                                <li>- <a href="#">Cerca restaurants</a></li>
                            </ul>
                        </div>
                    </div>
                    <div className="row mt-5">
                        <div className="col copyright">
                            <p className=""><small className="text-white-50">© 2021. Tots els drets reservats.</small></p>
                        </div>
                    </div>
                </div>
            </footer>

        )
    }
}

export default Footer;