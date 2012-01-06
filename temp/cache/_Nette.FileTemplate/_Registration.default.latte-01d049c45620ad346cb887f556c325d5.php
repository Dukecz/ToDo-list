<?php //netteCache[01]000393a:2:{s:4:"time";s:21:"0.27558000 1325875886";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:71:"/srv/http/nette/vhost-todolist/app/templates/Registration/default.latte";i:2;i:1325875799;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f38d86f released on 2011-08-24";}}}?><?php

// source file: /srv/http/nette/vhost-todolist/app/templates/Registration/default.latte

?><?php list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '7cauvob4zm')
;//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lbea93d5acd6_head')) { function _lbea93d5acd6_head($_l, $_args) { extract($_args)
;
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbc1ad46ca8d_content')) { function _lbc1ad46ca8d_content($_l, $_args) { extract($_args)
?>
<div id="wrapper">
<div id="container">
  <div id="topline">
    <?php echo Nette\Templating\DefaultHelpers::escapeHtml($title, ENT_NOQUOTES) ?>

  </div>
  <div id="header"><h1><?php echo Nette\Templating\DefaultHelpers::escapeHtml($loggedAs, ENT_NOQUOTES) ?></div>
  <div id="wrapper">
    <div id="content">
<?php $form = $control["registerForm"]; echo $form->getElementPrototype()->addAttributes(array())->startTag() ;if ($form->hasErrors()): ?>
			<ul class="errors">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($form->errors) as $error): ?>
        <li><?php echo Nette\Templating\DefaultHelpers::escapeHtml($error, ENT_NOQUOTES) ?></li>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
			</ul>
<?php endif ?>
			<table>
				<tr class="required">
    			<th><?php if ($_label = $form["username"]->getLabel()) echo $_label->addAttributes(array()) ?></th>
    			<td><?php echo $form["username"]->getControl()->addAttributes(array()) ?></td><td id=result></td>
				</tr>
				<tr class="required">
    			<th><?php if ($_label = $form["password"]->getLabel()) echo $_label->addAttributes(array()) ?></th>
    			<td><?php echo $form["password"]->getControl()->addAttributes(array()) ?></td>
				</tr>
				<tr>
				<th>&nbsp;</th>
				<td><?php echo $form["send"]->getControl()->addAttributes(array()) ?></td>
				</table>
<div><?php
foreach ($form->getComponents(TRUE, 'Nette\Forms\Controls\HiddenField') as $_tmp) echo $_tmp->getControl();
if (iterator_count($form->getComponents(TRUE, 'Nette\Forms\Controls\TextInput')) < 2) echo "<!--[if IE]><input type=IEbug disabled style=\"display:none\"><![endif]-->"
?></div>
<?php echo $form->getElementPrototype()->endTag() ?>
			<script src="<?php echo htmlSpecialChars($basePath) ?>/js/usernameTest.js" type="text/javascript"></script>
    </div>
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
