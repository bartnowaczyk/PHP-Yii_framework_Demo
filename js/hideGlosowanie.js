check = function () {
	var doms =$("#setId").val(); 

    if(!isNumber(doms) ) {
		$("#settings").hide();
	}
};

checkP = function () {
    switch ($(".czyP").val()) {
        case '0':
            $("#ilePP").hide();
        break;
        case '1':
            $("#ilePP").show();
        break;
    }
};


function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

$(document).ready(function(){
	check.apply();
	checkP.apply();

	$("#domyslne").change(function(){
		$("#settings").toggle('slow');
	});
		$(".czyP").change(function(){
		$("#ilePP").toggle('slow');
	});

});
