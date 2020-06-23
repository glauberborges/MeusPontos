@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Movimentações</h1>
@stop

@section('content')
    <div class="container content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Movimentações</h3>
                    </div>

                    <form class="" action="{{ route("movimentacoes.inserir") }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Funcionário</label>
                                    <select name="func_id" id="func_id" class="form-control {{ $errors->has('func_id') ? 'is-invalid' : '' }} ">
                                        @foreach($funcionarios->all() as $funcionario)
                                            <option value="{{$funcionario->id}}" {{ (old("func_id") == $funcionario->id ? "selected":"") }} > {{$funcionario->nome_completo}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('func_id'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('func_id') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tipo</label>
                                    <select name="tipo_movimentacao" id="tipo_movimentacao" class="form-control {{ $errors->has('tipo_movimentacao') ? 'is-invalid' : '' }} ">
                                        <option value="">Selecione</option>
                                        <option value="entrada" {{ (old("tipo_movimentacao") == "entrada" ? "selected":"") }} >Entrada</option>
                                        <option value="saida" {{ (old("tipo_movimentacao") == "saida" ? "selected":"") }} >Saída</option>
                                    </select>
                                    @if($errors->has('tipo_movimentacao'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('tipo_movimentacao') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Valor</label>
                                    <input type="number" step='0.01' class="form-control {{ $errors->has('valor') ? 'is-invalid' : '' }} " id="exampleInputEmail1"
                                           placeholder="53.00" name="valor" id="valor" value="{{ old('valor')  }}">
                                    @if($errors->has('valor'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('valor') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Observacão</label>
                                    <textarea class="form-control {{ $errors->has('observacao') ? 'is-invalid' : '' }}" name="observacao" id="observacao" cols="20" rows="5"></textarea>
                                    @if($errors->has('observacao'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('observacao') }}</strong>
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
