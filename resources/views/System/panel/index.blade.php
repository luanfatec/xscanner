@extends('System.master.index')


@section('content')
    <div id="root-panel">

        <div class="row mt-3 selected01">
            <div class="col-4">
                <div class="card bg-xs-dark-color-tertiary">
                    <div class="card-header" >
                        <i class="fas fa-server fa-2x"></i>
                        <span class="xs-title-card"> Máquinas</span>
                    </div>
                    <div class="card-body xs-card-b-host">

                        <span></span>

                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card bg-xs-dark-color-tertiary">
                    <div class="card-header">
                        <i class="fas fa-ethernet fa-2x"></i>
                        <span class="xs-title-card">Portas</span>
                    </div>
                    <div class="card-body xs-card-b-port">

                        <span></span>

                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card bg-xs-dark-color-tertiary">
                    <div class="card-header">
                        <i class="fas fa-history fa-2x"></i>
                        <span class="xs-title-card"> Máquinas</span>
                    </div>
                    <div class="card-body xs-card-b-history">

                        <span></span>

                    </div>
                </div>
            </div>

            <div class="col-12 mt-3 xs-history">
                <div class="card bg-xs-dark-color-tertiary">
                    <div class="card-header">
                        <i class="fas fa-history fa-2x"></i>
                        <span class="xs-title-card"> Ultimos escaneamento</span>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
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


        $.ajax({
            type: "POST",
            url: "{{ route('api.get-history-panel') }}",
            headers: {
                Authorization: 'Bearer ' + decodeTK()
            },
            success: function (response, status, xhr) {
                for (let index in response)
                {

                    if (response.code || response.code == 406) {
                        template_code_expired("#root-panel", response)
                        break;
                    } else {
                        $(".xs-history .card-body").append(`
                            <div class="xs-cards-lists mt-3">
                                <span>
                                    <i class="fas fa-ethernet"></i>
                                </span>
                                <span><strong>Realizado em: </strong> ${response[index].host} : <span>${response[index].port}</span></span>
                                <span class="xs-btn-data">
                                    <span>${formatDate(response[index].created_at)}</span>
                                </span>
                            </div>
                        `);
                    }
                }

            },
            error: function (xhr, status, error) {
                alert(error);
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('api.get-count') }}",
            headers: {
                Authorization: 'Bearer ' + decodeTK()
            },
            success: function (response, status, xhr) {

                if (response.code || response.code == 406) {
                    template_code_expired("#root-panel", response)
                } else {
                    $(".xs-card-b-host span").text(response.host)
                    $(".xs-card-b-port span").text(response.port)
                    $(".xs-card-b-history span").text(response.history)
                }

            },
            error: function (xhr, status, error) {
                alert(error);
            }
        });

    </script>
@endsection
