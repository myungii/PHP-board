<?php include  $_SERVER['DOCUMENT_ROOT']."/db.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<!-- bootstrap 게시판용 -->
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<!-- 페이징버튼 -->
<link rel="stylesheet" href="css/bootstrap.css">

<title>[list.php]</title>

	<script type="text/javascript">
	.container {
	width: 70%;
}

input:-ms-input-placeholer{color : #a8a8a8;}
input::-webkit-input-placeholder{color : #a8a8a8;}
input::-moz-paceholder{color : #a8a8a8;}

#keyfield{
	font-size : 10pt;
	height : 40px;
	width : 110px;
	padding : 10px;
	border : 1px solid #1b5ac2;
	outline : none;
	float : left;
}

.search_option{
	height : 40px;
	width : 300px;
	border : 1px solid #1b5ac2;
	background : #ffffff;
	float : left;
}

#search_text{
	font-size : 12pt;
	width : 225px;
	height : 38px;
	padding : 10px;
	border : 0px;
	outline : none;
	float : left;
}

#search_button{
	width : 50px;
	height : 100%;
	border : 0px;
	background : #1b5ac2;
	outline : none;
	float : right;
	color : #ffffff;
}

.padding{
	padding-bottom : 10em;
}
	</script>
</head>
<body>

<div class="container">
		<h2>게시물 리스트</h2>
		<p>자유게시판입니다.</p>
		<div align="right">총 0 개의 게시글이 있습니다.</div>
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
            $sql = mq("select @rownum := @rownum + 1 as rownum, board.*". 
                      "from board, (select @rownum := 0) r");

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
					        <td> <?php echo $board['seq']; ?> </td>
						    <td> <?php echo $board['rownum']; ?> </td>
						    <td> <?php echo $board['userid']; ?> </td>
						    <td>
                                <a href="#"> <?php echo $board['title']; ?>  
                            </td>
						    </td>
						    <td> <?php echo $board['hit']; ?> </td>
						    <td> <?php echo $board['recommend']; ?> </td>
						    <td> <?php echo $board['wdate']; ?> </td>
                        </tr>
          
            </tbody>
            <?php } ?>
		</table>
		<hr>
		
		
	
        <div class="col-lg-6 offset-lg-5 py-1">
            <ul class="pagination mx-auto">
             
                <c:forEach var="i" begin="1" end="10">
                	 <li class="page-item"><a class="page-link" href="#">${i}</a></li>
                </c:forEach>
               
            </ul>
       </div>	
       
       <div class="main_link">
			<p class="text-right">
				<button type="button" class="btn btn-outline-primary"
					onclick="location.href='#'">글쓰기</button>
				<button type="button" class="btn btn-outline-dark"
					onclick="location.href='index.php'">index</button>
			</p>
		</div>
		<div class="padding">
			<div class="col-lg-6 offset-lg-3 py-1">
				<form name="myform" action="/board/list">
					<select name="keyfield" id="keyfield" onchange="clearText();">
						<option value="">선택하세요</option>
						<option value="userid"
							>아이디
						</option>
						<option value="title"
							>제목</option>
						<option value="detail"
							>
							내용</option>
					</select> 
				
					<div class="search_option">
					<input type="text" id="search_text" name="keyword"  placeholder="검색어 입력">
					<input type="submit" id="search_button" value="검색">
					</div>
				</form>
			</div>
		</div>
    </div>
 
</body>
</html>