<?php
//servidor
//require_once $_SERVER['DOCUMENT_ROOT'].'/Recordatorios/core/init.php';
require_once 'core/init.php';
ob_start();
$factor = 86400;
?>
<head>
    <title>Recordatorios </title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"/>
    <script src="https://code.jquery.com/jquery-2.1.3.js"></script>

    <!-- no funciona post con el siguiente codigo -->
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!--   <link rel="stylesheet" href="/resources/demos/style.css">-->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="css.css">

    <script src="scripts.js"></script>
</head>

<?php

// echo 'no post';

if ($_POST) {

    $numero = (int)$_POST['num'];
    $i = 0;

    while ($i < $numero) {

        $tiempo = $_POST['' . $i . '&tiempo'] == null ? 0 : $_POST['' . $i . '&tiempo'] * $factor + time();
        $fecha = $_POST['' . $i . '&fecha'];
        $mensaje = $_POST['' . $i . '&mensaje'];
        $asunto = $_POST['' . $i . '&asunto'];
        $interval_time = $tiempo; //con esto grabamos el intervalo requerido
        $fechaingreso = date('Y-m-d');
        $recurrente = $_POST['' . $i . '&recurrente'] == 'checked' ? "1" : "0";

        if (!empty($asunto) && !empty($mensaje)) {
            //en hstech:
            $insertsql = "INSERT INTO `recordatoriosp`(`time`,`interval_time`, `fecha`, `mensaje`, `asunto`,`desactivado`,`fechaingreso`,`recurrente`) VALUES ('$tiempo','$interval_time','$fecha','$mensaje','$asunto','1','$fechaingreso','$recurrente')";
            $db->query($insertsql);
        }
        $i++;
    }
    if ($_POST['editId']) {

        $asunto = strval($_POST['edit&asunto']);
        $time = isset($_POST['edit&time']) ? $_POST['edit&time'] : 0;
        $fecha = $_POST['edit&fecha'];
        $fechaingreso = date('Y-m-d');
        $mensaje = strval(isset($_POST['edit&mensaje']) ? $_POST['edit&mensaje'] : "");
        $recurrente = $_POST['edit&recurrente'] == 'checked' ? "1" : "0";
        $editId = (int)$_POST['editId'];

        $UPDATEsql = "UPDATE `recordatoriosp` SET `time`= $tiempo, `interval_time`=$tiempo ,`fecha` = $fecha, `mensaje`=$mensaje, `asunto`=$asunto,`desactivado`=1,`fechaingreso`=$fechaingreso,`recurrente`=$recurrente WHERE id=$editId";
        $db->query($UPDATEsql);

        header("Location: index.php?todo");
    }
}
?>

<body>

<div id="login-form" style="width: 95%;">  <!-- 1 -->
    <h2 class="text-center">&nbsp&nbsp Lista de recordatorios pendientes

        <!--        --><?php
        //        var_dump(isset($_POST['editId']));
        //        var_dump($_POST);
        //        if ($_POST['editId']) {
        //            echo 'true post';
        //            if (isset($_POST['editId'])) {
        //                echo "true";
        //                $editId = (int)$_POST['editId'];
        //                $deleteEditedVar = "DELETE FROM `recordatoriosp` WHERE id=$editId";
        //                $db->query($deleteEditedVar);
        //                header("Location:index.php");
        //            }
        //        }
        //        ?>
    </h2>
    <div role="main" class="ui-content">   <!-- 2 -->
        <form action="index.php" method="post">
            <table data-role="table" class="ui-responsive table-stroke">

                <!-- Set the Data-role the Table , the reflow is applied by   default-->
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
                if (isset($_GET['delete'])) {

                    $deleteid = $_GET['id'];
                    $deleteidquery = "DELETE FROM `recordatoriosp` WHERE id=$deleteid";
                    $db->query($deleteidquery);

                    header("Location: index.php?todo");
                }

                if (isset($_GET['recurrente'])) {

                    $recurrrenciaid = $_GET['idrec'];
                    $recurrente = $_GET['recurrente'];
                    $recurrenciadquery = "UPDATE `recordatoriosp` SET `recurrente`=$recurrente WHERE id=$recurrrenciaid";

                    $db->query($recurrenciadquery);
                    header("Location: index.php");
                }
                //en hstech:
                if (isset($_GET['todo'])) {
                    $sql = "SELECT * FROM `recordatoriosp` WHERE desactivado=1";
                } //else if(!isset($_GET['todo'])) {
                else {
                    $areYouEditingId = isset($_GET['editar']) ? (int)$_GET['id'] : 0;
                    $sql = "SELECT * FROM `recordatoriosp` WHERE desactivado=1  AND id<>" . $areYouEditingId . " ORDER BY id ASC LIMIT 30";
                }

                if (isset($_POST['busqueda'])) {
                    $BusquedaParcial = filter_var((string)$_POST['busqueda'], FILTER_SANITIZE_STRING);

                    $sql = "SELECT * FROM `recordatoriosp` WHERE asunto LIKE '%" . $BusquedaParcial . "%' or  mensaje LIKE '%" . $BusquedaParcial . "%'";
                }
                $featured = $db->query($sql);
                $total = 0;
                $k = 0;
                ?>
                <?php while ($dato = mysqli_fetch_assoc($featured)):

                    $id = $dato['id'];
                    $asunto = $dato['asunto'];
                    if (round(($dato['time'] - time()) / $factor) < 0) {
                        $timet = 0;
                    } else {
                        $timet = round(($dato['time'] - time()) / $factor);
                    }
                    $time = $dato['time'];
                    $fecha = $dato['fecha'];
                    $mensaje = $dato['mensaje'];
                    $desactivado = $dato['desactivado'];
                    $fechaingreso = $dato['fechaingreso'];
                    $recurrente = $dato['recurrente'];
                    ?>
                    <tr>
                        <td><?= $asunto; ?></td>
                        <!-- <td><?= $time; ?> </td> -->
                        <td><?= $timet; ?> </td>
                        <td><?= $fecha; ?></td>
                        <td><?= $fechaingreso; ?></td>
                        <td><?= $mensaje; ?>
                            <a style="display: none;" data-ajax="false" href="index.php?delete&id=<?= $id; ?>"
                               class="eliminar">
                                <span class="glyphicon glyphicon-trash pull-right"></span>
                                <!--  <a style=" display: none;margin-top: -15%" data-ajax="false"-->
                                <a style=" display: none" data-ajax="false" href="index.php?editar&id=<?= $id; ?>"
                                   class="editar">
                                    <span class="glyphicon glyphicon-pencil pull-right"></span>
                        </td>
                        <td>
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
                        </td>
                    </tr>

                <?php
                endwhile;
                $numero = 0; ?>

                <!--  <form action="index.php" method="post">  -->

                <?php
                if (isset($_GET['add'])) {

                    $numero = isset($_GET['add']) ? (int)$_GET['add'] : 0;
                    $numero = (int)$_GET['add'];
                    //switch case:
                    if ((int)$_GET['add'] == 0) $numero = 1;
                    if ((int)$_GET['add'] == 1) $numero = 2;
                    if ((int)$_GET['add'] == 2) $numero = 3;
                    if ((int)$_GET['add'] == 3) $numero = 4;
                    if ((int)$_GET['add'] == 4) $numero = 5;
                    if ((int)$_GET['add'] == 5) $numero = 6;
                    if ((int)$_GET['add'] == 6) $numero = 7;

                    $i = 0;
                    while ($i < $numero) { ?>
                        <tr> <!-- row 3-->
                            <th><input type="text" name="<?= $i; ?>&asunto"></th>
                            <td><input type="number" name="<?= $i; ?>&tiempo"></td>
                            <td><input class="datepicker" type="text" name="<?= $i; ?>&fecha"></td>
                            <td><h4><?= date('Y-m-d'); ?></h4></td>
                            <td><input type="text" name="<?= $i; ?>&mensaje">
                                <a style="display: none;" href="index.php?editar&id=<?= $id; ?>">
                                    <span class="glyphicon glyphicon-pencil pull-right"></span>
                                </a>
                            </td>
                            <td>
                                <div style="margin-top: 30%;">
                                    <input name="<?= $i; ?>&recurrente" type="checkbox" value="checked">
                                </div>
                            </td>
                        </tr>
                        <?php $i++;
                    }
                }

                if (isset($_GET['editar'])) {

                    $editId = (int)$_GET['id'];
                    $recurrenciadquery = "SELECT * FROM `recordatoriosp` WHERE id=$editId";
                    $featured = $db->query($recurrenciadquery);
                    $numero = 1;
                    $datoAEditar = mysqli_fetch_row($featured);
                    ?>
                    <tr>
                        <th><input value="<?= $datoAEditar[1]; ?>" type="text" name="edit&asunto"></th>
                        <?php
                        if (round(($datoAEditar[2] - time()) / $factor) < 0) {
                            $timetoEdit = 0;
                        } else {
                            $timetoEdit = round(($datoAEditar[2] - time()) / $factor);
                        }
                        ?>
                        <td><input value="<?= $timetoEdit; ?>" type="number" name="edit&time"></td>
                        <td><input value="<?= $datoAEditar[4]; ?>" type="text" class="datepicker" name="edit&fecha">
                        </td>
                        <td><h4><?= date('Y-m-d'); ?></h4></td>
                        <td><input value="<?= $datoAEditar[5]; ?>" type="text" name="edit&mensaje"></td>
                        <td>
                            <div style="margin-top: 30%;">
                                <input name="edit&recurrente"
                                       checked="<?= $Ischecked = $datoAEditar[8] == "1" ? "checked" : "unchecked"; ?>"
                                       type="checkbox">
                            </div>
                        </td>
                        <input type="hidden" name="editId" value="<?= $editId; ?>">
                        <input type="hidden" name="num" value="<?= $numero; ?>">
                    </tr>
                    <!-- esto para borrar la fila desactualizada cuando se envie el post:-->

                <?php } ?>
                </tbody>

            </table>

            <div class="ui-field-contain">
                <hr>
                <?php if (isset($_GET['add']) || isset($_GET['editar'])) { ?>

                    <button data-theme="c" type="submit" data-inline="true" onclick="callme()">Guardar datos</button>

                <?php } ?>

                <input data-theme="a" type="hidden" name="num" value="<?= $numero; ?>">

                <a data-ajax="false" data-mini="false" href="index.php?add=<?= $numero; ?>" data-role="button"
                   data-inline="true">Agregar item</a>

                <a data-theme="d" data-mini="false" rel="external" onclick="editar();" data-role="button"
                   data-inline="true" data-theme="b">Editar</a>

                <a data-theme="c" data-mini="false" rel="external" href="index.php" data-role="button"
                   data-inline="true"
                   data-theme="b">Cancelar</a>

                <a data-theme="c" data-mini="false" rel="external" href="index.php?todo" data-role="button"
                   data-inline="true" data-theme="b">Mostrar todo</a>

                <a data-theme="c" data-mini="false" rel="external" onclick="mostrar();" data-role="button"
                   data-inline="true" data-theme="b">Eliminar</a>

                <input type="text" data-mini="false" data-role="none" placeholder="Escriba" name="busqueda">

                <button data-theme="c" data-mini="false" value="submit" type="submit" data-inline="true">Buscar</button>
                <!--<button data-theme="c" data-mini="true" onclick="recurrent();" data-inline="true">Recurrente</button>-->

        </form>

        <!--  <a data-theme="c" rel="external" onclick="mostrar();" data-role="button" data-inline="true" data-theme="b">Repetir (solo fecha)</a>
            <input data-inline="true" display="hidden" data-theme="a" type="number" name="num" value="<?= $numero; ?>"> -->

        <a data-theme="c" data-mini="true" rel="external" href="historico.php" data-role="button" data-inline="true"
           data-theme="b" class="btn btn-secondary pull-right">Ver historial</a>

    </div>

    ( <?php echo time(); ?>)


    <!-- ( Tiempo actual Unix: <?php echo time();
    echo ' - PHP v: ' . phpversion(); ?>) -->


</div>          <!-- 1 -->
</div>    <!-- 2 -->


</form>


</body>



