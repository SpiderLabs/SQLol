<?php
/*
SQLol - A configurable SQL injection testbed
Daniel "unicornFurnace" Crowley
Copyright (C) 2012 Trustwave Holdings, Inc.

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see <http://www.gnu.org/licenses/>.
*/
include('includes/inject_cookie.php');
?>
<html>
<head>
<title>SQLol - Custom query</title>
</head>
<body>
<center><h1>SQLol - Custom query</h1></center><br>
<?
include('includes/nav.inc.php');
?>

<tr><td>Original Query (write *INJECT* in the query where you want to inject):</td><td><input type="textbox" name="location"></td></tr>
	</table>
<input type="submit" name="submit" value="Inject!">

<?
if(isset($_REQUEST['submit'])){ //Injection time!	
		
	$query = str_replace('*INJECT*', $sqlol_vars['inject_string'], $sqlol_vars['location']);
	$displayquery = str_replace('*INJECT*', '<u>' . $sqlol_vars['inject_string'] . '</u>', $sqlol_vars['location']);
	
	include('includes/database.inc.php');
	
}
?>

</body>
</html>