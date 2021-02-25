import React, { Component } from 'react';
import axios from 'axios';

class SelectEspecialitats extends React.Component {
    constructor(props) {
        super(props);
    }

    state = {
        especialitat: [],
        
    }
    componentDidMount() {
        axios.post(`https://api.restaurat.me/controller/categoria/categoria.php`)
            .then(res => {
                const especialitat = res.data;
                this.setState({ especialitat });
            })
    }

    e = React.createRef();

    obteniEspecialitat = (e) =>{
        e.preventDefault();
    
        this.props.especialitat(this.e.current.value);
      }

    render() {
        return (
            <div className="form-group col-md-3">
                <label >Especialitat</label>
                <select id="especialitats" className="form-control" name="especialitats" ref={this.e} onChange={this.obteniEspecialitat}>
                    <option value= "0">Selecciona</option>
                    {this.state.especialitat.map(especialitat =>
                        <option key={especialitat.id} value={especialitat.id}>{especialitat.nom}</option>
                    )}
                </select>
            </div>

        );
    }
}

export default SelectEspecialitats; 