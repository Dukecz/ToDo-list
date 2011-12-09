<?php //netteCache[01]000380a:2:{s:4:"time";s:21:"0.34691900 1322860712";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:58:"/srv/http/nette/sandbox/app/templates/Rozvrh/default.latte";i:2;i:1322860710;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f38d86f released on 2011-08-24";}}}?><?php

// source file: /srv/http/nette/sandbox/app/templates/Rozvrh/default.latte

?><?php list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'v2owvrzg2s')
;//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb3cc9995e48_head')) { function _lb3cc9995e48_head($_l, $_args) { extract($_args)
?>
<link rel="stylesheet" media="screen,projection,tv" href="<?php echo htmlSpecialChars($basePath) ?>/css/rozvrh.css" type="text/css" />
<?php
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb799971e6ce_content')) { function _lb799971e6ce_content($_l, $_args) { extract($_args)
?>
<div id="timetable">
  <div class="header">Zimní semestr 2011 / 2012</div>
	<div class="lessons">

		<div class="lesson">1<span class="time">07:30</span></div>
		<div class="lesson">2<span class="time">08:15</span></div>
		<div class="lesson">3<span class="time">09:15</span></div>
		<div class="lesson">4<span class="time">10:00</span></div>
		<div class="lesson">5<span class="time">11:00</span></div>

		<div class="lesson">6<span class="time">11:45</span></div>
		<div class="lesson">7<span class="time">12:45</span></div>
		<div class="lesson">8<span class="time">13:30</span></div>
		<div class="lesson">9<span class="time">14:30</span></div>
		<div class="lesson">10<span class="time">15:15</span></div>

		<div class="lesson">11<span class="time">16:15</span></div>
		<div class="lesson">12<span class="time">17:00</span></div>
		<div class="lesson">13<span class="time">18:00</span></div>
		<div class="lesson">14<span class="time">18:45</span></div>
	</div>

	<div class="day">
		<div class="dayName">Po</div>
		<div class="subjects">
			<div class="subject exercise fifth">OPT<span class="teacher">J. Heller</span><span class="where">KN:E-132</span></div>
			
			<div class="subject exercise eleventh">HI1<span class="teacher">M. Josefovičová</span><span class="where">T2:A4-205</span></div>
			
			<div class="subject lecture thirteenth">WA1<span class="teacher">M. Klíma</span><span class="where">T2:D3-309</span></div>
		</div>
	</div>
	<div class="day">
		<div class="dayName">Út</div>
		<div class="subjects">
			<div class="subject lecture third">PSI<span class="teacher">M. Navara</span><span class="where">T2:D3-209</span></div>
			
			<div class="subject lecture seventh">OPT<span class="teacher">T. Werner,  V. Franc</span><span class="where">T2:C3-340</span></div>
			<div class="subject exercise ninth">WA1<span class="teacher">M. Macík</span><span class="where">KN:E-310</span></div>
			<div class="subject exercise eleventh">PAP<span class="teacher">F. Šejnost</span><span class="where">T2:C3-52</span></div>
			<div class="subject lecture thirteenth">HI1<span class="teacher">M. Josefovičová</span><span class="where">T2:C3-54</span></div>
		</div>
	</div>
	<div class="day">
		<div class="dayName">St</div>
		<div class="subjects">
			<div class="subject lecture third">PSI<span class="teacher">M. Navara</span><span class="where">KN:E-107</span></div>
			<div class="subject exercise eleventh">PSI<span class="teacher">L. Nentvich</span><span class="where">T2:C3-54</span></div>
			<div class="subject exercise thirteenth">CCNA2<span class="teacher">Srnová</span><span class="where">Bubenečská kolej</span></div>
		</div>
	</div>
	<div class="day">
		<div class="dayName">Čt</div>
		<div class="subjects">
		</div>
	</div>

	<div class="day">
		<div class="dayName">Pá</div>
		<div class="subjects">
		  <div class="subject lecture third">OPT<span class="teacher">T. Werner,  V. Franc</span><span class="where">KN:E-301</span></div>
		</div>
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

<?php if (!$_l->extends) { call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()); } ?>

<?php 
// template extending support
if ($_l->extends) {
	ob_end_clean();
	Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
