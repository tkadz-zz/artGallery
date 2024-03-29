<?php
if(isset($_SESSION['type']) && isset($_SESSION['err'])) {
    $type = $_SESSION['type'];
    $message = $_SESSION['err'];



    if($type == 'd'){
        //  DANGER MODAL
        ?>
        <hr>
        <div -id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-lg alert alert-danger">
            <div class="closebtn">
                <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
            </div>
            <span class="animated--grow-in fadeout mdi mdi-information-outline"></span> <?php echo $message  ?>
            <span style="float: right; color: firebrick; font-size:15px" href="#!" class="closebtn" data-bs-dismiss="toast" aria-label="Close"><span class="fa fa-times"></span></span>
        </div>
        <?php
    }
    elseif($type == 'i'){
        ?>
        <hr>
        <div id="divDis" class="animated--grow-in text-dark fadeout -my-3 -p-3 bg-white rounded shadow-lg alert alert-secondary">
            <div class="closebtn">
                <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
            </div>
            <span class="animated--grow-in fadeout mdi mdi-information-variant"></span> <?php echo $message  ?>
            <span style="float: right; color: firebrick; font-size:15px" href="#!" class="closebtn" data-bs-dismiss="toast" aria-label="Close"><span class="fa fa-times"></span></span>
        </div>
        <?php
    }
    elseif ($type == 'w'){
        //  WARNING MODAL
        ?>
        <hr>
        <div -id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-lg alert alert-warning">
            <div class="closebtn">
                <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
            </div>
            <span class="animated--grow-in fadeout mdi mdi-exclamation"></span> <?php echo $message  ?>
            <span style="float: right; color: firebrick; font-size:15px" href="#!" class="closebtn" data-bs-dismiss="toast" aria-label="Close"><span class="fa fa-times"></span></span>
        </div>
        <?php
    }
    elseif ($type == 's'){
        //  SUCCESS MODAL
        ?>
        <hr>
        <div id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-lg alert alert-success">
            <div class="closebtn">
                <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
            </div>
            <span class="animated--grow-in fadeout mdi mdi-check-all"></span> <?php echo $message  ?>
            <span style="float: right; color: firebrick; font-size:15px" href="#!" class="closebtn" data-bs-dismiss="toast" aria-label="Close"><span class="fa fa-times"></span></span>
        </div>
        <?php
    }

    unset($_SESSION['type']);
    unset($_SESSION['err']);

}


?>

<script>
    var close = document.getElementsByClassName("closebtn");
    var i;

    for (i = 0; i < close.length; i++) {
        close[i].onclick = function(){
            var div = this.parentElement;
            div.style.opacity = "0";
            setTimeout(function(){ div.style.display = "none"; }, 1000);
        }
    }
</script>


<script type="text/javascript">
    //close div in 5 secs
    window.setTimeout("closeDisDiv();", 10000);

    function closeDisDiv(){
        document.getElementById("divDis").style.display="none";
        $(".fadeout").click(function (){
            $("div").fadeOut();
        });
    }
</script>


