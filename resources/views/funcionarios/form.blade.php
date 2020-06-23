@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Formulário</h1>
@stop

@section('content')
    <div class="container content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Formulário funcionário</h3>
                    </div>

                    <form class="" action="{{(isset($funcionarios)) ? route("funcionarios.edicao") : route("funcionarios.inserir")  }}" method="POST" enctype="multipart/form-data">
                        @if(isset($funcionarios))
                            <input type="hidden" name="id" value="{{ $funcionarios->id }}">
                        @endif

                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nome completo</label>
                                    <input type="text" class="form-control {{ $errors->has('nome_completo') ? 'is-invalid' : '' }} " id="exampleInputEmail1"
                                           placeholder="Digite o nome completo" name="nome_completo" id="nome_completo" value="{{(isset($funcionarios)) ? $funcionarios->nome_completo :  old('nome_completo')  }}">
                                </div>
                                @if($errors->has('nome_completo'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('nome_completo') }}</strong>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">E-mail</label>
                                    <input type="email" class="form-control {{ $errors->has('login') ? 'is-invalid' : '' }} " id="exampleInputEmail1"
                                           placeholder="Digite o nome completo" name="login" id="login" value="{{(isset($funcionarios)) ? $funcionarios->login :  old('login')  }}">
                                    @if($errors->has('login'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('login') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Senha</label>
                                    <input type="password" class="form-control {{ $errors->has('senha') ? 'is-invalid' : '' }} " id="exampleInputEmail1"
                                           placeholder="Digite o nome completo" name="senha" id="senha" value="{{(isset($funcionarios)) ? $funcionarios->senha :  old('senha')  }}">
                                    @if($errors->has('senha'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('senha') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Saldo</label>
                                    <input type="text" class="form-control {{ $errors->has('saldo_atual') ? 'is-invalid' : '' }} " id="exampleInputEmail1"
                                           placeholder="Digite o saldo aqui" name="saldo_atual" id="saldo_atual" value="{{(isset($funcionarios)) ? $funcionarios->saldo_atual :  old('saldo_atual')  }}">
                                    @if($errors->has('saldo_atual'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('saldo_atual') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="box-footer clearfix">
                            <button type="submit" class="btn btn-primary fa-pull-right">Enviar</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@stop

@section('plugins.Datatables', true)
@section('css')
@stop

@section('js')
@stop
