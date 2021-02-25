import React, { Component } from 'react';
import axios from 'axios';
import { TileLayer, Marker, MapContainer, Popup,CircleMarker, Tooltip } from 'react-leaflet'
import "leaflet/dist/leaflet.css";


class Map extends React.Component {
    state = {
        coordenades: [],

    }
    componentDidMount() {
        const url = 'https://api.restaurat.me/controller/establiment/readCoordenades.php';
        axios.post(url).then(response => response.data)
            .then((data) => {
                this.setState({ coordenades: data })
                console.log(this.state.coordenades)
            })
    }

    render() {
        const position = [39.60017583077754, 2.9943578633572976]
        
        return (
            <div className="container">
                <MapContainer center={position} zoom={9}>
                    <TileLayer
                        attribution='&amp;copy <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
                        url=" https://{s}.basemaps.cartocdn.com/rastertiles/light_all/{z}/{x}/{y}.png"
                    />
                    {
                        this.state.coordenades.map((city) => {
                            return (
                                <CircleMarker
                                    center={[city.lat, city.lng]}
                                    radius={15}
                                    fillOpacity={0.5}
                                    stroke={false}
                                    color={'#94BFBE'}

                                >
                                    <Tooltip>
                                        <span>{city.nom}</span>
                                    </Tooltip>
                                </CircleMarker>
                            )
                        })
                    }
                </MapContainer>
            </div>
        );
    }
}

export default Map;
