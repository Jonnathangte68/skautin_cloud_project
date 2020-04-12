function goToTalentProfile(id) {
	$.ajax({
		type: "GET",
		url: '/redirect-user-after-visit-talent/'+id
	  })
	  	.done(function(replaceUrlString) {
				window.location.replace(replaceUrlString);
		  });
}
function goToRecruiterProfile() {
	alert("Go recruiter profile!");
}



$(document).ready(function() {
	setTimeout(function() {
		jQuery.ajax({
			  method: "GET",
			  url: "/load_other_data"
			})
			  .done(function( msg ) {
				  // 0 pending find message
			  		// 1 array of suggestions 
			  		var parser = JSON.parse(msg);var p1 = parser[0];var p2 = parser[1];var c=0;
			  		$html_var = '';
			  		// HTML for pending
			  		console.log(p1);
			  		for (var i = 0; i < p1.message.length; i++) {

			  			// profile_img - talent
						  // profile_image - recruiter
						  
						  jQuery.ajax({
							method: "GET",
							url: "/get_other_details_connections",
							async: false, 
							data: {'tId':p1.message[i]._i}
						  })
							.done(function( msg ) {
								$html_var += '<div class="row" onclick="goToRecruiterProfile()"><div class="col-md-1"><img src="'+
								((p1.message[i].hasOwnProperty('profile_img')) ? p1.message[i].profile_img : p1.message[i].profile_image)+'" class="img-circle rond"'+
								'onerror="this.onerror=null;this.src=\'img/img_avatar.png\';"'+'></div><div class="col-md-8">'
								+'<p class="pnobottom titleOne">'+p1.message[i].name+'</p>'
								+'<p class="pnobottom titleSecond">'+msg+'</p></div></div><br>';
							});


			  			c++;
			  		}
			  		for (var i = 0; i < p2.length; i++) {

						jQuery.ajax({
							method: "GET",
							url: "/get_other_details_connections",
							async: false, 
							data: {'tId':p2[i]._id}
						  })
							.done(function( msg ) {
								$html_var += '<div class="row" onclick="goToTalentProfile(\''+p2[i]._id+'\')"><div class="col-md-1"><img src="'+
								((p2[i].hasOwnProperty('profile_img')) ? p2[i].profile_img : p2[i].profile_image)+'" class="img-circle rond"'+
								'onerror="this.onerror=null;this.src=\'img/img_avatar.png\';"'+'></div><div class="col-md-8">'
								+'<p class="pnobottom titleOne">'+p2[i].name+'</p>'
								+'<p class="pnobottom titleSecond">'+msg+'</p></div></div><br>';
							});

			  			c++;
			  		}

			  		//console.log($html_var);
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