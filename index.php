<?php 
include_once 'lib.php';
$clientIP = $_SERVER['REMOTE_ADDR'];
$yourArea = iconv('GB2312','UTF-8',convertip_full($clientIP,'./qqwry.dat'));
$yourSina = getSinaData($clientIP);
$yourTaobao = getTaobaoData($clientIP);

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	$queryIP = trim($_GET['queryip']);
	$data=array();
	if( $queryIP  && ip2long($queryIP)){
		$data['chunzhen'] = iconv('GB2312','UTF-8',convertip_full($queryIP,'./qqwry.dat'));
		$data['sina'] = getSinaData($queryIP);
		$data['taobao'] = getTaobaoData($queryIP);
		echo json_encode($data);
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
<link href="./assets/font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="./assets/fontdiao/css/fontdiao.css" rel="stylesheet">
<style type="text/css">
body {
	padding-top: 40px;
	padding-bottom: 40px;
	background-color: #f5f5f5;
}

.form-ip {
	color: #666;
	max-width: 600px;
	padding: 20px 30px 10px;
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

.form-ip input[type="text"] {
	font-size: 16px;
	height: auto;
	margin-bottom: 5px;
}

.area {
	color: #fff !important;
	line-height: 31px;
	height: 35px;
	min-height: 35px;
}

.query {
	margin-top: 30px;
}

.source {
	text-align: right;
	font-size: 10px;
	padding-top: 15px;
}

.loading {
	width: 43px;
}

.coryright {
	margin-top: 30px;
}
.hide{
	display: none;
}
</style>
<link href="./assets/css/bootstrap-responsive.css" rel="stylesheet">
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144"
	href="./assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114"
	href="./assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72"
	href="./assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed"
	href="./assets/ico/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="./assets/ico/favicon.png">
</head>
<body>
	<div class="container">
		<form class="form-ip">
			<h2 class="form-ip-heading">您的IP/Your IP Address is:</h2>

			<div class="row-fluid">
				<div class="input-prepend input-append">				
					<span class="add-on">IP </span> 
					<input class="span10" type="text" value="<?php echo $clientIP;?>">
					<span class="add-on">你当前IP</span>
				</div>
			</div>
			<div class="row-fluid">
				<div class="input-prepend input-append">
					<span class="add-on"><i class="icon-leaf"></i></span>				
					<input class="span10" type="text" value="<?php echo $yourArea;?>"> 
					<span class="add-on">纯真数据</span>
				</div>
			</div>
			<div class="row-fluid">
				<div class="input-prepend input-append">				
					<span class="add-on"><i class="icon-weibo"></i></span>
					<input id="YsinaD" class="span10" type="text" value="<?php echo $yourSina;?>"> 
					<span class="add-on">新浪数据</span>
				</div>
			</div>
			<div class="row-fluid">
				<div class="input-prepend input-append">
				<span class="add-on"><i class="icon-taobao"></i></span>
					<input id="YtaobaoD" class="span10" type="text" value="<?php echo $yourTaobao;?>"> 
					<span class="add-on">淘宝数据</span>
				</div>
			</div>


			<h2 class="form-ip-heading query">IP查询/IP Address Lookup:</h2>
			<div class="row-fluid">
				<div class="input-prepend input-append">
					<span class="add-on"><i class="icon-globe"></i> </span> <input
						id="queryIP" type="text" class="input-block-level span10"
						placeholder="请输入查询IP" value="">
					<button id="querybt" type="submit" class="btn btn-info"
						data-loading-text="Loading">Submit</button>
				</div>
			</div>
			<div id="querydata" class="hide">
				<div class="row-fluid">
					<div class="input-prepend input-append">
						<span class="add-on"><i class="icon-leaf"></i></span>	
						<input id="queryResult" class="span10" type="text" value=""> 
						<span class="add-on">纯真数据</span>
					</div>
				</div>
				<div class="row-fluid">
					<div class="input-prepend input-append">
						<span class="add-on"><i class="icon-weibo"></i></span>
						<input id="QsinaD" class="span10" type="text" value=""> 
						<span class="add-on">新浪数据</span>
					</div>
				</div>
				<div class="row-fluid">
					<div class="input-prepend input-append">
						<span class="add-on"><i class="icon-taobao"></i></span>
						<input id="QtaobaoD" class="span10" type="text" value=""> 
						<span class="add-on">淘宝数据</span>
					</div>
				</div>
			</div>

			<div class="row-fluid coryright">
				<div class="span5 offset6 source">leolovenet.com</div>
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
	    $('#querybt').click(function () {
	    	$('#queryResult').val('');	    	
	        var btn = $(this);	        
	        var ip = $("#queryIP").val();
	        if(!ip){alert("请输入ip");return false;}	        
	        btn.button('loading');
	        $.getJSON('index.php',{'queryip':ip},function(D){
		         $('#queryResult').val(D.chunzhen);
		         $("#QsinaD").val(D.sina);
		         $("#QtaobaoD").val(D.taobao);
	        	 btn.button('reset');
		      });
		      		      
	    	querydata = $("#querydata");
			if(querydata.hasClass('hide')){
				querydata.removeClass('hide');
				querydata.fadeIn('slow');
			}
			return false;
	      });	      	      
		});
	</script>
</body>
</html>
