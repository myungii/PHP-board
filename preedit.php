<?php include  $_SERVER['DOCUMENT_ROOT']."/db.php"; ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>write.jsp</title>
        <!-- bootstrap 게시판용 -->
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
            integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
            crossorigin="anonymous">
        <!-- HTML웹 에디터 -->
        <!-- include libraries(jQuery, bootstrap) -->
        <link
            href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
            rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <!-- include summernote css/js -->
        <link
            href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css"
            rel="stylesheet">
        <script
            src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

        <style type="text/css">
            .container {
                width: 70%;
            }

            .id_form {
                padding-bottom: 10em;
            }

            .input-group {
                float: left;
            }

            .input-group-prepend {
                height: 34px;
                width: 200px;
                float: left;
            }

            .text_size {
                width: 200px;
                margin-left: -11em;
                float: left;
            }

            .text_size#text_title {
                width: 400px !important;
            }
        </style>
        <script type="text/javascript">

            function userid_chk() {
                if (myform.userid.value == null || myform.userid.value == "") {
                    alert("아이디를 입력하세요");
                    myform
                        .userid
                        .focus();
                    return false;
                } else {
                    myform
                        .name
                        .focus();
                    return true;
                }
            }

            function name_chk() {
                if (myform.name.value == null || myform.name.value == "") {
                    alert("이름을 입력하세요");
                    myform
                        .name
                        .focus();
                    return false;
                } else {
                    myform
                        .title
                        .focus();
                    return true;
                }
            }

            function title_chk() {
                if (myform.title.value == null || myform.title.value == "") {
                    alert("제목을 입력하세요");
                    myform
                        .title
                        .focus();
                    return false;
                } else {
                    return true;
                }
            }

            function nullCheck() {
                if (confirm('수정하시겠습니까?') == true) {
                    if (!(userid_chk() && name_chk() && title_chk()) == false) 
                        document
                            .myform
                            .submit();
                    }
                
            }
        </script>
    </head>
    <body>

        <?php

if(isset($_GET['seq'])){$seq = $_GET['seq'];}
$query = mq("select * from board where seq = ".$seq);
$pr = mysqli_fetch_array($query);


?>

        <div class="container">
            <h2>수정글쓰기</h2>
            <p>내 맘대로 글을 써 보세요!</p>

            <form name="myform" action="edit.php" method="POST">
                <div class="id_form">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">아이디</span>
                        </div>
                        <div class="text_size">
                            <input
                                type="text"
                                class="form-control"
                                name="userid"
                                value="<?=$pr['userid'] ?>"
                                readonly="readonly"
                                aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">이 &nbsp; 름</span>
                        </div>
                        <div class="text_size">
                            <input
                                type="text"
                                class="form-control"
                                name="name"
                                value="<?=$pr['name'] ?>"
                                aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">제 &nbsp; 목</span>
                        </div>
                        <div class="text_size" id="text_title">
                            <input
                                type="text"
                                class="form-control"
                                name="title"
                                value="<?=$pr['title'] ?>"
                                aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                </div>

                <textarea id="summernote" name="detail"><?=$pr['detail'] ?></textarea>
                <input type = "hidden" name = "seq" value ="<?=$pr['seq'] ?>">
                <script>
                    $(document).ready(function () {
                        $('#summernote').summernote(
                            {placeholder: '텍스트를 입력하세요.', tabsize: 2, height: 300}
                        );
                    });
                </script>
                <br>

                <p class="text-right">
                    <button type="button" class="btn btn-outline-primary" onclick="nullCheck();">수정완료</button>
                    <button
                        type="button"
                        class="btn btn-outline-dark"
                        onclick="location.href='list.php'">목록으로</button>
                </p>
            </form>

        </div>

    </body>
</html>