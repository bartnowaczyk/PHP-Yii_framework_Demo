check = function () {
    switch ($(".czyP").val()) {
        case '0':
            $("#ilePP").hide();
        break;
        case '1':
            $("#ilePP").show();
        break;
    }
};


$(document).ready(function(){
	check.apply();
	$(".czyP").change(function(){
		$("#ilePP").toggle('slow');
	});
});
