<?php include  $_SERVER['DOCUMENT_ROOT']."/db.php"; ?>

<?php

if(isset($_GET['seq'])){$seq = $_GET['seq'];}
$query = mq("delete from board where seq = $seq");
$delete = mysqli_query($db, $query);

?>
    <script>
       
        location.replace("<?php echo 'list.php'?>");
    </script>
