<?php
/*
 * http://www.rosmm.com
 * ��ȡ����like this
 * 
 *
 *
 */

include_once("conn.php");
header("Content-Type: text/html; charset=GBK");
set_time_limit(0);
if($_GET[id]<=16&& $_GET[id]){
	//$con="www.rosmm.com/rosimm/index_".$_GET[id].".htm";
	$con="www.rosmm.com/rosimm/index.htm";  //���ѵ�һҳҲ�ɼ�����
	$ch = curl_init($con);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$contents = curl_exec($ch);
	//print_r($contents);
	curl_close($ch);
	
	$preg1 = "#<li><a\shref=\"/rosimm(.*)\"\stitle=\"(.*)\"\starget#iUs";
	preg_match_all($preg1,$contents,$arr1);
	print_r($arr1);
	//--------------�ѻ�ȡ�������ӷŵ����ݿ�---------------
	for ($i = 0; $i < count($arr1[1]); $i++) {
		$fullUrl = "www.rosmm.com/rosimm".$arr1[1][$i];
		$sql="INSERT INTO `caiji_rosmm`.`pagelink_list` (`id`, `pageLink`, `title`, `photoPageLinkList`) VALUES (NULL, '".$fullUrl."', '".iconv("GBK", "UTF-8",$arr1[2][$i])."', '');";
		mysql_query($sql);
	}
	echo "���ڲɼ���".$_GET[id]."ҳ<br>";
	$_GET[id]++;
	sleep(2);
	//echo "<script>location.href='downloadPageLink.php?id=".$_GET[id]."'</script>";
}



?>