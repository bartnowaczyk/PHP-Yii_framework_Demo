$(document).ready(function(){
	ccc.apply();
	$("#infocookie").click(function(){
		$("#infocookie").toggle('slow');
		$.cookie('cookieInformacja', 1, {expires: 1365});
	});
});


ccc = function () {

		if($.cookie('cookieInformacja')==1) {
			$("#infocookie").hide();
		}
		else {
			$("#infocookie").show();
			
		}
}
