<?php

require 'ClassesExcel/PHPExcel/IOFactory.php';
require_once("ClassesExcel/PHPExcel.php");
include './PdfModeloFFC.php';
include './GenerarDir.php';

$fileNames = ['fichero_excel', 'imagen_logo'];
$ficheroExcel = $_FILES['fichero_excel']['name'];

$dirTmp = "dirTmp";
$generarDir = new GenerarDir();
$dirPath = $dirTmp . "/" . $generarDir->getDir();
$errors = [];
$erroresPdf = [];
$errorsFiles = [];
//$validarExcel = '';
//$validarImage = '';
$validarExcel = validateExcel($fileNames[0]);
if ($validarExcel != '') {
    $errorsFiles[] = $validarExcel;
}
$validarImage = validateImage($fileNames[1]);
if ($validarImage != '') {
    $errorsFiles[] = $validarImage;
}

/**
 * Validar el fichero Excel si es valido
 * @param type $fileName nombre Excel
 * @return string errores
 */
function validateExcel($fileName) {

    $errors = "";

    $tipo_archivo = $_FILES[$fileName]['type'];
    $nombre_archivo = $_FILES[$fileName]['name'];

    if (!((strpos($tipo_archivo, 'xlsx')) || (strpos($tipo_archivo, 'xls')) || (strpos($tipo_archivo, 'xml')) || (strpos($tipo_archivo, 'xlm')))) {
        $errors = "Error!! La extensión del archivo {$nombre_archivo} no es correcta.<br>";
    }

    return $errors;
}

/**
 * Validar si la imagen del logo es corracta
 * @param type $fileName nombre de la imagen 
 * @return string errores
 */
function validateImage($fileName) {
    $pesoMax = 30000;
    $errors = "";
    $tipo_archivo = $_FILES[$fileName]['type'];
    $tamaño_archivo = $_FILES[$fileName]['size'];
    $nombre_archivo = $_FILES[$fileName]['name'];

    if (!((strpos($tipo_archivo, 'gif') || strpos($tipo_archivo, 'jpeg') || strpos($tipo_archivo, 'png') || strpos($tipo_archivo, 'jpg')) && ($tamaño_archivo < $pesoMax))) {
        $errors = "Error!! La extensión o el tamaño del archivo {$nombre_archivo} no es correcto.<br>";
    }
    return $errors;
}

//$erfiles=count($errorsFiles);

if (count($errorsFiles) == 0) {

    mkdir($dirPath);
    foreach ($fileNames as $fileName) {
        $nombre_archivo = $_FILES[$fileName]['name'];
        if (move_uploaded_file($_FILES[$fileName]['tmp_name'], $dirPath . "/" . $nombre_archivo)) {
            
        } else {
            
        }
    }
} else {

    include("index.php");
}

if (count($errorsFiles) == 0) {

//leer el excel

    $sNifPerceptor;
    $sApellidosNombrePerceptor;
    $sRendTrabajoCuotaIntegra;
    $sRendTrabajoRetenPracticadas;
    $sRendActivEconCuotaIntegra;
    $sRendActivEconRetenPracticas;
    $sEjercicio = $_POST['ejercicio'];
    $sNifPagadora;
    $sPersonaOEntidadPagadora;
    $sLugar = $_POST['ciudad'];
    $meses = ['-', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Dociembre'];
    $sDia = date('d');
    $sMesTemp = date('n');
    $sMes = $meses[$sMesTemp];
    $sAny = date('Y');
    $oPdf;
    $sImagenLogo = $_FILES['imagen_logo']['name'];
    $sNombreFirma = $_POST['firmado'];
    $sRetriIncapacidadImporte;
    $sRetriIncapacidadRetenciones;
    $sImporteReducciones;
    $sGastosFiscalDeduciblesImporte;
    $sRentaExentaIRPFImporte;
    $sNombre;
    $sApellidos;
    $aPdfCertificados = [];


    $documento = PHPExcel_IOFactory::load($dirPath . "/" . $ficheroExcel);

    $totalHojas = $documento->getSheetCount();

    for ($indiceHoja = 0; $indiceHoja < $totalHojas; $indiceHoja++) {


        $hojaActual = $documento->getSheet($indiceHoja);

        $totalFilas = $hojaActual->getHighestRow();


        $totalColumnasLetra = $hojaActual->getHighestColumn();
        $toNumCol = PHPExcel_Cell::columnIndexFromString($totalColumnasLetra);

        $totalColumnas = 13;

        $aDatos;
        for ($fil = 2; $fil <= $totalFilas; $fil++) {
            for ($col = 0; $col <= $totalColumnas; $col++) {


                $celda = $hojaActual->getCellByColumnAndRow($col, $fil);
                $valorRaw = $celda->getValue();
                $valorFormateado = $celda->getFormattedValue();
                $fila = $celda->getRow();
                $columna = $celda->getColumn();

                $columnasConValor = [0, 1, 2, 3, 4];

                if ($valorRaw == '' && in_array($col, $columnasConValor)) {

                    $erroresPdf[] = "Error!! En la celda $columna$fila no puede haber un valor vacio.<br>";
                }
                if ($col == 0) {

                    if (is_numeric($valorRaw)) {
                        $erroresPdf[] = "Error!! En la celda $columna$fila no puede haber un valor numérico.<br>";
                    } else {
                        $valorRaw = sanearString($valorRaw);

                        $error = validarNif($valorRaw, 9, $columna, $fila);
                        if ($error != '') {

                            $erroresPdf[] = $error;
                            $sNifPerceptor = $valorRaw;
                        } else {
                            $sNifPerceptor = $valorRaw;
                        }
                    }
                }
                if ($col == 1) {

                    if (is_numeric($valorRaw)) {
                        $erroresPdf[] = "Error!! En la celda $columna$fila no puede haber un valor numérico.<br>";
                        $sNombre = '';
                    } else {
                        $sNombre = sanearString($valorRaw);
                    }
                }
                if ($col == 2) {

                    if (is_numeric($valorRaw)) {
                        $erroresPdf[] = "Error!! En la celda $columna$fila no puede haber un valor numérico.<br>";
                        $sApellidos = '';
                    } else {
                        $sApellidos = sanearString($valorRaw);
                    }
                }

                if ($col == 3) {
                    if (is_numeric($valorRaw)) {
                        $erroresPdf[] = "Error!! En la celda $columna$fila no puede haber un valor numérico.<br>";
                    } else {
                        $valorRaw = sanearString($valorRaw);


                        $error = validarNif($valorRaw, 9, $columna, $fila);
                        if ($error != '') {

                            $erroresPdf[] = $error;
                            $sNifPagadora = $valorRaw;
                        } else {
                            $sNifPagadora = $valorRaw;
                        }
                    }
                }
                if ($col == 4) {
                    if (is_numeric($valorRaw)) {
                        $erroresPdf[] = "Error!! En la celda $columna$fila no puede haber un valor numérico.<br>";
                    } else {
                        $sPersonaOEntidadPagadora = sanearString($valorRaw);
                    }
                }
                if ($col == 5) {

                    if ($valorRaw != '') {

                        if (!(is_numeric($valorRaw))) {
                            $erroresPdf[] = "Error!! En la celda $columna$fila debe de haber un valor numérico.";
                        } else {
                            $sRendTrabajoCuotaIntegraTemp = validarImporte($valorRaw);
                            $sRendTrabajoCuotaIntegra = $sRendTrabajoCuotaIntegraTemp;
                        }
                    } else {
                        $sRendTrabajoCuotaIntegra = '';
                    }
                }
                if ($col == 6) {
                    if ($valorRaw != '') {
                        if (!(is_numeric($valorRaw))) {
                            $erroresPdf[] = "Error!! En la celda $columna$fila debe de haber un valor numérico.";
                        } else {
                            $sRendTrabajoRetenPracticadasTemp = validarImporte($valorRaw);
                            $sRendTrabajoRetenPracticadas = $sRendTrabajoRetenPracticadasTemp;
                        }
                    } else {
                        $sRendTrabajoRetenPracticadas = '';
                    }
                }
                if ($col == 7) {
                    if ($valorRaw != '') {
                        if (!(is_numeric($valorRaw))) {
                            $erroresPdf[] = "Error!! En la celda $columna$fila debe de haber un valor numérico.";
                        } else {
                            $sRetriIncapacidadImporteTemp = validarImporte($valorRaw);
                            $sRetriIncapacidadImporte = $sRetriIncapacidadImporteTemp;
                        }
                    } else {
                        $sRetriIncapacidadImporte = '';
                    }
                }
                if ($col == 8) {
                    if ($valorRaw != '') {
                        if (!(is_numeric($valorRaw))) {
                            $erroresPdf[] = "Error!! En la celda $columna$fila debe de haber un valor numérico.";
                        } else {
                            $sRetriIncapacidadRetencionesTemp = validarImporte($valorRaw);
                            $sRetriIncapacidadRetenciones = $sRetriIncapacidadRetencionesTemp;
                        }
                    } else {
                        $sRetriIncapacidadRetenciones = '';
                    }
                }
                if ($col == 9) {
                    if ($valorRaw != '') {
                        if (!(is_numeric($valorRaw))) {
                            $erroresPdf[] = "Error!! En la celda $columna$fila debe de haber un valor numérico.";
                        } else {
                            $sImporteReduccionesTemp = validarImporte($valorRaw);
                            $sImporteReducciones = $sImporteReduccionesTemp;
                        }
                    } else {
                        $sImporteReducciones = '';
                    }
                }
                if ($col == 10) {
                    if ($valorRaw != '') {
                        if (!(is_numeric($valorRaw))) {
                            $erroresPdf[] = "Error!! En la celda $columna$fila debe de haber un valor numérico.";
                        } else {
                            $sGastosFiscalDeduciblesImporteTemp = validarImporte($valorRaw);
                            $sGastosFiscalDeduciblesImporte = $sGastosFiscalDeduciblesImporteTemp;
                        }
                    } else {
                        $sGastosFiscalDeduciblesImporte = '';
                    }
                }
                if ($col == 11) {
                    if ($valorRaw != '') {
                        if (!(is_numeric($valorRaw))) {
                            $erroresPdf[] = "Error!! En la celda $columna$fila debe de haber un valor numérico.";
                        } else {
                            $sRentaExentaIRPFImporteTemp = validarImporte($valorRaw);
                            $sRentaExentaIRPFImporte = $sRentaExentaIRPFImporteTemp;
                        }
                    } else {
                        $sRentaExentaIRPFImporte = '';
                    }
                }
                if ($col == 12) {
                    if ($valorRaw != '') {
                        if (!(is_numeric($valorRaw))) {
                            $erroresPdf[] = "Error!! En la celda $columna$fila debe de haber un valor numérico.";
                        } else {
                            $sRendActivEconCuotaIntegraTemp = validarImporte($valorRaw);
                            $sRendActivEconCuotaIntegra = $sRendActivEconCuotaIntegraTemp;
                        }
                    } else {
                        $sRendActivEconCuotaIntegra = '';
                    }
                }
                if ($col == 13) {
                    if ($valorRaw != '') {
                        if (!(is_numeric($valorRaw))) {
                            $erroresPdf[] = "Error!! En la celda $columna$fila debe de haber un valor numérico.";
                        } else {
                            $sRendActivEconRetenPracticasTemp = validarImporte($valorRaw);
                            $sRendActivEconRetenPracticas = $sRendActivEconRetenPracticasTemp;
                        }
                    } else {
                        $sRendActivEconRetenPracticas = '';
                    }
                }
            }
            $sApellidosNombrePerceptor = $sApellidos . " " . $sNombre;

            if (count($erroresPdf) == 0) {
                $oPdfCertificado = new PdfModeloFFC($sNifPerceptor, $sApellidosNombrePerceptor, $sNifPagadora, $sPersonaOEntidadPagadora, $sRendTrabajoCuotaIntegra, $sRendTrabajoRetenPracticadas, $sRetriIncapacidadImporte, $sRetriIncapacidadRetenciones, $sImporteReducciones, $sGastosFiscalDeduciblesImporte, $sRentaExentaIRPFImporte, $sRendActivEconCuotaIntegra, $sRendActivEconRetenPracticas, $sEjercicio, $sNombreFirma, $sLugar, $sDia, $sMes, $sAny, $sImagenLogo, $sApellidosNombrePerceptor . $sNifPerceptor, $dirPath);

                $aPdfCertificados[] = $oPdfCertificado;
            }
        }
    }
}/* else{

  foreach ($errorsFiles as $err) {


  }

  } */
if (count($errorsFiles) == 0) {

    if (count($erroresPdf) == 0) {

        $ruta = getcwd();
        $geneDir = new GenerarDir();
        $dir = $geneDir->getDir();
        $zip = new ZipArchive();
        $zip->open($dir, ZipArchive::CREATE);
        $zip->addEmptyDir($dir);
        foreach ($aPdfCertificados as $value) {
            $value->guardarPdf();
            $zip->addFile("./" . $dirPath . "/" . $value->sApellidosNombrePerceptor . $value->sNifPerceptor . ".pdf", $dir . "/" . $value->sApellidosNombrePerceptor . $value->sNifPerceptor . ".pdf");
        }
        $zip->close();
        header("Content-type: application/octet-stream");
        header("Content-disposition: attachment; filename=$dir.zip");
        readfile($dir);
        unlink($dir);

        borrarFicheros($dirPath);
    } else {

        borrarFicheros($dirPath);

        include ("index.php");
    }
}

/**
 * Borramos todos los ficheros
 * @param type $dirPath ruta de la carpeta
 */
function borrarFicheros($dirPath) {

    if (is_dir($dirPath)) {
        $files = glob($dirPath . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
}

/**
 * Validar si el NIF es correcto
 * @param type string Nif
 * @param type integer la longitud permitida = 9 caracteres
 * @param type $col letra columna
 * @param type $fila numero de fila
 * @return string
 */
function validarNif($sText, $iLongPermitida, $col, $fila) {
    $errores = '';
    $iLongText = strlen($sText);
    $sLetraPrimera = substr($sText, 0, 1);
    $sLetraUltima = substr($sText, strlen($sText) - 1);
    $sError = "Error!! En la celda $col$fila el Nif no es correcto: " . $sText;
    if ($iLongText > $iLongPermitida) {
        return $errores = $sError;
    } else if ($iLongText < $iLongPermitida) {

        return $errores = $sError;
    } else if (!((preg_match('/[0-9]/', $sLetraPrimera) && preg_match('/[a-z]/i', $sLetraUltima)) || (preg_match('/[a-z]/i', $sLetraPrimera) && preg_match('/[0-9]/', $sLetraUltima)))) {

        return $errores = $sError;
    } else {
        return $errores;
    }
}

/**
 * Formato numerico con dos decimales
 * @param type float
 * @return type float
 */
function validarImporte($fImporteTotal) {

    $fImporteTotal = number_format($fImporteTotal, 2);

    return $fImporteTotal;
}

/**
 * Pasar todo el texto a mayusculas
 * Eliminar los acentos y caracteres especiales
 * @param type $sText
 */
function sanearString($sText) {
    $sText = trim($sText);

    $sText = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $sText
    );
    $sText = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $sText
    );
    $sText = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $sText
    );
    $sText = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $sText
    );
    $sText = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $sText
    );
    $sText = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'), array('n', 'N', 'c', 'C',), $sText
    );

    $sText = str_replace(
            array("\\", "¨", "º", "-", "~",
        "#", "@", "|", "!", "\"",
        "·", "$", "%", "&", "/",
        "(", ")", "?", "'", "¡",
        "¿", "[", "^", "<code>", "]",
        "+", "}", "{", "¨", "´",
        ">", "< ", ";", ",", ":",
        "."), '', $sText
    );
    $sText = trim($sText);

    $sText = strtoupper($sText);
    return $sText;
}

?>