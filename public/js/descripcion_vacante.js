$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function loadMoreJobs() {

	$.ajax({
		  method: "GET",
		  url: "/load_shuffle_jobs",
		  data: { jid: $('#job_id').val() }
		})
		  .done(function( msg ) {
		    	//alert( "Data Saved: " + msg );
		    	console.log(msg);
		    	var all_objects = JSON.parse(msg);
		    	for (var i = 0; i < all_objects.length; i++) {
		    		$('#anexus_jobs').append('<div class="row suggested_vacant" onclick="window.location=\'/vacant-details/'+all_objects[i]['_id']+'\'"><div class="col-md-4"><img src="" class="img-circle img-vacant-description"></div><div class="col-md-8"><input type="hidden" value=""><div class="col-md-12"><p class="letraextragrande pnobottom">'+all_objects[i]['title']+'</p></div><div class="col-md-12"><p class="letragrande pnobottom">'+'REC TYPE'+'</p></div><div class="col-md-12"><p class="letramedia pnobottom">'+all_objects[i]['complete_address']+'</p></div><div class="col-md-12"><p class="letrachica pnobottom">'+(new Date(all_objects[i]['Created_date'])).toLocaleDateString("en-US")+'</p></div></div></div>');
		    	}
		  });

}
$(document).ready(function() {
	console.log("Ready test general settings!");
	console.log("testing 2!");
	console.log(GeneralConfig.talent_id);
	loadMoreJobs();
});
$('#btn_apply_to_vacant').click(function() {
	//alert("Yes.");
	//var talent_id =
	/*
	http://localhost:3002/job_already_apply?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhZG1pbiI6ZmFsc2UsImlhdCI6MTU1MDAzMDY4Mn0.0AnQbdgG-nNgBQ---Pn_9s6ET9v8AFmOhTBPgmoyUBA&job_id=5c3863871bc77e0940aa7dd0&talent_id=iamtalent123
	token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhZG1pbiI6ZmFsc2UsImlhdCI6MTU1MDAzMDY4Mn0.0AnQbdgG-nNgBQ---Pn_9s6ET9v8AFmOhTBPgmoyUBA
	job_id: 5c3863871bc77e0940aa7dd0
	talent_id: iamtalent123
	http://localhost:3002/aplications2
	job_id: 5c3863871bc77e0940aa7dd0
	talent: iamtalent123
	token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhZG1pbiI6ZmFsc2UsImlhdCI6MTU1MDAzMDY4Mn0.0AnQbdgG-nNgBQ---Pn_9s6ET9v8AFmOhTBPgmoyUBA
	*/
	$.ajax({
	  method: "POST",
	  url: "/apply_to_vacant",
	  data: { job_id: $('#job_id').val(), talent_id: GeneralConfig.talent_id }
	})
	  .done(function( msg ) {
	  		console.log(msg);
	  		var result = JSON.parse(msg); 
	  		if (result.ResponseCode==1) {
	  			//$('.alert-success').show();
	  			setTimeout(function(){ 
	  				$('#hidden_dv').show();
		  			$('.alert-success').fadeTo(2000, 500).slideUp(500, function(){
					    $(".alert-success").slideUp(500);
					    $('#hidden_dv').hide();
					});
		  			$('#success_body').text("You application for this vacant has been received. Good luck!");
	  			}, 100);
	  		}else {
	  			setTimeout(function(){ 
	  				$('#hidden_dv').show();
					$('.alert-warning').fadeTo(2000, 500).slideUp(500, function(){
					    $(".alert-warning").slideUp(500);
					    $('#hidden_dv').hide();
					});
		  			$('#warning_title').text("You have already apply to this vacant");
	  			}, 100);
	  		}
	  });
});

