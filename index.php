<?php
$trangthai = empty($_GET["trangthai"])?"":$_GET["trangthai"];
$trung = empty($_GET["trung"])?0:$_GET["trung"];
if($trangthai=="loi") 
	{
		echo "<script >
    	alert('File đã nhập không đúng định dạng vui lòng nhập lại!! Vui lòng nhập file excel có đuôi .xlsx')
		</script>";
	}
if($trangthai=="thanhcong") 
	{
		echo "<script >
    	alert('Quá trình nhập đã hoàn  tất!!!!)
		</script>";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Nhập nguyên liệu</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body class="text-center">	
	<br />
	<a href="/phpexcel/file/baoche.xlsx" style="display: table;width: 100%;text-align: right;padding-right: 100px;">Tải file Excel mẫu</a>
	<a href="thembaoche.html"><input class="btn btn-success" type="button" name="themminhchung" value="Thêm nguyên liệu từ tập tin Excel" /></a>
	<br />
	<br />
	<form method="post" action="downloadbaoche.php">
		<input class="btn btn-danger" type="submit" name="downloadminhchung" value="Xuất nguyên liệu thành tập tin Excel" />
	</form>

	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title"></h4>
	      </div>
	      <div class="modal-body">
	      	<div class="text-center">	      		
		        <img src="images/loading.gif" width="80" height="80">
		        <p></p>	
	      	</div>   
	      </div>
	    </div>

	  </div>
	</div>

	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(function() {
	    function reposition() {
	        var modal = $(this),
	            dialog = modal.find('.modal-dialog');
	        modal.css('display', 'block');
	        dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2));
	    }
	    // Reposition when a modal is shown
	    $('.modal').on('show.bs.modal', reposition);
	    // Reposition when the window is resized
	    $(window).on('resize', function() {
	        $('.modal:visible').each(reposition);
	    });

	   

	    //Xuat du lieu
	   //  $('input[name="downloadminhchung"]').click(function(){
	   //  	$('.modal-header .modal-title').html('Xuất minh chứng');
	   //  	$('.modal-body div p').html('Đang xuất minh chứng thành tập tin Excel, vui lòng chờ...');
				// $('#myModal').modal({backdrop: "static"});
				// $.ajax({
				//   url: "downloadmc.php",
				//    type: 'POST',
				// }).done(function(data) {
				//   $('#myModal').modal('hide');				  
				// });
	   //  });
		});
	</script>
</body>
</html>