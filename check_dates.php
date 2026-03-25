<?php 
$dateDeb = $_POST['dateDeb'];
$dateFin = $_POST['dateFin'];

if ($dateDeb < $dateFin) {
    echo "disponible";
} else {
    echo "indisponible";
}
?>