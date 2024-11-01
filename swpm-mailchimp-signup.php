<?php
/*
Plugin Name: Simple Membership MailChimp Integration
Version: v1.9.5
Plugin URI: https://simple-membership-plugin.com/
Author: smp7, wp.insider
Author URI: https://simple-membership-plugin.com/
Description: An addon for the simple membership plugin to signup the member to your MailChimp list after registration.
*/

//Slug - swpm_mailchimp_

if (!defined('ABSPATH')){
    exit; //Exit if accessed directly
}

define('SWPM_MAILCHIMP_CONTEXT', 'swpm_mailchimp');

include_once('swpm-mailchimp-admin-menu.php');
include_once('swpm-mailchimp-action.php');

add_action('plugins_loaded', 'swpm_mailchimp_addon_init');

function swpm_mailchimp_addon_init() {
    if (!class_exists('SimpleWpMembership')) {
        return;
    }

    if (is_admin()) {//Do admin side stuff
        add_filter('swpm_admin_add_membership_level_ui', 'swpm_mailchimp_admin_add_membership_level_ui');
        add_filter('swpm_admin_edit_membership_level_ui', 'swpm_mailchimp_admin_edit_membership_level_ui', 10, 2);

        add_filter('swpm_admin_add_membership_level', 'swpm_mailchimp_admin_add_membership_level');
        add_filter('swpm_admin_edit_membership_level', 'swpm_mailchimp_admin_edit_membership_level', 10, 2);
    } else {//Do front end stuff
    }
}

function swpm_mailchimp_admin_add_membership_level_ui($to_filter) {
    return $to_filter . '<tr>
            <th scope="row">MailChimp List Name</th>
            <td>
            <input type="text" class="regular-text" name="custom[swpm_mailchimp_list_name]" value="" />
            <p class="description">Enter the mailchimp list name where you want members of this level to be signed up.</p>
            </td>
            </tr>';
}

function swpm_mailchimp_admin_edit_membership_level_ui($to_filter, $id) {
    $fields = SwpmMembershipLevelCustom::get_value_by_context($id, SWPM_MAILCHIMP_CONTEXT);
    $swpm_mailchimp_list_name = isset($fields['swpm_mailchimp_list_name']) ? $fields['swpm_mailchimp_list_name']['meta_value'] : '';
    return $to_filter . '<tr>
            <th scope="row">MailChimp List Name</th>
            <td>
            <input type="text" class="regular-text" name="custom[swpm_mailchimp_list_name]" value="' . $swpm_mailchimp_list_name . '" />
            <p class="description">Enter the mailchimp list name where you want members of this level to be signed up.</p>
            </td>
            </tr>';
}

function swpm_mailchimp_admin_add_membership_level($to_filter) {
    $custom_field = $_POST['custom']['swpm_mailchimp_list_name'];
    $field = array(
        'meta_key' => 'swpm_mailchimp_list_name', // required
        'meta_value' => sanitize_text_field(stripslashes($custom_field)), //required
        'meta_context' => SWPM_MAILCHIMP_CONTEXT, // optional but recommended
        'meta_label' => '', // optional
        'meta_type' => 'text'// optional
    );
    $to_filter['swpm_mailchimp_list_name'] = $field;
    return $to_filter;
}

function swpm_mailchimp_admin_edit_membership_level($to_filter, $id) {
    $custom_field = $_POST['custom']['swpm_mailchimp_list_name'];
    $field = array(
        'meta_key' => 'swpm_mailchimp_list_name', // required
        'meta_value' => sanitize_text_field(stripslashes($custom_field)), //required
        'meta_context' => SWPM_MAILCHIMP_CONTEXT, // optional but recommended
        'meta_label' => '', // optional
        'meta_type' => 'text'// optional
    );
    $to_filter['swpm_mailchimp_list_name'] = $field;
    return $to_filter;
}
