<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Formato de Inducción Capacitante</title>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style>
    .page-break {
        page-break-after: always;
    }

</style>

<body>
    <div class="container-fluid">
        <h2 class="text-center">Formato de Inducción</h2>
        <hr>
        <h4>Datos Generales</h4>
        <div class="my-3">
            <h6>Fecha de Finalización</h6>
            {{ $formato->info['Fecha'] }}
        </div>
        <div class="my-3">
            <h6>Ciudad</h6>
            {{ $formato->info['Ciudad'] }}
        </div>
        <div class="my-3">
            <h6>Tipo de Contratación/Vinculación</h6>
            {{ $formato->info['Tipo_vinvulacion'] }}
        </div>
        <div class="my-3">
            <h6>Rol dentro de la Institución</h6>
            {{ $formato->info['Rol_institucion'] }}
        </div>
        <div class="mt-5">
            @if ($formato->info['razon_social'])
                <h4>Datos de Identificación de la Empresa</h4>
                <div class="my-3">
                    <h6>Nombre o Razón Social</h6>
                    {{ $formato->info['razon_social'] }}
                </div>
                <div class="my-3">
                    <h6>Celular</h6>
                    {{ $formato->info['celular'] }}
                </div>
                <div class="my-3">
                    <h6>Correo Electrónico</h6>
                    {{ $formato->info['email'] }}
                </div>
            @endif
        </div>
        <div class="page-break"></div>
        <h4>Datos de Identificación del Asistente</h4>
        <div class="my-3">
            <h6>Nombre completo</h6>
            {{ $formato->user->fullname() }}
        </div>
        <div class="my-3">
            <h6>Tipo de Identificación</h6>
            <div class="text-capitalize">{{ $formato->user->document->document_type->info }}</div>
        </div>
        <div class="my-3">
            <h6>Número de Identificación</h6>
            {{ $formato->user->document->document }}
        </div>
        <div class="my-3">
            <h6>Área o Dependencia</h6>
            {{ $formato->info['Dependencia'] }}
        </div>
        <div class="my-3">
            <h6>Cargo</h6>
            {{ $formato->info['Cargo'] }}
        </div>
        <div class="my-3">
            <h6>Sede o Ubicación</h6>
            {{ $formato->info['Sede'] }}
        </div>
        <div class="page-break"></div>
        <h4>Contenido realizado</h4>
        <ol>
            <li>Presentación</li>
            <li>Definiciones claves, política y
                objetivos
                del
                sistema de gestión de seguridad y salud en el trabajo </li>
            <li>Responsabilidades del trabajador en
                SST
                (decreto
                1072/2015 y normas de SST)</li>
            <li>Reglamento de Higiene y Seguridad
                Industrial</li>
            <li>Prevención en el consumo de
                alcohol,
                tabaco y
                drogas.</li>
            <li>Sistema general de riesgos
                laborales
                -SGRL
                (afiliación y cobertura)</li>
            <li>Procedimientos clave del SG-SST
                (autorreporte de
                condiciones de SST, gestión del cambio, reincorporación laboral, gestión de
                adquisiciones,
                análisis de tareas, actividades de alto riesgo, etc.) </li>
            <li>Peligros asociados a las tareas,
                identificación y
                medidas de control. </li>

            <li>Seguridad vial (conductores,
                pasajeros
                o
                peatones)</li>
            <li>Gestión multidisciplinar de los
                peligros /
                riesgos</li>
            <li>11. Actuaciones en caso de Accidente
                de
                Trabajo- AT,
                Incidente de Trabajo - IT y - Enfermedad</li>
            <li>Actuaciones en caso de
                emergencias:
                plan,
                rutas de
                evacuación, puntos de encuentro, etc.</li>
            <li>Aspectos básicos de primeros
                auxilios
                y
                servicio
                de área protegida</li>
            <li>Comité paritario de seguridad y
                salud
                en
                el
                trabajo COPASST y Comité de Convivencia laboral</li>
        </ol>
        <h4>Firmas</h4>
        <div class="my-3">
            <img src="{{ asset($formato->info['Firma']) }}"
                class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                width="150vh">
            <p>Firma del Asistente</p>

            <img src="{{ asset($formato->info['Firma']) }}"
                class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                width="150vh">
            <p>Firma del Capacitador</p>
        </div>
    </div>
</body>

</html>
