<?php
function createTemplateBase($base_path,$login_view,$menu_view,$slider_view,$content_view,$footer_view){
	$base=new Template($base_path."base.html");
	if(isLogged()){
		$login=new Template($base_path."user/".$login_view.".html");
		$login->setContent("USERNAME", $_SESSION['user']);
		$content=new Template($base_path."user/".$content_view.".html");
		$slider_view="";
	}
	else{
		$login=new Template($base_path.$login_view.".html");
		$content=new Template($base_path.$content_view.".html");
	}
	$menu=new Template($base_path.$menu_view.".html");
	if($slider_view!=""){
		$slider=new Template($base_path.$slider_view.".html");
		$base->setContent("SLIDER", $slider->get());	
	}
	
	$footer=new Template($base_path.$footer_view.".html");
	
	$base->setContent("LOGIN", $login->get());
	$base->setContent("MENU", $menu->get());
	$base->setContent("CONTENT", $content->get());
	$base->setContent("FOOTER", $footer->get());
	$base->close();
	
}

