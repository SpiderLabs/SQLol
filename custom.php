<?php
/*
SQLol - A configurable SQL injection testbed
Daniel "unicornFurnace" Crowley
Copyright (C) 2012 Trustwave Holdings, Inc.

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see <http://www.gnu.org/licenses/>.
*/
?>
<html>
<head>
<title>SQLol - Custom query</title>
</head>
<body>
<center><h1>SQLol - Custom query</h1></center><br>
<?php
include('includes/nav.inc.php');
include('includes/options.inc.php');
?>

<tr><td>Original Query (write *INJECT* in the query where you want to inject):</td><td><textarea name="location"><?php if(isset($_REQUEST["location"])) echo $_REQUEST["location"]; ?></textarea></td></tr>
	</table>
<input type="submit" name="submit" value="Inject!">

<?php
if(isset($_REQUEST['submit'])){ //Injection time!	
		
	include('includes/sanitize.inc.php');
	
	$query = str_replace('*INJECT*', $_REQUEST['inject_string'], $_REQUEST['location']);
	$displayquery = str_replace('*INJECT*', '<u>' . $_REQUEST['inject_string'] . '</u>', $_REQUEST['location']);
	
	include('includes/database.inc.php');
	
}
?>

</body>
</html>