<?php
include 'includes/autoloader.inc.php';
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Art Gallery</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="crossorigin"/>
    <link rel="icon" type="image/x-icon" href="images/favicon.png" />
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;600;700&amp;display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;600;700&amp;display=swap" media="print" onload="this.media='all'"/>
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;600;700&amp;display=swap"/>
    </noscript>
    <link href="css/bootstrap.min.css?ver=1.2.0" rel="stylesheet">

    <link href="css/font-awesome/css/all.min.css?ver=1.2.0" rel="stylesheet"><!-- Custom fonts for this template-->
    <link rel="stylesheet" href="css/mdi/css/materialdesignicons.min.css">

    <link href="css/main.css?ver=1.2.0" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link href="css/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="css/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="css/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="css/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />



    <!-- Font Awesome -->
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
            rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
            href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
            rel="stylesheet"
    />
    <!-- MDB -->
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css"
            rel="stylesheet"
    />

</head>
<style>
    img {
        pointer-events: none;
    }

    html {
        scroll-behavior: smooth;
    }

    #footer {
        position:absolute;
        width:100%;
    }

    .card-counter{
        box-shadow: 2px 2px 10px #DADADA;
        margin: 5px;
        padding: 20px 10px;
        background-color: #fff;
        height: 100px;
        border-radius: 5px;
        transition: .3s linear all;
    }

    .card-counter:hover{
        box-shadow: 4px 4px 20px #DADADA;
        transition: .3s linear all;
    }

    .card-counter.primary{
        background-color: #007bff;
        color: #FFF;
    }

    .card-counter.danger{
        background-color: #ef5350;
        color: #FFF;
    }

    .card-counter.success{
        background-color: #66bb6a;
        color: #FFF;
    }

    .card-counter.info{
        background-color: #26c6da;
        color: #FFF;
    }

    .card-counter i{
        font-size: 5em;
        opacity: 0.2;
    }

    .card-counter .count-numbers{
        position: absolute;
        right: 35px;
        top: 20px;
        font-size: 32px;
        display: block;
    }

    .card-counter .count-name{
        position: absolute;
        right: 35px;
        top: 65px;
        font-style: italic;
        text-transform: capitalize;
        opacity: 0.5;
        display: block;
        font-size: 18px;
    }
</style>


<script type="text/javascript">
    var message="Right click option is disabled for protection";

    function clickIE4(){
        if (event.button==2){
            alert(message);
            return false;
        }
    }

    function clickNS4(e){
        if (document.layers||document.getElementById&&!document.all){
            if (e.which==2||e.which==3){
                alert(message);
                return false;
            }
        }
    }

    if (document.layers){
        document.captureEvents(Event.MOUSEDOWN);
        document.onmousedown=clickNS4;
    }
    else if (document.all&&!document.getElementById){
        document.onmousedown=clickIE4;
    }

    document.oncontextmenu=new Function("alert(message);return false")
</script>


<script language="javascript">
    var noPrint=true;
    var noCopy=true;
    var noScreenshot=true;
    var autoBlur=true;
</script>


<script>
    //Srow Back to top automatically
    var el = document.querySelector('html');
    el.scrollTop = el.scrollHeight;

    setTimeout(function(){
        el.scrollTop = 0;
    }, 1);
</script>

