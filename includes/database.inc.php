<?php
/*
SQLol - A configurable SQL injection testbed
Daniel "unicornFurnace" Crowley
Copyright (C) 2012 Trustwave Holdings, Inc.

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

include('database.config.php');
include_once('adodb/adodb.inc.php');

$dsn = $dbtype.'://'.$hostspec.'/'.$database.$persist;
$db_conn = NewADOConnection($dsn);

print("\n<br>\n<br>");
if(isset($sqlol_vars['show_query']) and $sqlol_vars['show_query']=='on') echo "Query (injection string is <u>underlined</u>): " . $displayquery . "\n<br>";

$db_conn->SetFetchMode(ADODB_FETCH_ASSOC);
$results = $db_conn->Execute($query);

if (!$results){
	$error = $db_conn->ErrorMsg();
	if(isset($sqlol_vars['error_level']) and isset($error)){
		switch ($sqlol_vars['error_level']){
			case 'errors':
				echo "An error occurred." . "\n<br>";
				break;
			case 'verbose':
				echo "Error: " . $error . "\n<br>";
				break;
		}
	}	
} else {
	switch($sqlol_vars['query_results']){
		case 'one_row':
			print_r($results->fields);
			print("\n<br>");
			break;
		case 'all_rows':
			while(!$results->EOF){
				print_r($results->fields);
				print("\n<br>");
				$results->MoveNext();
			}
			break;
		case 'bool':
			if(!$results->EOF) print "Got results!";
			break;
	}
}

if ($results) $results->Close();
if ($db_conn) $db_conn->Close();

?>