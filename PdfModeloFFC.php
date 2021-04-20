<?php

include ('tcpdf/config/tcpdf_config.php'); 
include('tcpdf/examples/lang/spa.php'); 
include('tcpdf/tcpdf.php'); 
class PdfModeloFFC {
    
    
    var $sNifPerceptor;
    var $sApellidosNombrePerceptor;
    var $sRendTrabajoCuotaIntegra;
    var $sRendTrabajoRetenPracticadas;
    var $sRendActivEconCuotaIntegra;
    var $sRendActivEconRetenPracticas;
    var $sEjercicio;
    var $sNifPagadora;
    var $sPersonaOEntidadPagadora;
    var $sLugar;
    var $sDia;
    var $sMes;
    var $sAny;
    var $oPdf;
    var $sImagenLogo;
    var $sNombreFirma;//P
    var $sRetriIncapacidadImporte;
    var $sRetriIncapacidadRetenciones;
    var $sImporteReducciones;
    var $sGastosFiscalDeduciblesImporte;
    var $sRentaExentaIRPFImporte;
    var $sGuardarNombrePdf;
    var $sDirPdfs;
    
    public function __construct($sNifPerceptor,$sApellidosNombrePerceptor,$sNifPagadora,$sPersonaOEntidadPagadora,
            $sRendTrabajoCuotaIntegra, //F
            $sRendTrabajoRetenPracticadas,//G
            $sRetriIncapacidadImporte,//H
            $sRetriIncapacidadRetenciones,//I
            $sImporteReducciones,//J
            $sGastosFiscalDeduciblesImporte,//K
            $sRentaExentaIRPFImporte,//L
            $sRendActivEconCuotaIntegra,//M
            $sRendActivEconRetenPracticas,//N
            $sEjercicio,//O
            $sNombreFirma,//P
            $sLugar,$sDia,$sMes,$sAny, $sImagenLogo,$sGuardarNombrePdf,$sDirPdfs
            ){
        $this->sDirPdfs = $sDirPdfs;
        $this->sGuardarNombrePdf = $sGuardarNombrePdf;
        $this->sNifPerceptor = $sNifPerceptor;
        $this->sApellidosNombrePerceptor = $sApellidosNombrePerceptor;
        $this->sRendTrabajoCuotaIntegra = $sRendTrabajoCuotaIntegra;
        $this->sRendTrabajoRetenPracticadas = $sRendTrabajoRetenPracticadas;
        $this->sRendActivEconCuotaIntegra = $sRendActivEconCuotaIntegra;
        $this->sRendActivEconRetenPracticas = $sRendActivEconRetenPracticas;
        $this->sEjercicio = $sEjercicio;//O
        $this->sNifPagadora = $sNifPagadora;
        $this->sPersonaOEntidadPagadora = $sPersonaOEntidadPagadora;
        $this->sLugar = $sLugar;
        $this->sDia = $sDia;
        $this->sMes = $sMes;
        $this->sAny = $sAny;
        $this->sImagenLogo = $sImagenLogo;
        $this->sNombreFirma = $sNombreFirma;
        $this->sRetriIncapacidadImporte = $sRetriIncapacidadImporte;
        $this->sRetriIncapacidadRetenciones = $sRetriIncapacidadRetenciones;
        $this->sImporteReducciones = $sImporteReducciones;
        $this->sGastosFiscalDeduciblesImporte = $sGastosFiscalDeduciblesImporte;
        $this->sRentaExentaIRPFImporte = $sRentaExentaIRPFImporte;
        //crear el pdf
        $this->oPdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $this->oPdf->setPrintHeader(false);
        $this->oPdf->setPrintFooter(false);
        $this->oPdf->SetMargins(0, 0, 0, true);
        $this->oPdf->SetAutoPageBreak(false, 0);
        //primera página
        $this->oPdf->Addpage('P','A4');
        //imagen de fondo pag_1
        $imgPag1='imagenes/pag_1.png';
        $this->oPdf->Image($imgPag1, 0, 0, 210, 297, 'PNG', '', '', true, 200, '', false, false, 0, false, false, true);
        //tipo fuente, tamaño
        $this->oPdf->SetFont('helvetica', '',9);
        //Datos perceptor
        $this->oPdf->SetXY(3, 19);
        $this->oPdf->Cell(0,0,$this->sNifPerceptor,0,0);
        $this->oPdf->SetXY(45, 19);
        $this->oPdf->Cell(0,0,$this->sApellidosNombrePerceptor,0,0);
        //Datos de persona o entidad pagadora
        $this->oPdf->SetXY(3, 35);
        $this->oPdf->Cell(0,0,$this->sNifPagadora,0,0);
        $this->oPdf->SetXY(45, 35);
        $this->oPdf->Cell(0,0,$this->sPersonaOEntidadPagadora,0,0);
        //Datos Ejercicio
        $this->oPdf->SetXY(195, 48);
        $this->oPdf->Cell(0,0,$this->sEjercicio,0,0);
        //Datos rendimientos del trabajo
        if($this->sRendTrabajoCuotaIntegra!=''&&$this->sRendTrabajoRetenPracticadas!=''){//F - G
        $this->oPdf->SetXY(140, 69);
        $this->oPdf->Cell(30,0,$this->sRendTrabajoCuotaIntegra,0,0,'R');
        $this->oPdf->SetXY(176, 69);
        $this->oPdf->Cell(30,0,$this->sRendTrabajoRetenPracticadas,0,0,'R');
        }
        
        if($this->sRetriIncapacidadImporte!=''){//H
        $this->oPdf->SetXY(140, 88);
        $this->oPdf->Cell(30,0,$this->sRetriIncapacidadImporte,0,0,'R');
        }
        if($this->sRetriIncapacidadRetenciones!=''){//I
        $this->oPdf->SetXY(176, 88);
        $this->oPdf->Cell(30,0,$this->sRetriIncapacidadRetenciones,0,0,'R');
        }
        if($this->sImporteReducciones!=''){//J
        $this->oPdf->SetXY(176, 125);
        $this->oPdf->Cell(30,0,$this->sImporteReducciones,0,0,'R');
        }
        if($this->sGastosFiscalDeduciblesImporte!=''){//K
        $this->oPdf->SetXY(176, 134);
        $this->oPdf->Cell(30,0,$this->sGastosFiscalDeduciblesImporte,0,0,'R');
        }
        if($this->sRentaExentaIRPFImporte!=''){//L
        $this->oPdf->SetXY(176, 247);
        $this->oPdf->Cell(30,0,$this->sRentaExentaIRPFImporte,0,0,'R');
        }
        
        //segunda pagina
        $this->oPdf->Addpage('P','A4');
        $imgPag2='imagenes/pag_2.png';
        $this->oPdf->Image($imgPag2, 0, 0, 210, 297, 'PNG', '', '', true, 200, '', false, false, 0, false, false, true);
        //Datos perceptor
        $this->oPdf->SetXY(4, 18);
        $this->oPdf->Cell(0,0,$this->sNifPerceptor,0,0);
        $this->oPdf->SetXY(46, 18);
        $this->oPdf->Cell(0,0,$this->sApellidosNombrePerceptor,0,0);
        //Datos de persona o entidad pagadora
        $this->oPdf->SetXY(4, 34);
        $this->oPdf->Cell(0,0,$this->sNifPagadora,0,0);
        $this->oPdf->SetXY(46, 34);
        $this->oPdf->Cell(0,0,$this->sPersonaOEntidadPagadora,0,0);
        //Datos Ejercicio
        $this->oPdf->SetXY(195, 44);
        $this->oPdf->Cell(0,0,$this->sEjercicio,0,0);
        //Datos rendimientos del trabajo
        if($this->sRendActivEconCuotaIntegra!=''&&$this->sRendActivEconRetenPracticas!=''){//M - N
        $this->oPdf->SetXY(140, 61);
        $this->oPdf->Cell(30,0,$this->sRendActivEconCuotaIntegra,0,0,'R');
        $this->oPdf->SetXY(176, 61);
        $this->oPdf->Cell(30,0,$this->sRendActivEconRetenPracticas,0,0,'R');
        }
        //datos fecha firma sello
        $this->oPdf->SetXY(8, 270);
        $this->oPdf->Cell(0,0,$this->sLugar,0,0);
        $this->oPdf->SetXY(126, 270);
        $this->oPdf->Cell(0,0,$this->sDia,0,0);
        $this->oPdf->SetXY(144, 270);
        $this->oPdf->Cell(0,0,$this->sMes,0,0);
        $this->oPdf->SetXY(195, 270);
        $this->oPdf->Cell(0,0,$this->sAny,0,0);
        $sDirPath = $this->sDirPdfs."/".$this->sImagenLogo;
        $this->oPdf->Image($sDirPath, 60, 280, 10);
        $this->oPdf->SetXY(22, 291);
        $this->oPdf->Cell(0,0,$this->sNombreFirma,0,0);
    }
    
    public function guardarPdf(){
        
        $ruta= getcwd();
        
        
        $this->oPdf->Output(__DIR__.'/'.$this->sDirPdfs.'/'.$this->sGuardarNombrePdf.'.pdf','F');
    }
}

?>