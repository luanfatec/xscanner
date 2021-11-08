@extends('System.master.index')

@section('content')
    <div class="xs-paginate-buttons">
        {{ $history->links('vendor.pagination.pagination') }}
    </div>
    <div id="root-history-ports" class="m-2" >
        @foreach ($history as $item)
            <div class="xs-cards-lists mt-3">
                <span>
                    <i class="fas fa-ethernet"></i>
                </span>
                <span><strong>Host: </strong> {{ $item->host }} : <span>{{ $item->port }}</span></span>
                <span class="xs-btn-details">
                    <button type="button" onclick="search_history_port('{{ $item->id }}')" >Destalhes</button>
                </span>
            </div>
        @endforeach
    </div>

    <div id="xs-model-history-ports" class="w3-modal w3-animate-opacity" style="display: none">
        <div class="w3-modal-content w3-card-4">
            <header class="w3-container">
                <span onclick="document.getElementById('xs-model-history-ports').style.display='none'"
                class="w3-button w3-large w3-display-topright">&times;</span>
                <div class="m-3">
                    <i class="fas fa-ethernet fa-2x"></i>
                    <span class="xs-history-ports"></span>
                </div>
            </header>
            <div class="w3-container xs-select01">

                <div class="xs-content-details">
                    <div class="row selectrow01">

                        <div class="col-12 row m-2">
                            <div>Endereço: <span class="xs-history"></span></div>
                        </div>

                        <div class="xs-separate"></div>

                        <div class="col-12 row m-2">
                            <div class="col-8">
                                <strong>Status: </strong>
                                <span class="text-xs-success xs-is-onoroff"></span>
                            </div>
                            <div class="col-4">
                                <span class="text-xs-danger">
                                </span>
                            </div>
                        </div>

                        <div class="xs-separate"></div>

                        <div class="col-12 row m-2">
                            <div class="col-12">Escaneado em: <span class="xs-scan-date"></span></div>
                        </div>

                        <div class="xs-separate"></div>

                        <div class="col-12 row m-2 xs-form-create-new-scan">
                            <div class="col-12 text-center">
                                <h5>Detalhes do Scan<hr/></h5>
                            </div>

                            <div class="col-8 mt-2">
                                <div class="form-group">
                                    <label for="xs-port-send">Porta:</label>
                                    <input type="text" class="form-control" id="xs-p-history-port" disabled>
                                </div>
                            </div>
                            <div class="col-4 mt-2">
                                <div class="form-group">
                                    <label for="xs-port-send">Histórico(Dias):</label>
                                    <input type="text" class="form-control" id="xs-p-history-history" disabled>
                                </div>
                            </div>

                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <label for="xs-port-send">Descrição:</label>
                                    <textarea class="form-control" id="xs-p-description-history" cols="30" rows="4" disabled></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="xs-separate"></div>

                        <div class="col-12 mt-2">
                            <div class="row text-center">

                                <div class="col-12">
                                    <button class="btn text-xs-white xs-btn-cancel" onclick="document.getElementById('xs-model-history-ports').style.display='none'">Fechar</button>
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

        // Search History Ports
        function search_history_port(history) {
            console.log(history);
            document.getElementById('xs-model-history-ports').style.display='block';

            $.ajax({
                type: "POST",
                url: "{{ route('api.get-history') }}",
                headers: {
                    Authorization: 'Bearer ' + decodeTK()
                },
                data: {
                    idhistory: history
                },
                success: function (response, status, xhr) {
                    console.log(response);
                    if (response.code || response.code == 406) {
                        template_code_expired("#xs-model-history-ports .xs-select0");
                    } else {
                        $("#xs-model-history-ports .xs-history-ports").text(response.host);

                        //
                        $("#xs-model-history-ports .xs-history").text(response.host);

                        //
                        $("#xs-model-history-ports .xs-scan-date").text(formatDate(response.created_at));

                        //
                        $("#xs-model-history-ports #xs-p-history-port").val(response.port);

                        //
                        $("#xs-model-history-ports #xs-p-history-history").val(response.temp_history);

                        //xs-p-description-history
                        $("#xs-model-history-ports #xs-p-description-history").val(response.description);

                        // xs-is-onoroff
                        if (!response.onoroff == 1) {
                            $("#xs-model-history-ports .xs-is-onoroff").addClass("text-xs-danger");
                            $("#xs-model-history-ports .xs-is-onoroff").html("Fechada");
                        } else {
                            $("#xs-model-history-ports .xs-is-onoroff").removeClass("text-xs-danger");
                            $("#xs-model-history-ports .xs-is-onoroff").html("Aberta");
                        }
                    }

                },
                error: function (xhr, status, error) {
                    alert(error);
                }
            });
        }

    </script>
@endsection
