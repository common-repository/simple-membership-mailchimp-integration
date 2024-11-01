=== Simple Membership MailChimp Integration ===
Contributors: smp7, wp.insider
Donate link: https://simple-membership-plugin.com/
Tags: mailchimp, autoresponder, email, signup, optin, member, members, membership, access, subscribe
Requires at least: 5.5
Tested up to: 6.6
Stable tag: 1.9.5
License: GPLv2 or later

An addon for the simple membership plugin to signup members to your MailChimp list

== Description ==

This addon allows you to specify a MailChimp list name for each of your access levels. When members join your site, they get signed up to the specified MailChimp list.

This addon requires the [simple membership plugin](http://wordpress.org/plugins/simple-membership/).

After you install this addon, edit your membership level and specify the mailchimp list name. Then go to the MailChimp settings interface and specify your API Key.

Read the following page for step by step usage documentation:
https://simple-membership-plugin.com/signup-members-mailchimp-list/

== Installation ==

1. Upload `swpm-mailchimp-signup` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

None

== Screenshots ==

None

== Changelog ==

= 1.9.5 =
- Fixed a notice in the admin settings interface for PHP 8.2.

= 1.9.4 =
- Updated the addon to work with the latest version of the main Simple Membership plugin.

= 1.9.3 =
- The API key value is trimmed to remove any empty space characters when it is saved in the settings.

= 1.9.2 =
- Membership level upgrade will trigger that member to be added to the new list (of the new level).

= 1.9.1 =
- Fixed the double opt-in checkbox not taking effect.

= 1.9 =
- Added a new option in the settings to enable double opt-in for mailchimp subscription.

= 1.8 =
- Appropriate interest groups are set when member upgrades to new membership level and when membership level is changed via the admin dashboard. Requires Simple Membership v3.6.0 or higher.
- An update related to Mailchimp API v3.0.

= 1.7 =
* Adding architecture to handle interest group name with the list name.

= 1.6 = 
* Mailchimp signup will be triggered when members are added via the admin dashboard also. Requires Simple Membership v3.4.5 or higher.

= 1.5 =
* Updated the Mailchimp API library to their latest version (v3.0). It requires PHP v5.3 at least.

= 1.4 =
* It will now perform Mailchimp signup when used with the WP User import addon.

= 1.3 =
* Minor fix for the form builder integration.

= 1.2 =
* Added integration with the form builder addon.

= 1.1 =
* Minor architectural improvements.

== Upgrade Notice ==

The new MailChimp library requires PHP v5.3. So your server must have PHP v5.3 to use the updated plugin.
