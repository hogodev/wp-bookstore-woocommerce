=== WooCommerce Autocomplete Orders ===
Contributors: seriousplugins
Tags: WooCommerce, order, complete, virtual, autocomplete
Donate link: http://cl.ly/2C2W181j1G2g
Tested up to: 4.4.2
Stable tag: 1.1.3
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Would you buy twice from a website that does not give you instanctly access to the product you purchased? Why would you want that for your customer?

== Description ==
WooCommerce by design instantly completes only orders containing "Downloadable" products upon payment. Products that are "only" virtual will have to wait for a manual approval from the shop manager. Installing this plugin you will have the opportunity to extend WooCommerce with a new option to automatically complete orders:
   
* Paid orders of virtual products only: orders containing "Virtual" products only will be turned to "Completed" upon successful payment.  
* All paid orders of any product: orders of any product will be turned to "Completed" upon successful payment.  
* All orders (!): each and every order will turn to "Completed" irrespective of the payment status.   
      
Please be aware that the third mode allows the customer to access the product immediately before the payment is completed.    

== Installation ==
1. Upload the plugin\'s folder to the `/wp-content/plugins/` directory or install it through the integrated plugin installer    
1. Activate the plugin through the \'Plugins\' menu in WordPress     
1. Navigate to WooCommerce > Settings > Extra Options in your Dashboard
1. Select the desired mode    

== Frequently Asked Questions ==
= The plugin is not working =
Please test the followings:
1. Navigate to WooCommerce > Settings > Extra Options and ensure that the mode under Autocomplete Oreders is not set to off.       
1. Navigate to WooCommerce > Settings > Checkout > PayPal and ensure that your "PayPal Email" is the primary email of your [PayPal Account](https://www.paypal.com/myaccount/settings/).  
1. Activate Payment Data Transfer from your [seller preferences](https://www.paypal.com/?cmd=_profile-website-payments&CALL_FORM_UPDATE=false) on PayPal and copy the identity token that will appear into WooCommerce > Settings > Checkout > PayPal > PayPal Identity Token.

Please watch this video if you don't know how to properly configure PayPal on WooCommerce:

[youtube https://www.youtube.com/watch?v=dp5uv-GLGng]

= No dude, not working yet! =
Please deactivate my plugin (or select mode "Off"), test with a product marked as "virtual" and "downloadable". If it still doesn\'t work, then there\'s something wrong in your WooCommerce configuration or in your payment gateway. If it does work, please log an issue on the [support page](http://www.seriousplugins.com/woocommerce-autocomplete-orders/support/)!    

== Screenshots ==
1. Set the products as "Virtual" products
2. In your PayPal account browse "Seller preferences" under "Selling Tools"
3. Click on "Instant Payment Notifications"
4. Activate IPN notifications and insert the link as in the picture (using your own domain name)
5. Ensure that your main email is the same email you are using to receive payments
6. Browse WooCommerce > Settings > Extra Options
7. Pick the mode that suits you best

== Changelog ==

= 1.1.3 =
* Minor fixes.
* Compatibility with WordPress 4.4.2.
* Rebrand of the plugin.
* Added direct link to the Settings page from the plugin page.
* Added support links.

= 1.1.2 =
* Minor fixes.
* Compatibility with WordPress 4.4 and WooCommerce 2.5.

= 1.1.1 =
* Minor fixes.
* Documentation completely rewritten.

= 1.1 =
* Solved PHP Notices and Warnings.
* Plugin is now compatible with WooCommerce Product Bundles.

= 1.0 =
* Plugin completely rewritten to comply with WordPress 4.0 and WooCommerce 2.0.     
* Added 3 different modes to activate the plugin:
	* Virtual Paid Products Only: order for products marked as "Virtual" will be turned to "Completed" upon successful payment.           
	* All Paid Products: orders for any product are turned to "Completed" upon successful payment.      
	* All Products: each and every order is turned to "Completed" irrespective for the payment method and whether or not the payment happened.      
* Added a settings page (in WooCommerce dashboard) to select the mode we want to activate (under WooCommerce > Settings > Woo Extra Options).      
	
= 0.1.2 =
* Updated compatibility.     
* Added localisation support.     
* Added Italian localisation.     
* Added Spanish localisation.     

= 0.1.1 =
* Added links to support and the official page.     
	
= 0.1 =
* First release.