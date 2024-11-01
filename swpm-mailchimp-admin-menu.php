<?php
add_action( 'swpm_after_main_admin_menu', 'swpm_mc_do_admin_menu' );

function swpm_mc_do_admin_menu( $menu_parent_slug ) {
    add_submenu_page( $menu_parent_slug, __( "MailChimp", 'simple-membership' ), __( "MailChimp", 'simple-membership' ), 'manage_options', 'swpm-mailchimp', 'swpm_mc_admin_interface' );
}

function swpm_mc_admin_interface() {
    echo '<div class="wrap">';
    echo '<h1>MailChimp Integration</h1>';

    if ( isset( $_POST[ 'swpm_mc_save_settings' ] ) ) {
        $api_key = isset ( $_POST[ 'mc_api_key' ] ) ? sanitize_text_field( $_POST[ 'mc_api_key' ] ) : '';
	$options = array(
	    'mc_api_key' => trim( $api_key ),
            'mc_enable_double_optin'	 => isset( $_POST[ 'mc_enable_double_optin' ] ) ? 1 : 0,
	    'mc_remove_when_cancelled'	 => isset( $_POST[ 'mc_remove_when_cancelled' ] ) ? 1 : 0,
	);
	update_option( 'swpm_mailchimp_settings', $options ); //store the results in WP options table
	echo '<div id="message" class="updated fade">';
	echo '<p>MailChimp Settings Saved!</p>';
	echo '</div>';
    }
    $swpm_mc_settings = get_option( 'swpm_mailchimp_settings' );
	$mc_api_key = isset($swpm_mc_settings[ 'mc_api_key' ]) ? $swpm_mc_settings[ 'mc_api_key' ] : '';

    echo '<div id="poststuff"><div id="post-body">';
    ?>

    <p style="background: #fff6d5; border: 1px solid #d1b655; color: #3f2502; margin: 10px 0;  padding: 5px 5px 5px 10px;">
        Read the <a href="https://simple-membership-plugin.com/signup-members-mailchimp-list/" target="_blank">usage documentation</a> to learn how to use the mailchimp integration addon
    </p>
    <p>Enter the MailChimp API details below.</p>

    <form action="" method="POST">

        <div class="postbox">
    	<h3 class="hndle"><label for="title">MailChimp Integration Settings</label></h3>
    	<div class="inside">
    	    <table class="form-table">
    		<tr valign="top">
    		    <th scope="row">MailChimp API Key:</th>
    		    <td>
    			<input type="text" name="mc_api_key" value="<?php echo esc_attr($mc_api_key); ?>" size="60" />
    			<p class="description">The API Key of your MailChimp account (you can find it under the "Account" tab). Make sure to activate it first.</p>
    		    </td>
    		</tr>
    		<tr valign="top">
    		    <th scope="row"><?php echo __( "Enable Double Opt-In", 'simple-membership' ); ?></th>
    		    <td>
    			<input type="checkbox" name="mc_enable_double_optin" value="1"<?php echo ! empty( $swpm_mc_settings[ 'mc_enable_double_optin' ] ) ? ' checked' : ''; ?> />
    			<p class="description"><?php echo __( "Use this checkbox if you want to use the double opt-in option.", 'simple-membership' ); ?></p>
    		    </td>
    		</tr>
    		<tr valign="top">
    		    <th scope="row"><?php echo __( "Remove Email From List When Subscription Payment is Cancelled", 'simple-membership' ); ?></th>
    		    <td>
    			<input type="checkbox" name="mc_remove_when_cancelled" value="1"<?php echo ! empty( $swpm_mc_settings[ 'mc_remove_when_cancelled' ] ) ? ' checked' : ''; ?> />
    			<p class="description"><?php echo __( "Remove member's email from MailChimp list when subscription is cancelled.", 'simple-membership' ); ?></p>
    		    </td>
    		</tr>
    	    </table>
    	</div></div>
        <input type="submit" name="swpm_mc_save_settings" value="Save" class="button-primary" />

    </form>


    <?php
    echo '</div></div>'; //end of poststuff and post-body
    echo '</div>'; //end of wrap
}
