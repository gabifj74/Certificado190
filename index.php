<!DOCTYPE html>
<html>
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-47886667-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-47886667-1');
        </script>
        <title>Genera tu certificado 190 gratis</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
        <link rel="manifest" href="favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="css/estilo.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>

        <script type="text/javascript">

            $(document).on('change', '.btn-file :file', function () {
                var input = $(this);
                var numFiles = input.get(0).files ? input.get(0).files.length : 1;
                var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');


                input.trigger('fileselect', [numFiles, label]);

            });

            $(document).ready(function () {
                $('.btn-file :file').on('fileselect', function (event, numFiles, label) {
                    var input = $(this).parents('.input-group').find(':text');
                    var log = numFiles > 1 ? numFiles + ' files selected' : label;
                    if (input.length) {
                        input.val(log);
                    } else {
                        if (log)
                            alert(log);
                    }
                });

            });
            $(document).ready(function () {
                $('#enviar').click(function () {

                    $('.errores').attr("hidden", true);
                });
            });


        </script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12" style="border: solid 0px red;">
                    <h1 class="text-center">Genera tu Certificado 190 GRATIS</h1>
                </div>
            </div>
            <br>
            <div class="col-md-4 col-sm-12 text-center" style="border: solid 0px red;">
                <img src="imagenes/pag1_pag2Aeat.png" class="img-fluid"/>
            </div>
            <div class="col-md-8 col-sm-12" style="border: solid 0px red;">
                <form target="_self" method="post" id="form" action="controlador.php" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4 col-sm-6" style="border: solid 0px red;">
                            <label for="fichero">Fichero Excel</label><br>
                            <p style="font-size: 11px;">(.xls .xlsm)</p>
                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-primary btn-file">
                                        Fichero<input class="hidden" name="fichero_excel" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" type="file" id="fichero_excel" required/>
                                    </span>
                                </label>
                                <input class="form-control" id="fichero_captura" readonly="readonly" name="fichero_captura" type="text" value="" required/>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6" style="border: solid 0px red;">
                            <label for="fichero" class="form-label">Imagen del logo</label><br>
                            <p style="font-size: 11px;">(.gif .png .jpeg, Máximo 30KB)</p>
                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-primary btn-file">
                                        Imagen<input class="hidden" name="imagen_logo" type="file" accept="image/gif,image/jpeg,image/png" id="imagen_logo"/>
                                    </span>
                                </label>
                                <input class="form-control" id="text_logo" readonly="readonly" name="text_logo" type="text" value="" required/>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <input class="form-control" type="text" name="firmado" id="firmado" placeholder="Firmado" required/>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <input class="form-control" type="text" name="ciudad" id="ciudad" placeholder="Ciudad" required/>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 6px;">
                        <div class="col-md-4 col-sm-6" style="border: solid 0px red;">
                            <?php
                            $age = date('Y');
                            $age--;
                            echo '<label for="select-age" class="form-label">Ejercicio</label>'
                            . '<select class="form-control" id="select-age" required name="ejercicio"><option></option>'
                            . '<option value="' . $age . '">' . $age . '</option>'
                            . '</select>';
                            ?>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4 col-sm-6" style="border: solid 0px red;">
                            <button type="submit" id="enviar" class="btn btn-primary">Crear Certificado 190</button>
                        </div>
                    </div>
                </form>
                <div class="row errores">
                    <div class="col-md-8 col-sm-12" style="border: solid 0px red;">
                        <?php
                        if (isset($errorsFiles)) {

                            foreach ($errorsFiles as $value) {

                                echo '<label style="font-size: 11px;color: red;font-weight: bold;">' . $value . '</label><br>';
                            };
                        };
                        if (isset($erroresPdf)) {
                            foreach ($erroresPdf as $value) {
                                echo '<label style="font-size: 11px;color: red;font-weight: bold;">' . $value . '</label><br>';
                            };
                        }
                        if (isset($errorDelete)) {
                            foreach ($errorDelete as $value) {
                                echo '<label style="font-size: 11px;color: red;font-weight: bold;">' . $value . '</label><br>';
                            };
                        }
                        if (isset($excepcion)) {
                            foreach ($excepcion as $value) {
                                echo '<label style="font-size: 11px;color: red;font-weight: bold;">' . $value . '</label><br>';
                            };
                        }
                        ?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6 col-sm-6" style="border: solid 0px red;">
                        <label>Creación de tu Excel</label><span>&nbsp;&nbsp;&nbsp;<a class="download" download href="download/plantillaCertificado190.xlsx" >Descargar plantilla</a></span>
                        <ul> 
                            <li title="Columna A: Nif del perceptor">
                                Columna A: Nif del perceptor</li>
                            <li title="Columna B: Nombre del perceptor">
                                Columna B: Nombre del perceptor</li>
                            <li title="Columna C: Apellidos del perceptor">
                                Columna C: Apellidos del perceptor</li>
                            <li title="Columna D: Nif de la persona o entidad pagadora">
                                Columna D: Nif de la persona o entidad pagadora</li>
                            <li title="Columna E: Apellidos y nombre, denominación o razón social">
                                Columna E: Apellidos y nombre, denominación o...</li>
                            <li title="Columna F: Retribuciones no derivadas de incapacidad laboral dinerarias del importe integro satisfecho.">
                                Columna F: Retribuciones no derivadas de incapacidad...</li>
                            <li title="Columna G: Retribuciones no derivadas de incapacidad laboral dinerarias de retenciones practicadas.">
                                Columna G: Retribuciones no derivadas de incapacidad...</li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-6" style="border: solid 0px red;">
                        <br>
                        <ul>
                            <li title="Columna H: Retribuciones derivadas de incapacidad laboral dinerarias del importe integro satisfecho.">
                                Columna H: Retribuciones derivadas de incapacidad...</li>
                            <li title="Columna I: Retribuciones derivadas de incapacidad laboral dinerarias de retenciones practicadas.">
                                Columna I: Retribuciones derivadas de incapacidad...</li>
                            <li title="Columna J: Reducciones a que se refieren el artículo 18, apartados 2 y 3, y/o las disposiciones transitorias 11.ª y 12.ª de la Ley del Impuesto.">
                                Columna J: Reducciones a que se refieren el artículo 18...</li>
                            <li title="Columna K: Gastos fiscalmente deducibles a que se refiere el artículo 19.2[letras a),b)y c)] de la Ley del Impuesto">
                                Columna K: Gastos fiscalmente deducibles...</li>
                            <li title="Columna L: Rentas exentas del IRPF incluidas por la empresa o entidad pagadora en el resumen anual de retenciones e ingresos a cuenta">
                                Columna L: Rentas exentas del IRPF incluidas...</li>
                            <li title="Columna M: Rendimientos de actividades profesionales contraprestaciones dinerarias del importe integro satisfecho">
                                Columna M: Rendimientos de actividades profesionales...</li>
                            <li title="Columna N: Rendimientos de actividades profesionales contraprestaciones dinerarias de retenciones practicadas">
                                Columna N: Rendimientos de actividades profesionales...</li>
                        </ul>
                    </div>
                </div>
            </div>      
        </div>
        <br><br>
        <footer>                
            <p class="text-center" style="margin-top: 10px;color: white;">&copy; Todos los derechos reservados 2021&nbsp;
                <a class="terminos" href="https://www.pupgam.com/terms.php" target="_blank" title="T&eacute;rminos y condiciones">T&eacute;rminos y condiciones</a></p>
        </footer>
    </body>
</html>