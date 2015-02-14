<?php
/*
你可以在此基础上修改，但需保留此头部信息。
微信公众平台开发者交流   http://bbs.binguo.me
Copyright © 2013 BinGuo.Co.Ltd. All rights reserved.
*/
if($_SERVER['REQUEST_METHOD'] == 'POST'){
		new wxtool;
}else{
	echo "Error!";
	exit;
}


class wxtool{	
	function __construct(){
		$data = trim($_POST['input']);
		$url  = trim($_POST['url']);
		$type = $_POST['type'];
		if($type == 'LOCAL'){
			$arr = explode(",",$data);
			$num = count($arr);
			if($num < 3){
				echo "Error Data!";
				exit;
			}
		}elseif($type == 'EVENT'){
			if($data == 1){
				$arr[0] = 'subscribe';
				$arr[1]	=	'';
			}elseif($data == 0){
				$arr[0] = 'unsubscribe';
				$arr[1]	=	'';
			}elseif($data == 2){
				$arr[0] = 'SCAN';
				$arr[1]	=	'';
			}elseif($data == 3){
				$arr[0] = 'CLICK';
				$arr[1]	=	'';
			}else{
				echo "Error Data!";
				exit;
			}
		}else{
			$arr = $data;
		}
		$xml = $this->tpl($type,$arr);
		$this->post($url,$xml);
	}
	public function runtime(){
      $times = explode(" ",microtime());
      $nowtime = $times[1]+$times[0];
      return $nowtime;
	}
	
	public function tpl($type,$data){
		if($type == 'TEXT'){
				$tpl = '<xml><ToUserName><![CDATA[TEST_ToUser]]></ToUserName>
							 <FromUserName><![CDATA[TEST_FromUser]]></FromUserName> 
							 <CreateTime>'.$_SERVER['REQUEST_TIME'].'</CreateTime>
							 <MsgType><![CDATA[text]]></MsgType>
							 <Content><![CDATA['.$data.']]></Content>
							 <MsgId>'.rand(1000000,9999999).'</MsgId>
							 </xml>';
		}elseif($type == 'IMAGE'){
				$tpl = '<xml>
							 <ToUserName><![CDATA[TEST_ToUser]]></ToUserName>
							 <FromUserName><![CDATA[TEST_FromUser]]></FromUserName>
							 <CreateTime>'.$_SERVER['REQUEST_TIME'].'</CreateTime>
							 <MsgType><![CDATA[image]]></MsgType>
							 <PicUrl><![CDATA['.$data.']]></PicUrl>
							 <MsgId>'.rand(1000000,9999999).'</MsgId>
							 </xml>';
		}elseif($type == 'LOCAL'){
			$tpl = '<xml>
							<ToUserName><![CDATA[TEST_ToUser]]></ToUserName>
							<FromUserName><![CDATA[TEST_FromUser]]></FromUserName>
							<CreateTime>'.$_SERVER['REQUEST_TIME'].'</CreateTime>
							<MsgType><![CDATA[location]]></MsgType>
							<Location_X>'.$data[0].'</Location_X>
							<Location_Y>'.$data[1].'</Location_Y>
							<Scale>'.$data[2].'</Scale>
							<Label><![CDATA[中国北京市朝阳区]]></Label>
							<MsgId>'.rand(1000000,9999999).'</MsgId>
							</xml>';
		}elseif($type == 'EVENT'){
				$tpl = '<xml><ToUserName><![CDATA[TEST_ToUser]]></ToUserName>
							<FromUserName><![CDATA[TEST_FromUser]]></FromUserName>
							<CreateTime>'.$_SERVER['REQUEST_TIME'].'</CreateTime>
							<MsgType><![CDATA[event]]></MsgType>
							<Event><![CDATA['.$data[0].']]></Event>
							<EventKey><![CDATA['.$data[1].']]></EventKey>
							</xml>';
		}
		return $tpl;
	}
	
	public function post($url,$xml){
			$token = trim($_POST['token']);
			if($token <> ''){
				$sign = $this->auth($token);
				if(strpos($url,'?') == true){
					$url  = $url.'&timestamp='.$sign[0].'&nonce='.$sign[1].'&signature='.$sign[2];
				}else{
					$url  = $url.'?timestamp='.$sign[0].'&nonce='.$sign[1].'&signature='.$sign[2];
				}
			}
		$start_time = $this->runtime();
		$header[] = "Content-type: text/xml"; //定义content-type为xml
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		$response = curl_exec($ch);
		if (curl_errno($ch)) {
			$data['xml'] = curl_error($ch);
			echo json_encode($data);
			exit;
		}
		curl_close($ch);
		//echo $response;
		$end_time = $this->runtime();
		$cost_time = $end_time - $start_time;
		$cost_time = round($cost_time,4);
		$data['xml'] = "<xmp>".$response."</xmp><br/><br/><p>共耗时<b>" . $cost_time . " </b>秒</p>";
		$postObj = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
		$MsgType = (string)$postObj->MsgType;
		if($MsgType == 'text'){
			$content = $postObj->Content;
			$content = str_replace('\n','<br/>',$content);
			$data['demo']	=	'<div class="show">'.$content.'</div>';
		}elseif($MsgType == 'news'){
			$count = $postObj->ArticleCount;
			if($count > 1){ //多于1条
				$patterns[0] = '|<xml>.*?<Articles>|Uis';
				$patterns[1] = '|<\/Articles>.*?<\/xml>|Uis';
				$patterns[2] = '/<!\[CDATA\[/';
				$patterns[3] = '/\]\]>/';
				$patterns[4] = '|</item>\s+<item>|Uis';
				$patterns[5] = '/<item>/';
				$patterns[6] = '/<\/item>/';
				$placeto[0]	=	'';
				$placeto[1]	=	'';
				$placeto[2]	=	'';
				$placeto[3]	=	'';
				$placeto[4]	=	'||||||';
				$placeto[5]	=	'';
				$placeto[6]	=	'';
				$tmp = preg_replace($patterns, $placeto, $response);
				$new_arr = explode('||||||',$tmp);
				$num = count($new_arr);
				$fd[0]	=	'/<Title>/';
				$fd[1]	=	'|</Title>\s+<Description>|Uis';
				$fd[2]	=	'|</Description>\s+<PicUrl>|Uis';
				$fd[3]	=	'|</PicUrl>\s+<Url>|Uis';
				$fd[4]	= '/<\/Url>/';
				$rt[0]	=	'';$rt[1]	=	'||||||';$rt[2]	=	'||||||';$rt[3]	=	'||||||';$rt[4]	=	'';
				for($i=0;$i<$num;$i++){
					$new_arr[$i] = preg_replace($fd, $rt, $new_arr[$i]);
					$new_arr[$i] = explode('||||||',$new_arr[$i]);
					$new_arr[$i] = "<li class=\"news_0\"><a href=\"".$new_arr[$i][3]."\" target=\"_blank\" title=\"".$new_arr[$i][1]."\"><img src=\"".$new_arr[$i][2]."\"/></a><p>".$new_arr[$i][0]."</p></li>";
				}
				$data['demo']	=	'<div class="show">'.implode(" ",$new_arr).'</div>';
			}else{ //等于1条
			}
		}elseif($MsgType == 'music'){
			$title = $postObj->Music->Title;
			$intro = $postObj->Music->Description;
			$play = $postObj->Music->MusicUrl;
			$hplay = $postObj->Music->HQMusicUrl;
			if(!empty($play)){
				$add_1 = '<br/><embed src="script/player.swf?url='.$play.'&amp;autoplay=1" type="application/x-shockwave-flash" wmode="transparent" allowscriptaccess="always" width="260" height="30">';
			}else{
				$add_1 = '';
			}
			if(!empty($hplay)){
				$add_2 = '<br/>WIFI 下优先：<br/><embed src="script/player.swf?url='.$hplay.'&amp;autoplay=0" type="application/x-shockwave-flash" wmode="transparent" allowscriptaccess="always" width="260" height="30">';
			}else{
				$add_2 = '';
			}
			$data['demo']	= '<div class="show"><li class="play"><h2>'.$title.'</h2><p>'.$intro.$add_1.$add_2.'</p>
</div>';
		}
		echo json_encode($data);
	}                          
                                                         
	function auth($token){
        $data[0] = time();
        $data[1] = rand(1,9);	
		$tmpArr = array($token, $data[0], $data[1]);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$data[2] = sha1( $tmpStr );
		return $data;
	}
}
