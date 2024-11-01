(function( $ ) {
	'use strict';
	jQuery(document).ready(function(){
		jQuery('.tvc-chrome-login').bind('click',function(e){
			e.preventDefault();
			jQuery.ajax({
				url:tvc_ajax.url,
				data:{
					'action':'tvc_user_logged_in'
				},
				success:function( is_logged_in ) {
					if(is_logged_in == 'false'){
						const retrievePromise = googleyolo.retrieve({
							supportedAuthMethods: [
								"https://accounts.google.com",
								"googleyolo://id-and-password"
							],
							supportedIdTokenProviders: [
							  {
								uri: "https://accounts.google.com",
								clientId: tvc_ajax.tvc_client_id
							  }
							]
						});
						retrievePromise.then((credential) => {
							if(credential.password){
								tvc_onetap_login(credential);
								googleyolo.disableAutoSignIn();
							}
							else {
							  jQuery(this).trigger( e.type );
							}
						}, (error) => {
							window.location.href = tvc_ajax.redirect_val;
							if ( error.type === 'noCredentialsAvailable' ) {
							  window.location.href = tvc_ajax.redirect_val;
							}
						});
					}
					else{
						window.location.href = is_logged_in;
					}
				},
				
			});
		});
		
		function tvc_onetap_login(credential){
			jQuery.ajax({
				url:tvc_ajax.url,
				type:"POST",
				data:{
					action:'tvc_user_one_tap_login',
					username:credential.id,
					password:credential.password
				},
				complete:function( error_msg ) {
					console.log( error_msg );
				},
				success : function( redirect ){
					console.log(redirect);
					window.location.href = redirect;
				}
			});
		}
	});
})( jQuery );
