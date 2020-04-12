function visitTalentSite(id) {
	$.get( '/redirect-user-after-visit-talent/'+id, function( data ) {
		window.location = data;
	});
}
function visitRecruiterSite() {
	console.log("Visit recruiter site...");
}
$(document).ready(function() {
	setTimeout(function() {
		jQuery.ajax({
			  method: "GET",
			  url: "/get_pending_and_suggested"
			})
			  .done(function( msg ) {
			  		// 0 pending find message
					  // 1 array of suggestions 
					  console.log("msg from server...");
					  console.log(msg);
			  		var parser = JSON.parse(msg);var p1 = parser[0];var p2 = parser[1];var c=0;
			  		$html_var = '';
			  		for (var i = 0; i < p1.message.length; i++) {
			  			$html_var += '<div class="row cursor-hand" onclick="visitRecruiterSite()"><div class="col-md-1"><img src="'+
				  		((p1.message[i].hasOwnProperty('profile_img')) ? p1.message[i].profile_img : p1.message[i].profile_image)+'" class="img-circle rond"'+
				  		'onerror="this.onerror=null;this.src=\'img/img_avatar.png\';"'+'></div><div class="col-md-8">'
				  		+'<p class="pnobottom">'+p1.message[i].name+'</p>'
				  		+'<p class="pnobottom">Talent, category, etc...</p></div></div><br>';
			  			c++;
			  		}
			  		for (var i = 0; i < p2.length; i++) {
			  			$html_var += '<div class="row cursor-hand" onclick="visitTalentSite(\''+String(p2[i]._id)+'\')"><div class="col-md-1"><img src="'+
				  		((p2[i].hasOwnProperty('profile_img')) ? p2[i].profile_img : p2[i].profile_image)+'" class="img-circle rond"'+
				  		'onerror="this.onerror=null;this.src=\'img/img_avatar.png\';"'+'></div><div class="col-md-8">'
				  		+'<p class="pnobottom">'+p2[i].name+'</p>'
				  		+'<p class="pnobottom">Talent, category, etc...</p></div></div><br>';
			  			c++;
			  		}
			  		$('#default_data_image').hide();
			  		if (c>0) {
			  			$('#rightsectiondata').show();
			  			$('#rightsectiondata').html($html_var);
			  		}else {
			  			$('#emptymsg').show();
			  		}
			  });
	},500);
});