<?php
$codProyecto = 1;
$cadenaPatrocindores = "1,2,3";
$insertPatrocidaresQ = "";
$arreglo = explode(",", $cadenaPatrocindores); 
if(count($arreglo) > 0){
    for($i=0; $i<count($arreglo); $i++){ 
        $insertPatrocidaresQ = 
        $insertPatrocidaresQ." "
        ." insert into tblpatrocinadoresxproyecto (codPatrocinador, codProyecto) values (".$arreglo[$i]." , ".$codProyecto.");";
        
    }
    echo $insertPatrocidaresQ;
}else
    echo "no hay areglo";


    $consulta = 
    "INSERT INTO tblproyectos ("
    ."codProyecto, "
    ."nombreProyecto, "
    ."fechaInicio, "
    ."fechafinal, "
    ."lugar, "
    ."descripcion, "
    ."codTipoProyecto, "
    ."codEstado, "
    ."codUsuario, "
    ."costoEstimado," 
    ."beneficiario"
    .") "
    ."VALUES ( null , 1, 2, 2, 1, 4, );";

    echo $consulta."SELECT LAST_INSERT_ID();".$insertPatrocidaresQ;


?>