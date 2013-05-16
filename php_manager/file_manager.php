<html>
<head>
	  
  <script src="php_manager/javascript/jquery.js"></script>
  <script src="php_manager/javascript/functions.js"></script>
  
	<link rel="stylesheet" href="php_manager/style/style.css"  type="text/css" />  
</head>

<body style="background:#FFFFDF;">

	<div class="header">
	ceva
	</div>
	<div class="content" style="margin-left:10px;">
	<center><BR>
		<table cellpadding=0 cellspacing=0 border=0>
			<tr>
				<td class="left_up"><div style="width:1px;height:1px;"><!--kkt de html prost--></td>
				<td class="middle_up"><div style="width:1px;height:1px;"></td>
				<td class="right_up"></td>
			</tr>
			<tr>
				<td class="middle" style="" colspan=3>
				<!-- ----------------------------------THIS IS CONTENT-->
				<table>
					<tr>
						<td>
						<div style="font-family:arial;font-size:10pt;color:white;font-weight:bold;margin-top:-5px;margin-left:10px;margin-bottom:10px;">Path \ to \ folder</div>
						<iframe src="php_manager/direct.php?thumbs=1" width="450" height="500" name="1" id="1" ></iframe>
						</td>
						<td>
						<div style="font-family:arial;font-size:10pt;color:white;font-weight:bold;margin-top:-5px;margin-left:10px;margin-bottom:10px;">Path \ to \ folder</div>
						<iframe src="php_manager/direct.php" width="450" height="500" name="2" id="2" ></iframe>
						</td>
					</tr>
				</table>
				<!-- -----------------------------/////THIS IS CONTENT-->
				</td>
			</tr>
			<tr>
				<td class="left_down"></td>
				<td class="middle_down"></td>
				<td class="right_down"></td>
			</tr>
		</table>
	


			
	</div>
	<script>
  $("#left").ready(function(){
  
  alert();
  var bg_color = '<?=$bg_color?>';
  var cur_color = '<?=$cur_color?>';
  
  $("#link").css("width",$(".link").outerWidth()+$(".icon").outerWidth());

  
  /*$(".ceva").filter(
					function(index)
						{
						if(index%2!=0) return true
						}
					).css("background","#EDE8D3");
	*/
  
	//$(".table_head").resizable({ alsoResize: '.other',containment: 'parent'});
	//$(".table_head").resizable();
	
	//$("td").disableTextSelect();
	//$("td").selectable('disable');
    $(".ceva").mousedown(function()
				{
					$('.ceva').css('background','transparent');
					$('.ceva').removeClass('selected');
					/*$(".ceva").filter(
					function(index)
						{
						if(index%2!=0) return true
						}
).css("background","#EDE8D3");*/
					
					
					$(this).css('background',cur_color);
					$(this).addClass('selected');
					
				});
				
	$(document).keypress(function(e)
				{
				curent = $('.ceva').filter(function(){if($(this).hasClass('selected')) return 1});
				 if(e.keyCode == 38 && $(".ceva").index(curent)>=1)  //up arrow
					{
					
					//parent.document.getElementById('mesaj').innerHTML = $(".ceva").index(curent);
					
					
										
					curent.css("background",'transparent');
					curent.removeClass("selected");
					
					/*$(".ceva").filter(
					function(index)
						{
						if(index%2!=0) return true
						}
					).css("background","#EDE8D3");*/
					curent.prev().css("background",cur_color);
					curent.prev().addClass("selected");
					
					if(curent.prev().offset().top <= document.body.scrollTop)  window.scrollBy(0,-curent.outerHeight());
					
					}
				if(e.keyCode == 40 && (parseInt($(".ceva").index(curent))<parseInt($(".ceva").length)-1))  //down arrow
					{
					//parent.document.getElementById('mesaj').innerHTML = "curent: "+$(".ceva").index(curent)+" total: "+$(".ceva").length;
					
					
										
					curent.css("background",'transparent');
					curent.removeClass("selected");
					
					/*$(".ceva").filter(
					function(index)
						{
						if(index%2!=0) return true
						}
					).css("background","#EDE8D3");*/
					
					curent.next().css("background",cur_color);
					curent.next().addClass("selected");
					
					//parent.document.getElementById('mesaj').innerHTML="current: "+curent.attr("offsetTop")+"<BR> total: "+$(document.body).attr("scrollTop")+"<BR> suma:"+parseInt(parseInt(parent.document.getElementById('1').height)+parseInt($(document.body).attr("scrollTop")));
					
					//$(document).parent().get("#mesaj").html("aaasadasaaaa");
					
					//alert("current: "+curent.attr("offsetTop")+"\n total: "+$(document.body).attr("scrollTop"));
					
					//if(curent.next().next().offset().top > parseInt(parseInt(parent.document.getElementById('1').height)+parseInt($(document.body).attr("scrollTop")))-20)  window.scrollBy(0,curent.outerHeight());
					}
				return false;
				
				});
				
				
	$("#tabel").tablesorter(); 
    $("#rele").click(function() { 
        // set sorting column and direction, this will sort on the first and third column the column index starts at zero 
        var sorting = [[1,0]]; 
        // sort on the first column 
        $("#tabel").trigger("sorton",[sorting]); 
        // return false to stop default link action 
        //return false; 
    }); 
	
	
  });	
  
	function open_folder(address)
	{
	window.location=address;
	}
  
  
 
  </script>
  
</body>
