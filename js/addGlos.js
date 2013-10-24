$(document).ready(function(){
	$("#peselErr").hide();
	$("#peselok").hide();
	$("#nazwiskoErr").hide();
	$("#nazwiskoOk").hide();
	$("#imieErr").hide();
	$("#imieOk").hide();
	$("#dokumentErr").hide();
	$("#dokumentOk").hide();	
	var re= /^[0-9]{1,}$/;
	$("#peselInput").keyup(function(){
		if ($("#peselInput").val().length!=$("#ilePesel").val() || !$("#peselInput").val().match(re) ) {
				$("#peselok").hide();
				$("#peselErr").show();
		}
		else {
			$("#peselErr").hide();
			$("#peselok").show();
		}
	});

	var ie= /^[a-ząęśćńółżźA-ZŚŁŻŹ]{2,}$/;
	$("#imieInput").keyup(function(){
		if (!$("#imieInput").val().match(ie) ) {
				$("#imieOk").hide();
				$("#imieErr").show();
		}
		else {
			$("#imieErr").hide();
			$("#imieOk").show();
			cos.apply();
//			checkInfo.apply();	
//			$("#alert").text("HAHA")'
//			document.getElementById('alert').innerHTML = "HAHAHA";
		}
	});

	var ne= /^[a-ząęśćńółżźA-ZŚŁŻŹ-]{2,}$/;
	$("#nazwiskoInput").keyup(function(){
		if (!$("#nazwiskoInput").val().match(ne) ) {
				$("#nazwiskoOk").hide();
				$("#nazwiskoErr").show();
		}
		else {
			$("#nazwiskoErr").hide();
			$("#nazwiskoOk").show();
		}
	});
	var ve= /^[a-ząęśćńółżźA-ZŚŁŻŹ1-9-/]{2,}$/;
	$("#dokumentInput").keyup(function(){
		if (!$("#dokumentInput").val().match(ve) ) {
				$("#dokumentOk").hide();
				$("#dokumentErr").show();
		}
		else {
			$("#dokumentErr").hide();
			$("#dokumentOk").show();
		}
	});
});

function checkInfo() {
	$.post('valid.php',{username: $("#imieInput").val()}, function(data){
		if(data.exists){	
			alert("ccc");
		}
		else{
			alert("ddd");	
		}
	}, 'JSON');
	
}

/*
function checkInfo() {
		var glosowanie = $("#glosowanieId").val();
		if (typeof $("#nazwiskoInput").val() != 'undefined'){ 
			var pes = $("#nazwiskoInput").val();
		} else { 
			var pes = "1010010001";
		}		
		if (typeof $("#imieInput").val() != 'undefined'){ 
			var imi = $("#imieInput").val();
		}else { 
			var imi= "1010010001";
		}
		if (typeof $("#nazwiskoInput").val() != 'undefined'){
			var naz = $("#nazwiskoInput").val();
		} else { 
			var naz= "1010010001";
		}
		if (typeof $("#dokumentInput").val() != 'undefined'){
			var dok = $("#dokumentInput").val();
		} else { 
			var dok= "1010010001";
		}
		var string = "imie="+imi + "&pesel="+pes+ "&nazwisko="+naz + "&dokument" + dok + "&glosowanie=" + glosowanie;

		$.post('valid.php',{imie: imi, pesel: pes, nazwisko: naz, dokument: dok, glosowanie: glosowanie}, function(data){
    if(data.exists){
		alert ("sukces");    
	}
	else {
		alert ("brak");
    }
 }, 'JSON');
/*
		$.ajax({                                      
		  url: 'sprawdz.php',                  //the script to call to get data          
		  data: {imie: imi, pesel: pes, nazwisko: naz, dokument: dok, glosowanie: glosowanie},                        //you can insert url argumnets here to pass to api.php
										   //for example "id=5&parent=6"
		  dataType: 'json',                //data format      
		  success: function(data)          //on recieve of reply
		  {
		  if (data) {
			  alert("aa");
		  }
			var id = data[0];              //get id
			var vname = data[1];           //get name
			//--------------------------------------------------------------------
			// 3) Update html content
			//--------------------------------------------------------------------
			$('#alert').html("<b>id: </b>"+id+"<b> name: </b>"+vname); //Set output element html
			//recommend reading up on jquery selectors they are awesome 
			// http://api.jquery.com/category/selectors/
		  } 
		});
/*		
	if (window.XMLHttpRequest) { 				// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else {							// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	} 
	
	xmlhttp.onreadystatechange=function() {
	
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			//var ooo = xmlhttp.responseText;
//			document.getElementById('alert').innerHTML = xmlhttp.responseText;
//			var imCh=document.getElementById('imCh').value;
//			var peCh=document.getElementById('peCh').value;

//			if (imCh==1 && peCh==1) {

	//			document.getElementById("submit").disabled=false;	
	//		}

			
		}
	}
  
	xmlhttp.open("GET", "sprawdz.php?imie="+imi + "&pesel="+pes+ "&nazwisko="+naz + "&dokument" + dok + "&glosowanie=" + glosowanie, true);
	xmlhttp.send();		
}

*/

function cos() 
  {
   $.ajax({                                      
      url: 'cos.php',                  //the script to call to get data          
      data: "",                        //you can insert url argumnets here to pass to api.php
                                       //for example "id=5&parent=6"
      dataType: 'json',                //data format      
      success: function(data)          //on recieve of reply
      {
		alert('ddd');
        var id = data[0];              //get id
        //--------------------------------------------------------------------
        // 3) Update html content
        //--------------------------------------------------------------------
		
  //      $('#alert').html("<b>id: </b>"+id+"<b> name: </b>"+vname); //Set output element html
        //recommend reading up on jquery selectors they are awesome 
        // http://api.jquery.com/category/selectors/
      } 
    });
  }
