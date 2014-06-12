$(document).ready(function(){
	filter();
});
function addSearch(){
	var visibleSearch=document.getElementById("visibleSearch");
	var search=document.getElementById("search");
	search.value=visibleSearch.value;
	$('#page').val('1');
	filter();
}

function addRole(val){
	if($("#role").val()==val){
		$("#role").val('');
	}
	else{
		$("#role").val(val);
	}
	$('#page').val('1');
	$('#roleList li a').css("font-weight", "normal");
	if($("#role").val()!='')el=document.getElementById(val).style.fontWeight="bold";
	filter();
}

function addTeam(val){
	if($("#team").val()==val){
		$("#team").val('');
	}
	else{
		$("#team").val(val);
	}
	$('#page').val('1');
	$('#teamList li a').removeClass("selected");
	if($("#team").val()!='')
		$("#"+val+"_a").addClass("selected");

	filter();
}
function addOrder(item){
	
	$('#page').val('1');
	var itemSort = document.getElementById('itemSort');
	if(itemSort.value!=''){
		if(itemSort.value==item){
			var dirSort = document.getElementById('dirSort');
			if(dirSort.value=='' || dirSort.value=='desc'){
				$("#dirSort").val('asc');
			}
			else{
				$("#dirSort").val('desc');
			}
		}
		else{
			$("#itemSort").val(item);
			$("#dirSort").val('asc');
		}
	}
	else{
		$("#itemSort").val(item);
		$("#dirSort").val('asc');
	}	
	var dirSort = document.getElementById('dirSort');
	var itemSort = document.getElementById('itemSort');
	if(itemSort.value=='g.cognome'){
		$('#squadra i').removeClass("icon-up-dir");
		$('#squadra i').removeClass("icon-down-dir");
		$('#quotazione i').removeClass("icon-up-dir");
		$('#quotazione i').removeClass("icon-down-dir");
		if(dirSort.value=='asc'){
			$('#nome i').removeClass("icon-up-dir");
			$('#nome i').addClass("icon-down-dir");
			
		}
		else{
			$('#nome i').removeClass("icon-down-dir");
			$('#nome i').addClass("icon-up-dir");
			
		}
	}
	else{
		if(itemSort.value=='s.nome'){
			$('#nome i').removeClass("icon-up-dir");
			$('#nome i').removeClass("icon-down-dir");
			$('#quotazione i').removeClass("icon-up-dir");
			$('#quotazione i').removeClass("icon-down-dir");
			if(dirSort.value=='asc'){
				$('#squadra i').removeClass("icon-up-dir");
				$('#squadra i').addClass("icon-down-dir");
				
			}
			else{
				$('#squadra i').removeClass("icon-down-dir");
				$('#squadra i').addClass("icon-up-dir");
				
			}
		}
		else{
			$('#nome i').removeClass("icon-up-dir");
			$('#nome i').removeClass("icon-down-dir");
			$('#squadra i').removeClass("icon-up-dir");
			$('#squadra i').removeClass("icon-down-dir");
			if(dirSort.value=='asc'){
				$('#quotazione i').removeClass("icon-up-dir");
				$('#quotazione i').addClass("icon-down-dir");
				
			}
			else{
				$('#quotazione i').removeClass("icon-down-dir");
				$('#quotazione i').addClass("icon-up-dir");
				
			}
		}
	}
	filter();
}
function setPage(page){
	$('#page').val(page);
	filter();
}
function pagesCounter(itemsNumber){
	var pages;
	var itemsForPage=$('#itemsForPage').val();
	var mod = itemsNumber%itemsForPage;
	if(mod==0){
		pages=itemsNumber/itemsForPage;
	}
	else{
		pages=(itemsNumber-mod)/itemsForPage+1;
	}
	return pages;
}
function pager(itemsNumber){
	var pages = pagesCounter(itemsNumber);
	var page=$('#page').val();
	//alert(pages);
	var prev="";
	var next="";
	var html="<ul>";
	var pagerHtml="";
	if(pages==0){
		html+="";
	}
	else{
		if(pages==1){
			pagerHtml+='<li id="page1"><a href="javascript:setPage(1)">1</a></li>';
			html+=pagerHtml;
		}
		else{
			if(pages>5){
				if((parseInt(page)-2)>1){
					if(parseInt(page)+2<=parseInt(pages)){
						for(var i = parseInt(page)-2;i<=parseInt(page)+2;i++){
							pagerHtml+='<li id="page'+i+'"><a href="javascript:setPage('+i+')">'+i+'</a></li>';
						}
					}
					else{
						for(var i = pages-4;i<=pages;i++){
							pagerHtml+='<li id="page'+i+'"><a href="javascript:setPage('+i+')">'+i+'</a></li>';
						}
					}
				}
				else{
					for(var i = 1;i<=5;i++){
						pagerHtml+='<li id="page'+i+'"><a href="javascript:setPage('+i+')">'+i+'</a></li>';
					}
				}
			}
			else{
				for(var i = 1;i<=pages;i++){
					pagerHtml+='<li id="page'+i+'"><a href="javascript:setPage('+i+')">'+i+'</a></li>';
				}
			}
			var nextPage=1+parseInt(page);
			next='<li><a href="javascript:setPage('+ nextPage +')">>></a></li>';
			if(page==1){
				html+=pagerHtml+next;
			}
			else{
				var prevPage=parseInt(page)-1;
				prev='<li><a href="javascript:setPage('+prevPage+')"><<</a></li>';
				if(page==pages){
					html+=prev+pagerHtml;
				}
				else{
					html+=prev+pagerHtml+next;
				}
			}
		}
	}
	 return html+'</ul>';
}
function filter(){
	var dataForm = $("#filterDataForm").serialize();
	var loadImage='<img src="../resources/superweb/images/loading.gif"/>';
	$("#result_list").html(loadImage);
	$.ajax({
		url:'findAllPlayers.php',
		type:'POST',
		dataType:'json',
		data:dataForm,
		success:function(data){
			var html = "";
			var players=data.items;
			if(players.length==0){
				html+='<tr><td colspan="3">Non ci sono giocatori con questi parametri</td></tr>';
			}
			else{
				for(var i = 0; i < players.length; i++){
					var color='';
				if(players[i].ruolo=='por'){
					color+='portiere';
				}
				else{
					if(players[i].ruolo=='dif'){
						color+='difensore';
					}
					else{
						if(players[i].ruolo=='cen'){
							color+='centrocampista';
						}
						else{
							color+='attaccante';
						}
					}
				}
				html+='<tr class="'+color+'">'+
				//'<td id="'+players[i].id+'_role" style="display:none;">'+players[i].ruolo+'</td>'+
				'<td><a id="'+players[i].id+'_name" href="javascript:addPlayer('+players[i].id+',\''+players[i].ruolo+'\');">'+players[i].cognome+' '+players[i].nome+'</a></td>'+
				'<td>'+players[i].squadra+'</td>'+
				'<td>'+players[i].quotazione+'</td></tr>';
				}
			}
			$('#result_list').html(html);
			var pagerHtml=pager(data.totalItems);
			$('#pagination').html(pagerHtml);
			var pageCurrent = $('#page').val();
			$('#page'+pageCurrent).addClass('active');
			$('#counter').html(+data.totalItems+" giocatori in "+pagesCounter(data.totalItems)+" pagine");
		  }
	});
}
var porCounter=0;
var difCounter=0;
var cenCounter=0;
var attCounter=0;

function addPlayer(id,role){
	var rosa=$("#rosa_text").html();
	if(rosa.search(","+id+",")!=-1){
		alert("Giocatore già inserito");
		return;
	}
	switch (role) {
	case 'por':
		if(porCounter==3){
			alert("Ruolo Portieri pieno");
			return;
		}
		porCounter+=1;
		break;
	case 'dif':
		if(difCounter==8){
			alert("Ruolo Difensori pieno");
			return;
		}
		difCounter+=1;
		break;
	case 'cen':
		if(cenCounter==8){
			alert("Ruolo Centrocampisti pieno");
			return;
		}
		cenCounter+=1;
		break;
	case 'att':
		if(attCounter==6){
			alert("Ruolo Attaccanti pieno");
			return;
		}
		attCounter+=1;
		break;
	}
	$("#rosa_text").append(id+',');
	var name=$("#"+id+"_name").html();
	var id_li=role+id;
	var html="<li id='"+id_li+"'><a href=\"javascript:removePlayer("+id+",'"+role+"');\">"+name+"</a></li>";
	$("#"+role+"_list").append(html);
	
}
function removePlayer(id,role){
	switch (role) {
	case 'por':
		porCounter-=1;
		break;
	case 'dif':
		difCounter-=1;
		break;
	case 'cen':
		cenCounter-=1;
		break;
	case 'att':
		attCounter-=1;
		break;
	}
	$("#"+role+id).remove()
	var rosa=$("#rosa_text").html();
	var newHtml=rosa.replace(id+",","");
	$("#rosa_text").html(newHtml);
}