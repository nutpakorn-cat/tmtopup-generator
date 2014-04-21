<?php
if(empty($_SESSION['usegen']))
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
        <link rel="stylesheet" href="<?=base_url()?>cm/lib/codemirror.css">
        <link rel="stylesheet" href="<?=base_url()?>cm/theme/solarized.css">
        <script type="text/javascript" src="<?=  base_url()?>assets/jquery.js"></script>
    </head>
    <body>
        <?php if($_POST) : ?>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Log</h4></div>
                    <div class="panel-body">
                        <?php
                        $handle = fopen(BASEPATH .DIRECTORY_SEPARATOR . "output" . DIRECTORY_SEPARATOR . "tmtopup_api.php", 'w');
                        if($handle){

                            if(!fwrite($handle, "<?php
# ------------------------------------- Config Begin ------------------------------------- #
// ------------------------------------------------------------------------------------------------
/* MySQL Config | Begin */
// Hostname ของ MySQL Server
\$_CONFIG['mysql']['dbhost'] = 'localhost';

// Username ที่ใช้เชื่อมต่อ MySQL Server
\$_CONFIG['mysql']['dbuser'] = '{$_POST["username"]}';

// Password ที่ใช้เชื่อมต่อ MySQL Server
\$_CONFIG['mysql']['dbpw'] = '{$_POST["password"]}';

// ชื่อฐานข้อมูลที่เราจะเติม Point ให้
\$_CONFIG['mysql']['dbname'] = '{$_POST["database"]}';

// ชื่อตารางที่เราจะเติม Point ให้ ตัวอย่าง : member
\$_CONFIG['mysql']['tbname'] = '{$_POST["table"]}';

// ชื่อ field ที่ใช้อ้าง Username
\$_CONFIG['mysql']['field_username'] = '{$_POST["field_username"]}';

// ชื่อ field ที่ใช้ในการเก็บ Point จากการเติมเงิน
\$_CONFIG['TMN']['point_field_name'] = '{$_POST["field_point"]}';
/* MySQL Config | End */
// ------------------------------------------------------------------------------------------------


// ------------------------------------------------------------------------------------------------
/* จำนวน Point ที่จะได้รับเมื่อเติมเงินในราคาต่างๆ | Begin */
\$_CONFIG['TMN'][50]['point'] = {$_POST["50p"]};					// Point ที่ได้รับเมื่อเติมเงินราคา 50 บาท
\$_CONFIG['TMN'][90]['point'] = {$_POST["90p"]};					// Point ที่ได้รับเมื่อเติมเงินราคา 90 บาท
\$_CONFIG['TMN'][150]['point'] = {$_POST["150p"]};				// Point ที่ได้รับเมื่อเติมเงินราคา 150 บาท
\$_CONFIG['TMN'][300]['point'] = {$_POST["300p"]};				// Point ที่ได้รับเมื่อเติมเงินราคา 300 บาท
\$_CONFIG['TMN'][500]['point'] = {$_POST["500p"]};				// Point ที่ได้รับเมื่อเติมเงินราคา 500 บาท
\$_CONFIG['TMN'][1000]['point'] = {$_POST["1000p"]};			// Point ที่ได้รับเมื่อเติมเงินราคา 1,000 บาท
/* จำนวน Point ที่จะได้รับเมื่อเติมเงินในราคาต่างๆ | End */
// ------------------------------------------------------------------------------------------------


// กำหนด API Passkey
define('API_PASSKEY', '{$_POST["api_passkey"]}');

# -------------------------------------- Config End -------------------------------------- #


require_once('AES.php');


// ------------------------------------------------------------------------------------------------
/* เชื่อมต่อฐานข้อมูล | Begin */
mysql_connect(\$_CONFIG['mysql']['dbhost'],\$_CONFIG['mysql']['dbuser'],\$_CONFIG['mysql']['dbpw']) or die('ERROR|DB_CONN_ERROR|' . mysql_error());
mysql_select_db(\$_CONFIG['mysql']['dbname']) or die('ERROR|DB_SEL_ERROR|' . mysql_error());
/* เชื่อมต่อฐานข้อมูล | End */
// ------------------------------------------------------------------------------------------------


if(\$_SERVER['REMOTE_ADDR'] == '203.146.127.115' && isset(\$_GET['request']))
{
	\$aes = new Crypt_AES();
	\$aes->setKey(API_PASSKEY);
	\$_GET['request'] = base64_decode(strtr(\$_GET['request'], '-_,', '+/='));
	\$_GET['request'] = \$aes->decrypt(\$_GET['request']);
	if(\$_GET['request'] != false)
	{
		parse_str(\$_GET['request'],\$request);
		\$request['Ref1'] = base64_decode(\$request['Ref1']);

		/* Database connection | Begin */
		\$result = mysql_query('SELECT * FROM `'. \$_CONFIG['mysql']['tbname'] .'` WHERE `'. \$_CONFIG['mysql']['field_username'] .'`=\'' . mysql_real_escape_string(\$request['Ref1']) . '\' LIMIT 1') or die(mysql_error());
		if(mysql_num_rows(\$result) == 1)
		{
			\$row = mysql_fetch_assoc(\$result);
			if(mysql_query('UPDATE `'.\$_CONFIG['mysql']['tbname'].'` SET `'. \$_CONFIG['TMN']['point_field_name'] .'` = `'. \$_CONFIG['TMN']['point_field_name'] .'+'. \$_CONFIG['TMN'][\$request['cardcard_amount']]['point'] .' WHERE `'. \$_CONFIG['mysql']['field_username'] .'` = '. \$row[\$_CONFIG['mysql']['field_username']] .' LIMIT 1 ') == false)
			{
				echo 'ERROR|MYSQL_UDT_ERROR|' . mysql_error();
			}
			else
			{
                                        {$_POST["code"]}
				echo 'SUCCEED|UID=' . \$row[\$_CONFIG['mysql']['field_username']];
			}
		}
		else
		{
			echo 'ERROR|INCORRECT_USERNAME';
		}
		/* Database connection | End */

	}
	else
	{
		echo 'ERROR|INVALID_PASSKEY';
	}
}
else
{
	echo 'ERROR|ACCESS_DENIED';
}
?>"))  die("<p class='text-danger'>ไม่สามารถบันทึกไฟล์ได้</p>"); 
                            echo "<p class='text-success'>บันทึกไฟล์เสร็จสมบูรณ์ ตำแหน่งไฟล์อยู่ที่ ".BASEPATH .DIRECTORY_SEPARATOR . "output" . DIRECTORY_SEPARATOR . "tmtopup_api.php"."</p>";
                            echo "<p>ตำแหน้ง URL : ".base_url()."output/tmtopup_api.php </p>";
                        }


                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php else : ?>
        <br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>ระบบสร้างไฟล์ tmtopup api อัตโนมัติ</h4></div>
                    <div class="panel-body">
                        <form class="form-group" method="post" action="<?php $_SERVER['PHP_SELF']?>">
                            <legend>Mysql setting.</legend>
                            <input class="form-control" name="username" type="text" placeholder="Username ที่ใช้เชื่อมต่อ MySQL Server" required>
                            <p></p>
                            <input class="form-control" name="password" type="text" placeholder="Password ที่ใช้เชื่อมต่อ MySQL Server" required>
                            <p>พาสเวิร์ดระบบจะไม่ทำเป็น *** เนื่องจากกันพิมพ์ password ผิด</p>
                            <input class="form-control" name="database" type="text" placeholder="Database ที่เก็บข้อมูล" required>
                            <p></p>
                            <input class="form-control" name="table" type="text" placeholder="ชื่อตารางที่จะเติม point เช่น iconomy" required>
                            <p></p>
                            <input class="form-control" name="field_username" type="text" placeholder="ชื่อ field ที่ใช้อ้างเอง username" required>
                            <p></p>
                            <input class="form-control" name="field_point" type="text" placeholder="ชื่อ field ที่ใช้ในการเก็บ Point จากการเติมเงิน" required>
                            <br>
                            <legend>Point setting.</legend>
                            <input class="form-control" name="50p" type="text" placeholder="เงินในเกมที่จะได้เมื่อเติมเงิน 50 บาท" required>
                            <p></p>
                            <input class="form-control" name="90p" type="text" placeholder="เงินในเกมที่จะได้เมื่อเติมเงิน 90 บาท" required>
                            <p></p>
                            <input class="form-control" name="150p" type="text" placeholder="เงินในเกมที่จะได้เมื่อเติมเงิน 150 บาท">
                            <p></p>
                            <input class="form-control" name="300p" type="text" placeholder="เงินในเกมที่จะได้เมื่อเติมเงิน 300 บาท" required>
                            <p></p>
                            <input class="form-control" name="500p" type="text" placeholder="เงินในเกมที่จะได้เมื่อเติมเงิน 500 บาท" required>
                            <p></p>
                            <input class="form-control" name="1000p" type="text" placeholder="เงินในเกมที่จะได้เมื่อเติมเงิน 1000 บาท" required>
                            <br>
                            <legend>Tmtopup setting.</legend>
                            <input class="form-control" name="api_passkey" type="text" placeholder="API PASSKEY ต้องเป็น key เดียวกับที่ตั้งใน tmtopup" required>
                            <br>
                            <legend>(DEV) เขียน PHP เพิ่มเมื่อเติมสำเร็จ ไม่จำเป็นต้องใส่</legend>
                            <p>เช่นในกรณีเติมเสร็จแล้วอยากให้บันทึกประวัติ หรือกระทำอื่นๆ Code จะไปอยู่ข้างบน  <br>echo 'SUCCEED|UID=' . $row[\$_CONFIG['mysql']['field_username']]; ในไฟล์ tmtopup_api.php</p>
                            <textarea name="code" id="code">echo "เติมเสร็จสมบูรณ์";</textarea>
                            <hr>
                            <button class="btn btn-lg btn-block btn-primary" type="submit">บันทึก</button>
                        </form>
                     </div>
                </div>
            </div>
        </div>
        <script src="<?=base_url()?>cm/lib/codemirror.js"></script>
        <script src="<?=base_url()?>cm/mode/javascript/javascript.js"></script>
        <script>
        var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
            lineNumbers: true,
            styleActiveLine: true,
            matchBrackets: true
          });
        editor.setOption("theme", "solarized light");</script>
        <?php endif; ?>
        <script type="text/javascript" src="<?=base_url()?>assets/main.js"></script>
    </body>
</html>
