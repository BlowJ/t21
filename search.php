<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tìm kiếm</title>
	<link href="external stylesheet/bootstrap.min.css" rel="stylesheet">
	<link href="external stylesheet/style.css" rel="stylesheet">
</head>
<body> 
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.12&appId=532331000501204&autoLogAppEvents=1';
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2">
			</div>
			<div class="col-md-8" style="background-color: #ffffff">
				<!--Đây là thanh điều hướng-->
				<nav class="navbar navbar-toggleable-md navbar-light bg-faded fixed-top">
					<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					</button> <a class="navbar-brand" href="Trang-Chu.html" title="Trang Chủ"> <img src="images/logo.jpg" class="rounded-circle"></a>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="navbar-nav">
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown">Thể loại</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
									<a class="dropdown-item" href="The-loai/Phim-le.html">Phim Lẻ</a>
									<a class="dropdown-item" href="The-loai/Phim-bo.html">Phim Bộ</a>
								</div>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown">Quốc Gia</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
									<a class="dropdown-item" href="Quoc-gia/Au-My.html">Âu-Mỹ</a>
									<a class="dropdown-item" href="Quoc-gia/Chau-A.html">Châu Á</a>
								</div>
							</li>
							<li class="nav-item" style="margin-right:5px">
								<a class="nav-link" href="Tin-Tuc/Tin-Tuc.html">Tin Tức</a>
							</li>
						</ul>
						<form class="form-inline">
							<input class="form-control mr-sm-2" type="text" placeholder="Tìm Kiếm" title="Bạn Đang Muốn Tìm Gì ?">
							<button class="btn btn-primary my-2 my-sm-0" type="submit" title="Nhẫn Vào Đây Để Tìm Kiếm">
								Tìm kiếm
							</button>
						</form>
					</div>
					<!-- Đây là nút login bằng facebook -->
					<fb:login-button scope="public_profile,email" onlogin="checkLoginState();" class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="true" data-use-continue-as="true">
				</fb:login-button>
				<div id="status" style="margin-left: 5px">
				</div>
			</nav>
		</br>
	</br>
</br>
</br>
<?php
        // Nếu người dùng submit form thì thực hiện
if (isset($_REQUEST['ok'])) 
{

            // Gán hàm addslashes để chống sql injection
	$search = addslashes($_GET['search']);

            // Nếu $search rỗng thì báo lỗi, tức là người dùng chưa nhập liệu mà đã nhấn submit.
	if (empty($search)) {
		echo "Yeu cau nhap du lieu vao o trong";
	} 
	else
	{	
		$servername = "PC\SQLEXPRESS";
		$connectioninfo = array("Database"=>"the21st", "UID"=>"sa", "PWD"=>"123","CharacterSet"=>"UTF-8");
                // Kết nối sql
        $con = sqlsrv_connect($servername, $connectioninfo);//chọn database đã tạo 
        if (!$con) {
        	trigger_error('Không thể kết nối đến SQL: ' . sqlsrv_errors());
        }
                // Dùng câu lênh like trong sql và sứ dụng toán tử % của php để tìm kiếm dữ liệu chính xác hơn.
        $query = "SELECT * FROM news_search WHERE title LIKE '%$search%'";

                // Thực thi câu truy vấn
        $sql = sqlsrv_query($con,$query);
        
                // Đếm số dòng trả về trong sql.
        //$num = mysqli_num_rows($sql);

                // Nếu có kết quả thì hiển thị, ngược lại thì thông báo không tìm thấy kết quả
        
        if($sql){

        // Kiểm tra có dòng record nào hay không?
        	echo 'Kết quả tìm kiếm cho "'.$_GET['search'].'": ';
        	if(sqlsrv_rows_affected($sql)!=0){  
            // Hiển thị dữ liệu

        		while($row = sqlsrv_fetch_array($sql)){

        			echo '<p class="title"> <a href="'.$row['link'].'" target="_blank"><b>'.$row['title'].'</b></a><br>'.$row['description'] .'</p>'   ;

        		}

        	}
        }
        else {

        	echo 'Không có kết quả nào cho từ khóa :"'.$_GET['search'].'"';

        }
    }    
}
?>  
</br>
<p><b>Vui lòng về trang chủ nếu có ý định tìm kiếm tiếp, xin cảm ơn!</b></p>
</br>
</br>
<p>Có thể bạn quan tâm: </p>
<a href="The-loai/Phim-Le/Review-Guardian-Of-Galaxy-2.html"><b>[Review] Vệ Binh Dải Ngân Hà 2: Fan truyện tranh sẽ thích mê, còn khán giả thường?</b></a>
<p>Lấy mốc thời gian chỉ vài tháng sau phần đầu tiên, đội Vệ binh Ngân hà, gồm Peter Quill (Chris Pratt), Gamora (Zoe Saldana), Rocket Raccoon (Bradley Cooper), Drax the Destroyer (Dave Bautista) và Groot (Vin Diesel), giờ đã trở thành anh hùng sau khi đánh bại Ronan.</p>
</br>
<a href="The-loai/Phim-Le/Review-La-La-Land.html"><b>[Review] La La Land: Gần Như Hoàn Hảo</b></a>
<p>Sau thất bại đáng tiếc của Whiplash năm 2014, Damien Chazelle đã trở lại và phục thù bằng La La Land. Cũng lấy đề tài âm nhạc, bộ phim âm nhạc này càn quét nhiều giải thưởng Liên hoan phim, nhận được 7 đề cử Quả Cầu Vàng và đang là ứng cử viên sáng giá cho hàng loạt tượng vàng Oscar.</p>
</br>
<a href=""><b>Review phim "Insidious: The Last Key" (Quỷ Quyệt 4)</b></a>
<p>Insidious: The Last Key là mảnh ghép cuối cùng trong series phim kinh dị Insidious từng được người xem đón nhận rất tốt. Phim ra rạp với tựa Quỷ quyệt 4: Chìa khóa...</p>
<a href=""><b>Review phim "Shape of Water"(Người Đẹp Và Thủy Quái)</b></a>
<p>Có thể nói ngay rằng Shape of Water (Người đẹp và Thủy quái) là một tác phẩm điện ảnh đáng xem nhất từ đầu năm tới nay, phim tựa như một...</p>
</div>
<div class="col-md-2">
</div>

</br>
</br>
</br>
</br>


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" src="js/watermark.jquery.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
</body>
</html>