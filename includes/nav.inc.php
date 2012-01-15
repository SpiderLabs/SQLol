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
<center>
| <a href="insert.php">INSERT</a> || <a href="update.php">UPDATE</a> || <a href="delete.php">DELETE</a> || <a href="select.php">SELECT</a> || <a href="custom.php">Custom</a> || <a href="challenges.htm">Challenges</a> |<br>
| <a href="?method=get">get</a> || <a href="?method=post">post</a> || <a href="?method=cookie">cookie</a> |<br>
<a href="resetbutton.php"><h2>RESET</h2></a></center>

<hr width="40%">
<hr width="60%">
<hr width="40%">
<br>
<form action="<? echo basename($_SERVER['SCRIPT_FILENAME']) ?>" method="<?
if(isset($_COOKIE['method'])){
	switch( $_COOKIE['method']){
		case 'get':
			echo 'get"><input type="hidden" name="method" value="get';
			break;
		case 'cookie':
			echo 'post"><input type="hidden" name="method" value="cookie';
			break;
		case 'post':
		default:
			echo 'post"><input type="hidden" name="method" value="post';
			break;
	}
}else{
	echo 'post"><input type="hidden" name="method" value="post';
}
?>">
<table>
<?php
if (!isset($_COOKIE['method']) or $_COOKIE['method']!='cookie'){
	echo '<tr><td>Injection String:</td><td><input type="text" name="inject_string"></td></tr>';
}
?>
<tr><td><b>Input Sanitization:</b></td></tr>
<tr><td>Single Quotes:</td><td><select name="sanitize_quotes">
		<option value="none">No sanitization</option>
		<option value="quotes_double">Single quotes doubled</option>
		<option value="quotes_escape">Single quotes backslashed</option>
		<option value="quotes_remove">Single quotes removed</option>
	</select></td></tr>
	<tr><td>Remove Spaces:</td><td><input type="checkbox" name="spaces_remove" value="off"></td></tr>
	<tr><td>Blacklist Keywords:</td><td><select name="keyword_blacklist">
		<option value="none">No blacklisting</option>
		<option value="low">Low</option>
		<option value="medium">Medium</option>
		<option value="high">High</option>
	</select></td></tr>
<tr><td><b>Output Level:</b></td></tr>
	<tr><td>Output Query Results:</td><td><select name="query_results">
		<option value="all_rows">All rows</option>
		<option value="one_row">One row</option>
		<option value="none">No results</option>
	</select></td></tr>
	<tr><td>Error Verbosity:</td><td><select name="error_level">
		<option value="verbose">Verbose error messages</option>
		<option value="errors">Generic error messages</option>
		<option value="none">No error messages</option>
	</select></td></tr>
	<tr><td>Show Query:</td><td><input type="checkbox" name="show_query" value="on"></td></tr>
<?php
if(isset($_REQUEST['submit'])){ //Injection time!	
	
	switch($_COOKIE['method']){//Determine how variables are being submitted
		
		case 'get':
		case 'post':
			$sqlol_vars = $_REQUEST;
			break;
		case 'cookie':
			$sqlol_vars = $_REQUEST;
			$sqlol_vars['inject_string'] = $_COOKIE['inject_string'];
			break;
		default:
			$sqlol_vars = $_REQUEST;
			break;
			
	}
	
	switch($sqlol_vars['sanitize_quotes']){ //Apply the requested level of quote sanitization
		
		case 'quotes_double':
			$sqlol_vars['inject_string'] = str_replace('\'', '\'\'', $sqlol_vars['inject_string']);
			break;
		case 'quotes_escape':
			$sqlol_vars['inject_string'] = str_replace('\'', '\\\'', $sqlol_vars['inject_string']);
			break;
		case 'quotes_remove':
			$sqlol_vars['inject_string'] = str_replace('\'', '', $sqlol_vars['inject_string']);
			break;
	
	}
	
	//Remove spaces if requested
	if(isset($sqlol_vars['spaces_remove']) and $sqlol_vars['spaces_remove'] == 'on') $sqlol_vars['inject_string'] = str_replace(' ', '', $sqlol_vars['inject_string']);
	
	//Define blacklists
	$blacklist_low = array(
		'select',
		'from',
		'1=1',
		'--',
		'union',
		'#'
	);
	$blacklist_medium = array_merge($blacklist_low, array(
		'@@',
		'xp_cmdshell',
		'UTL_HTTP'
	));
	$blacklist_high = array_merge($blacklist_medium, array(
		'/*',
		'*/',
		';'
	));
	
	switch($sqlol_vars['keyword_blacklist']){
		//We process blacklists differently at each level. At the lowest, each keyword is removed case-sensitively.
		//At medium blacklisting, more keywords are added and checks are done case-insensitively.
		//At the highest level, more keywords are added and checks are done case-insensitively and repeatedly.
		
		case 'low':
			foreach($blacklist_low as $keyword){
				$sqlol_vars['inject_string'] = str_replace($keyword, '', $sqlol_vars['inject_string']);
			}
			break;
		case 'medium':
			foreach($blacklist_medium as $keyword){
				$sqlol_vars['inject_string'] = str_replace(strtolower($keyword), '', strtolower($sqlol_vars['inject_string']));
			}
			break;
		case 'high':
			do{
				$keyword_found = 0;
				foreach($blacklist_high as $keyword){
					$sqlol_vars['inject_string'] = str_replace(strtolower($keyword), '', strtolower($sqlol_vars['inject_string']), $count);
					$keyword_found += $count;
				}	
			}while ($keyword_found);
			break;
			
	}
	
}

?>