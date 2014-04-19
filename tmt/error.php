<?php
if(empty($error))
{
    header("Refresh: 0;url=../index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TMTOPUP Generator By Nutter Rocker</title>
        <link rel="stylesheet" href="<?=base_url()?>assets/main.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/fonts.css">
        <script type="text/javascript" src="<?=  base_url()?>assets/jquery.js"></script>
    </head>
    <body>
        <br>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>ข้อผิดพลาด</h4></div>
                    <div class="panel-body">
                        <p><?=$error?></p>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?=base_url()?>assets/main.js"></script>
    </body>
</html>
