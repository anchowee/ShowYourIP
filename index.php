<?php
include_once 'lib.php';
$clientIP = $_SERVER['REMOTE_ADDR'];
$yourArea = iconv('GB2312','UTF-8',convertip_full($clientIP,'./IPdata/qqwry.dat'));
$yourSina = getSinaData($clientIP);
$yourTaobao = getTaobaoData($clientIP);
$yourBaidu = getBaiduData($clientIP);
$queryIP='';
$data=array();


if(isset($_GET['q'])){
	$queryIP = trim( $_GET['q'] );
}elseif (isset($_GET['queryip'])) {
	$queryIP = trim( $_GET['queryip']);
}

if( $queryIP  && ip2long($queryIP)){
	$data['chunzhen'] = iconv('GB2312','UTF-8',convertip_full($queryIP,'./IPdata/qqwry.dat'));
	$data['sina'] = getSinaData($queryIP);
	$data['taobao'] = getTaobaoData($queryIP);
	$data['baidu'] = getBaiduData($queryIP);
}else{
	$str = '请输入正确IP';
	$data['chunzhen'] = $data['sina'] = $data['taobao'] = $str;
}

if( (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
	echo decodeUnicode(json_encode($data));
	exit;
}


if( substr_count($_SERVER['REQUEST_URI'], '??')){
	echo "yourIP:   $clientIP <br/> qqip: $yourArea <br/> sina: $yourSina <br/> tbip:	 $yourTaobao";
	exit;
}

?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<title>Your IP Address &middot; 你的IP &middot; BBkanba.com &middot; 比比看吧</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="show your ip address">
<meta name="author" content="leolovenet">
<!-- Le styles -->
<link rel="search" type="application/opensearchdescription+xml" title="Your IP" href="./assets/plugins/search-provider.xml"/>
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
<link rel="shortcut icon" href="./assets/ico/favicon.ico" type="image/x-icon">
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
			<div class="row-fluid">
				<div class="input-prepend input-append">
					<span class="add-on"><i class="icon-baidu"></i></span>
					<input id="YbaiduD" class="span10" type="text" value="<?php echo $yourBaidu;?>">
					<span class="add-on">百度数据</span>
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
				<div class="row-fluid">
					<div class="input-prepend input-append">
						<span class="add-on"><i class="icon-baidu"></i></span>
						<input id="QbaiduD" class="span10" type="text" value="">
						<span class="add-on">百度数据</span>
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
				 $("#QbaiduD").val(D.baidu);
	        	 btn.button('reset');
		      });

	    	querydata = $("#querydata");
			if(querydata.hasClass('hide')){
				querydata.removeClass('hide');
				querydata.fadeIn('slow');
			}
			return false;
	      });
	    $("#queryIP").focus();
	    <?php
	    	if($queryIP){
	    	echo '$("#queryIP").val("'.$queryIP.'");$("#querybt").click()';
	    	}
	    ?>
		});
	</script>
</body>
</html>
