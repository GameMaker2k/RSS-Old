<?php if($_GET['bbtype']=="phpBB") {
require("phpBB/index.php");
die();
}  if($_GET['bbtype']=="IPB") {
require("IPB/index.php");
die();
} $_GET['bbtype']=null;
  if($_GET['bbtype']==null) { ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title> RSS Feed Maker 2k </title>
<meta name="Generator" content="Edit Plus v2.12" />
<meta name="Author" content="Game Maker 2k© 2004" />
<meta name="Keywords" content="RSS Feed Maker 2k" />
<meta name="Description" content="RSS Feed Maker 2k" />
</head>

<body style="background-color: black;">
<table style="width: 100%; height: 100%; text-align: center; vertical-align: center;">
<tr>
	<td>
<form method="get" action="?act=GetRSS">
<div style="color: skyblue; font-weight: bold;"><label for="bbtype">Pick Board System:</label><br />
<select style="background-color: black; color: skyblue; font-weight: bold; border-color: seagreen;" id="bbtype" name="bbtype">
<option value="IPB">IPB RSS Maker</option>
<option value="phpBB">phpBB RSS Maker</option>
</select></div>
<div><input style="background-color: black; color: skyblue; font-weight: bold; border-color: seagreen;" type="submit" value="Get&nbsp;RSS">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input style="background-color: black; color: skyblue; font-weight: bold; border-color: seagreen;" type="reset"></div>
</form>
<form method="post" action="Download"><div><input style="background-color: black; color: skyblue; font-weight: bold; border-color: seagreen;" type="submit" value="Get Code" /></div></form>
	</td>
</tr>
</table>
</body>
</html>
<?php } ?>