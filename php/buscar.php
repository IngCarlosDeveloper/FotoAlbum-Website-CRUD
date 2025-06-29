<?php
#------------------------------------------------CONEXION A LA DB----------------------------------------

require "conexion.php"; //llamo el archivo con permisos para la db

#-----------------------------------------------BUSCADOR POR PALABRA-----------------------------------------

$buscar = isset($_POST['palabraBuscar']) ? $conexion-> real_escape_string($_POST['palabraBuscar']) : NULL;
//Extrae la palabra del input

$pais = isset($_POST['Pais']) ? $conexion-> real_escape_string($_POST['Pais']) : NULL;
//Extrae el id de la seleccion de la lista
$columnas = ["IdFoto", "Titulo", "Fecha", "Album", "FRegistro", "Fichero"]; //Columnas de la tabla fotos
$contar = count($columnas); //Cuenta cuantos datos hay en $columnas

$tabla = "fotos"; 

$where = '';

if($pais != 0){
    $where .= "WHERE Pais = $pais";
}

if($pais != 0 && $buscar != NULL){
    $where .= " AND (";
} elseif ($pais == 0 && $buscar != NULL){
     $where = "WHERE ";
}

if($buscar != NULL){

    for($i =0; $i < $contar; $i++){
        $where .= $columnas[$i] . " LIKE '%". $buscar . "%' OR ";
    } //Bucle para buscar la palabra por cada columna

    $where = substr_replace(string: $where, replace: "", offset: -3);
    //Se elimina el ultimo OR
    
    if($pais != 0 && $buscar != NULL){
    $where .= ")";
    }
    

}

$sqlBuscar = "SELECT * FROM $tabla $where;";

$resultadobusqueda = mysqli_query($conexion, $sqlBuscar);

#------------------------------------------EMPAQUETAR PARA EL HTML----------------------------

$num_rows = $resultadobusqueda->num_rows;

$html = '';

if($num_rows > 0){

    while($row = mysqli_fetch_assoc($resultadobusqueda)){
        $html .= '<tr>';

        for($i=0; $i < $contar-1; $i++){
             $html .= '<td><a href="hola.html?foto='.$row[$columnas[0]].'">'. $row[$columnas[$i]] .'</a></td>';
        }
        $html .= '<td><img src="'. $row[$columnas[$i]] .'"/></td>';

        $html .= '</tr>';
    }
}else{
    $html .= '<tr>';
    $html .= '<td>Sin resultado</td>';
    $html .= '</tr>';
}

echo json_encode( $html, JSON_UNESCAPED_UNICODE);


?>