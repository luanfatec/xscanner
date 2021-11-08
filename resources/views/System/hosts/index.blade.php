@extends('System.master.index')

@section('content')

    <div id="xs-btn-create-host" onclick="document.getElementById('xs-model-hosts-create').style.display='block'">
        <span>
            <i class="fas fa-plus-circle fa-3x"></i>
        </span>
    </div>

    <div class="xs-paginate-buttons">
        {{ $hosts->links('vendor.pagination.pagination') }}
    </div>

    <div id="root-hosts" class="m-2">
        @foreach ($hosts as $item)
            <div class="xs-cards-lists mt-3">
                <span>
                    <i class="fas fa-server"></i>
                </span>
                <span><strong>Host: </strong> {{ $item->dshost }} - <span> {{ $item->dsname }} </span></span>
                <span class="xs-btn-details">
                    <button type="button" onclick="search_host('{{ $item->id }}')" >Destalhes</button>
                </span>
            </div>
        @endforeach

    </div>

    <div id="xs-model-hosts" class="w3-modal w3-animate-opacity" style="display: none">
        <div class="w3-modal-content w3-card-4">
            <header class="w3-container">
                <span onclick="document.getElementById('xs-model-hosts').style.display='none'"
                class="w3-button w3-large w3-display-topright">&times;</span>
                <div class="m-3">
                    <i class="fas fa-server fa-2x"></i>
                    <span class="xs-name-host" hostid=""></span>
                </div>
            </header>
            <div class="w3-container xs-select01">

                <div class="xs-content-details">
                    <div class="row selectrow01">
                        <div class="col-12 row m-2">
                            <div class="col-8">
                                <div>Endereço: <span class="xs-host" host=""></span></div>
                            </div>
                            <div class="col-4">
                                <span class="text-xs-danger">
                                    <a id="delete-host">Excluir</a>
                                </span>
                            </div>
                        </div>

                        <div class="xs-separate"></div>

                        <div class="col-12 row m-2">
                            <div class="col-8">
                                <strong>Status: </strong>
                                <span class="text-xs-success xs-is-active"></span>
                            </div>
                            <div class="col-4">
                                <span class="text-xs-danger">
                                    <a id="inactive-host">Desativar maquina</a>
                                </span>
                            </div>
                        </div>

                        <div class="xs-separate"></div>

                        <div class="col-12 row m-2">
                            <div class="col-12">Criado em: <span class="xs-created-date"></span></div>
                        </div>

                        <div class="xs-separate"></div>

                        <div class="col-12 row m-2 xs-form-create-new-scan">
                            <div class="col-12 text-center">
                                <h5>Criar um Scan<hr/></h5>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="xs-port-send">Nome para o Scan:</label>
                                    <input type="text" class="form-control" id="xs-p-scan-name-send">
                                </div>
                            </div>

                            <div class="col-4 mt-2">
                                <div class="form-group">
                                    <label for="xs-port-send">Porta:</label>
                                    <input type="text" class="form-control" id="xs-p-port-send">
                                </div>
                            </div>

                            <div class="col-4 mt-2">
                                <div class="form-group">
                                    <label for="xs-p-type-send">Tipo de scan:</label>
                                    <select type="text" class="form-control" id="xs-p-type-send">
                                        <option value="">selecione</option>
                                        <option value="single_port">Scanner simples</option>
                                        <option value="complex_ports">Scanner avançado</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-4 mt-2">
                                <div class="form-group">
                                    <label for="xs-port-send">Histórico(Dias):</label>
                                    <input type="text" class="form-control" id="xs-p-history-send">
                                </div>
                            </div>

                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <label for="xs-port-send">Descrição:</label>
                                    <textarea class="form-control" id="xs-p-description-send" cols="30" rows="4"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="xs-separate"></div>

                        <div class="col-12 mt-2">
                            <div class="row text-center">

                                <div class="col-6">
                                    <button class="btn text-xs-white xs-btn-cancel" onclick="document.getElementById('xs-model-hosts').style.display='none'">Cancelar</button>
                                </div>

                                <div class="col-6 ">
                                    <button class="btn text-xs-white xs-action-create-scanner">Criar scan</button>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <footer class="w3-container">
                <p></p>
            </footer>
        </div>
    </div>

    <div id="xs-model-hosts-create" class="w3-modal w3-animate-opacity" style="display: none;">
        <div class="w3-modal-content w3-card-4" style="height: 64vh;">
            <header class="w3-container">
                <span onclick="document.getElementById('xs-model-hosts-create').style.display='none'"
                class="w3-button w3-large w3-display-topright">&times;</span>
                <div class="m-3">
                    <i class="fas fa-server fa-2x"></i>
                    <span class="xs-name-host">Novo Host</span>
                </div>
            </header>
            <div class="w3-container xs-select01">

                <div class="xs-content-details">
                    <div class="row selectrow01">

                        <div class="col-12 row m-2 xs-form-create-new-scan">
                            <div class="col-12 text-center">
                                <h5>Criar um Host<hr/></h5>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="xs-port-send">Nome para o Host:</label>
                                    <input type="text" class="form-control" id="xs-p-hname">
                                </div>
                            </div>

                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <label for="xs-port-send">Endereço do alvo:</label>
                                    <input type="text" class="form-control" id="xs-p-hhost">
                                </div>
                            </div>
                        </div>

                        <div class="xs-separate"></div>

                        <div class="col-12 mt-2">
                            <div class="row text-center mb-2">

                                <div class="col-6">
                                    <button class="btn text-xs-white xs-btn-cancel" onclick="document.getElementById('xs-model-hosts-create').style.display='none'">Cancelar</button>
                                </div>

                                <div class="col-6">
                                    <button class="btn text-xs-white xs-action-create-host">Criar máquina</button>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>

            </div>
            <footer class="w3-container">
                <p></p>
            </footer>
        </div>
    </div>

@endsection


@section('scripts')
    <script>
        function formatDate(datetimestamp)
        {
            let date = new Date(datetimestamp);
            const month = date.getMonth() + 1

            return `${
                date.getDate().toString().length === 2 ? date.getDate() : `0${date.getDate()}`
            }/${
                month.toString().length === 2 ? month : `0${month}`
            }/${
                date.getFullYear()
            } as ${
                date.getHours().toString().length === 2 ? date.getHours() : `0${date.getHours()}`
            }:${
                date.getMinutes().toString().length === 2 ? date.getMinutes() : `0${date.getMinutes()}`
            }`;
        }

        function template_code_expired(target_name, response)
        {
            $(`${target_name}`).html(`
                <div class="xs-cards-lists mt-3">
                    <span>${response.status} - </span>
                    <span>
                        <a href="{{ route('system.login.logout') }}">Clique aqui para encerrar minha sessão</a>
                    </span>
                </div>
            `);
        }

        /* Inicio da ação de busca pelo jwt */
        function getCookie(c_name) {
            if (document.cookie.length > 0) {
                c_start = document.cookie.indexOf(c_name + "=");
                if (c_start != -1) {
                    c_start = c_start + c_name.length + 1;
                    c_end = document.cookie.indexOf(";", c_start);
                    if (c_end == -1) {
                        c_end = document.cookie.length;
                    }
                    return unescape(document.cookie.substring(c_start, c_end));
                }
            }
            return "";
        }
        function decodeTK() {
            return JSON.parse(window.atob(unescape(encodeURIComponent(getCookie("jwt_token") )))).access_token;
        }
        /* Final da ação de busca pelo jwt */

        /// Inactived host
        $("#inactive-host").on("click", function () {
            $.ajax({
                type: "POST",
                url: "{{ route('api.inactive-host') }}",
                data: {
                    idhost: `${$("#xs-model-hosts .xs-name-host")[0].attributes[1].value}`
                },
                headers: {
                    Authorization: 'Bearer ' + decodeTK()
                },
                success: function (response, status, xhr) {
                    if (response.status || response.status === "error") {
                        alert(response.message);
                    } else {
                        alert(response.message);
                        window.location.reload();
                    }
                },
                error: function (xhr, status, error) {
                    alert(error);
                }
            });
        });

        /// Delete host
        $("#delete-host").on("click", function () {
            $.ajax({
                type: "DELETE",
                url: "{{ route('api.delete-host') }}",
                data: {
                    idhost: `${$("#xs-model-hosts .xs-name-host")[0].attributes[1].value}`
                },
                headers: {
                    Authorization: 'Bearer ' + decodeTK()
                },
                success: function (response, status, xhr) {
                    if (response.status || response.status === "error") {
                        alert(response.message);
                    } else {
                        alert(response.message);
                        window.location.reload();
                    }
                },
                error: function (xhr, status, error) {
                    alert(error);
                }
            });
        });

        // Realizando a busca de um host específico.
        function search_host(host) {
            document.getElementById('xs-model-hosts').style.display='block';

            $.ajax({
                type: "POST",
                url: "{{ route('api.get-host') }}",
                data: {
                    idhost: `${host}`
                },
                headers: {
                    Authorization: 'Bearer ' + decodeTK()
                },
                success: function (response, status, xhr) {
                    if (response.code || response.code == 406) {
                        template_code_expired("#xs-model-hosts .xs-select0", response);
                    } else {
                        /* Adicionando o nome dohost*/
                        $("#xs-model-hosts .xs-name-host").html(response.dsname);
                        /** Adicionando um atributo com o id do host selecionado.
                         * Esse id será utilizando para realizar a criação de um novo scanner com a porta determinada.
                        */
                        $("#xs-model-hosts .xs-name-host").attr("hostid", host);
                        // Adicionado o endereço do host e criando um atributo com o valor de host.
                        $("#xs-model-hosts .xs-host").html(response.dshost);
                        $("#xs-model-hosts .xs-host").attr("host", response.dshost);

                        /**
                        * Verificando se o host está ativo.
                        * Caso não esteja ativo, será aplicada uma classe mudando a cor do
                        * texto para vermelho e adicionado um texto de inativo.
                        */
                        if (response.dsactive == 1) {
                            $("#xs-model-hosts .xs-is-active").addClass("text-xs-danger");
                            $("#xs-model-hosts .xs-is-active").html("Inativo");
                        } else {
                            $("#xs-model-hosts .xs-is-active").removeClass("text-xs-danger");
                            $("#xs-model-hosts .xs-is-active").html("Ativo");
                        }

                        $("#xs-model-hosts .xs-created-date").html(formatDate(response.created_at));

                    }
                },
                error: function (xhr, status, error) {
                    alert(error);
                }
            });
        }

        // xs-action-create-host
        $(".xs-action-create-host").on("click", function () {

            $.ajax({
                type: "PUT",
                url: "{{ route('api.create-host') }}",
                data: {
                    hname: $("#xs-p-hname").val(),
                    hhost: $("#xs-p-hhost").val(),
                },
                headers: {
                    Authorization: 'Bearer ' + decodeTK()
                },
                success: function (response, status, xhr) {

                    if (response.status || response.status === "error") {
                        alert(response.message);
                    } else {
                        alert(response.message);
                        window.location.reload();
                    }
                },
                error: function (xhr, status, error) {
                    alert(error);
                }
            });
        });

        /**
        * Ação:
        * Criação de um scanner
        * Class: xs-form-create-new-scan
        */

        $(".xs-action-create-scanner").on("click", function (e) {

            $.ajax({
                type: "POST",
                url: "{{ route('api.create-port-scan') }}",
                data: {
                    scann_name: $("#xs-p-scan-name-send").val(),
                    ports: $("#xs-p-port-send").val(),
                    history: $("#xs-p-history-send").val(),
                    description: $("#xs-p-description-send").val(),

                    host_target: $("#xs-model-hosts .xs-host")[0].attributes[1].value,
                    host_id: $("#xs-model-hosts .xs-name-host")[0].attributes[1].value,
                    type_scan: $("#xs-p-type-send").val(),
                },
                headers: {
                    Authorization: 'Bearer ' + decodeTK()
                },
                success: function (response, status, xhr) {
                    if (response.code || response.code == 406) {
                        template_code_expired("#xs-model-hosts .xs-select0");
                    } else {
                        if(response.status || response.status === "error")
                        {
                            alert(response.message);
                        } else {
                            alert(response.message);
                            window.location.reload();
                        }
                    }
                },
                error: function (xhr, status, error) {
                    alert(error);
                }
            });

        });

    </script>

@endsection
