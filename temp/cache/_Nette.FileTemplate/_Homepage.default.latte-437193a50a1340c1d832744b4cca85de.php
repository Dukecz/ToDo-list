<?php //netteCache[01]000384a:2:{s:4:"time";s:21:"0.35712800 1322869279";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:62:"/srv/http/nette/vhost-www/app/templates/Homepage/default.latte";i:2;i:1322860916;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f38d86f released on 2011-08-24";}}}?><?php

// source file: /srv/http/nette/vhost-www/app/templates/Homepage/default.latte

?><?php list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '2bln1dzswy')
;//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lbc6af911302_head')) { function _lbc6af911302_head($_l, $_args) { extract($_args)
?>
<link rel="stylesheet" href="<?php echo htmlSpecialChars($basePath) ?>/css/styles.css" type="text/css" />
<?php
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb45963397bd_content')) { function _lb45963397bd_content($_l, $_args) { extract($_args)
?>
<div id="wrapper">
<div id="container">
  <div id="topline">
    <?php echo Nette\Templating\DefaultHelpers::escapeHtml($topline, ENT_NOQUOTES) ?>

  </div>
  <div id="header"><h1>Rozcestník na Duke.dynalias.com</h1></div>
  <div id="wrapper">
    <div id="content">
      <p>Vítejte na mých osobních stránkách obsahujících něco málo, co jsem byl ochoten narvat na net.<br />
      Jako vedlejší aktivitu píšu weby za použití PHP/MySQL a v rámci školy programuji Java/C aplikace.</p>
      <p>
      Kontakt:<br />
      jabber: stukov@isgeek.info <img src="http://status.isgeek.info/stukov/bulb/" alt="" /><br />
      </p>
      <p>Hosting Terraria server on port 7777<br />
      For more info, use im contacts on this page.</p>
      <br />
      <a href="./uploaded/large.png" target="_blank" title="Terraria map">World map</a>
      <br />
      <img src="/images/Terraria1.png" alt="terraria server" title="terraria server" border="0" />
    </div>
  </div>
  <div id="navigation">
    <p><strong>MENU</strong></p>
      <p><a class="button" href="./">Index</a></p>
      <p><a class="button" href="./ajaxplorer/">Ajaxplorer: FEL files & FTP</a></p>
      <p><a class="button" href="./fyzika/" target="_blank">Java-semestrálka</a></p>
      <p><a class="button" href="./rozvrh/">Rozvrh</a></p>
      <p><a class="button" href="#">Přihlášení</a></p>
  </div>
  <div id="extra">
    <iframe src="http://cache.www.gametracker.com/components/html0/?host=80.243.108.46:9987&bgColor=373E28&fontColor=D2E1B5&titleBgColor=2E3225&titleColor=FFFFFF&borderColor=3E4433&linkColor=889C63&borderLinkColor=828E6B&showMap=0&currentPlayersHeight=160&showCurrPlayers=1&showTopPlayers=0&showBlogs=0&width=240" frameborder="0" scrolling="no" width="240" height="348"></iframe>
  </div>
  <div id="footer">
    <a href="http://czech-148533849376.spampoison.com"><img src="http://pics4.inxhost.com/images/sticker.gif" border="0" width="80" height="15" alt="Spampoison" /></a>
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
