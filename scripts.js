function mostrar() {

    //        alert("doacciona");

    var x = document.getElementsByClassName("eliminar");
    var i;
    for (i = 0; i < x.length; i++) {

        if (x[i].style.display === "none") {
            //alert("none");
            x[i].style.display = "block";
            // document.getElementsByClassName("eliminar").style.display = "none";

        } else {
            //else if (x[i].style.display === "hidden") {
            // alert("hidden");
            x[i].style.display = "none";
            // document.getElementsByClassName("eliminar").style.display = "hidden";
        }
    }
}

function recurrent() {
    var x = document.getElementsByClassName("recurrente");
    var i;
    for (i = 0; i < x.length; i++) {

        if (x[i].style.display === "none") {
            x[i].style.display = "block";
        } else {
            x[i].style.display = "none";
        }
    }
}

function editar() {

    var y = document.getElementsByClassName("editar");
    var i;
    for (i = 0; i < y.length; i++) {

        if (y[i].style.display === "none") {
            y[i].style.display = "block";
        } else {
            y[i].style.display = "none";

        }
    }
}

//para cambio de formato:
$(function () {
    $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
});

function callme() {

    $(window).load(function () {
        if (window.location.href.indexOf('reload') == -1) {
            window.location.replace(window.location.href + '?reload');
        }
    });
    location.reload();
}


    