@extends('layouts.argon')
@section('title', 'Formato de Inducción')
@section('content')
    @include('layouts.argon_nav_user_2')
    {{ Auth()->user()->formato }}
    @if (!Auth()->user()->formato)
        <div class="container-fluid my-5">
            <div class="card shadow">
                <div class="card-header bg-translucent-white">
                    <h2 class="mt-3 font-weight-bold">Formato de Inducción</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.doformato') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <p class="card-text">Por favor llenas todos campos para poder así realizar el formato y finalizar la
                            inducción.</p>
                        <h3>Datos Generales</h3>
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="date" class="font-weight-bold">Fecha de Finalización</label>
                                    <input type="date" name="date" id="date" class="form-control" placeholder="date"
                                        aria-describedby="helpId">
                                    @error('date')
                                        <small id="helpId" class="bg-translucent-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="city" class="font-weight-bold">Ciudad</label>
                                    <input type="text" name="city" id="city" class="form-control" placeholder="Ciudad"
                                        aria-describedby="helpId">
                                    @error('city')
                                        <small id="helpId" class="bg-translucent-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <h3 class="text-left">A continuación seleccione</h3>
                        <div class="row">
                            <div class="col-12-col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="tipo_vinculacion">Tipo de Contratación/Vinculación</label>
                                    <select class="form-control" name="tipo_vinculacion" id="tipo_vinculacion">
                                        <option value="-1">Seleccione una opción por favor</option>
                                        <option>Contrato Laboral</option>
                                        <option>Prestación de Servicios</option>
                                        <option>Trabajador en Misión</option>
                                        <option>Contrato de Aprendizaje</option>
                                    </select>
                                    @error('tipo_vinculacion')
                                        <small id="helpId" class="bg-translucent-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12-col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="rol_institucion">Rol en la Institución</label>
                                    <select class="form-control" name="rol_institucion" id="rol_institucion">
                                        <option value="-1">Seleccione una opción por favor</option>
                                        <option>Profesor</option>
                                        <option>Administrativo</option>
                                        <option>Estudiante en Prácticas</option>

                                    </select>
                                    @error('rol_institucion')
                                        <small id="helpId" class="bg-translucent-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <h3>Datos de Identificación de la Empresa</h3>
                        <div class="container-fluid">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="switch1" name="esContratista">
                                    <label class="custom-control-label" for="switch1">¿Es usted contratista?</label>
                                </div>
                            </div>
                        </div>
                        <h4>(Solo para contratistas) Si no, dejarlo vacío.</h4>
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12 col-xl-4">
                                <div class="form-group">
                                    <label for="razon_social" class="font-weight-bold">Nombre o Razón Social</label>
                                    <input type="text" name="razon_social" id="razon_social" class="form-control"
                                        placeholder="" aria-describedby="helpId">
                                    @error('razon_social')
                                        <small id="helpId" class="bg-danger text-white">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-12 col-xl-4">
                                <div class="form-group">
                                    <label for="celular" class="font-weight-bold">Teléfono o Celular</label>
                                    <input type="text" name="celular" id="celular" class="form-control" placeholder=""
                                        aria-describedby="helpId">
                                    @error('celular')
                                        <small id="helpId" class="bg-danger text-white">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-12 col-xl-4">
                                <div class="form-group">
                                    <label for="email" class="font-weight-bold">Correo Electrónico</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder=""
                                        aria-describedby="helpId">
                                    @error('email')
                                        <small id="helpId" class="bg-danger text-white">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <h4>Datos de Identificación del Asistente</h4>
                        <div class="row">
                            <div class="col-12-col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="fullname" class="font-weight-bold">Nombre completo</label>
                                    <input type="text" name="fullname" id="fullname" class="form-control"
                                        value="{{ auth()->user()->fullname() }}" aria-describedby="helpId" readonly>
                                    @error('fullname')
                                        <small id="helpId" class="bg-translucent-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="document_type" class="font-weight-bold">Tipo de identificación (CC, CE, TI,
                                        PA,
                                        etc.)</label>
                                    <input type="text" name="document_type" id="document_type"
                                        class="form-control text-capitalize"
                                        value="{{ auth()->user()->document->document_type->info }}"
                                        aria-describedby="helpId" readonly>
                                    @error('document_type')
                                        <small id="helpId" class="bg-translucent-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="document" class="font-weight-bold">Número de Identificación</label>
                                    <input type="text" name="document" id="document" class="form-control text-capitalize"
                                        value="{{ auth()->user()->document->document }}" aria-describedby="helpId" readonly>
                                    @error('document')
                                        <small id="helpId" class="bg-translucent-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12-col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="dependencia" class="font-weight-bold">Área o Dependencia</label>
                                    <input type="text" name="dependencia" id="dependencia" class="form-control"
                                        aria-describedby="helpId"
                                        placeholder="Por favor, escriba el área o la dependencia a la que pertenece">
                                    @error('dependencia')
                                        <small id="helpId" class="bg-translucent-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cargo" class="font-weight-bold">Cargo</label>
                                    <input type="text" name="cargo" id="cargo" class="form-control"
                                        aria-describedby="helpId" placeholder="Por favor, escriba el cargo que posee">
                                    @error('cargo')
                                        <small id="helpId" class="bg-translucent-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="sede" class="font-weight-bold">Sede/Ubicación</label>
                                    <input type="text" name="sede" id="sede" class="form-control" aria-describedby="helpId"
                                        placeholder="Por favor, escriba la sede o la ubicación a la que pertenece">
                                    @error('sede')
                                        <small id="helpId" class="bg-translucent-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <h3>Contenido realizado</h3>
                        <div class="list-group">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12 col-xl-6">
                                    <a class="list-group-item list-group-item-action">1. Presentación</a>
                                    <a class="list-group-item list-group-item-action">2. Definiciones claves, política y
                                        objetivos
                                        del
                                        sistema de gestión de seguridad y salud en el trabajo </a>
                                    <a class="list-group-item list-group-item-action">3. Responsabilidades del trabajador en
                                        SST
                                        (decreto
                                        1072/2015 y normas de SST)</a>
                                    <a class="list-group-item list-group-item-action">4. Reglamento de Higiene y Seguridad
                                        Industrial</a>
                                    <a class="list-group-item list-group-item-action">5. Prevención en el consumo de
                                        alcohol,
                                        tabaco y
                                        drogas.</a>
                                    <a class="list-group-item list-group-item-action">6. Sistema general de riesgos
                                        laborales
                                        -SGRL
                                        (afiliación y cobertura)</a>
                                    <a class="list-group-item list-group-item-action">7. Procedimientos clave del SG-SST
                                        (autorreporte de
                                        condiciones de SST, gestión del cambio, reincorporación laboral, gestión de
                                        adquisiciones,
                                        análisis de tareas, actividades de alto riesgo, etc.) </a>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12 col-xl-6"> <a
                                        class="list-group-item list-group-item-action">8. Peligros asociados a las tareas,
                                        identificación y
                                        medidas de control. </a>

                                    <a class="list-group-item list-group-item-action">9. Seguridad vial (conductores,
                                        pasajeros
                                        o
                                        peatones)</a>
                                    <a class="list-group-item list-group-item-action">10. Gestión multidisciplinar de los
                                        peligros /
                                        riesgos</a>
                                    <a class="list-group-item list-group-item-action">11. Actuaciones en caso de Accidente
                                        de
                                        Trabajo- AT,
                                        Incidente de Trabajo - IT y - Enfermedad</a>
                                    <a class="list-group-item list-group-item-action">12. Actuaciones en caso de
                                        emergencias:
                                        plan,
                                        rutas de
                                        evacuación, puntos de encuentro, etc.</a>
                                    <a class="list-group-item list-group-item-action">13. Aspectos básicos de primeros
                                        auxilios
                                        y
                                        servicio
                                        de área protegida</a>
                                    <a class="list-group-item list-group-item-action">14. Comité paritario de seguridad y
                                        salud
                                        en
                                        el
                                        trabajo COPASST y Comité de Convivencia laboral</a>
                                    <a class="list-group-item list-group-item-action"></a>
                                </div>
                            </div>
                        </div>
                        <h3 class="py-3">Firmas</h3>
                        <div class="form-group">
                            <label for="firma_asistente" class="font-weight-bold">Firma del Asistente</label>
                            <input type="file" class="form-control-file" name="firma_asistente" id="firma_asistente"
                                placeholder="firma_asistente" aria-describedby="fileHelpId">
                            @error('firma_asistente')
                                <small id="fileHelpId"
                                    class="form-text bg-danger text-white font-weight-bold">{{ $message }}</small>
                            @enderror
                            <small id="fileHelpId" class="form-text text-muted">Por favor subir una foto en la que se
                                pueda visualizar correctamente la firma del asistente.</small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-success">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('scripts')
    @if (session()->has('update_complete'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '¡Éxito!',
                text: "{{ session('update_complete') }}",
                showConfirmButton: false,
                timer: 1500
            })

        </script>
    @endif
    @if (session()->has('update_failed'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: "¡Error!",
                text: "{{ session('update_failed') }}",
                showConfirmButton: false,
                timer: 1500
            })

        </script>
    @endif
@endsection
