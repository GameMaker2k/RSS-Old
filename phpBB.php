<?php
ini_set("user_agent","Mozilla/5.0 (compatible; googlebot/2.1; +http://www.google.com/bot.html)");
ini_set("zlib.output_compression","On");
ini_set("zlib.output_compression_level","2");
ob_start('ob_gzhandler');
if($_GET['url']!=null) {
$checkurl = parse_url($_GET['url']);
$_GET['url'] = $checkurl['scheme']."://".$checkurl['host'].$checkurl['path'];
$rssprenews = file_get_contents($_GET['url']."viewforum.php?f=".$_GET['forum']);
$prepreg1 = preg_quote("<span class=\"topictitle\">","/");
$prepreg2 = preg_quote("</span>","/");
preg_match_all("/".$prepreg1."(.*?)".$prepreg2."/i", $rssprenews, $rssfeed);
$prepreg3 = preg_quote("<a href=\"","/");
$prepreg4 = preg_quote("\" class=\"topictitle\">","/");
$prepreg5 = preg_quote("</a>","/");
$i=0; $l=0; 
$nums = 1;//count($rssfeed);
while ($i < $nums) { $l=0; 
	$numz = count($rssfeed[$i]);
	while ($l < $numz) {
preg_match_all("/".$prepreg3."(.*?)".$prepreg4."(.*?)".$prepreg5."/i", $rssfeed[$i][$l], $rssfeedend);
$One = $One.'<rdf:li rdf:resource="'.$_GET['url'].$rssfeedend[1][0].'"/>'."\n\r";
$Two = $Two.'<item>'."\n\r".'<title>'.$rssfeedend[2][0].'</title>'."\n\r".'<description>'.$rssfeedend[2][0].'</description>'."\n\r".'<link>'.$_GET['url'].$rssfeedend[1][0].'</link>'."\n\r".'</item>'."\n\r";  ++$l; } ++$i; }
header("Content-type: application/xml");
if($_GET['charset']==null) { $_GET['charset']="iso-8859-15"; }
echo '<?xml version="1.0" encoding="'.$_GET['charset'].'"?>'."\n\r";
?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
  <channel>
   <title>phpBB RSS Feeds</title>
   <description>RSS Feed of <?php echo $_GET['url']."viewforum.php?f=".$_GET['forum']; ?></description>
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
<title> phpBB RSS Feeds </title>
<meta name="Generator" content="Edit Plus v2.12" />
<meta name="Author" content="Game Maker 2k© 2004" />
<meta name="Keywords" content="phpBB RSS Feeds" />
<meta name="Description" content="phpBB RSS Feeds" />
</head>

<body style="background-color: black;">
<table style="width: 100%; height: 100%; text-align: center; vertical-align: center;">
<tr>
	<td>
<form method="get" action="?act=GetRSS">
<div style="color: skyblue; font-weight: bold;"><label for="url">Insert URL to phpBB Board:</label><br />
<input style="background-color: black; color: skyblue; font-weight: bold; border-color: seagreen;" type="text" name="url" id="url" /></div>
<div style="color: skyblue; font-weight: bold;"><label for="forum">Insert Forum ID:</label><br />
<input style="background-color: black; color: skyblue; font-weight: bold; border-color: seagreen;" type="text" name="forum" id="forum" /></div>
<div style="color: skyblue; font-weight: bold;">
<a target="_blank" style="color: skyblue;" href="http://www.w3.org/International/O-charset-list.html" title="Charset List">[?]</a>
<label for="forum">Use Charset:</label><br />
<input style="background-color: black; color: skyblue; font-weight: bold; border-color: seagreen;" type="text" name="charset" id="charset" value="iso-8859-15" /></div>
<div><input type="hidden" name="bbtype" id="bbtype" value="phpBB" />
<input style="background-color: black; color: skyblue; font-weight: bold; border-color: seagreen;" type="submit" value="Get&nbsp;RSS">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input style="background-color: black; color: skyblue; font-weight: bold; border-color: seagreen;" type="reset"></div>
</form>
	</td>
</tr>
</table>
</body>
</html>
<?php } ?>