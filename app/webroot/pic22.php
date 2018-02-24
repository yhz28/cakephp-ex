<?php 
ob_start(); 
$img=$_GET['url']; 
$host=$path=str_replace('http://','',$img); 
$host=explode('/',$host); 
$host=$host[0]; 
$path=strstr($path,'/'); 
$fp = fsockopen($host, 80, $errno, $errstr, 30); 
if ($fp) 
{ 
@fputs($fp, "GET $path HTTP/1.1\r\n"); 
@fputs($fp, "Host: $host\r\n"); 
@fputs($fp, "Accept: */*\r\n");
@fputs($fp, "Referer: http://$host/\r\n"); 
@fputs($fp, "User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)\r\n"); 
@fputs($fp, "Connection: Close\r\n\r\n"); 
} 
$Content = ''; 
while ($str = fread($fp, 4096)) 
$Content .= $str; 
@fclose($fp); 
$pos=strpos($Content,"\r\n\r\n"); 
$head=substr($Content,0,$pos); 
$text=substr($Content,$pos+4); 
//header($head); 
echo $text; 
?>
