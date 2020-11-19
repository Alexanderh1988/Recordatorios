  <?php
  //servidor
  require_once $_SERVER['DOCUMENT_ROOT'].'/Recordatorios/core/init.php';


  $sql="SELECT * FROM `rememberhstech` WHERE desactivado=1";


  $featured = $db->query($sql);   
  $total=0;
  $k=0;
  ?>
  <?php while($dato= mysqli_fetch_assoc($featured)):


    $id=$dato['id'];
    $asunto=$dato['asunto'];
    $time=$dato['time'];
    $fecha= $dato['fecha'];
    $mensaje= $dato['mensaje'];
    $desactivado= $dato['desactivado'];


    if(((int)strtotime($fecha)+14000<time() && strtotime($fecha)!='-62169984000') || ((int)$time<time() && $time!='0')) {

            //  if(strtotime($fecha)<time()) {

      $to = "youEmail";
      $subject = $asunto;
      $txt = $mensaje;
      $headers = "From: notificaciones@yourDomain.cl" . "\r\n";

      mail($to,$subject,$txt,$headers);

              //en hstech:
      $insertsql2="UPDATE `rememberhstech` SET `desactivado`='0' WHERE id=$id";             
      $db->query($insertsql2);

    }

         //  $conta++;
         // }  // fin de if de instruccion por tramo

             // $insertsql4="UPDATE `desactivado` SET `desactivado`='$conta' WHERE id=1";             
             //  $db->query($insertsql4);

  endwhile; 	?>

  <!--  <form action="index.php" method="post">  -->

  

   
