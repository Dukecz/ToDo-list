<?php //netteCache[01]000389a:2:{s:4:"time";s:21:"0.22369200 1324305953";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:67:"/srv/http/nette/vhost-todolist/app/templates/Homepage/default.latte";i:2;i:1324305948;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f38d86f released on 2011-08-24";}}}?><?php

// source file: /srv/http/nette/vhost-todolist/app/templates/Homepage/default.latte

?><?php list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'kystrt1fe3')
;//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb823db7b06b_head')) { function _lb823db7b06b_head($_l, $_args) { extract($_args)
?>
<link rel="stylesheet" href="<?php echo htmlSpecialChars($basePath) ?>/css/style.css" type="text/css" />
<script src="../js/alphanumeric.js" type="text/javascript"></script>
<?php
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb0f5b6b8516_content')) { function _lb0f5b6b8516_content($_l, $_args) { extract($_args)
?>
<div id="wrapper">
<div id="container">
  <div id="topline">
    <?php echo Nette\Templating\DefaultHelpers::escapeHtml($title, ENT_NOQUOTES) ?>

  </div>
  <div id="header"><h1><?php echo Nette\Templating\DefaultHelpers::escapeHtml($loggedAs, ENT_NOQUOTES) ?></div>
  <div id="wrapper">
    <div id="content">
<?php if ($loggedAs != "Nepřihlášen"): $_ctrl = $control->getWidget("addTaskForm"); if ($_ctrl instanceof Nette\Application\UI\IPartiallyRenderable) $_ctrl->validateControl(); $_ctrl->render() ;else: $_ctrl = $control->getWidget("signInForm"); if ($_ctrl instanceof Nette\Application\UI\IPartiallyRenderable) $_ctrl->validateControl(); $_ctrl->render() ;endif ?>
    </div>
  </div>
  <div id="navigation">
    <p><strong>MENU</strong></p>
      <ul>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($menuItems) as $item => $link): ?>
      <li><a href="<?php echo Nette\Templating\DefaultHelpers::escapeHtml($control->link($link)) ?>
"><?php echo Nette\Templating\DefaultHelpers::escapeHtml($item, ENT_NOQUOTES) ?></a></li>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
      </ul>
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
