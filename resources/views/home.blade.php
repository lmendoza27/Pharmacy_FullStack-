@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>


   
        <div class="container mt-2">
        <div class="row">
        <div class="col-lg-12 margin-tb">
        <div class="pull-left">
       
        </div>
        <div class="pull-right mb-2">
        <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Crear Farmacia</a>
        </div>
        </div>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
        <p>{{ $message }}</p>
        </div>
        @endif
        <div class="card-body">
        <table class="table table-bordered" id="ajax-crud-datatable">
        <thead>
        <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Dirección</th>
        <th>Latitud</th>
        <th>Longitud</th>
        <th>Fecha de Creación</th>
        <th>Acción</th>
        </tr>
        </thead>
        </table>
        </div>
        </div>
        <!-- boostrap company model -->
        <div class="modal fade" id="company-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="CompanyModal"></h4>
        </div>
        <div class="modal-body">
        <form action="javascript:void(0)" id="CompanyForm" name="CompanyForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id">
        <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Nombre de Farmacia</label>
        <div class="col-sm-12">
        <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa Nombre de Farmacia" maxlength="50" required="">
        </div>
        </div>  
        <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Dirección de Farmacia</label>
        <div class="col-sm-12">
        <input type="double" class="form-control" id="direccion" name="direccion" placeholder="Ingresa Nombre de Farmacia" maxlength="50" required="">
        </div>
        </div>
        <div class="form-group">
        <label class="col-sm-2 control-label">Latitud de Farmacia</label>
        <div class="col-sm-12">
        <input type="double" class="form-control" id="latitud" name="latitud" placeholder="Ingresa Latitud de la Farmacia" required="">
        </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Longitud de Farmacia</label>
            <div class="col-sm-12">
            <input type="text"  class="form-control" id="longitud" name="longitud" placeholder="Ingresa Longitud de la Farmacia" required="">
            </div>
            </div>

        <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary" id="btn-save">Guardar Cambios
        </button>
        </div>
        </form>
        </div>
        <div class="modal-footer">
        </div>
        </div>
        </div>
        </div>
        <!-- end bootstrap model -->
      

</div>




@endsection

