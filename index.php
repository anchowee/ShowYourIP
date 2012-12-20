<?php 
include_once 'lib.php';
$clientIP = $_SERVER['REMOTE_ADDR'];
$yourArea = iconv('GB2312','UTF-8',convertip_full($clientIP,'./qqwry.dat'));

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	$queryIP = trim($_GET['queryip']);
	if( $queryIP  && ip2long($queryIP)){	
		echo iconv('GB2312','UTF-8',convertip_full($queryIP,'./qqwry.dat'));
	}else{
		echo "请输入正确IP";
	}
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Your IP Address &middot; 你的IP &middot; BBkanba.com &middot; 比比看吧</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!-- Le styles -->
<link href="./assets/css/bootstrap.css" rel="stylesheet">
<style type="text/css">
body {
	padding-top: 40px;
	padding-bottom: 40px;
	background-color: #f5f5f5;
}
.form-ip {
	color:#666;
	max-width: 450px;
	padding: 19px 29px 10px;
	margin: 0 auto 20px;
	background-color: #fff;
	border: 1px solid #e5e5e5;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
	-moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
	box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
}
.form-ip .form-ip-heading,.form-ip .checkbox {
	margin-bottom: 10px;
}
.form-ip input[type="text"] {
	font-size: 16px;
	height: auto;
	margin-bottom: 15px;
	padding: 7px 9px;
}
.area{
	color:#fff !important;
	line-height: 31px;
	height: 35px;
	min-height: 35px;	
}
.query{
	margin-top: 60px;
}
.source{
	text-align: right;
	font-size: 10px;
	padding-top: 15px;
}
.loading{
	width: 43px;
}
.coryright{
	margin-top: 30px;
}
</style>
<link href="./assets/css/bootstrap-responsive.css" rel="stylesheet">
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="./assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="./assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="./assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="./assets/ico/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="./assets/ico/favicon.png">
</head>
<body>
	<div class="container">
		<form class="form-ip">
			<h2 class="form-ip-heading">您的IP/Your IP Address is:</h2>		
			<div class="row-fluid">
			<div class="span4">
			<span class="label label-info area span12"><?php echo $clientIP;?></span>
			</div>
			<div class="span8">
			<span class="label area span12"><?php echo $yourArea;?></span>
			</div>
			</div>
			
			<h2 class="form-ip-heading query">IP查询/IP Address Lookup:</h2>
			<div class="row-fluid">
			<div class="span4">
			<input id="queryIP" type="text" class="input-block-level span12" placeholder="请输入查询IP" value=""> 
			</div>
			<div class="span8">
				<span id="queryResult" class="label area span12"><?php echo $queryArea;?></span>
			</div>
			</div>
			<div class="row-fluid">				
				<button id="querybt" class="btn btn-large offset1 span10" type="submit" data-loading-text="Loading...">Submit</button>
			</div>
			<div class="row-fluid coryright">
				<div class="span5 offset6 source">BBkanba数据来源:纯真IP库</div>
				<img class="span1 loading" alt="loading" src="./assets/img/loading.gif">
			</div>
		</form>
	</div>
	<!-- /container -->
	<!-- Le javascript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="./assets/js/jquery.js"></script>
	<script src="./assets/js/bootstrap-button.js"></script>
	<script type="text/javascript">
	$(function(){
	    $('#querybt')
	      .click(function () {
	    	  $('#queryResult').html('');
	        var btn = $(this);
	        btn.button('loading');
	        var ip = $("#queryIP").val();
	        $.get('index.php',{'queryip':ip},function(data){
		         $('#queryResult').html(data);
	        	 btn.button('reset');
		        });	
		return false;
	      });
		});
	</script>
</body>
</html>
