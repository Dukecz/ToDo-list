<?php //netteCache[01]000390a:2:{s:4:"time";s:21:"0.24953100 1325881703";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:68:"/srv/http/nette/vhost-todolist/app/templates/Homepage/category.latte";i:2;i:1325880810;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f38d86f released on 2011-08-24";}}}?><?php

// source file: /srv/http/nette/vhost-todolist/app/templates/Homepage/category.latte

?><?php list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'iy4agpcyly')
;//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb45ea176926_head')) { function _lb45ea176926_head($_l, $_args) { extract($_args)
;
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbe120457a6e_content')) { function _lbe120457a6e_content($_l, $_args) { extract($_args)
?>
	<div class="category">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($categoryList) as $row): ?>
			<a <?php if ($id == $row->idcategory): ?>class="current"<?php endif  ?> href="<?php echo Nette\Templating\DefaultHelpers::escapeHtml($control->link("category", array($row->idcategory))) ?>
"><?php echo Nette\Templating\DefaultHelpers::escapeHtml($row->name, ENT_NOQUOTES) ?></a>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
		<a href="<?php echo Nette\Templating\DefaultHelpers::escapeHtml($control->link("Homepage:default:")) ?>
">Vše</a>
	</div>
	<table class="center">
		<thead>
			<th>Name</th><th>Description</th><th>Deadline</th><th>Status</th><th>Priority</th><th colspan="2">Options</th>
		</thead>
		<tbody>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($tasks) as $row): ?>
				<tr><td><?php echo Nette\Templating\DefaultHelpers::escapeHtml($row->name, ENT_NOQUOTES) ?>
</td><td><?php echo Nette\Templating\DefaultHelpers::escapeHtml($row->description, ENT_NOQUOTES) ?>
</td><td><?php echo Nette\Templating\DefaultHelpers::escapeHtml($row->deadline, ENT_NOQUOTES) ?>
</td><td><?php echo Nette\Templating\DefaultHelpers::escapeHtml($row->status, ENT_NOQUOTES) ?>
</td><td><?php echo Nette\Templating\DefaultHelpers::escapeHtml($row->priority, ENT_NOQUOTES) ?>
</td><td><a href="<?php echo Nette\Templating\DefaultHelpers::escapeHtml($control->link("editTask", array($row->idtask))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/b_edit.png" alt="Edit Task" /></a></td><td><a href="<?php echo Nette\Templating\DefaultHelpers::escapeHtml($control->link("Homepage:default", array('deleteTask'=>$row->idtask))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/b_drop.png" alt="Delete Task" /></a></td></tr>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
		</tbody>
	</table>
<?php $_ctrl = $control->getWidget("vp"); if ($_ctrl instanceof Nette\Application\UI\IPartiallyRenderable) $_ctrl->validateControl(); $_ctrl->render() ;$_ctrl = $control->getWidget("addTaskForm"); if ($_ctrl instanceof Nette\Application\UI\IPartiallyRenderable) $_ctrl->validateControl(); $_ctrl->render() ;
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
