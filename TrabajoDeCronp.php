<?php
//servidor
require_once('core/init.php');

$sql = "SELECT * FROM `recordatoriosp` WHERE desactivado=1 ORDER BY id DESC LIMIT 60";

$featured = $db->query($sql);
$total = 0;
$k = 0;

while ($dato = mysqli_fetch_assoc($featured)):

    $id = $dato['id'];
    $asunto = $dato['asunto'];
    $time = $dato['time'];
    $fecha = $dato['fecha'];
    $mensaje = $dato['mensaje'];
    $desactivado = $dato['desactivado'];
    $recurrente = $dato['recurrente'];

    //echo '(int)$time: ' . (int)$time;
    //echo '|';
    //echo 'time() : ' . time();

    if (((int)strtotime($fecha) + 14000 < time() && strtotime($fecha) != strtotime("0000-00-00")) || ((int)$time < time() && $time != '0')) {

        $to = "ahauck_88@hotmail.com";
        $subject = $asunto;
        $txt = $mensaje;
        $headers = "From: notificaciones@hstech.cl" . "\r\n";

        mail($to, $subject, $txt, $headers);

        //en hstech:
        if ($recurrente == '0') {
            $insertsql2 = "UPDATE `recordatoriosp` SET `desactivado`='0' WHERE id=$id";
        } else { //se repite
            if (strtotime($fecha) == strtotime("0000-00-00")) { //se establecio por periodos fijos, se vuele a repetir en 20 dias mas
                $time = strval((int)$time + 1800000 - 8000);
                $insertsql2 = "UPDATE `recordatoriosp` SET  `time`= $time  WHERE id=$id";
            } else {   // una vez al año
                $fecha = (string)date("Y-m-d", substr(strval(strtotime($fecha) + 31556926), 0, 10));
                $insertsql2 = "UPDATE `recordatoriosp` SET  `fecha`=$fecha WHERE id=$id";
            }
        }
        $db->query($insertsql2);
    }

endwhile; ?>
 
   
