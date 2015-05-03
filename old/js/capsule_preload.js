function capsule_preload() {
	var i=0;
	var imagepreloads= new Array();
	$("img").each(function(index) {
		if (typeof($(this).attr("longdesc"))!="undefined") {
			if ($(this).attr("longdesc")!="") {
				imagepreloads[i] = new Image();
				imagepreloads[i].src = $(this).attr("longdesc");
				i++;
			}
		}
	});
	$("img").each(function(index) {
		if (typeof($(this).attr("longdesc"))!="undefined") {
			if ($(this).attr("longdesc")!="") {
				$(this).attr("src",$(this).attr("longdesc"));
			}
		}
	});
	
}
