<?php
/*
Plugin Name: Filiais Dropdown
Description: Exibe um menu dropdown com os endereços das filiais.
Version: 1.0
Author: Seu Nome
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

    <script>
        function showDetails(filial) {
            var details = {
                "matriz": "<b>MATRIZ</b><br><i class='fa fa-map-marker'></i> Av. João Pedro Blumenthal, 300<br>Cumbica - Guarulhos - SP<br>CEP: 07224-150<br><i class='fa fa-phone'></i> ⁺55 11 3545-0500",
                "espiritoSantoSerra": "<b>Espírito Santo - Serra</b><br><i class='fa fa-map-marker'></i> Rua Luciano Sathler, 249<br>Bairro: Nova Zelândia – Serra – ES<br>CEP: 29175-704<br><i class='fa fa-phone'></i> ⁺55 27 3398-7400",
                "espiritoSantoSaoMateus": "<b>Espírito Santo - São Mateus</b><br><i class='fa fa-map-marker'></i> Rod. BR101 Norte, s/n – KM 60, sala 1<br>Bairro: Litorânea – São Mateus – ES<br>CEP: 29932-540<br><i class='fa fa-phone'></i> ⁺55 27 3771-2500",
                "minasGerais": "<b>Minas Gerais</b><br><i class='fa fa-map-marker'></i> Rua Humberto de Moro, 380<br>Bairro: Inconfidentes – Contagem – MG<br>CEP: 32260-000<br><i class='fa fa-phone'></i> ⁺55 31 3364-4995<br>⁺55 31 3364-4838",
                "bahia": "<b>Bahia</b><br><i class='fa fa-map-marker'></i> Rua dos Motoristas, s/n – sala 1 – set de Trans<br>Bairro: Copec – Camaçari – BA<br>CEP: 42816-050<br><i class='fa fa-phone'></i> ⁺55 71 3634-3700",
                "pernambuco": "<b>Pernambuco</b><br><i class='fa fa-map-marker'></i> Rua Merendiba, 84<br>Bairro: Pontezinha – Cabo de Santo Agostinho – PE<br>CEP: 54589-050<br><i class='fa fa-phone'></i> ⁺55 81 3479-7800",
                "sumareSP": "<b>Sumaré - SP</b><br><i class='fa fa-map-marker'></i> Rua Idalécio Rodrigues, 50<br>Bairro: Parque Florença – Sumaré – SP<br>CEP: 13177-451<br><i class='fa fa-phone'></i> ⁺55 19 3645-0474<br>⁺55 11 4810-4425",
                "rioDeJaneiroParadaDeLucas": "<b>Rio de Janeiro - Parada de Lucas</b><br><i class='fa fa-map-marker'></i> Av. Brasil, 15295<br>Bairro: Parada de Lucas – Rio de Janeiro – RJ<br>CEP: 21241-051<br><i class='fa fa-phone'></i> ⁺55 21 3351-7404",
                "rioDeJaneiroIlhaDoGovernador": "<b>Rio de Janeiro - Ilha do Governador</b><br><i class='fa fa-map-marker'></i> Praça Iaiá Garcia, 3<br>Bairro da Ribeira – Ilha do Governador – RJ<br>CEP: 21930-040<br><i class='fa fa-phone'></i> ⁺55 21 3386-5800",
                "ribeiraoPreto": "<b>Ribeirão Preto</b><br><i class='fa fa-map-marker'></i> Via: Doutor Jeremias de Paula Martins, 306<br>Bairro: Jardim Zinato – Ribeirao Preto – SP<br>CEP: 14097-142<br><i class='fa fa-phone'></i> ⁺55 16 4042-0969",
                "uberlandia": "<b>Uberlândia</b><br><i class='fa fa-map-marker'></i> Rua: Ignez Favato, 304<br>Bairro: Distrito Industrial – Uberlândia – MG<br>CEP: 38402-340<br><i class='fa fa-phone'></i> ⁺55 34 99725-1689",
                "saoJoseDoRioPreto": "<b>São José do Rio Preto</b><br><i class='fa fa-map-marker'></i> Rua Goiania, 1590<br>Bairro: Nossa Senhora da Penha<br>CEP: 15043-140"
            };

            document.getElementById("filial-details").innerHTML = details[filial] || "";
        }
    </script>
    <style>
        #filiais-dropdown select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
    <?php
    return ob_get_clean();
}

add_shortcode('filiais_dropdown', 'filiais_dropdown_shortcode');
?>
