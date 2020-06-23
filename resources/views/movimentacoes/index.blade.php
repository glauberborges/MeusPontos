@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Movimentações</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box">


                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-6"> <h3 class="box-title">Listagem das Movimentações</h3></div>
                            <div class="col-md-6 text-right">
                                <a href="{{route('funcionarios.novo')}}" class="btn bg-olive margin"><i class="fa fa-plus"></i> Inserir </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            @if (session()->has('success'))
                                <div class="callout callout-success bg-success">
                                    <h4>Sucesso!</h4>
                                    <p>{{session('success')}}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="bg-destaque">
                        <div class="row">
                            <div class="col-md-4"> <p>Buscar pelo nome </p> <input type="text"  class="input-search--nome-js">  <button class="btn btn-info btn-search--nome-js">Buscar</button> </div>
                            <div class="col-md-4"> <p>Buscar por data </p> <input type="date"  class="input-search--date-js">  <button class="btn btn-info btn-search--date-js">Buscar</button> </div>
                            <div class="col-md-4"> <p>Buscar por tipo </p> 
                                {{--<input type="text"  class="input-search--tipo-js">--}}
                                <select name="" id="" class="form-controlx input-search--tipo-js">
                                    <option value="entrada" >Entrada</option>
                                    <option value="saida">Saída</option>
                                </select>
                                <button class="btn btn-info btn-search--tipo-js">Buscar</button> 
                            </div>

                            <hr>
                            <div class="col-md-12">
                                <button class="btn btn-info btn-search--clear-js">Limpar busca</button>
                            </div>
                        </div>
                    </div>

                    <table id="pageTable" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Valor</th>
                            <th>funcionário</th>
                            <th>Observação</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($data_tables as $item)
                            <tr>
                                <td>
                                    {{ $item->id }}
                                </td>
                                <td>
                                    {{ $item->tipo_movimentacao }}
                                </td>
                                <td>
                                    {{ $item->valor }}
                                </td>
                                <td>
                                    {{ $item->funcionario->nome_completo }}
                                </td>
                                <td>
                                    {{ $item->observacao }}
                                </td>
                                <td>
                                    {{ date_format($item->updated_at,"d/m/Y") }}
                                </td>
                                <td>
                                    {{ date_format($item->updated_at,"Y-m-d") }}
                                </td>



                                <td width="80">
                                    <div class="btn-group">
                                        <a href="{{route('funcionarios.editar', $item->id)}}" class="btn btn-info"> <i class="fa fa-edit"></i></a>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{route('funcionarios.extrato', $item->id)}}">Extrato</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop

@section('plugins.Datatables', true)
@section('css')
@stop

@section('js')
    <script>
        jQuery(function($) {
            const myTable =
                $('#pageTable').DataTable( {
                    bAutoWidth: false,
                    "aoColumns": [
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        null
                    ],
                    "aaSorting": [],
                    select: {
                        style: 'multi'
                    },
                    language: {
                        "sEmptyTable": "Nenhum registro encontrado",
                        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sInfoThousands": ".",
                        "sLengthMenu": "_MENU_ resultados por página",
                        "sLoadingRecords": "Carregando...",
                        "sProcessing": "Processando...",
                        "sZeroRecords": "Nenhum registro encontrado",
                        "sSearch": "Pesquisar",
                        "oAria": {
                            "sSortAscending": ": Ordenar colunas de forma ascendente",
                            "sSortDescending": ": Ordenar colunas de forma descendente"
                        }
                    },
                    columnDefs: [
                        {
                            "targets": [7],
                            "visible": true,
                            "searchable": false,
                            "orderable": false
                        },{
                            "targets": [6],
                            "visible": false,
                            "searchable": true,
                            "orderable": true
                        },
                    ],
                });

            $(".btn-search--tipo-js").click(function (e) {
                e.preventDefault();
                myTable.column(1).search($('.input-search--tipo-js').val(), false, false);
                myTable.table().draw();
            })

            $(".btn-search--nome-js").click(function (e) {
                e.preventDefault();
                myTable.column(3).search($('.input-search--nome-js').val(), false, false);
                myTable.table().draw();
            })

            $(".btn-search--date-js").click(function (e) {
                e.preventDefault();
                myTable.column(6).search($('.input-search--date-js').val(), false, false);
                myTable.table().draw();
            })


            $(".btn-search--clear-js").click(function (e) {
                e.preventDefault();
                $('.input-search--nome-js').val(" ")
                $('.input-search--date-js').val(" ")
                $('.input-search--tipo-js').val(" ")
                myTable.column(1).search('', false, false);
                myTable.column(3).search('', false, false);
                myTable.column(6).search('', false, false);
                myTable.table().draw();
            })

        });


    </script>
@stop
