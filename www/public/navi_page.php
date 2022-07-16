﻿<?php
/**列表框(分页页码)导航条**/
class navigate_page{
	var $url;
	var $num;
	var $pageval;
	var $pagesize;
	var $lastpage;
	function navigate_page($url,$num,$npage=1,$size=8) {
		$this->url=$url;
		$this->num=$num;
		$this->pageval=$npage;
		$this->pagesize=$size;
	}
	function getlimit() {
	$page=($this->pageval-1)*$this->pagesize;
	$page.=',';
	return $page;
	}
	function geturl()
	{
	$url=$_SERVER["PHP_SELF"];//取得当前路径地址
//	$this->url=basename($url);
	return $url;
	}
	function show_page(){
//	$this->geturl();  $this->url.="?";
	if($this->pageval<=1) $this->pageval=1;//  echo $this->url."<br>";  echo $this->geturl()."<br>";
	$this->url=$this->geturl().$this->url;
	$this->lastpage = ceil($this->num/$this->pagesize); //最后页，也是总页
	$pre = $this->pageval -1; //上一页
	$next = $this->pageval +1; //下一页
	//开始分页导航条代码
	//$this->pagenav =  "&nbsp第".$this->pageval."页&nbsp";
	$pagenav = "<a>当前是第".$this->pageval."页</a>";
	$pagenav .= "&nbsp<a href=".$this->url."page=1>首页</a> ";
	if ($pre>0)
		$pagenav .= " <a href='".$this->url."page=".$pre."'>上一页</a> ";
	else
		$pagenav .= " 上一页 ";
	if($this->lastpage>7) {
		for($i=0; $i<3; $i++) $pagenav .="<a href=".$this->url."page=".($i+1).">".($i+1)."</a> ";
		$halfpage = ceil($this->lastpage/2);
		if($halfpage>4)  $pagenav .= "..";
		$pagenav .="<a href=".$this->url."page=".$halfpage.">".$halfpage."</a> ";
		$pagenav .= "..";
		for($i=$this->lastpage-2; $i<=$this->lastpage; $i++) $pagenav .="<a href=".$this->url."page=".$i.">".$i."</a> ";
	} else {
		for($i=1; $i<=$this->lastpage; $i++) $pagenav .="<a href=".$this->url."page=".$i.">".$i."</a> ";
	}
	if ($next<=$this->lastpage)
		$pagenav .= " <a href=".$this->url."page=".$next.">下一页</a> ";
	else
		$pagenav .= "下一页";
	$pagenav .= " <a href=".$this->url."page=".$this->lastpage.">尾页</a> ";
	$pagenav .= "<a>共".$this->lastpage."页</a>";
	//显示分页文字
	echo $pagenav;
	}
}
?>
