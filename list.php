<?php include  $_SERVER['DOCUMENT_ROOT']."/db.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <!-- bootstrap 게시판용 -->
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <!-- 페이징버튼 -->
        <link rel="stylesheet" href="css/bootstrap.css">

        <title>[list.php]</title>
        <style type="text/css">
            .container {
                width : 70 %;
            }

            input : -ms - input - placeholer {
                color : #a8a8a8;
            }
            input:: - webkit - input - placeholder {
                color : #a8a8a8;
            }
            input:: - moz - paceholder {
                color : #a8a8a8;
            }

            #keyfield {
                font - size : 10 pt;
                height : 40 px;
                width : 110 px;
                padding : 10 px;
                border : 1 px solid #1b5ac2;
                outline : none;
                float : left;
            }.search_option {
                height : 40 px;
                width : 300 px;
                border : 1 px solid #1b5ac2;
                background : #ffffff;
                float : left;
            }

            #search_text {
                font - size : 12 pt;
                width : 225 px;
                height : 38 px;
                padding : 10 px;
                border : 0 px;
                outline : none;
                float : left;
            }

            #search_button {
                width : 50 px;
                height : 100 %;
                border : 0 px;
                background : #1b5ac2;
                outline : none;
                float : right;
                color : #ffffff;
            }.padding {
                padding - bottom : 10e m;
            }
        </style>
        <script type="text/javascript">
            
        </script>
    </head>
    <body>
    <?php 
             if(isset($_GET['pageNum'])){
                 $pageNUM = $_GET['pageNum'];
             }else {$pageNUM = 1;}
           
             $start = ($pageNUM-1)*10;
             $end = $pageNUM*10;

             $temp = ($pageNUM-1)%10;
             $startpage = $pageNUM-$temp-1;
             $endpage = $startpage+9;
        
              $sql = mq("select @rownum := @rownum + 1 as rownum, board.*". 
              "from board, (select @rownum := $start) r order by board.seq desc limit $startpage, 10");
              $total = mysqli_num_rows($sql);
              if($total%10 == 0) {$pagecount = $total;}
              else{$pagecount = ($total/10) + 1;}

              if($endpage > $pagecount){$endpage = $pagecount;}
             
            ?>
        <div class="container">
            <h2>게시물 리스트</h2>
            <p>자유게시판입니다.</p>
            <div align="right">총
                <?=$total?>
                개의 게시글이 있습니다.</div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>번 호</th>
                        <th>아이디</th>
                        <th>제 목</th>
                        <th>조회수</th>
                        <th>추천수</th>
                        <th>등록날짜</th>
                    </tr>
                </thead>
                <?php

                while($board = $sql->fetch_array()){
                    //title변수에 DB에서 가져온 title을 선택
                     $title=$board["title"]; 
                    if(strlen($title)>30)
                     { 
                         //title이 30을 넘어서면 ...표시
                         $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
                     }
            ?>
                <tbody>
                    <tr>
                        <td>
                            <?php echo $board['seq']; ?>
                        </td>
                        <td>
                            <?php echo $board['rownum']; ?>
                        </td>
                        <td>
                            <?php echo $board['userid']; ?>
                        </td>
                        <td>
                            <a href="detail.php?seq=<?=$board['seq'];?>">
                                <?php echo $board['title']; ?>
                            </td>
                        </td>
                        <td>
                            <?php echo $board['hit']; ?>
                        </td>
                        <td>
                            <?php echo $board['recommend']; ?>
                        </td>
                        <td>
                            <?php echo $board['wdate']; ?>
                        </td>
                    </tr>

                </tbody>
                <?php } ?>
            </table>
            <hr>

            <form>
                <div class="col-lg-6 offset-lg-5 py-1">
                    <ul class="pagination mx-auto">
                        <?php 
                if($startpage+1>10){ ?>
                        <li class="page-item">
                            <a class="page-link" href="list.php?pageNum=<?=($startpage+1)-10?>">
                                <?php echo '이전' ?></a>
                        </li>
                        <?php } 
                for($i = $startpage+1; $i<=$endpage; $i++){ ?>
                        <li class="page-item">
                            <a class="page-link" href="list.php?pageNum=<?=$i?>">
                                <?php echo $i ?></a>
                        </li>
                        <?php } 

                if($endpage<$pagecount){ ?>     
                        <li class="page-item">
                            <a class="page-link" href="list.php?pageNum=<?=($startpage+1)+10?>">
                                <?php echo '다음' ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </form>
            <div class="main_link">
                <p class="text-right">
                    <button
                        type="button"
                        class="btn btn-outline-primary"
                        onclick="location.href='write.php'">글쓰기</button>
                    <button
                        type="button"
                        class="btn btn-outline-dark"
                        onclick="location.href='index.php'">index</button>
                </p>
            </div>
            <div class="padding">
                <div class="col-lg-6 offset-lg-3 py-1">
                    <form name="myform" action="search_list.php">
                        <select name="keyfield" id="keyfield" onchange="clearText();">
                            <option value="">선택하세요</option>
                            <option value="userid">아이디
                            </option>
                            <option value="title">제목</option>
                            <option value="detail">
                                내용</option>
                        </select>

                        <div class="search_option">
                            <input type="text" id="search_text" name="keyword" placeholder="검색어 입력">
                            <input type="submit" id="search_button" value="검색">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </body>
</html>