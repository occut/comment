<?php

header("Content-Type:text/html;charset=gb2312");

$ip=$_SERVER["REMOTE_ADDR"];

echo $ip;

$url='http://www.ip138.com/ips138.asp?ip='.$ip.'&action=2';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//设置URL，可以放入curl_init参数中
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/14.0.835.202 Safari/535.1");
//设置UA
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//将curl_exec()获取的信息以文件流的形式返回，而不是直接输出。 如果不加，即使没有echo,也会自动输出
$content = curl_exec($ch);
//执行
curl_close($ch);
//关闭


//echo $content;


preg_match('/本站数据：(.*)<\/li><li>参考数据1/',$content,$arr);

//var_dump($arr[1]);


header("Content-Type:text/html;charset=utf-8");

$utf8Html = mb_convert_encoding($arr[1], 'utf-8', 'gb2312');

echo ":".$utf8Html;

?>
