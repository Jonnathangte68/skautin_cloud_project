// function fn60sec() {
//     // runs every 60 sec and runs on init.
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     $.ajax({
//         method: "GET",
//         url: "/get-new-notifications",
//         data: {}
//     })
//         .done(function( notfJson ) {
//             $('#loading_ntf_default').hide();
//             var arrNotifications = JSON.parse(notfJson);
//             arrNotifications.forEach(function(n) {
//                 // If notifId doesn't exist and notif is not seen   -    add and make sound, move the bell
//                 // If notifId doesn't exist and has been seen    -    just add it
//                 var notifHtml = `<div id="${n._id}" class="row">
//                                         <!-- Empty yet... -->
//                                         <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 no-padd">
//                                         <img src="${n.picture}" onerror='this.src="img/notifications-011.png"' class="img-notif">
//                                     </div> 
//                                     <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
//                                         <div class="row">
//                                             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
//                                                 <b>${n.title}</b>
//                                             </div>
//                                             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
//                                                 ${n.message}
//                                             </div>
//                                         </div>
//                                     </div>     
//                             </div>`;
//                 if(!($(".popover-content #"+String(n._id)).length>0)) {
//                     $('.popover > .popover-content').append(notifHtml);
//                 }
//             });
//         });
// }
// fn60sec();
// if (gvalues.NOTIFICATION_THREAD===-1) {
//     var nId = setInterval(fn60sec, 10*1000);
//     gvalues.NOTIFICATION_THREAD = nId;
// }
