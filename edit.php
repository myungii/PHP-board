<?php include  $_SERVER['DOCUMENT_ROOT']."/db.php"; ?>

<?php

if(isset($_POST['seq'])){$seq = $_POST['seq'];}
if(isset($_POST['name'])){$name = $_POST['name'];}
if(isset($_POST['title'])){$title = $_POST['title'];}
if(isset($_POST['detail'])){$detail = $_POST['detail'];}

$query = mq("update board set name = '".$name."', title = '".$title."', detail = '".$detail.
             "' where seq = ".$seq);

$update = mysqli_query($db, $query);

?>
    <script>
        alert('글이 수정되었습니다.');
        location.href = "detail.php?seq=<?= $seq ?>";
        //location.href = "list.php";
    </script>
<?php 
 mysqli_close($db);
?>