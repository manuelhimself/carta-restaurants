import { camelCase } from 'jquery';
import React, { Component } from 'react';
import axios from 'axios';
import PropTypes from 'prop-types';
import { faSearch } from '@fortawesome/free-solid-svg-icons';


class SelectPoblacio extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            poblacio: []
        }

    }

    p = React.createRef();

    componentDidMount() {
        axios.post(`https://api.restaurat.me/controller/poblacio/poblacio.php`)
            .then(res => {
                const poblacio = res.data;
                this.setState({ poblacio });
            })
    }

    obteniPoblacio = (e) => {
        e.preventDefault();

        this.props.poblacio(this.p.current.value);
    }

    render() {


        return (

            <div className="form-group col-md-3">
                <label >Localitat</label>
                <select id="poblacio" className="form-control" name="poblacio" ref={this.p} onChange={this.obteniPoblacio} >
                    <option value="0">Selecciona</option>
                    {this.state.poblacio.map(poblacio =>
                        <option key={poblacio.id} value={poblacio.id}>{poblacio.nom}</option>
                    )}
                </select>
            </div>

        );
    }

}

export default SelectPoblacio; 