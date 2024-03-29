  <?php
  //servidor
  //require_once $_SERVER['DOCUMENT_ROOT'].'/Recordatorios/core/init.php';
  require_once 'core/init.php';
  $factor = 86400;
  ?>
  <head> 
    <title>Recordatorios</title>  

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-2.1.3.js"></script>

    <!-- no funciona post con el siguiente codigo -->
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.js"></script> 

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>   
    <link rel="stylesheet" href="css.css">

    <script>

  //para cambio de formato: 
  $( function() {
    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );

  function callme() {

    $( window ).load(function() {
      if (window.location.href.indexOf('reload')==-1) {
       window.location.replace(window.location.href+'?reload');
     }
   });
    location.reload();
  }

  
</script>

</head> 

<body> 

  <div id="login-form" style="width: 95%;">  <!-- 1 -->
    <h2 class="text-center">&nbsp&nbsp Listado historico </h2>

    <div data-role="header">
      <!-- <h1>jQuery Mobile : Reflow</h1> -->
    </div>

    <div role="main" class="ui-content">   <!-- 2 -->

     <!--  <form action="index.php" method="post">  -->

      <form action="#" method="post">

        <table data-role="table" class="ui-responsive table-stroke">

          <!-- Set the Data-role the Table , the reflow is applied by 	default-->
          <thead>
            <tr>

              <th style="width: 20%;">Asunto</th>
                    <th style="width: 10%;">Dias de aviso</th>
                    <th style="width: 10%;">Fecha de control</th>
                    <th style="width: 10%;">Fecha ingreso</th>
                    <th style="width: 50%;">Mensaje</th>
                    <th style="width: 5%;">Recurrente</th>

              <!-- aca no funciona post -->

            </tr>
          </thead>
          <tbody>

           <!-- //aca no funciona post -->

           <?php 

                     if (isset($_POST['busqueda'])) {
                    $BusquedaParcial = filter_var((string)$_POST['busqueda'], FILTER_SANITIZE_STRING);

                    $sql = "SELECT * FROM `recordatoriosp` WHERE asunto LIKE '%" . $BusquedaParcial . "%' or  mensaje LIKE '%" . $BusquedaParcial . "%'";
                } 
                else {

            //en hstech:
           $sql = "SELECT * FROM recordatoriosp WHERE desactivado=0";
}

           $featured = $db->query($sql);   
           $total=0;
           $k=0;
           ?>
           <?php while($dato= mysqli_fetch_assoc($featured)):

            $id=$dato['id'];
            $asunto=$dato['asunto'];

                if(round(($dato['time']-time())/$factor)<0){$timet=0; } else {$timet=round(($dato['time']-time())/$factor);}

$time = $dato['time'];
            //$time=$dato['time'];
            $fecha= $dato['fecha'];
            $mensaje= $dato['mensaje'];
            $desactivado= $dato['desactivado'];

            ?>
            <tr> 

              <?php  if(isset($_GET['delete'])){  ?>
                <th>   

                  <a href="index.php?hola"  data-ajax="false">
                    <span class="glyphicon glyphicon-trash"></span>
                  </a>

                </th>
              <?php  }  ?>

              <td><?= $asunto; ?></td>                 
              <td><?= $time; ?></td>
              <td><?= $fecha; ?></td>      				
              <td><?= $mensaje; ?></td>

             <td>
                            <?php
                            if ($recurrente == '1') {
                                ?>
                                <a data-ajax="false" href="index.php?recurrente=0&idrec=<?= $id; ?>">
                                    <span class="glyphicon glyphicon-thumbs-up pull-left"></span>
                                </a>
                                <?php
                            } else if ($recurrente == '0') {
                                ?>
                                <a data-ajax="false" href="index.php?recurrente=1&idrec=<?= $id; ?>">
                                    <span class="glyphicon glyphicon-thumbs-down pull-left"></span>
                                </a>
                                <?php
                            }
                            ?>
                        </td>
            
            </tr>


        <?php  endwhile;  $numero=0;	?>

        <!--  <form action="index.php" method="post">  -->

      

          </tbody>

        </table> 


        <hr>

        <?php

  // echo 'no post';

      
        ?>

            <input type="text" data-mini="false" data-role="none" placeholder="Escriba" name="busqueda">

  <button data-theme="c" data-mini="false" value="submit" type="submit" data-inline="true">Buscar</button>

<a data-theme="e" rel="external" href="historico.php" data-role="button" data-inline="true" data-theme="b">Actualizar</a>
        
        <a data-theme="c" rel="external" href="index.php" data-role="button" data-inline="true" data-theme="b"  class="btn btn-secondary pull-right">Volver</a>

        <?php  echo time();  ?>

      </form>


      <?php 

      ?>



    </div>          <!-- 1 -->
  </div>    <!-- 2 -->


</form>



</body>



