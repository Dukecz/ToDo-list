<?php //netteCache[01]000391a:2:{s:4:"time";s:21:"0.87350800 1325881543";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:69:"/srv/http/nette/vhost-todolist/app/templates/Categories/default.latte";i:2;i:1325880809;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f38d86f released on 2011-08-24";}}}?><?php

// source file: /srv/http/nette/vhost-todolist/app/templates/Categories/default.latte

?><?php list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'wbrxza2su2')
;//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb23cc5a55f8_head')) { function _lb23cc5a55f8_head($_l, $_args) { extract($_args)
;
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbe80b1a2163_content')) { function _lbe80b1a2163_content($_l, $_args) { extract($_args)
?>
			<?php if (isset($error)): ?><p class="error"><?php echo Nette\Templating\DefaultHelpers::escapeHtml($error, ENT_NOQUOTES) ?>
</p><?php endif ?>

			<table class="center">
				<thead>
      		<tr><th>Name</th><th colspan="2">Options</th></tr>
				</thead>
				<tbody>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($categories) as $row): ?>
      			<tr><td><?php echo Nette\Templating\DefaultHelpers::escapeHtml($row->name, ENT_NOQUOTES) ?>
</td><td><a href="<?php echo Nette\Templating\DefaultHelpers::escapeHtml($control->link("editCategory", array($row->idcategory))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/b_edit.png" alt="Edit Category" /></a></td><td><a href="<?php echo Nette\Templating\DefaultHelpers::escapeHtml($control->link("Categories:default", array('deleteCategory'=>$row->idcategory))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/b_drop.png" alt="Delete Category" /></a></td></tr>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
				</tbody>
			</table>
<?php $_ctrl = $control->getWidget("vp"); if ($_ctrl instanceof Nette\Application\UI\IPartiallyRenderable) $_ctrl->validateControl(); $_ctrl->render() ;$_ctrl = $control->getWidget("addCategoryForm"); if ($_ctrl instanceof Nette\Application\UI\IPartiallyRenderable) $_ctrl->validateControl(); $_ctrl->render() ;
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
