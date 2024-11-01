<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.tatvic.com
 * @since      1.0.0
 *
 * @package    Chrome_One_Tap_Login_For_Woocommerce_Store
 * @subpackage Chrome_One_Tap_Login_For_Woocommerce_Store/admin/partials
 */
if (!defined('ABSPATH')) {
    exit;
}

if(isset($_POST['tvc_submit'])){
	Chrome_One_Tap_Login_For_Woocommerce_Store_Settings::add_update_settings('tvc_one_tap_options');
}

$data =  unserialize(get_option('tvc_one_tap_options'));

?>
<div class="container">
	<div class="row" style="margin-left:-11%; !important;">
		<div class= "col col-9" >
			<div class="card mw-100" style="padding:0px;">
				<div class="card-header">
					<h5> Chrome One Tap Login </h5>
				</div>
			<div class="card-body">
			<form id="tvc_plugin_form" method="post" action="" enctype="multipart/form-data" >
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td>
										<label class="align-middle" for="google_one_tap_login_client_id" >Client Id:</label>&nbsp;<br/>
									</td>
									<td>
										<label class="align-middle" for="fb_pixel">
										<?php $t_login_chkbox = !empty($data['enable_login'])? 'checked' : ''; ?>
										<input class="" type="checkbox" name="enable_login" id="enable_login" style="" <?php echo $t_login_chkbox;?>> Enable Chrome One Tap Login</label><br/>
										<input style="margin-top:10px;" size="30"  type="text" name="tvc_clientid" id="tvc_clientid" value="<?php echo $data['tvc_clientid'];?>" required="required" placeholder="Client Id">
										<i class="tvc_span" title="Enter a valid Client ID"></i>
									</td>
								</tr>
								<tr>
									<td>
										<label class = "align-middle" for="ga_PrivacyPolicy">Privacy Policy</label>
									</td>
									<td>
										<label  class = "align-middle" for="ga_PrivacyPolicy">
											<?php $ga_PrivacyPolicy = !empty($data['ga_PrivacyPolicy'])? 'checked' : ''; ?>
										<input type="checkbox" onchange="enableSubmit();" name="ga_PrivacyPolicy" id="ga_PrivacyPolicy" required="required" <?php echo $ga_PrivacyPolicy; ?>>
										Accept Privacy Policy of Plugin
										<p class="description">By using Tatvic Plugin, you agree to Tatvic plugin's <a href= "https://www.tatvic.com/privacy-policy/?ref=plugin_policy&utm_source=plugin_backend&utm_medium=woo_premium_plugin&utm_campaign=GDPR_complaince_ecomm_plugins" target="_blank">Privacy Policy</a></p>
										</label>
									</td>
								</tr>
							</tbody>
						</table>
					<p class="submit save-for-later" id="save-for-later">
						<button type="submit"  class="btn btn-primary btn-success" id="tvc_submit" name="tvc_submit">Submit</button>
					</p>
			</form>
			
			</div>
			</div>
		</div>
		<?php require_once('sidebar.php');?>
	</div>
</div>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
