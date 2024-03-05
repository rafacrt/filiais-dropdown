<?php
/*
Plugin Name: Filiais Dropdown com Mapa Locar
Description: Exibe um menu dropdown com os endereços das filiais e um mapa do Google Maps.
Version: 2.0
Author: Rafael Medeiros
*/

function filiais_dropdown_shortcode() {
    ob_start();
    ?>
    <div id="filiais-dropdown">
        <select id="filiais-select" onchange="showDetails(this.value)">
            <option value="">Selecione uma Filial...</option>
            <option value="matriz">MATRIZ</option>
            <option value="espiritoSantoSerra">Espírito Santo - Serra</option>
            <option value="espiritoSantoSaoMateus">Espírito Santo - São Mateus</option>
            <option value="minasGerais">Minas Gerais</option>
            <option value="bahia">Bahia</option>
            <option value="pernambuco">Pernambuco</option>
            <option value="sumareSP">Sumaré - SP</option>
            <option value="rioDeJaneiroParadaDeLucas">Rio de Janeiro - Parada de Lucas</option>
            <option value="rioDeJaneiroIlhaDoGovernador">Rio de Janeiro - Ilha do Governador</option>
            <option value="ribeiraoPreto">Ribeirão Preto</option>
            <option value="uberlandia">Uberlândia</option>
            <option value="saoJoseDoRioPreto">São José do Rio Preto</option>
        </select>
        <div id="filial-details" style="margin-top: 20px;"></div>
    </div>

    <div id="filiais-map" style="height: 700px;"></div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7yg24UmPDVMK1JtXJruBEVyFagb8zhgU"></script>
    <script>
        var map;
        var filiais = {
            // suas filiais aqui...
        };
        var infowindows = [];
        var customIcon = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'; // URL do ícone de localização

        function initMap() {
            map = new google.maps.Map(document.getElementById('filiais-map'), {
                zoom: 5,
                center: {lat: -23.46990, lng: -46.48286}
            });

            for (var filial in filiais) {
                let marker = new google.maps.Marker({
                    position: filiais[filial],
                    map: map,
                    icon: customIcon, // Usando o ícone de localização
                    title: filial
                });

                let infowindow = new google.maps.InfoWindow({
                    content: filiais[filial].info
                });
                infowindows.push(infowindow);

                marker.addListener('click', function() {
                    closeAllInfoWindows();
                    infowindow.open(map, marker);
                });
            }
        }

        function closeAllInfoWindows() {
            for (let i = 0; i < infowindows.length; i++) {
                infowindows[i].close();
            }
        }

        function showDetails(filial) {
            if (filiais[filial]) {
                map.setCenter(filiais[filial]);
                map.setZoom(15); // Aumente o valor aqui para um zoom mais próximo
            }
        }

        google.maps.event.addDomListener(window, 'load', initMap);
    </script>
    <style>
        #filiais-dropdown select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
        #filiais-map {
            height: 700px; /* Altura ajustada para 700px */
            margin-top: 20px;
        }
        .filial-info {
            cursor: pointer;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }
        .filial-info:hover {
            background-color: #e9e9e9;
        }
    </style>
    <script>
        // Função para selecionar a filial no mapa ao clicar na div
        function selectFilial(filial) {
            showDetails(filial);
            document.getElementById('filiais-select').value = filial;
        }
    </script>
    <?php
    return ob_get_clean();
}

add_shortcode('filiais_dropdown', 'filiais_dropdown_shortcode');
