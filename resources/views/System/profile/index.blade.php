@extends('System.master.index')

@section('content')
    <div id="root-profile">

        <div class="row">
            <div class="col-12">
                <div class="card bg-xs-dark-color-tertiary">
                    <div class="card-header">
                        <span>Logado como: <span class="xs-name-user">{{ auth()->user()->name }}</span></span>
                    </div>
                    <div class="card-body">

                        <form class="row" action="{{ route('system.save.user') }}" method="POST">
                            @method('PUT')
                            @csrf

                            <div class="col-12 row mt-3">
                                <div class="form-group col-6">
                                    <label for="nameuser" >Nome:</label>
                                    <input type="text" class="mt-2 form-control" id="nameuser" name="name" value="{{ auth()->user()->name }}"/>
                                </div>

                                <div class="form-group col-6">
                                    <label for="email" >Nome:</label>
                                    <input type="text" class="mt-2 form-control" id="email" name="email" value="{{ auth()->user()->email }}"/>
                                </div>
                            </div>


                            <div class="col-12 row mt-3">
                                <div class="form-group col-6">
                                    <label for="nivel" >Nivel:</label>
                                    <input type="text" class="mt-2 form-control" id="nivel" value="@php
                                        if (auth()->user()->type == 0) {
                                            echo "Administrador";
                                        } else {
                                            echo "Usuário";
                                        }
                                    @endphp"/>
                                </div>

                                <div class="form-group col-6">
                                    <label for="password" >Nome:</label>
                                    <input type="password" class="mt-2 form-control" id="password" name="password" value=""/>
                                </div>
                            </div>

                            <div class="col-12 row mt-3">
                                <div class="form-group col-6">
                                    <button type="submit" class="btn text-xs-white xs-action-delete-account" name="action" value="delete">Excluir minha conta</button>
                                </div>

                                <div class="form-group col-6">
                                    <button type="submit" class="btn text-xs-white xs-action-updated-account" name="action" value="update">Atualizar conta</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
