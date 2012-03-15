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
	<title>SQLol - Challenge 5 - Blind Luck</title>
</head>
<body>
	<center><h1>SQLol - Challenge 5 - Blind Luck</h1></center><br>

	<hr width="40%">
	<hr width="60%">
	<hr width="40%">
	
You must perform a basic Blind SQL injection attack. Only an indication of whether the query returned results is available.<br>
<br>
Your objective is to find the table of social security numbers present in the database and extract its information.

<pre>
PARAMETERS:
Query Type - SELECT query
Injection Type - String value in WHERE clause
Method - POST
Sanitization - None
Output - Boolean results, no error messages
</pre>

<form action="../select.php" method="post" name="challenge_form">
	<input type="hidden" name="sanitize_quotes" value="none"/>
	<input type="hidden" name="spaces_remove" value="off"/>
	<input type="hidden" name="blacklist_level" value="none"/>
	<input type="hidden" name="query_results" value="bool"/>
	<input type="hidden" name="error_level" value="none"/>
	<input type="hidden" name="show_query" value="on"/>
	<input type="hidden" name="location" value="where_string"/>
	Injection String: <input type="text" name="inject_string"/><br>
	<input type="submit" name="submit" value="Inject!"/>
</form>
<br>
</body>
</html>