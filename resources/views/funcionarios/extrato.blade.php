@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Extrato</h1>
@stop

@section('content')
    <div class="container content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Extrato funcionário</h3>
                    </div>

                    <table id="pageTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Data da movimentação</th>
                                <th>Tipo</th>
                                <th>Valor</th>
                                <th>Observação</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($extrato as $item)
                                <tr>
                                    <td>
                                        {{ date_format($item->created_at,"d/m/Y H:i:s") }}
                                    </td>
                                    <td>
                                        {{ $item->tipo_movimentacao }}
                                    </td>
                                    <td>
                                        {{ $item->valor }}
                                    </td>
                                    <td>
                                        {{ $item->observacao }}
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
                });

            $(".btn-search--nome-js").click(function (e) {
                e.preventDefault();
                myTable.column(1).search($('.input-search--nome-js').val(), false, false);
                myTable.table().draw();
            })

            $(".btn-search--date-js").click(function (e) {
                e.preventDefault();
                myTable.column(3).search($('.input-search--date-js').val(), false, false);
                myTable.table().draw();
            })

            $(".btn-search--clear-js").click(function (e) {
                e.preventDefault();
                $('.input-search--nome-js').val(" ")
                $('.input-search--date-js').val(" ")
                myTable.column(1).search('', false, false);
                myTable.column(3).search('', false, false);
                myTable.table().draw();
            })

        });
    </script>
@stop
