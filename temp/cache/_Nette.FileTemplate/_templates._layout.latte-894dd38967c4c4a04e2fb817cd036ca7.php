<?php //netteCache[01]000380a:2:{s:4:"time";s:21:"0.00400400 1325879723";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:58:"/srv/http/nette/vhost-todolist/app/templates/@layout.latte";i:2;i:1325879721;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f38d86f released on 2011-08-24";}}}?><?php

// source file: /srv/http/nette/vhost-todolist/app/templates/@layout.latte

?><?php list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'atqlumcqek')
;//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lbcfefba9184_head')) { function _lbcfefba9184_head($_l, $_args) { extract($_args)
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
extract(array('description' => 'Semestrální práce pro WA1.'), EXTR_SKIP) ;extract(array('keywords' => 'kruzimic, fel, čvut, java, programováni, php, html, css, js, ajax'), EXTR_SKIP) ;extract(array('robots' => 'index,follow'), EXTR_SKIP) ?>

<!DOCTYPE html>
<html lang="cs">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if (isset($description)): ?>
  	<meta name="Description" content="<?php echo htmlSpecialChars($description) ?>" />
<?php endif ?>
  	<meta name="Author" content="Michal 'Duke' Kruzik" />
<?php if (isset($keywords)): ?>
  	<meta name="keywords" content="<?php echo htmlSpecialChars($keywords) ?>" />
<?php endif ?>
  	<meta name="google-site-verification" content="xjIf4L7ECylgFBbEoH6BiQc09l7uLD5ixcrmeMxa7zo" />
<?php if (isset($robots)): ?>
		<meta name="robots" content="<?php echo htmlSpecialChars($robots) ?>" />
<?php endif ?>

		<title><?php echo Nette\Templating\DefaultHelpers::escapeHtml($title, ENT_NOQUOTES) ?></title>

		<link rel="stylesheet" media="screen,projection,tv" href="<?php echo htmlSpecialChars($basePath) ?>/css/style.css" type="text/css" />
		<link rel="stylesheet" media="print" href="<?php echo htmlSpecialChars($basePath) ?>/css/print.css" type="text/css" />
		<link rel="shortcut icon" href="<?php echo htmlSpecialChars($basePath) ?>/favicon.ico" type="image/x-icon" />
  	<script src="../js/netteForms.js" type="text/javascript"></script>

		<?php if (!$_l->extends) { call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars()); } ?>

	</head>

	<body>
		<div id="wrapper">
				<div id="topline">
					<?php echo Nette\Templating\DefaultHelpers::escapeHtml($title, ENT_NOQUOTES) ?>

				</div>
				<div id="header">
					<?php echo Nette\Templating\DefaultHelpers::escapeHtml($loggedAs, ENT_NOQUOTES) ?>

				</div>
					<div id="content">
<?php Nette\Latte\Macros\UIMacros::callBlock($_l, 'content', $template->getParams()) ?>
						</div>
				<div id="navigation">
					<p><strong>MENU</strong></p>
      		<ul>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($menuItems) as $item => $link): ?>
      		<li><a class="menubutton" href="<?php echo Nette\Templating\DefaultHelpers::escapeHtml($control->link($link)) ?>
"><?php echo Nette\Templating\DefaultHelpers::escapeHtml($item, ENT_NOQUOTES) ?></a></li>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
      		</ul>
				</div>
				<div id="footer">
					Created by Michal "kruzimic" Kružík
				</div>
				</div>
		</div>
	</body>
</html>
<?php 
// template extending support
if ($_l->extends) {
	ob_end_clean();
	Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
