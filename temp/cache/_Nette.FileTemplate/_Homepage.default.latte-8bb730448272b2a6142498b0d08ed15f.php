<?php //netteCache[01]000384a:2:{s:4:"time";s:21:"0.51849700 1323198308";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:62:"/srv/http/nette/ToDo-list/app/templates/Homepage/default.latte";i:2;i:1323198307;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f38d86f released on 2011-08-24";}}}?><?php

// source file: /srv/http/nette/ToDo-list/app/templates/Homepage/default.latte

?><?php list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '2yraoug74k')
;//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb2aec4c5e5c_head')) { function _lb2aec4c5e5c_head($_l, $_args) { extract($_args)
?>
<link rel="stylesheet" href="<?php echo htmlSpecialChars($basePath) ?>/css/style.css" type="text/css" />
<?php
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb79057c611b_content')) { function _lb79057c611b_content($_l, $_args) { extract($_args)
?>
<div id="wrapper">
<div id="container">
  <div id="topline">
    <?php echo Nette\Templating\DefaultHelpers::escapeHtml($title, ENT_NOQUOTES) ?>

  </div>
  <div id="header"><h1><?php echo Nette\Templating\DefaultHelpers::escapeHtml($loggedas, ENT_NOQUOTES) ?></div>
  <div id="wrapper">
    <div id="content">
      <?php echo Nette\Templating\DefaultHelpers::escapeHtml($content, ENT_NOQUOTES) ?>

    </div>
  </div>
  <div id="navigation">
    <p><strong>MENU</strong></p>
    <?php echo Nette\Templating\DefaultHelpers::escapeHtml($menu, ENT_NOQUOTES) ?>

  </div>
  <div id="extra"></div>
  <div id="footer"></div>
</div>
</div>
<?php
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
if (!$_l->extends) { call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars()); } ?>

<?php if (!$_l->extends) { call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()); }  
// template extending support
if ($_l->extends) {
	ob_end_clean();
	Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
