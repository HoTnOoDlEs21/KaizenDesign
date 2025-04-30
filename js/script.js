$(document).ready(function () {
    //Carregamento dinâmico das notícias usando AJAX

    function loadNews() {
        var url = 'https://www.noticiasaominuto.com/rss/tech';

        $.ajax({
            url: 'https://api.rss2json.com/v1/api.json?rss_url=' + url,
            type: 'GET',
            success: function (data) {
                console.log(data.items); // Verifica o conteúdo
            },
            error: function (xhr, status) {
                console.error('Erro ao carregar o feed:', status);
            },
        });

        $.ajax({
            url: 'https://api.rss2json.com/v1/api.json?rss_url=' + url,
            type: 'GET',
            success: function (data) {
                objeto_json = eval(data);

                var link = '';
                var imagem = '';
                var titulo = '';
                var numeroNoticias = 8;

                for (i = 0; i < numeroNoticias; i++) {
                    link = objeto_json.items[i].link;
                    imagem = objeto_json.items[i].enclosure.link;
                    titulo = objeto_json.items[i].title;

                    $('#news_link' + (i + 1)).attr('href', link);
                    $('#news_img' + (i + 1)).attr('src', imagem);
                    $('#news_title' + (i + 1)).html(titulo);
                }
            },
            error: function (xhr, status) {
                alert('Ocorreu um erro.');
            },
        });
    }

    loadNews();

    //Cálculo dinâmico do orçamento

    function orcamento() {
        let tipo = document.getElementById('tipo');
        let prazo = document.getElementById('prazo');
        let resultado = document.getElementById('resultado');
        let checked = $('input:checkbox:checked').length;
        let total = null;

        function calc_tipo(tipo_pagina) {
            switch (tipo_pagina) {
                case 'simples':
                    total = 500;
                    break;
                case 'institucional':
                    total = 1200;
                    break;
                case 'loja':
                    total = 1600;
                    break;
                case 'blog':
                    total = 850;
                    break;
            }
        }

        function calc_prazo(meses) {
            switch (meses) {
                case '':
                    total = total;
                    break;
                case '0':
                    total = total;
                    break;
                case '1':
                    total = total * 0.95;
                    break;
                case '2':
                    total = total * 0.9;
                case '3':
                    total = total * 0.85;
                    break;
                default:
                    total = total * 0.8;
                    break;
            }
        }

        function calc_checkboxes() {
            total = total + 400 * checked;
        }

        //Caso nenhum tipo de página for escolhido
        if (tipo.value == '') {
            resultado.value = '';
            //Caso seja escolhido um tipo de separador
        } else {
            calc_tipo(tipo.value);
            calc_prazo(prazo.value);

            calc_checkboxes();

            //calculo final
            resultado.value = total + ' €';
        }
    }

    $('#tipo').change(orcamento);
    $('#prazo').on('keyup', orcamento);
    $('.form-check-input').change(orcamento);

    //Validar pedido de orçamento

    function validar_pedido_orcamento() {
        // Nome
        let nome = document.getElementById('nome').value;
        if (nome == '') {
            alert('Deve inserir o seu nome.');
            return false;
        }

        // Apelido
        let apelido = document.getElementById('apelido').value;
        if (apelido == '') {
            alert('Deve inserir o seu apelido.');
            return false;
        }

        // Telemóvel
        let telemovel = document.getElementById('telemovel').value;
        if (isNaN(telemovel)) {
            alert('O número inserido nao está correto.');
            return false;
        }
        if (telemovel.length != 9) {
            alert('O número de telemóvel deverá conter 9 algarismos.');
            return false;
        }

        // Tipo de página
        let tipo = document.getElementById('tipo').value;
        if (tipo == '') {
            alert('Por favor escolha o tipo de página desejado.');
            return false;
        }

        // Prazo
        let prazo = document.getElementById('prazo').value;
        if (isNaN(parseInt(prazo)) || prazo < 0) {
            alert('Por favor indique o prazo em meses.');
            return false;
        }

        alert('O seu pedido de orçamento foi submetido com sucesso. Obrigado!');
        return true;
    }

    $('#submeter_orcamento').click(validar_pedido_orcamento);

    //Validação do Formulário de contacto

    function validar_pedido_contacto() {
        // Nome
        let nome = document.getElementById('cont-nome').value;
        if (nome == '') {
            alert('Por favor insira o seu nome.');
            return false;
        }

        // Apelido
        let apelido = document.getElementById('cont-apelido').value;
        if (apelido == '') {
            alert('Por favor insira o seu apelido.');
            return false;
        }

        // Telemóvel
        let telemovel = document.getElementById('cont-telemovel').value;
        if (isNaN(telemovel)) {
            alert('Por favor insira nº de telemóvel correto.');
            return false;
        }
        if (telemovel.length != 9) {
            alert('O número de telemóvel deverá conter 9 algarismos.');
            return false;
        }

        // Email
        var email = document.getElementById('cont-email').value;
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!re.test(String(email).toLowerCase())) {
            alert('Email é inválido.');
            return false;
        }

        // Data
        let contdata = document.getElementById('cont-data').value;
        if (contdata == '') {
            alert('Por favor insira uma data válida.');
            return false;
        }

        // Motivo
        let contmotivo = document.getElementById('cont-motivo').value;
        if (contmotivo == '') {
            alert('Por favor informe o motivo do contacto.');
            return false;
        }

        alert(
            'O seu pedido de contacto foi submetido com sucesso. Obrigado! Responderemos o mais breve possivel'
        );
        return true;
    }

    $('#submeter_contacto').click(validar_pedido_contacto);

    //Script do OpenStreet Map

    function iniciarMapa() {
        const officeLatLng = L.latLng(41.16140318025507, -8.646579277483239);
        const map = L.map('map').setView(officeLatLng, 30);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution:
                '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        }).addTo(map);

        const officeMarker = L.marker(officeLatLng).addTo(map);
        officeMarker
            .bindPopup(
                '<b>São aqui os nossos escritórios, faça-nos uma visita!</b>'
            )
            .openPopup();

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    const userLatLng = L.latLng(
                        position.coords.latitude,
                        position.coords.longitude
                    );

                    //Para adicionar a rota ao mapa
                    L.Routing.control({
                        waypoints: [userLatLng, officeLatLng],
                        routeWhileDragging: true,
                        geocoder: L.Control.Geocoder.nominatim(),
                        showAlternatives: true,
                        createMarker: function (i, wp, n) {
                            return L.marker(wp.latLng, {
                                draggable: true,
                            }).bindPopup(
                                i === 0
                                    ? 'O teu local atual'
                                    : 'O nosso escritório'
                            );
                        },
                    }).addTo(map);

                    map.setView(userLatLng, 30);
                },
                function (error) {
                    alert(
                        'Não foi possível obter a tua localização. Por favor, verifica as permissões.'
                    );
                    console.error('Erro de geolocalização:', error);
                }
            );
        } else {
            alert('Geolocalização não é suportada pelo teu navegador.');
        }
    }

    // Inicia o mapa
    iniciarMapa();
});

//Script que confirma edição
function confirmEdit() {
    return confirm('Tens a certeza que queres guardar as alterações?');
}

//Script que confirma cancelamento
function confirmDelete() {
    return confirm('Tens a certeza que queres apagar este agendamento?');
}
