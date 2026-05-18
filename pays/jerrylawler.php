<?php include ("../serive/samparka.php");?>
<?php 
if(isset($_GET['amount'])){
	$ramt = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['amount']));
} else{
	$ramt = 0;
}
$dot_pos = strpos($ramt, '.');
if ($dot_pos === false) {
    $ramt = $ramt . '.00';
}else {
    $after_dot = substr($ramt, $dot_pos + 1);
    $after_dot_length = strlen($after_dot);
    if ($after_dot_length > 2) {
        $after_dot = substr($after_dot, 0, 2);
        $ramt = substr($ramt, 0, $dot_pos + 1) . $after_dot;
    } elseif ($after_dot_length < 2) {
        $zeros_to_add = 2 - $after_dot_length;
        $ramt = $ramt . str_repeat('0', $zeros_to_add);
    }
}
$date = date("Ymd");
$time = time();
$serial = 'P' . $date . $time . rand(1000,9999);

$tyid = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['tyid']));
$uid = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['uid']));
$sign = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['sign']));
$urlInfo = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['urlInfo']));
?>
<?php 
	$s_upi = "SELECT maulya FROM deyya WHERE sthiti='1'";
	$r_upi = mysqli_query($conn, $s_upi);
	$f_upi = mysqli_fetch_array($r_upi);
	$upi_id = $f_upi['maulya'];
	
	$selectupi_two=mysqli_query($conn,"select * from `images` where `status`=1");
	$selectupiresult_two=mysqli_fetch_array($selectupi_two);
?>
<?php
	$res = [
		'code' => 405,
		'message' => 'Illegal access!',
	];
	if (isset($_GET['tyid']) && isset($_GET['amount']) && isset($_GET['uid']) && isset($_GET['sign']) && isset($_GET['urlInfo'])) {
		$userId = $uid;
		$userPhoto = '1';
		
		$numquery = "SELECT mobile, codechorkamukala
		  FROM shonu_subjects
		  WHERE id = ".$userId;
		$numresult = $conn->query($numquery);
		$numarr = mysqli_fetch_array($numresult);
		
		$userName = '91'.$numarr['mobile'];
		$nickName = $numarr['codechorkamukala'];
		
		$creaquery = "SELECT createdate
		  FROM shonu_subjects
		  WHERE id = ".$userId;
		$crearesult = $conn->query($creaquery);
		$creaarr = mysqli_fetch_array($crearesult);
		
		$knbdstr = '{"userId":'.$userId.',"userPhoto":"'.$userPhoto.'","userName":'.$userName.',"nickName":"'.$nickName.'","createdate":"'.$creaarr['createdate'].'"}';
		$shonusign = strtoupper(hash('sha256', $knbdstr));
		
		$urlarr = explode (",", $urlInfo);
		$theirurl = $urlarr[0];
		$myurl = 'https://selimxpro.com';
		
		if($shonusign == $sign && $theirurl == $myurl){
?>
			<html class="pixel-ratio-2 retina ios ios-13 ios-13-2-3 ios-gt-12 ios-gt-11 ios-gt-10 ios-gt-9 ios-gt-8 ios-gt-7 ios-gt-6">
				<head>
					<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
					<title>
						UPIPAY Checkout
					</title>
					<meta content="width=device-width,initial-scale=1,user-scalable=0" name="viewport">
					<link rel="icon" href="/favicon.ico">
					<link href="assets/css/wepay/weui2.min.css" rel="stylesheet">
					<link href="assets/css/wepay/weuix.min.css" rel="stylesheet">
					<script src="assets/js/wepay/jquery-2.2.4.min.js"></script>
					<style type="text/css" id="operaUserStyle"></style>
					<script src="assets/js/wepay/clipboard.min.js"></script>
					<script src="assets/js/wepay/layer.js"></script>
					<link rel="stylesheet" href="assets/css/wepay/layer.css" id="layuicss-layer">
					<style type="text/css">
						body{
							font-family:Arial
						}
						.weui-tabbar__item{
							padding:5px 0 8px 0
						}
						.weui-tabbar__label{
							font-size:12px;
							margin-top:-5px
						}
					</style>
					<style type="text/css">
						.diylabel{
							font-size:12px;
							color:#999
						}
						.money_syb{
							font-size:16px;
							position:relative;
							top:0;
							left:0
						}
						.money_val{
							font-size:16px
						}
						table.minfo td{
							padding:0;
							margin:0;
							border:none;
							padding-right:10px;
							line-height:30px;
							font-family:Arial
						}
						.membermenu .weui-cell__ft{
							font-size:12px
						}
						.menuname{
							font-size:15px!important
						}
						.membermenu .menuicon{
							width:24px;
							height:24px;
							margin-right:10px;
							display:block
						}
						.weui-pay-inner{
							border-radius:8px
						}
						.weui-pay-inner:after{
							border:0
						}
						.moneytable{
							background:0 0
						}
						.moneytable td{
							padding:0;
							margin:0;
							text-align:left;
							border:0;
							color: #16bffa
						}  
						.weui-payselect-li{
							width:50%
						}  
						.weui-payselect-a{
							background-color:#f6fdff;
							color:#888
						}  
						.weui-payselect-on{
							background-color:#fff
						}  
						.weui-pay-line{
							line-height:25px
						}  
						.weui-pay-name{
							padding-bottom:10px
						}  
						.weui-pay-label{
							width:60px
						}  
						.weui-pay-m::before{
							border:0
						}  
						#refnoeg{
							padding-bottom:20px
						}  
						#refnoeg>div{
							width:90%;
							margin-top:5px;
							text-align:center;
							margin:0 auto
						}
						#refnoeg img{
							width:100%
						}
						#refout:after{
							border-bottom:1px solid #16bffa
						 }
					</style>
					<style type="text/css">
						#wraper_all{
							margin: 0 auto;
							position: relative;
							max-width: 750px;
						}
						.tab-bottom{
							max-width: 750px;
						}
						.main_title_wraper{
							height: 50px;
							line-height: 30px;
							background-image: radial-gradient(circle at center top, #00ff59, #01c158);
							color: white;
							font-size: 30px;
							
							/*box-shadow: yellow 0px 0px 10px 5px inset;*/
						}
						.main_title{
							padding: 10px;
							padding-left: 20px;
						}
						.mimo_title{
							font-size: 14px;
							padding-left: 14px;
						}
						.ensure_btn{
							color: white;
							width: 100%;
							
						}
						.liner-border{
							height: 10px;
						}
						.order-info{
							font-size: 12px;
							color: rgba(0,0,0,.7)
						}
						.lable-left{
							display: inline-block;
							width: 80px;
							color: rgba(0,0,0,.4);
						}
						.moeny_part_main{
							display:flex;
							align-items:center;
							padding-top: 10px;
							line-height: 20px;
						}
						.tranfer_amount{
							font-size:20px;
							font-weight: 700;
							padding-left:20px;
						}
						.moeny_part{
							width: 100%;
							text-align: start;
							font-size: 30px;
							font-weight: 700;
						}
						.order_mino{
							width: 100%;
							text-align: center;
							padding-bottom: 20px;
						}
						.logo{
							width: 60px;
							height: 60px;
							position: absolute;
							top: 0px;
							left: 20px;
						}
						.logo img{
							width: 100%;
						}
						.close {
							font-size: 28px;
							line-height: 28px;
							padding: 6px 12px 12px;
						}

						.video-shadow{
							width:100%;
							height:100%;
							position:absolute;
							left:0;
							top:0;
							z-index:998;
							background-color:#000;
							opacity:0.6;
							display:none;
						}
						.video-box-iconleft{
							width:20px;
							height:20px;
							vertical-align: middle;
						}
						.instruction-container {
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 20px auto;
            max-width: 600px;
            font-family: Arial, sans-serif;
        }

        .instruction-title {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .instruction-list {
            list-style-type: decimal;
            padding-left: 20px;
        }

        .instruction-item {
            margin-bottom: 10px;
        }

        .highlight {
            font-weight: bold;
            color: red;
        }
         .qr-code-container {
            display: inline-block;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .qr-code-container img {
            display: block;
            width: 100px;
            height: auto;
            
        }     
            
            
          
/* Style for the input box similar to the image */
.weui-pay-input {
    border: 2px solid #ff00ff; /* Border color similar to the image */
    background-color: #fff; /* White background */
    border-radius: 8px; /* Slightly rounded corners */
    padding: 10px; /* Internal padding */
    box-shadow: 0 0 10px rgba(255, 0, 255, 0.5); /* Pink glow shadow */
    animation: vibrate 0.5s infinite; /* Apply the vibration animation to the box */
    position: relative;
}

.utr-label {
    position: absolute;
    left: 10px; /* Adjust this value to control the distance from the left */
    top: 50%;
    transform: translateY(-50%);
    font-size: 18px;
    color: #000; /* Adjust color to match your design */
    pointer-events: none; /* Prevent the label from interfering with input actions */
}

/* Style for the input field */
.weui-pay-inputs {
    border: none; /* Remove default border */
    outline: none; /* Remove outline */
    text-align: center; /* Center text */
    font-size: 18px; /* Font size */
    color: #0000FF; /* Text color */
    background-color: transparent; /* Transparent background */
    margin-left:70px;
}

@keyframes vibrate {
    0%, 100% { transform: translate(0, 0); } /* Initial position */
    25% { transform: translate(-3px, -5px); } /* Move left and up more */
    50% { transform: translate(3px, 5px); } /* Move right and down more */
    75% { transform: translate(-3px, 5px); } /* Move left and down */
}

.vibrating {
    animation: vibrate 0.3s infinite; /* Vibrate effect with slight lift */
}

            
 #qrCodeImage
             {border-style: outset;}
             
           
        
					</style>
				</head>
				<body data-gr-ext-installed="" data-new-gr-c-s-check-loaded="14.1012.0" ontouchstart="">
				<div id="wraper_all">
						<div class="weui-flex main_title_wraper">
							<div class="main_title">
								<span>UPIPAY</span>
							
							</div>
						</div>
						
						<div class="liner-border"></div>
						<div id="copyAmount">
							<div class="moeny_part_main">
								<div class='tranfer_amount'>
									TRANSFER AMOUNT
								</div>
								<div class="moeny_part">

									<span>₹</span> 
									<span class="moeny"><?php echo $ramt; ?></span> 
								</div>
							</div>
						</div>
						<div class="weui-panel weui-panel_access">
							<div class="weui-panel__hd" style="color:#e71111">
								Step 1: Transfer&nbsp;&nbsp;
								<span style="color:#d375de;font-weight:bold">  <span class="moeny"><?php echo $ramt; ?></span> &nbsp;&nbsp;to the following upi </span>
					<br>
					<span> Please scan QR Code with you favorite UPI appand copy UTR code</span>
							</div>
							<div class="weui-panel__bd">
    <div class="weui-media-box weui-media-box_text" style="padding-top:10px">
        <div id="qrcodeImg" style="text-align: center;">
            <img style="height:200px; width:200px;" src="<?php echo '../images/'.$selectupiresult_two['filename']; ?>" id="qrCodeImage">
        </div>
        
        <!-- Download Button -->
        <div style="text-align:center; margin-top:10px;">
            <a href="<?php echo '../images/'.$selectupiresult_two['filename']; ?>" download="QRCodeImage" class="weui-btn weui-btn_primary" style="background-color: #487ef5; color: white; border: 1px solid #487ef5;">Download QR CODE</a>
        </div>

        <div style="display:flex;justify-content:space-between;align-items:center;border:1px solid #BDBDBD!important;padding:4px;border-radius:6px; margin-top:10px;">
            <span class="weui-media-box__title" id="upi" style="color:#333;font-weight:500;margin:0px !important;text-shadow:1px 1px 0 #fff;background-color: #e0e73a4f;text-align:center;padding:10px 0;letter-spacing:1px;"><?php echo $upi_id;?></span>
            <div style="text-align:center;padding-top:5px">
                <a class="weui-btn weui-btn_mini b-green" href="javascript:" id="btncopy" style="color:#487ef5;border:1px solid #487ef5!important"> Copy UPI </a>
            </div>
        </div>
        
            </div>
</div>

						</div>
					
					<div class="weui-pay" style="padding:0 !important;padding-top:0 !important">
    <div class="weui-pay-inner" style="border-radius:0; padding:0 !important;">
        <div class="weui-pay-input" id="refout" style="position: relative; padding:0 !important;">
            <input class="weui-pay-inputs" id="refno" placeholder="12-digit here" minlength="12" maxlength="12" 
                   style="padding-left:40px; text-align:left; font-size:18px;" type="text">
            <span class="utr-label">UTR:</span>
        </div>
        <div class="weui-pay-intro">
            Generally, your transfer will be confirmed within 10 minutes
        </div>
    </div>
</div>


<script>
// Add the 'vibrating' class to make the box vibrate
document.getElementById('refno').classList.add('vibrating');
</script>

							<div class="weui-panel weui-panel_access">
							<div class="weui-panel__hd" style="color:#e71111">
								Step 2: Submit Ref No/Reference No/UTR
							</div>
						</div>
						<div class="weui-panel weui-panel_access" style="background-color:#f1f1f1;margin-top:0">
							
							<div class="instruction-container">
        <p class="instruction-title">Payment Instructions:</p>
        <ol class="instruction-list">
            <li class="instruction-item">Please save the QR code or copy the UPI ID for payment purposes. The account is only valid for a single deposit; please do not make any subsequent deposits to avoid potential loss of funds.</li>
            <li class="instruction-item">Please ensure that the deposited amount matches the originally applied amount, as any discrepancy may result in a failed transaction or loss of funds.</li>
            <li class="instruction-item">You may pay through any app for the given UPI ID.</li>
            <li class="instruction-item">Complete the transaction in <span class="highlight">5 minutes</span> or the money may be <span class="highlight">LOST</span>.</li>
            <li class="instruction-item">If, within 24 hours, 5 deposit attempts fail to complete a successful payment, your ID will be temporarily suspended for a 24-hour period.</li>
            <li class="instruction-item">Kindly note that we cannot be held responsible for any losses incurred if you did not adhere to the aforementioned guidelines.</li>
        </ol>
    </div>
						</div>
						<div style="clear:both;height:75px">
							&nbsp;
						</div>
						<div class="weui-tabbar tab-bottom" style="padding:15px 0 20px 0">
							<a class="weui-btn weui-btn_primary ensure_btn" href="javascript:" id="savebtn"> Submit Ref Number </a>
						</div>
						<div class="loading2 hide" data-text="confirming, please wait"></div>
					</div>
					<script type="text/javascript">
					  
					  var ifscCopyBoard = new ClipboardJS("#ifscCopy", {
						  text: function() {
							  var e = $("#ifsc").html();
							  return e
						  }
					  });
					  ifscCopyBoard.on("success", function() {
						  layer.msg("ifsc copied successfully")
					  });
					  ifscCopyBoard.on("error", function() {
						  layer.msg("ifsc failed, Please input manually")
					  });


					  var accNameCopy = new ClipboardJS("#accNameCopy", {
						  text: function() {
							  var e = $("#accName").html();
							  return e
						  }
					  });
					  accNameCopy.on("success", function() {
						  layer.msg("acc name copied successfully")
					  });
					  accNameCopy.on("error", function() {
						  layer.msg("acc name failed, Please input manually")
					  });

					function process() {
						$.post(base_url + "/cashier/v1/IN_UPI/" + order_no,
							function(e) {
								if (e.code == -1){
									window.location.href = base_url + "/cashier/v1/IN_UPI/fail/" + order_no;
									return;
								}
								if (e.data.success != null && e.data.success){
									window.location.href = success_url+order_no;
									return;
								}
								if (100 === e.code) {
									if (100 === parseInt(status)) return;
									status = parseInt(e.code),
										pa = e.data.upi.pa,
										cu = e.data.upi.cu,
										mc = e.data.upi.mc,
										tn = e.data.upi.tn,
										tr = e.data.upi.tr,
										am = e.data.upi.am,
										pn = e.data.upi.am,
										tno = e.data.order_no,
										$(".moeny").html(am),
										$(".order_no").html(tno),
										$("#upi").html(pa)
								} else - 1 === e.code ? alert(e.msg) : 200 === e.code ? alert(e.msg) : 40006 === e.code && alert(e.msg)
							})
					}
					function getQueryString(e) {
						var url = window.location.href;
						var index = url.lastIndexOf("/");
						return url.substring(index + 1, url.length);
					}
					var pa = "",
						cu = "",
						mc = "",
						tn = "",
						tr = "",
						am = "",
						pn = "",
						order_no = null,
						tno = null,
						status = -1,
						base_url = '';
						success_url = "success/",
					order_no = getQueryString("no"),
						null === order_no || "" === order_no ? alert("Please replace your order.") : process(),
						layer.alert("<span style='word-break:break-word;'>After the payment is successful, you must coming back here to submit the Ref/UTR No.(12 digits) Only then your money be reached to the account.</span>", {
							title: "Cashier",
							icon: 0,
							btn: ["OK"]
						});
					</script>
					<div class="layui-layer-shade" id="layui-layer-shade1" times="1" style="z-index: 19891014; background-color: rgb(0, 0, 0); opacity: 0.3;">
					</div>
					<div class="layui-layer layui-layer-dialog" id="layui-layer1" type="dialog" times="1" showtime="0" contype="string" style="z-index: 19891015; width: 360px; top: 282px; left: 334px; display:none;">
						<div class="layui-layer-title" style="cursor: move;">Cashier</div>
						<div id="" class="layui-layer-content layui-layer-padding">
							<i class="layui-layer-ico layui-layer-ico0"></i>
							<span style="word-break:break-word;">After the payment is successful, you must coming back here to submit the Ref/UTR No.(12 digits) 
							Only then your money be reached to the account.</span>
						</div>
						<span class="layui-layer-setwin">
							<a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a>
						</span>
						<div class="layui-layer-btn layui-layer-btn-">
							<a class="layui-layer-btn0">OK</a>
						</div>
						<span class="layui-layer-resize"></span>
					</div>
					<div class="layui-layer-move"></div>
					<script>
						var ramt = <?php echo $ramt; ?>;
						var serial = '<?php echo $serial; ?>';
						var upi = document.getElementById("upi").innerHTML;
						
						var userId = <?php echo $userId; ?>;
						var token = '<?php echo $shonusign; ?>';
					
						var copyAmount = new ClipboardJS("#copyAmount", {
						  text: function() {
							  var e = am;
							  return e
						  }
						});
						copyAmount.on("success",
						function() {
						  layer.msg("amount copied successfully")
						});

						var clipboard = new ClipboardJS("#btncopy", {
							text: function() {
								var e = $("#upi").html();
								return e
							}
						});
						clipboard.on("success",
							function() {
								layer.msg("UPI copied successfully")
							}),
							clipboard.on("error",
								function() {
									layer.msg("UPI copied failed, Please input manually")
								}),
							$(function() {
								$('#refno').bind('input propertychange', function() {
								   var v =  $("#refno").val();
								   if (v.length >= 12){
									   $("#savebtn").click();
								   }
								});

								$("#savebtn").on("click",
									function() {
										var e = $("#refno").val();
										var refNo = e;
										return 12 != e.length ? (layer.msg("Invalid Ref Number"), !1) : void layer.confirm("<span style='word-break:break-word'><span style='color:#f80'>For your money security, please confirm the following information carefully</span><br><br>UPI : <code style='color:#487ef5'>" + upi + "</code><br>Transfer amount : <code style='color:#487ef5'>" + ramt + "</code><br>Ref No : <code style='color:#487ef5'>" + refNo + "</code></span>", {
												title: "Security",
												btn: ["Confirm", "Cancel"]
											},
											function() {
												layer.closeAll();									
												adddep(ramt,refNo,serial,upi,userId,token);
											},
											function() {})
									})

								 $("#open-video").click(function (){

									//

									layer.load();
									 $(".video-shadow").css({'display':'block'});
									 $('.addBox').show();
									$("#videoFrame").fadeIn(500);
									document.getElementById("video1").src = "https://objects.bzpay.cc/demo/payment_demo_low.mp4"
									document.getElementById("video1").load();
									$("#video1")[0].play();
									layer.closeAll();
								});

								$("#close-video").click(function (){
									$("#video1")[0].pause();
									$("#videoFrame").fadeOut(500);
									$(".video-shadow").css({'display':'none'});
									$('.addBox').hide();
									layer.closeAll();
								});
							});

						function handelResp(e){
							0 == e.code ? 0 == e.data.type ? layer.alert(e.msg, {
								title: "Congratulations",
								icon: 6,
								btn: ["OK"]
							},
							function() {
								window.location.href = e.data.redirectUrl
							}) : 1 == e.data.type ? layer.alert(e.msg, {
								title: "Sorry",
								icon: 5,
								btn: ["OK"]
							},
							function() {
								window.location.href = e.data.redirectUrl
							}) : 2 == e.data.type ? layer.alert("<span style='word-break:break-word'>" + e.msg + "</span>", {
								title: "Cashier",
								icon: 6,
								btn: ["OK"]
							},
							function() {
								window.location.href = e.data.redirectUrl
							}) : window.location.href = e.data.redirectUrl: layer.alert(e.msg, {
							title: "Sorry",
							icon: 5,
							btn: ["OK"]
							})
						}


						function showLoading(){
							$(".loading2").show();
						}
						function closeLoading(){
							$(".loading2").hide();
						}
						
						function depconfirm(refnum){
							window.location.href = 'depositconfirm.php?amt=' + ramt + '&refnum=' + refnum + '&srl=' + serial+ "&userId=" + userId+ "&token=" + token;
						}
						
						function adddep(amt,refnum,srl,upi,userId,token)
						{
							$.ajax({
							type: "Post",
							data:"amt=" + amt+ "& refnum=" + refnum+ "& srl=" + srl+ "& source=" + "wepay"+ "& upi=" + upi+ "& userId=" + userId+ "& token=" + token,
							url: "adddeposit.php",
							success: function(html)   
								{
									var arr = html.split('~');
									
									if (arr[0]== 1) {
										showLoading();
										setTimeout(depconfirm, 1900, refnum);
									}	
									else if(arr[0]==0)
									{ 
										alert("Error");
									}
									else if(arr[0]==2)
									{ 
										alert("Duplicate UTR");
									}
									else if(arr[0]==3)
									{ 
										alert("Please Wait For 1 Minute");
									}
									else if(arr[0]==4)
									{ 
										alert("Your recharge option is suspended" + "\n" + "Contact Customer Support");
									}
								},
								  error: function (e) {}
							});				
						}
					</script>
				</body>
			</html>
<?php
		}
		else{
			$res['code'] = 10000;
			$res['success'] = 'false';
			$res['message'] = 'Sorry, The system is busy, please try again later!';
			
			header('Content-Type: text/html; charset=utf-8');
			http_response_code(200);
			echo json_encode($res);	
		}
	}
	else{
		header('Content-Type: application/json; charset=utf-8');
		http_response_code(200);
		echo json_encode($res);	
	}
?>