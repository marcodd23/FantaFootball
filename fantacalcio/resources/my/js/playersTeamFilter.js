$(document).ready(function(){
	filter();
	addModule('1', 1, 4, 4, 2,1 , 2, 2, 2);
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
		url:'findAllPlayersTeam.php',
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
var por_rCounter=0;
var dif_rCounter=0;
var cen_rCounter=0;
var att_rCounter=0;
var totPor;
var totDif;
var totCen;
var totAtt;
var totPor_r;
var totDif_r;
var totCen_r;
var totAtt_r;

function addModule(val,por,dif,cen,att,por_r,dif_r,cen_r,att_r){
	totPor=por;
	totDif = dif;
	totCen = cen;
	totAtt = att;
	totPor_r = por_r;
	totDif_r = dif_r;
	totCen_r=cen_r;
	totAtt_r=att_r;

	for(i=0;i<=porCounter-por;i++){
		var id_li=$("#por_list li:nth-child("+porCounter+")").attr("id");
		var id=id_li.substring(3);
		removePlayer(id,'por')
	}
	for(i=0;i<=difCounter-dif;i++){
		var id_li=$("#dif_list li:nth-child("+difCounter+")").attr("id");
		var id=id_li.substring(3);
		removePlayer(id,'dif')
	}
	for(i=0;i<=cenCounter-dif;i++){
		var id_li=$("#cen_list li:nth-child("+cenCounter+")").attr("id");
		var id=id_li.substring(3);
		removePlayer(id,'cen')
	}
	for(i=0;i<=attCounter-dif;i++){
		var id_li=$("#att_list li:nth-child("+attCounter+")").attr("id");
		var id=id_li.substring(3);
		removePlayer(id,'att')
	}
	if($("#module").val()==val){
		$("#module").val('');
	}
	else{
		$("#module").val(val);
	}
	$('#page').val('1');
	$('#moduleList li a').removeClass("selected");
	if($("#module").val()!='')
		$("#"+val+"_a").addClass("selected");

	//filter();
}

function addPlayer(id,role){
	//alert(porCounter+" "+totPor);
	//alert(por_rCounter+" "+totPor_r);
	var rosa=$("#rosa_text").html();
	var riserve=$("#riserve_text").html();
	//alert(rosa);
	if(rosa.search(","+id+",")!=-1||riserve.search(","+id+",")!=-1){
		alert("Giocatore già inserito");
		return;
	}
	switch (role) {
	case 'por':
		if(porCounter==totPor){
			if(por_rCounter==totPor_r){
				alert("Ruolo Portieri pieno");
				return;
			}
			else{
				por_rCounter+=1;
				role+="_r"
			}
		}
		else porCounter+=1;
		break;
	case 'dif':
		if(difCounter==totDif){
			if(dif_rCounter==totDif_r){
				alert("Ruolo Difensori pieno");
				return;
			}
			else{
				dif_rCounter+=1;
				role+="_r"
			}
		}
		else difCounter+=1;
		break;
	case 'cen':
		if(cenCounter==totCen){
			if(cen_rCounter==totCen_r){
				alert("Ruolo Centrocampisti pieno");
				return;
			}
			else{
				cen_rCounter+=1;
				role+="_r"
			}
		}
		else cenCounter+=1;
		break;
	case 'att':
		if(attCounter==totAtt){
			if(att_rCounter==totAtt_r){
				alert("Ruolo Attaccanti pieno");
				return;
			}
			else{
				att_rCounter+=1;
				role+="_r"
			}
		}
		else attCounter+=1;
		break;
	}
	if(role.length>3)$("#riserve_text").append(id+',');
	else $("#rosa_text").append(id+',');
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
	case 'por_r':
		por_rCounter-=1;
		break;
	case 'dif_r':
		dif_rCounter-=1;
		break;
	case 'cen_r':
		cen_rCounter-=1;
		break;
	case 'att_r':
		att_rCounter-=1;
		break;
	}
	$("#"+role+id).remove()
	if(role.length>3)type="riserve";
	else type="rosa";
	var rosa=$("#"+type+"_text").html();
	var newHtml=rosa.replace(id+",","");
	$("#"+type+"_text").html(newHtml);
}