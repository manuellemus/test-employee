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
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                        Nuevo Empleado
                    </button>

                    <br>
                    <hr>
                    <!-- seccion de busqueda -->
                    
                        <div class="row mb-3">
                            <div class="col-md-6 ">
                                <label for="Nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre_search" >
                            </div>
                            <div class="col-md-6 ">
                                <label for="correo">Correo</label>
                                <input type="text" class="form-control" name="correo" id="correo_search" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 ">
                                <label for="telefono">Telefono</label>
                                <input type="text" class="form-control" name="telefono" id="telefono_search" >
                            </div>
                            <div class="col-md-6 ">
                                <label for="address">Departameto</label>
                                <select class="form-control" name="departamento_id" id="departamento_id_search">
                                    @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->nombreDepartamento }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="modal-foote row mb-3r">
                            @csrf
                            <input type="submit" value="Buscar" class="btn btn-sm btn-primary col-6" onclick="onChangeSendRequest()">
                        </div>
                    

                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Telefono</th>
                                <th>Departamento</th>
                                <th></th>
                                <th></th>
                            </tr>
                        <tbody id="cuerpoTabla">

                        </tbody>
                        </thead>
                    </table>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Nuevo empleado</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('empleado.store') }}" method="POST">
                                        <div class="row mb-3">
                                            <div class="col-md-6 ">
                                                <label for="Nombre">Nombre</label>
                                                <input type="text" class="form-control" name="nombre" id="Nombre" required>
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="correo">Correo</label>
                                                <input type="text" class="form-control" name="correo" id="correo" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6 ">
                                                <label for="telefono">Telefono</label>
                                                <input type="text" class="form-control" name="telefono" id="telefono" required>
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="address">Departameto</label>
                                                <select class="form-control" name="departamento_id" id="departamento_id">
                                                    @foreach($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->nombreDepartamento }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="modal-foote row mb-3r">
                                            @csrf
                                            <button type="button" class="btn btn-danger col-6" data-dismiss="modal">Calcelar</button>
                                            <input type="submit" value="Guardar" class="btn btn-sm btn-primary col-6">
                                        </div>
                                    </form>
                                    <br>
                                    <hr>
                                    <br>
                                    <table id="example_two" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Correo</th>
                                                <th>Telefono</th>
                                                <th>Departamento</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        <tbody>
                                            @foreach($empleados as $empleado)
                                            <tr>
                                                <td>{{ $empleado->nombre }}</td>
                                                <td>{{ $empleado->correo }}</td>
                                                <td>{{ $empleado->telefono }}</td>
                                                <td>{{ $empleado->departamento->nombreDepartamento }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdropEdit" onclick="set_body_modal_of_edit('{{ $empleado->id }}')">
                                                        Editar
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#staticBackdropDelete" onclick="set_body_modal_of_delete('{{ $empleado->id }}')">
                                                        Eliminar
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdropEdit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropEditLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropEditLabel">Editando Empleado</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="body_modal_edit">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdropDelete" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropDeleteLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropDeleteLabel">Desea eliminar esta informacion</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="body_modal_delete">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<h2></h2>
<input type="hidden" id="url_base" value="{{ route('empleado.search') }}">

<script>
    function set_body_modal_of_edit(id) {
        //todos los empleados
        const empleados = <?php echo json_encode($empleados); ?>;
        console.log(empleados);

        //bucando empleado
        var empleado = empleados.filter(obj => obj.id == id);
        console.log(empleado);
        var body_edit = document.getElementById('body_modal_edit');
        console.log(empleado[0].nombre);
        var url = 'http://localhost:8000/empleado/' + empleado[0].id;

        content = `
        <form action="${url}" method="POST">
                                        <div class="row mb-3">
                                            <div class="col-md-6 ">
                                                <label for="Nombre">Nombre</label>
                                                <input type="text" class="form-control" name="nombre" id="Nombre" required value="${empleado[0].nombre}">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="correo">Correo</label>
                                                <input type="text" class="form-control" name="correo" id="correo" required value="${empleado[0].correo}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6 ">
                                                <label for="telefono">Telefono</label>
                                                <input type="text" class="form-control" name="telefono" id="telefono" required value="${empleado[0].telefono}">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="address">Departameto</label>
                                                <select class="form-control" name="departamento_id" id="departamento_id">
                                                <option selected value="${empleado[0].departamento.id}">${empleado[0].departamento.nombreDepartamento}</option>

                                                    @foreach($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->nombreDepartamento }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="modal-foote row mb-3r">
                                            <input type="hidden"name="id" id="id" required value="${empleado[0].id}">
                                            @csrf
                                            @method('PUT')
                                            <button type="button" class="btn btn-danger col-6" data-dismiss="modal">Calcelar</button>
                                            <input type="submit" value="Guardar" class="btn btn-sm btn-primary col-6">
                                        </div>
                                    </form>
                                    `;


        body_edit.innerHTML = content;
    }

    function set_body_modal_of_delete(id) {
        //todos los empleados
        const empleados = <?php echo json_encode($empleados); ?>;
        console.log(empleados);

        //bucando empleado
        var empleado = empleados.filter(obj => obj.id == id);
        console.log(empleado);
        var body_delete = document.getElementById('body_modal_delete');
        console.log(empleado[0].nombre);
        var url = 'http://localhost:8000/empleado/' + empleado[0].id;

        content = `
        <form action="${url}" method="POST">
                                        <div class="row mb-3">
                                            <div class="col-md-6 ">
                                                <label for="Nombre">Nombre</label>
                                                <input type="text" class="form-control" name="nombre" id="Nombre" required value="${empleado[0].nombre}">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="correo">Correo</label>
                                                <input type="text" class="form-control" name="correo" id="correo" required value="${empleado[0].correo}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6 ">
                                                <label for="telefono">Telefono</label>
                                                <input type="text" class="form-control" name="telefono" id="telefono" required value="${empleado[0].telefono}">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="address">Departameto</label>
                                                <select class="form-control" name="departamento_id" id="departamento_id">
                                                <option selected value="${empleado[0].departamento.id}">${empleado[0].departamento.nombreDepartamento}</option>

                                                    @foreach($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->nombreDepartamento }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="modal-foote row mb-3r">
                                            <input type="hidden"name="id" id="id" required value="${empleado[0].id}">
                                            @csrf
                                            
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger col-6" data-dismiss="modal">Calcelar</button>
                                            <input type="submit" value="Eliminar" class="btn btn-sm btn-primary col-6">
                                        </div>
                                    </form>
                                    `;


        body_delete.innerHTML = content;
    }

    function onChangeSendRequest() {
        var nombre = document.getElementById("nombre_search").value;
        var correo = document.getElementById("correo_search").value;
        var telefono = document.getElementById("telefono_search").value;
        var departamento_id = document.getElementById("departamento_id_search").value;


        var url_base = document.getElementById("url_base").value;

        $.ajax({
            url: url_base,
            data: "nombre=" + nombre + "&correo=" + correo + "&telefono=" + telefono + "&departamento_id=" + departamento_id + "&_token={{ csrf_token()}}",
            dataType: "json",
            method: "POST",
            success: function(data) {

                //limpiando tabla
                const $elemento = document.querySelector("#cuerpoTabla");
                $elemento.innerHTML = "";
                //fin lipiar
                for (var i = 0; i < data.length; i++) {
                    var tr = `<tr>
                                    <td>` + data[i].nombre + `</td>
                                    <td>` + data[i].correo + `</td>
                                    <td>` + data[i].telefono + `</td>
                                    <td>` + data[i].nombreDepartamento + `</td>
                                    <td>  </td>
                                    <td>  </td>

                                </tr>`;
                    $("#cuerpoTabla").append(tr)
                }

            },
            fail: function() {},
            beforeSend: function() {}
        });
    }
</script>
@endsection