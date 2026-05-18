<?php 
	include "../../conn.php";
	include "../../functions2.php";

	header('Content-Type: application/json; charset=utf-8');
	header('Strict-Transport-Security: max-age=31536000');
	header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
	header('Access-Control-Allow-Credentials: true');
	$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
	header('Access-Control-Allow-Origin: ' . $origin);
	header('vary: Origin');
	
	date_default_timezone_set("Asia/Kolkata");
	$shnunc = date("Y-m-d H:i:s");
	$res = [
		'code' => 11,
		'msg' => 'Method not allowed',
		'msgCode' => 12,
		'serviceNowTime' => $shnunc,
	];
	$shonubody = file_get_contents("php://input");
	$shonupost = json_decode($shonubody, true);
	if ($_SERVER['REQUEST_METHOD'] != 'GET') {
		if (isset($shonupost['bannerId']) && isset($shonupost['language']) && isset($shonupost['random']) && isset($shonupost['signature']) && isset($shonupost['timestamp'])) {
			$bannerId = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['bannerId']));
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			$shonustr = '{"bannerId":'.$bannerId.',"language":'.$language.',"random":"'.$random.'"}';
			$shonusign = strtoupper(md5($shonustr));
			if($shonusign == $signature){
				$bearer = explode(" ", $_SERVER['HTTP_AUTHORIZATION']);
				$author = $bearer[1];				
				$is_jwt_valid = is_jwt_valid($author);
				$data_auth = json_decode($is_jwt_valid, 1);
				if($data_auth['status'] === 'Success') {
					$sesquery = "SELECT akshinak
					  FROM shonu_subjects
					  WHERE akshinak = '$author'";
					$sesresult=$conn->query($sesquery);
					$sesnum = mysqli_num_rows($sesresult);
					if($sesnum == 1){
						if($bannerId == 71){
							$data['title'] = 'Member Recharge Benefits';
							$data['img'] = '[{"Id":"17225024498060d979egil58","Url":"https://selimxpro.com/apiimages/BDGWin/banner/rechargebenifet.png"}]';
							$data['coverUrl'] = 'https://selimxpro.com/apiimages/BDGWin/banner/rechargebenifetposter.png';
							$data['jumpType'] = 3;
						}
						else if($bannerId == 53){
							$data['title'] = "1 MINUTE LOTTERY GAME\t";
							$data['img'] = '<p><br></p><h1 style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; line-height: normal; font-family: &quot;Microsoft YaHei&quot;, ΢���ź�, SimSun, ����, Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); text-align: center;"><span style="text-align: left;"><font face="Helvetica Neue"><span style="font-size: 13px;"><font color="#ffff00">Click link to apply bonus ➡️ ➡️➡️</font><a href="https://t.me/youtubegyrox/wap/indexFDetail.jsp?applyId=20240430001" target="_blank"><font color="#000000" style="background-color: rgb(255, 255, 0);"><b>[link]</b></font></a></span></font></span></h1><p><img src="https://selimxpro.com/apiimages/BDGWin/editor/editor_202404142139016c66.png" style="width: 1080px;"><br></p>';
							$data['coverUrl'] = 'https://selimxpro.com/apiimages/BDGWin/banner/Banner_20240405153611n2r3.png';
							$data['jumpType'] = 1;
						}
						else if($bannerId == 59){
							$data['title'] = 'Aviator Bonus';
							$data['img'] = '<p><br></p><h1 style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; line-height: normal; font-family: &quot;Microsoft YaHei&quot;, ΢���ź�, SimSun, ����, Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); text-align: center;"><span style="text-align: left;"><font face="Helvetica Neue"><span style="font-size: 13px;"><font color="#ffff00">Click link to apply bonus ➡️ ➡️➡️</font><a href="https://t.me/youtubegyrox/wap/indexFDetail.jsp?applyId=20240502001" target="_blank"><font color="#000000" style="background-color: rgb(255, 255, 0);"><b>[link]</b></font></a></span></font></span></h1><p><img src="https://selimxpro.com/apiimages/BDGWin/editor/editor_20240502120211y8hl.png" style="width: 1080px;"><br></p>';
							$data['coverUrl'] = 'https://selimxpro.com/apiimages/BDGWin/banner/avitorgameimage.png';
							$data['jumpType'] = 1;
						}
						else if($bannerId == 47){
							$data['title'] = "Mystery Random Bonus\t";
							$data['img'] = '<h3></h3><h3 style="text-align: center;"><br></h3><h4 style="text-align: center; ">❤️<span style="background-color: rgb(255, 231, 206); font-family: &quot;Arial Black&quot;;"><font color="#000000">Click To FollowTelegram Channel：</font></span><a href="https://t.me/youtubegyrox" target="_blank" style="">https://t.me/youtubegyrox</a></h4><h3><p style="text-align: center;"></p><p style="text-align: center; "><b><font color="#000000" style="background-color: rgb(255, 255, 255);"><br></font></b></p></h3><h4 style="margin-top: 0px; margin-bottom: 0px; font-family: Verdana, Helvetica; line-height: 22px; font-size: 13.3333px; text-align: center;">❤️<span style="font-family: &quot;Arial Black&quot;;"><span style="color: rgb(0, 0, 0); background-color: rgb(255, 231, 206);">Mystery bonus 1:</span> <span style="font-family: &quot;Microsoft YaHei&quot;;"><font color="#efefef">Mystery bonus Rs 1-9999999 will be distributed randomly from time to time. The more active you are on the platform, the higher your engagement rate will be.                     </font></span></span></h4><h4 style="margin-top: 0px; margin-bottom: 0px; font-family: Verdana, Helvetica; line-height: 22px; font-size: 13.3333px; text-align: center;"><span style="font-family: &quot;Arial Black&quot;;"><font color="#000000" style=""><span style="font-family: &quot;Microsoft YaHei&quot;;"><br></span></font></span></h4><h4 style="margin-top: 0px; margin-bottom: 0px; line-height: 22px; text-align: center;"><span style="font-family: &quot;Arial Black&quot;; font-size: 13.3333px; color: rgb(69, 90, 100);"><br></span><font face="Arial Black"><span style="font-size: 13.3333px;"><font color="#000000">❤️</font><span style="color: rgb(0, 0, 0); background-color: rgb(255, 231, 206);">Mystery Bonus 2:</span> <span style="font-family: &quot;Microsoft YaHei&quot;;"><font color="#efefef">Recharge In 91clubold.investment93.site , Randomly Draw A Single Recharge Amount To Give A Multiple Bonus Of 1-10! ! The Time Is Not Fixed. The More Deposit Times, The Higher Chances To Get.</font></span></span></font><br></h4>';
							$data['coverUrl'] = 'https://selimxpro.com/apiimages/BDGWin/banner/freespin.png';
							$data['jumpType'] = 1;
						}
						else if($bannerId == 66){
							$data['title'] = "91clubold.investment93.site AGENT GOLD EVENT\t";
							$data['img'] = '<p><img src="https://selimxpro.com/apiimages/BDGWin/editor/editor_20240716090948aako.jpg" style="width: 658px;"><br></p>';
							$data['coverUrl'] = 'https://selimxpro.com/apiimages/BDGWin/banner/Banner_20240514165423npjh.png';
							$data['jumpType'] = 1;
						}
						
						$res['data'] = $data;
						$res['code'] = 0;
						$res['msg'] = 'Succeed';
						$res['msgCode'] = 0;
						http_response_code(200);
						echo json_encode($res);			
					}
				}
			}
			else{
				$res['code'] = 5;
				$res['msg'] = 'Wrong signature';
				$res['msgCode'] = 3;
				http_response_code(200);
				echo json_encode($res);
			}
		}
		else{
			$res['code'] = 7;
			$res['msg'] = 'Param is Invalid';
			$res['msgCode'] = 6;
			http_response_code(200);
			echo json_encode($res);
		}		
	} else {		
		http_response_code(405);
		echo json_encode($res);
	}	
?>