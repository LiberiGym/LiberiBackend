@extends('front.layout.layout_registro')
@section('css')
<link href="/css/registro.steps.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css" />

<link href="/admin_assets/plugins/dropzone/dropzone.css" rel="stylesheet" />
<link href="/admin_assets/css/base/theme/custom.css" rel="stylesheet" id="theme" />

<link href="/css/perfil.css" rel="stylesheet" id="theme" />

<link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" id="theme" />

<!--<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">-->

<style media="screen">
    .dt-buttons{
            text-align: right;
            margin-top: 10px;
    }
    .buttonsTable{
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        background: #1d4289;
        padding: 3px 10px;
        margin-right: 5px;
    }
</style>



@endsection
@section('content')

<!-- about -->
<div class="jarallax agileits-registro agile-section-about-detail" id="aboutUs">
    <div class="container">

        <div class="w3agile-about w3agile-about-detail">

            <div class="col-lg-3">
                <div class="logo-perfil" align="center">
                    <img src="/images/logo_admin_perfil.png" alt="" style="width:100%; text-aling:center;">
                </div>
                <hr class="hr-nav-perfil">
                <ul class="nav-perfil">
                    <li class="active"><a href="/administracion">Gimnasios <span><i class="fa fa-angle-right" aria-hidden="true"></i></span></a></li>
                    <li><a href="/administracion/usuarios">Usuarios <span><i class="fa fa-angle-right" aria-hidden="true"></i></span></a></li>
                    <li><a href="/administracion/ventas">Ventas <span><i class="fa fa-angle-right" aria-hidden="true"></i></span></a></li>
                    <li><a href="/administracion/notificaciones">Notificaciones <span><i class="fa fa-angle-right" aria-hidden="true"></i></span></a></li>
                    <li><a href="/administracion/promociones">Promociones <span><i class="fa fa-angle-right" aria-hidden="true"></i></span></a></li>

                </ul>
                <button type="button" name="button" id="btnCerrarSesion" class="cerrar-session">Cerrar Sesión</button>

            </div>
            <div class="col-lg-9">
                <h1>Gimnasios Registrados <img src="/images/barra_amarilla_banner_top.png" height="6" style="width:79px;"/></h1>
                <form class="form-registro" role="form" class="cmxform" method="post" id="frmDatos">

                    <fieldset class="col-lg-12">

                        <table id="table_usuarios" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Fecha de Registro</th>
                                    <th>Negocio</th>
                                    <th>Encargado</th>
                                    <th>Teléfono</th>
                                    <th>Correo Electrónico</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($gyms as $gym)
                                <tr>
                                    <td>
                                        {{$gym->created_at}}
                                    </td>
                                    <td>{{$gym->tradename}}</td>
                                    <td>{{$gym->manager}}</td>
                                    <td>{{$gym->manager_cel}}</td>
                                    <td>{{$gym->usuario->email}}</td>
                                    <td><a href="/administracion/clientes/gym/{{  $gym->id }}"><button type="button" class="btn btn-success btn-icon btn-sm btn-editar" data-id="{{  $gym->id }}" style="width: 44px;background: #fdb429; margin-right:10px;">Ver</button></a></td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="clearfix"></div>
                        <div class="" id="controlPanel"></div>

                    </fieldset>
                </form>

            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- //about -->
@endsection
@section('js')
<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/perfil_gym.js"></script>

<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>


<script>
$(document).ready(function () {

    var table = $('#table_usuarios').DataTable({
            "bLengthChange": false,
            "iDisplayLength": 10,
            "aaSorting": [
                [0,'ASC']
            ],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'print',
                    className: 'buttonsTable',
                    text: 'Imprimir',
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '10pt' )
                            .prepend(
                                '<div>'+
                                    '<table style="width:100%;">'+
                                        '<tr>'+
                                            '<td style="width:50%; text-align:center;">'+
                                                '<h3 style="font-size:18px;">Gimnasios Registrados</h3>'+
                                            '</td>'+
                                        '</tr>'+
                                    '</table>'+
                                '</div>'
                            );

                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', '10px' );
                    }
                },
                { extend: 'excel', className: 'buttonsTable', text: 'Exportar Excel' }
            ],
            "language": ﻿{
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "No se encontró información para mostrar",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },

        });

    table
        .buttons()
        .container()
        .appendTo( '#controlPanel' );

});

</script>
@endsection
