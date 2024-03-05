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

    <script src=""></script>
    <script>
        var map;
        var filiais = {
            "matriz": {lat: -23.46990, lng: -46.48286, info: "<b>MATRIZ</b><br>Av. João Pedro Blumenthal, 300<br>Cumbica - Guarulhos - SP<br>CEP: 07224-150<br>Telefone: ⁺55 11 3545-0500"},
            "espiritoSantoSerra": {lat: -20.180324, lng: -40.225547, info: "<b>Espírito Santo - Serra</b><br>Rua Luciano Sathler, 249<br>Bairro: Nova Zelândia – Serra – ES<br>CEP: 29175-704<br>⁺55 27 3398-7400"},
            "espiritoSantoSaoMateus": {lat: -18.71611, lng: -39.85891, info: "<b>Espírito Santo - São Mateus</b><br>Rod. BR101 Norte, s/n – KM 60, sala 1<br>Bairro: Litorânea – São Mateus – ES<br>CEP: 29932-540<br>⁺55 27 3771-2500"},
            "minasGerais": {lat: -19.917299, lng: -44.084044, info: "<b>Minas Gerais</b><br>Rua Humberto de Moro, 380<br>Bairro: Inconfidentes – Contagem – MG<br>CEP: 32260-000<br>⁺55 31 3364-4995<br>⁺55 31 3364-4838"},
            "bahia": {lat: -12.699722, lng: -38.326111, info: "<b>Bahia</b><br>Rua dos Motoristas, s/n – sala 1 – set de Trans<br>Bairro: Copec – Camaçari – BA<br>CEP: 42816-050<br>⁺55 71 3634-3700"},
            "pernambuco": {lat: -8.28125, lng: -35.034722, info: "<b>Pernambuco</b><br>Rua Merendiba, 84<br>Bairro: Pontezinha – Cabo de Santo Agostinho – PE<br>CEP: 54589-050<br>⁺55 81 3479-7800"},
            "sumareSP": {lat: -22.821944, lng: -47.266944, info: "<b>Sumaré - SP</b><br>Rua Idalécio Rodrigues, 50<br>Bairro: Parque Florença – Sumaré – SP<br>CEP: 13177-451<br>⁺55 19 3645-0474<br>⁺55 11 4810-4425"},
            "rioDeJaneiroParadaDeLucas": {lat: -22.8329, lng: -43.2951, info: "<b>Rio de Janeiro - Parada de Lucas</b><br>Av. Brasil, 15295<br>Bairro: Parada de Lucas – Rio de Janeiro – RJ<br>CEP: 21241-051<br>⁺55 21 3351-7404"},
            "rioDeJaneiroIlhaDoGovernador": {lat: -22.813409, lng: -43.198487, info: "<b>Rio de Janeiro - Ilha do Governador</b><br>Praça Iaiá Garcia, 3<br>Bairro da Ribeira – Ilha do Governador – RJ<br>CEP: 21930-040<br>⁺55 21 3386-5800"},
            "ribeiraoPreto": {lat: -21.2300, lng: -47.8103, info: "<b>Ribeirão Preto</b><br>Via: Doutor Jeremias de Paula Martins, 306<br>Bairro: Jardim Zinato – Ribeirao Preto – SP<br>CEP: 14097-142<br>⁺55 16 4042-0969"},
            "uberlandia": {lat: -18.911304, lng: -48.262224, info: "<b>Uberlândia</b><br>Rua: Ignez Favato, 304<br>Bairro: Distrito Industrial – Uberlândia – MG<br>CEP: 38402-340<br>⁺55 34 99725-1689"},
            "saoJoseDoRioPreto": {lat: -20.8113, lng: -49.3758, info: "<b>São José do Rio Preto</b><br>Rua Goiania, 1590<br>Bairro: Nossa Senhora da Penha<br>CEP: 15043-140"}
        };
        var infowindows = [];
        var customIcon = 'https://projetos.rajo.com.br/locar/wp-content/uploads/2024/01/logo-map3.png'; // URL da imagem do marcador personalizado

        function initMap() {
            map = new google.maps.Map(document.getElementById('filiais-map'), {
                zoom: 5,
                center: {lat: -23.46990, lng: -46.48286}
            });

            for (var filial in filiais) {
                let marker = new google.maps.Marker({
                    position: filiais[filial],
                    map: map,
                    icon: customIcon, // Usando a imagem personalizada como ícone
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
    </style>
    <?php
    return ob_get_clean();
}

add_shortcode('filiais_dropdown', 'filiais_dropdown_shortcode');
?>