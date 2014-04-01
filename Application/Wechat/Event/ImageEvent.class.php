<?php
namespace Wechat\Event;

class ImageEvent{

	/**
	 * 对图片类型消息进行处理
	 * @param string $openId 客户微信唯一识别码openid
	 * @param unknown_type $keyword 客户发送的文本信息
	 */
	public function imageHandle($openId,$mediaId){
		//认证判断
		if(WEB_ACCOUNT_RZ === '1'){
			//下载图片
			$accessToken = get_access_token();
			$url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=$accessToken&media_id=$mediaId";
			$fileInfo = $this->downloadWeixinFile($url);
			
			$filePath = CLIENT_PHOTO.date('Ym',time())."/";
			$fileName = time()."-".rand(100, 999).".jpg";
			$this->saveWeixinFile($filePath,$fileName, $fileInfo["body"]);
			
			/* 将图片存储到数据库中，并与微信客户表中的客户ID关联*/
			$clientId = get_client_detail($openId, array('id'));
			$data = array(
				'client_id' =>$clientId,
				'photo' => $filePath.$fileName,
				'create_time' => date('Y-m-d H:i:s',time()),
			);
			$picId = M('Tchat_client_photo')->data($data)->add();
			
			//回复客户内容
			$filePath = str_replace('./', '/', $filePath);
	
			$content = "( ＾-＾)っ您的图片收到啦\n<a href='http://".$_SERVER["HTTP_HOST"].$filePath.$fileName."' >点击查看</a>".C('WECHAT_APP_ID');	
		}else{
			$content = "( ＾-＾)っ您的图片收到啦";	
		}
		
		return $reply = get_text_arr($content);
	}
	
/**
 * 通过CRUL方式下载微信服务器上客户发送的图片
 * @author 方倍工作室  <http://www.cnblogs.com/txw1958/>
 * @param $url 资源地址
 */
private function downloadWeixinFile($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);    
    curl_setopt($ch, CURLOPT_NOBODY, 0);    //只取body头
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $package = curl_exec($ch);
    $httpinfo = curl_getinfo($ch);
    curl_close($ch);
    $imageAll = array_merge(array('header' => $httpinfo), array('body' => $package)); 
    return $imageAll;
}

/**
 * 存储客户发送的图片
 * @author 方倍工作室  <http://www.cnblogs.com/txw1958/>
 * 有更改，增加一个传入参数$filePath并对此参数进行目录检查，不存在则建立，以解决只能存储在既有目录的问题
 * @param string $filePath
 * @param string $fileName
 * @param object $fileContent
 */
private function saveWeixinFile($filePath,$fileName, $fileContent)
{
	if(!is_dir($filePath)){
	mkdir($filePath,0777,true);
			}
	$fileName = $filePath.$fileName;
    $local_file = fopen($fileName, 'w');
    if (false !== $local_file){
        if (false !== fwrite($local_file, $fileContent)) {
            fclose($local_file);
        }
    }
}


}