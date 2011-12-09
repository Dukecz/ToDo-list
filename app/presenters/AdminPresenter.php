<?php

/**
 * Homepage presenter.
 *
 * @author     Duke
 * @package    MyApplication
 */
class AdminPresenter extends BasePresenter

{
  function gen_uptime($time = 0){
    $days = (int)floor($time/86400);
    $hours = (int)floor($time/3600)%24;
    $minutes = (int)floor($time/60)%60;
    $seconds = (int)floor($time/1)%60;

    if($days==1) { $uptime = "$days day, "; } else if($days>1) { $uptime = "$days days, "; }
    if($hours==1) { $uptime .= "$hours hour"; } else if($hours>1) { $uptime .= "$hours hours"; }
    /*if($uptime && $minutes>0 && $seconds>0) { $uptime .= ", "; } else */if($uptime && $minutes>0 /*& $seconds==0*/) { $uptime .= " and "; }
    ($minutes>0) ? $uptime .= "$minutes minute" . ( ($minutes>1) ? "s" : NULL ) : NULL;

    return $uptime;
}
	
  
  public function renderDefault()
	{
	  $this->template->description =  "Dukeho osobní stránky.";
	  $this->template->keywords =  "duke, fel, čvut, java, programováni, php, html, teamspeak";
	  $this->template->title =  "duke.dynalias.com";
	  $this->template->robots =  "index,follow";
	
    $spojeni = mysql_connect("localhost","root","Duken0210");
    mysql_query('SET CHARACTER SET utf8', $spojeni);

    $row = mysql_fetch_array(mysql_query("SHOW STATUS LIKE '%uptime%'"));
    
    $this->template->topline = "Server Uptime: " . $this->gen_uptime($row['Value']);
    
    
	}
}
