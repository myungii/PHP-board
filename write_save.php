<?php include  $_SERVER['DOCUMENT_ROOT']."/db.php"; ?>
<?php 
 if(isset($_POST['userid'])){$suserid = $_POST['userid'];}
 else $suserid = "";
 echo 'userid : '.$suserid;
 if(isset($_POST['name'])){$sname = $_POST['name'];}
 else $sname = "";
 echo 'name : '.$sname;
 if(isset($_POST['title'])){$stitle = $_POST['title'];}
 else $stitle = "";
 echo 'title : '.$stitle;
 if(isset($_POST['detail'])){$sdetail = $_POST['detail'];}
 else $sdetail ="";
    echo 'detail : '.$sdetail;
    $swdate = date('Y-m-d H:i:s');
   // $conn = mysqli_connect("localhost","root","12345678","choi");
$query = "insert into board(seq, userid, name, title, detail, hit, recommend, wdate".
            ") values(null, '".$suserid."', '".$sname."', '".$stitle."', '".$sdetail."', ".
            "0, 0, sysdate())";
            echo $query;
$result=mysqli_query($db, $query);


if($result){ ?>
    <script>
        console.log('글쓰기저장성공');
        location.replace("<?php echo 'list.php'?>");
    </script>
<?php } else{?>
    <script>
        console.log('글쓰기저장실패');
        //location.replace("<?php echo 'write.php'?>");
    </script>
<?php } 
    mysqli_close($db);
?>