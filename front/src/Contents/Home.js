import React, { Component } from 'react';
import SelectPoblacio from '../Components/SelectEspecialitats';
import SelectEspecialitats from "../Components/SelectPoblacio";
import Cards from "../Components/Cards"
import Sercador from "../Components/Sercador"
import Map from "../Components/Map";
import axios from "axios"


class Home extends React.Component {

  state = {
    poblacio: '',
    especialitat: '',
    establiment: '',
    filtre: [],
  }

  componentDidMount() {
    
    const url2 = 'https://api.restaurat.me/controller/establiment/filtre.php';
    axios.post(url2).then(response => response.data)
        .then((data) => {
            this.setState({ filtre: data })
        })
}
  consultaApi = () => {
   
    const url = `https://api.restaurat.me/controller/establiment/filtre.php?nom=${this.state.establiment}&poblacio=${this.state.poblacio}&categoria=${this.state.especialitat}`;
    console.log(url)

    fetch(url)
      .then(resposta => resposta.json())
      .then(resultat => this.setState({ filtre: resultat }))
  }
  establiment = (establiment) => {
    this.setState({
      establiment
    }, () => {
      this.consultaApi();
    })
  }

  poblacio = (poblacio) => {

    this.setState({
      poblacio
    }, () => {
      this.consultaApi();
    })

  }

  especialitat = (especialitat) => {
    this.setState({
      especialitat
    }, () => {
      this.consultaApi();
    })

  }

  render() {

    return (
      <div className="app conteiner ">
        <div className="container-fluid">
          <div className="row">
            <div className="col-8">
              <form id="formInici">
                <div className="form-row">
                  <Sercador establiment={this.establiment} />
                  <SelectPoblacio especialitat={this.especialitat} />
                  <SelectEspecialitats poblacio={this.poblacio} />
                  <button type="reset" class="btn mb-2" id="borrar">Borra</button>
                </div>
              </form>
              <div >
                <Cards filtre={this.state.filtre} />
              </div>
              <div className="col-4 sticky-inner">
              <div className="container">
                <Map />
              </div>
            </div>
            
            </div>
          </div>
        </div>
      </div>


    );
  }

}
export default Home; 