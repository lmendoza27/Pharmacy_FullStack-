<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                   Home
                </a>
                @auth
               

                <a class="navbar-brand" target="_blank" href="{{ url('/log-viewer') }}">
                   Logs
                </a>

                <a class="navbar-brand" target="_blank" href="{{ url('/telescope') }}">
                    Tracking
                 </a>

                 <a class="navbar-brand" target="_blank" href="{{ url('/api/documentation') }}">
                    APIs
                 </a>

                 @endauth
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                          
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                 {{ __('Logout') }}
                             </a>
                             

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <!--<main class="">-->
            @yield('content')
        </main>
    </div>

    <!--<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>-->
@yield('scripts')
</body>


<script type="text/javascript">
    $(document).ready( function () {
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $('#ajax-crud-datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ url('ajax-crud-datatable') }}",
    columns: [
    { data: 'id', name: 'id' },
    { data: 'nombre', name: 'nombre' },
    { data: 'dirección', name: 'dirección' },
    { data: 'latitud', name: 'latitud' },
    { data: 'longitud', name: 'longitud' },
    { data: 'created_at', name: 'created_at' },
    {data: 'action', name: 'action', orderable: false},
    ],
    order: [[0, 'desc']],
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Nada que mostrar - lo sentimos",
            "info": "Mostrando página _PAGE_ de _PAGES_ ",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "paginate": {
                "previous": "Anterior",
                "next": "Siguiente"
            },
            "search": "Buscar:"
        }
    });
    $('#CompanyForm').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
    type:'POST',
    url: "{{ url('store-farmacia') }}",
    data: formData,
    cache:false,
    contentType: false,
    processData: false,
    success: (data) => {
    $("#company-modal").modal('hide');
    var oTable = $('#ajax-crud-datatable').dataTable();
    oTable.fnDraw(false);
    $("#btn-save").html('Submit');
    $("#btn-save"). attr("disabled", false);
    },
    error: function(data){
    console.log(data);
    }
    });
    });
    });
    function add(){
    $('#CompanyForm').trigger("reset");
    $('#CompanyModal').html("Agregar Farmacia");
    $('#company-modal').modal('show');
    $('#id').val('');
    }   
    function editFunc(id){
    $.ajax({
    type:"POST",
    url: "{{ url('edit-farmacia') }}",
    data: { id: id },
    dataType: 'json',
    success: function(res){
    $('#CompanyModal').html("Editar Farmacia");
    $('#company-modal').modal('show');
    $('#id').val(res.id);
    $('#name').val(res.nombre);
    $('#direccion').val(res.dirección);
    $('#longitud').val(res.longitud);
    $('#latitud').val(res.latitud);
    }
    });
    }  
    function deleteFunc(id){
    if (confirm("Delete Record?") == true) {
    var id = id;
    // ajax
    $.ajax({
    type:"POST",
    url: "{{ url('delete-farmacia') }}",
    data: { id: id },
    dataType: 'json',
    success: function(res){
    var oTable = $('#ajax-crud-datatable').dataTable();
    oTable.fnDraw(false);
    }
    });
    }
    }
    </script>

</html>