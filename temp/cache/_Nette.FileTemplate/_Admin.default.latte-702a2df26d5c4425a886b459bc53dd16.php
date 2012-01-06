<?php //netteCache[01]000386a:2:{s:4:"time";s:21:"0.07570000 1325880813";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:64:"/srv/http/nette/vhost-todolist/app/templates/Admin/default.latte";i:2;i:1325880776;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f38d86f released on 2011-08-24";}}}?><?php

// source file: /srv/http/nette/vhost-todolist/app/templates/Admin/default.latte

?><?php list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'ri5n164mzd')
;//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb0e4111e233_head')) { function _lb0e4111e233_head($_l, $_args) { extract($_args)
;
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb17d4094bc1_content')) { function _lb17d4094bc1_content($_l, $_args) { extract($_args)
?>
	<table class="center">
		<thead>
		<tr><th>Username</th><th>Role</th><th colspan="2">Options</th></tr>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($users) as $row): ?>
			<tr><td><?php echo Nette\Templating\DefaultHelpers::escapeHtml($row->username, ENT_NOQUOTES) ?>
</td><td><?php echo Nette\Templating\DefaultHelpers::escapeHtml($row->role, ENT_NOQUOTES) ?>
</td><td><a href="<?php echo Nette\Templating\DefaultHelpers::escapeHtml($control->link("editUser", array($row->iduser))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/b_edit.png" alt="Edit user" /></a></td><td><a href="<?php echo Nette\Templating\DefaultHelpers::escapeHtml($control->link("Admin:default", array('deleteUser'=>$row->iduser))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/b_drop.png" alt="Delete user" /></a></td></tr>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
		</thead>
	</table>
<?php $_ctrl = $control->getWidget("vp"); if ($_ctrl instanceof Nette\Application\UI\IPartiallyRenderable) $_ctrl->validateControl(); $_ctrl->render() ;
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
