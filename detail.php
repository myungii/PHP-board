<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<!-- bootstrap 게시판용 -->
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<title>detail.jsp</title>
<style type="text/css">

</style>

<script type="text/javascript">
	
</script>
</head>
<body>

	<div class="container">
		<h2>자유게시물</h2>
		<p>나만의 자유로운 게시물을 작성해보세요!</p>
		<table class="table">
			<colgroup>
				<col width="15%" />
				<col width="35%" />
				<col width="15%" />
				<col width="35%" />
			</colgroup>

			<tbody>
				<tr>

					<th scope="row">조회수</th>
					<td>${dto.hit }</td>
					<th scope="row">추천수</th>
					<td>${dto.recommend }</td>
				</tr>
				<tr>
					<th scope="row">작성아이디</th>
					<td>${dto.userid}</td>
					<th scope="row">작성날짜</th>
					<td>${dto.wdate}</td>
				</tr>
				<tr>
					<th scope="row">제목</th>
					<td colspan="3">${dto.title}</td>
				</tr>
				<tr>
					<td colspan="4">${dto.detail}</td>
				</tr>
			</tbody>
		</table>

		<p class="text-right">
			<button type="button" class="btn btn-outline-primary"
				onclick="location.href='/board/list'">목록으로</button>
			<button type="button" class="btn btn-outline-dark"
				onclick="location.href='/board/delete?seq=${dto.seq}'">삭제하기</button>
			<button type="button" class="btn btn-outline-dark"
				onclick="location.href='/board/preedit?seq=${dto.seq}'">수정하기</button>
		</p><br>
		
		 <c:import url="/reply/list"/>
		
	</div>

</body>
</html>






