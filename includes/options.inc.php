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

<form method="get">
<table>
<tr><td>Injection String:</td></tr>
<tr><td><textarea name="inject_string"><?php if(isset($_REQUEST["inject_string"])) echo htmlentities($_REQUEST["inject_string"]); ?></textarea></td></tr>
<tr><td><b>Input Sanitization:</b></td></tr>
<tr><td>Double-up Single Quotes:</td><td><input type="checkbox" name="quotes_double" <?php if(isset($_REQUEST["quotes_double"])) echo "checked"; ?> ></td></tr>
	<tr><td>Blacklist Level:</td><td><select name="blacklist_level">
		<option value="none">No blacklisting</option>
		<option value="reject_low" <?php if(isset($_REQUEST["blacklist_level"]) and $_REQUEST["blacklist_level"]=="reject_low") echo "selected"; ?>>Reject (Low)</option>
		<option value="reject_high" <?php if(isset($_REQUEST["blacklist_level"]) and $_REQUEST["blacklist_level"]=="reject_high") echo "selected"; ?>>Reject (High)</option>
		<option value="escape" <?php if(isset($_REQUEST["blacklist_level"]) and $_REQUEST["blacklist_level"]=="escape") echo "selected"; ?>>Escape</option>
		<option value="low" <?php if(isset($_REQUEST["blacklist_level"]) and $_REQUEST["blacklist_level"]=="low") echo "selected"; ?>>Remove (Low)</option>
		<option value="medium" <?php if(isset($_REQUEST["blacklist_level"]) and $_REQUEST["blacklist_level"]=="medium") echo "selected"; ?>>Remove (Medium)</option>
		<option value="high" <?php if(isset($_REQUEST["blacklist_level"]) and $_REQUEST["blacklist_level"]=="high") echo "selected"; ?>>Remove (High)</option>
	</select></td></tr>
	<tr><td>Blacklist Keywords (comma separated):</td><td><textarea name="blacklist_keywords"><?php if(isset($_REQUEST["blacklist_keywords"])) echo $_REQUEST["blacklist_keywords"]; ?></textarea></td></tr>
<tr><td><b>Environmental Settings:<b></td></tr>
	<tr><td>Random Failure?</td><td><input type="checkbox" name="random_failure"<?php echo isset($_REQUEST['random_failure']) ? ' checked' : '' ?>>
	<tr><td>Random Time Delay?</td><td><input type="checkbox" name="random_delay"<?php echo isset($_REQUEST['random_delay']) ? ' checked' : '' ?>>
<tr><td><b>Output Level:</b></td></tr>
	<tr><td>Output Query Results:</td><td><select name="query_results">
		<option value="all_rows">All rows</option>
		<option value="one_row" <?php if(isset($_REQUEST["query_results"]) and $_REQUEST["query_results"]=="one_row") echo "selected"; ?>>One row</option>
		<option value="bool" <?php if(isset($_REQUEST["query_results"]) and $_REQUEST["query_results"]=="bool") echo "selected"; ?>>Boolean (Zero/Non-zero result set)</option>
		<option value="none" <?php if(isset($_REQUEST["query_results"]) and $_REQUEST["query_results"]=="none") echo "selected"; ?>>No results</option>
	</select></td></tr>
	<tr><td>Error Verbosity:</td><td><select name="error_level">
		<option value="verbose">Verbose error messages</option>
		<option value="errors" <?php if(isset($_REQUEST["error_level"]) and $_REQUEST["error_level"]=="errors") echo "selected"; ?>>Generic error messages</option>
		<option value="none" <?php if(isset($_REQUEST["error_level"]) and $_REQUEST["error_level"]=="none") echo "selected"; ?>>No error messages</option>
	</select></td></tr>
	<tr><td>Show Query:</td><td><input type="checkbox" name="show_query" value="on" <?php if(isset($_REQUEST["show_query"])) echo "checked"; ?> ></td></tr>