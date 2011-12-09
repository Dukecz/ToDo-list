<?php //netteCache[01]000375a:2:{s:4:"time";s:21:"0.84462000 1323196949";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:53:"/srv/http/nette/ToDo-list/app/templates/@layout.latte";i:2;i:1323195345;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f38d86f released on 2011-08-24";}}}?><?php

// source file: /srv/http/nette/ToDo-list/app/templates/@layout.latte

?><?php list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'za2g9ja3io')
;//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb86cb0843cb_head')) { function _lb86cb0843cb_head($_l, $_args) { extract($_args)
;
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extends) ? FALSE : $template->_extends; unset($_extends, $template->_extends);


if ($_l->extends) {
	ob_start();
} elseif (!empty($control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
  <meta name="language" content="cs" />
<?php if (isset($description)): ?>
  <meta name="Description" content="<?php echo htmlSpecialChars($description) ?>" />
<?php endif ?>
  <meta name="Author" content="Michal 'Duke' Kruzik" />
<?php if (isset($robots)): ?>
  <meta name="keywords" content="<?php echo htmlSpecialChars($keywords) ?>" />
<?php endif ?>
  <meta name="google-site-verification" content="xjIf4L7ECylgFBbEoH6BiQc09l7uLD5ixcrmeMxa7zo" />
<?php if (isset($robots)): ?>
	<meta name="robots" content="<?php echo htmlSpecialChars($robots) ?>" />
<?php endif ?>

	<title><?php echo Nette\Templating\DefaultHelpers::escapeHtml($title, ENT_NOQUOTES) ?></title>

	<!--<link rel="stylesheet" media="screen,projection,tv" href="<?php echo Nette\Templating\DefaultHelpers::escapeHtmlComment($basePath) ?>/css/screen.css" type="text/css">-->
	<!--<link rel="stylesheet" media="print" href="<?php echo Nette\Templating\DefaultHelpers::escapeHtmlComment($basePath) ?>/css/print.css" type="text/css">-->
	<link rel="shortcut icon" href="<?php echo htmlSpecialChars($basePath) ?>/favicon.ico" type="image/x-icon" />

	<?php if (!$_l->extends) { call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars()); } ?>

</head>

<body>
<?php Nette\Latte\Macros\UIMacros::callBlock($_l, 'content', $template->getParams()) ?>
</body>
</html>
<?php 
// template extending support
if ($_l->extends) {
	ob_end_clean();
	Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
