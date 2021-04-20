# Certificado190
Creación de los certificados del modelo 190 de los trabajadores de una empresa en Pdf, leyendo un fichero Excel con los
datos correspondientes.

### Clase PdfModeloFFC.php
Clase con los parámetros de los datos obtenidos del fichero Excel. Creación del pdf con la librería TCPDF.

### Clase GenerarDir.php
Clase para generar un directorio con nombre único.

### controlador.php
Obtenemos los datos a partir del formulario. Generar directorio único. Validar el fichero Excel y la imagen
del logo. Mostrar los posibles errores. Guardar el Excel y la imagen en el directorio. Leer el documento Excel para obtener los
datos. Validar los datos del Excel. Mostrar posibles errores. Crear n objetos de la clase PdfModeloFFC.php y generar los
certificados. Se creara un .zip para agrupar los pdfs y se descargarán. Eliminar el directorio.

#### https://www.pupgam.com/webapp/certificado_irpf
