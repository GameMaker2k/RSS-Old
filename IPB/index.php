<?php
ini_set("user_agent","Mozilla/5.0 (compatible; googlebot/2.1; +http://www.google.com/bot.html)");
ini_set("zlib.output_compression","On");
ini_set("zlib.output_compression_level","2");
ob_start('ob_gzhandler');
if($_GET['url']!=null) {
$checkurl = parse_url($_GET['url']);
$_GET['url'] = $checkurl['scheme']."://".$checkurl['host'].$checkurl['path'];
if($_GET['forum']==null&&$_GET['name']==null) { $_GET['forum']=20; }
if($_GET['name']!=null&&$_GET['forum']==null) { 
$rssprenews = file_get_contents($_GET['url']);
preg_match_all("/showforum=(.*?)(\"|')\>(.*?)\<\/a\>/isxS", $rssprenews, $rssfid);
$allf = count($rssfid);
$alli=0;
while ($alli < $allf) {
if($_GET['name']==$rssfid[3][$alli]) { 
$_GET['forum'] = $rssfid[1][$alli];
$FondID=true;
} ++$alli; } }
$rssnews = file_get_contents($_GET['url']."?showforum=".$_GET['forum'].$_GET['querys']);
preg_match_all("/href=\"(.*?)showtopic(.*?)\"/isxS", $rssnews, $rssnewx);
$rssnews = preg_replace("/\<span class=\'desc\'\>(.*?)\<\/span\>/i", "", $rssnews);
//$rssnews = preg_replace("/\<span class=\"pagelink\"\>(.*?)\<\/span\>/i", "", $rssnews);
//$rssnews = preg_replace("/\<span class=\"pagecurrent\"\>(.*?)\<\/span\>/i", "", $rssnews);
//$rssnews = preg_replace("/multi_page_jump\((.*?)\)\<\/span\>/i", "", $rssnews);
$rssnews = preg_replace("/\(Pages(.*?)\)/i", "", $rssnews);
$i=1; $l=0; 
$nums = count($rssnewx);
while ($i < $nums) {
$numx = count($rssnewx[$i])+1;
$tid = 1;
while ($l < $numx) {
preg_match_all("/showtopic(.*?)(\"|')(.*?)This(.*?)\>(.*?)\<\/a\>/isxS", $rssnews, $rsstid);
preg_match_all("/\"This(.*?)\>(.*?)\<\/a\>/isxS", $rssnews, $rsstname);
if($rsstid[$i][$numx]==null) { $numx=$numx-1; }
$rssnewx[$i][$l] = preg_replace("/\?(.*?)&amp;/isxS", "?", $rssnewx[$i][$l]);
$One = $One.'<rdf:li rdf:resource="'.$rssnewx[$i][$l]."showtopic".$rsstid[1][$tid].'"/>'."\n\r";
$il = $l - 1;
$Two = $Two.'<item>'."\n\r".'<title>'.$rsstid[5][$l].'</title>'."\n\r".'<description>'.$rsstid[5][$l].'</description>'."\n\r".'<link>'.$_GET['url']."?showtopic".$rsstid[1][$l].'</link>'."\n\r".'</item>'."\n\r";
$tid = $tid + 2;
++$l;
}
++$i;
}
header("Content-type: application/xml");
if($_GET['charset']==null) { $_GET['charset']="iso-8859-15"; }
echo '<?xml version="1.0" encoding="'.$_GET['charset'].'"?>'."\n\r";
?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
  <channel>
   <title>IPB 1.3.1 RSS Feeds</title>
   <description>RSS Feed of <?php echo $_GET['url']."?showforum=".$_GET['forum']; ?></description>
   <link><?php echo $_GET['url']; ?></link>
   <language>en-us</language>
   <generator>Edit Plus v2.21</generator>
   <copyright>Game Maker 2k© 2006</copyright>
   <ttl>120</ttl>
   <doc>http://backend.userland.com/rss</doc>
 <?php echo "\n\r".$Two."\n\r"; ?></channel>
</rss>
<?php } if($_GET['url']==null) { ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title> IPB 1.3.1 RSS Feeds </title>
<meta name="Generator" content="Edit Plus v2.12" />
<meta name="Author" content="Game Maker 2k© 2004" />
<meta name="Keywords" content="IPB 1.3.1 RSS Feeds" />
<meta name="Description" content="IPB 1.3.1 RSS Feeds" />
</head>

<body style="background-color: black;">
<table style="width: 100%; height: 100%; text-align: center; vertical-align: center;">
<tr>
	<td>
<form method="get" action="?act=GetRSS">
<div style="color: skyblue; font-weight: bold;"><label for="url">Insert URL to IPB 1.3.1 Board:</label><br />
<input style="background-color: black; color: skyblue; font-weight: bold; border-color: seagreen;" type="text" name="url" id="url" /></div>
<div style="color: skyblue; font-weight: bold;"><label for="forum">Insert Forum ID:</label><br />
<input style="background-color: black; color: skyblue; font-weight: bold; border-color: seagreen;" type="text" name="forum" id="forum" /></div>
<div style="color: skyblue; font-weight: bold;"><label for="querys">Extra Querys(Put in &amp; to start):</label><br />
<input style="background-color: black; color: skyblue; font-weight: bold; border-color: seagreen;" type="text" name="querys" id="querys" value="&amp;prune_day=100" /></div>
<div style="color: skyblue; font-weight: bold;">
<a target="_blank" style="color: skyblue;" href="http://www.w3.org/International/O-charset-list.html" title="Charset List">[?]</a>
<label for="forum">Use Charset:</label><br />
<input style="background-color: black; color: skyblue; font-weight: bold; border-color: seagreen;" type="text" name="charset" id="charset" value="iso-8859-15" /></div>
<div><input type="hidden" name="bbtype" id="bbtype" value="IPB" />
<input style="background-color: black; color: skyblue; font-weight: bold; border-color: seagreen;" type="submit" value="Get&nbsp;RSS">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input style="background-color: black; color: skyblue; font-weight: bold; border-color: seagreen;" type="reset"></div>
</form>
	</td>
</tr>
</table>
</body>
</html>
<?php } ?>