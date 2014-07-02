<?php
	$node = $_GET["node"];
	$array =array('1','3','5','6','8');
?>
[
	{
		"isActive":false,
		"isFolder":true,
		"isExpanded":false,
		"isLazy":true,
		"iconUrl":null,
		"id":null,
		"href":null,
		"hrefTarget":null,
		"lazyUrl":null,
		"lazyUrlJson":null,
		"liClass":null,
		"text":"Lazy Folder <?php echo $node;?>",
		"textCss":null,
		"tooltip":null,
		"uiIcon":null,
		"children":null
	}<?php if(in_array($node,$array)) { ?>
	,{
		"isActive":false,
		"isFolder":true,
		"isExpanded":false,
		"isLazy":true,
		"iconUrl":null,
		"id":null,
		"href":null,
		"hrefTarget":null,
		"lazyUrl":null,
		"lazyUrlJson":null,
		"liClass":null,
		"text":"Lazy Folder <?php echo $node;?>_a",
		"textCss":null,
		"tooltip":null,
		"uiIcon":null,
		"children":null
	}<?php }; ?>,{
		"isActive":false,
		"isFolder":false,
		"isExpanded":false,
		"isLazy":false,
		"iconUrl":null,
		"id":null,
		"href":null,
		"hrefTarget":null,
		"lazyUrl":null,
		"lazyUrlJson":null,
		"liClass":null,
		"text":"Node<?php echo $node;?>",
		"textCss":null,
		"tooltip":null,
		"uiIcon":null,
		"children":null
	}
]