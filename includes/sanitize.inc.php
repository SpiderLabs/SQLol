<?php

if(isset($_REQUEST['submit'])){ //Injection time!	
	
	//Double up single-quotes if requested
	if(isset($_REQUEST['quotes_double']) and $_REQUEST['quotes_double'] == 'on') $_REQUEST['inject_string'] = str_replace('\'', '\'\'', $_REQUEST['inject_string']);
	
	//Parse blacklist
	if(isset($_REQUEST['blacklist_keywords'])){
		$blacklist = explode(',' , $_REQUEST['blacklist_keywords']);
	}
	
	if(isset($_REQUEST['blacklist_level'])){
		switch($_REQUEST['blacklist_level']){
			//We process blacklists differently at each level. At the lowest, each keyword is removed case-sensitively.
			//At medium blacklisting, checks are done case-insensitively.
			//At the highest level, checks are done case-insensitively and repeatedly.
			
			case 'reject_low':
				foreach($blacklist as $keyword){
					if(strstr($_REQUEST['inject_string'], $keyword)!='') {
						die("\nBlacklist was triggered!");
					}
				}
				break;
			case 'reject_high':
				foreach($blacklist as $keyword){
					if(strstr(strtolower($_REQUEST['inject_string']), strtolower($keyword))!='') {
						die('Blacklist was triggered!');
					}
				}
				break;
			case 'escape':
				foreach($blacklist as $keyword){
					$_REQUEST['inject_string'] = str_replace($keyword, '\\'.$keyword, $_REQUEST['inject_string']);
				}
				break;
			case 'low':
				foreach($blacklist as $keyword){
					$_REQUEST['inject_string'] = str_replace($keyword, '', $_REQUEST['inject_string']);
				}
				break;
			case 'medium':
				foreach($blacklist as $keyword){
					$_REQUEST['inject_string'] = str_replace(strtolower($keyword), '', strtolower($_REQUEST['inject_string']));
				}
				break;
			case 'high':
				do{
					$keyword_found = 0;
					foreach($blacklist as $keyword){
						$_REQUEST['inject_string'] = str_replace(strtolower($keyword), '', strtolower($_REQUEST['inject_string']), $count);
						$keyword_found += $count;
					}	
				}while ($keyword_found);
				break;
			
		}
	}
}

?>