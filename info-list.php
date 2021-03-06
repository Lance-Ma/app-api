<?php
// http://app.com/list.php?page-=1&pagesize=12
require_once('./response.php');

require_once('./data.inc.php');

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = isset($_GET['pagesize']) ? $_GET['pagesize'] : 50;
if(!is_numeric($page) || !is_numeric($pageSize)) {
	return Response::show(401, '数据不合法');
}

$offset = ($page - 1) * $pageSize;

$sql = "select * from mdlog order by time desc limit ". $offset ." , ".$pageSize;

$offset .','.$pageSize;

try {
		$connect = NewData::getInstance()->connect();
	} catch(Exception $e) {
		// $e->getMessage();
		return Response::show(403, '数据库链接失败');
	}

$result = mysql_query($sql, $connect); 
$videos = array();

while($video = mysql_fetch_assoc($result)) {
		$videos[] = $video;
}

if($videos) {
	return Response::show(200, '数据获取成功', $videos);
} else {
	return Response::show(400, '数据获取失败', $videos);
}