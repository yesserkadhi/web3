<?php
if (!defined('WPINC')) {
    die;
}
?>
<div id="postbox-container-1" class="postbox-container">
    <div class="meta-box-sortables">
        <div class="postbox">
            <h3>Plugin Info</h3>
            <div class="inside">
                <p>Plugin Name : <?php esc_html_e($plugin_data['Title']); ?> <?php esc_html_e($plugin_data['Version']); ?></p>
                <p>Author : <?php esc_html_e($plugin_data['Author']) ?></p>
                <p>Website : <a href="http://logichunt.com" target="_blank">logichunt.com</a></p>
                <p>Email : <a href="mailto:logichunt.info@gmail.com" target="_blank">info@logichunt.com</a></p>
                <p>Twitter : @<a href="http://twitter.com/logichunt" target="_blank">logichunt</a></p>
                <p>Facebook : <a href="http://facebook.com/logichunt" target="_blank">LogicHunt</a></p>
            </div>
        </div>
        <div class="postbox">
            <h3>Help & Supports</h3>
            <div class="inside">
                <p>Support : <a class="button" href="http://logichunt.com/support/" target="_blank">Get Support</a></p>
                <p>Website : <a class="button" href="http://logichunt.com/" target="_blank">Website</a></p>
                <p>Donate Link: <a class="button button-primary" href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=vaspal%2ekt%40gmail%2ecom&lc=US&item_name=LogicHunt&item_number=wp&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHosted" target="_blank">Donate Now</a></p>
                <p>Your contribution always helps us to be more serious and supportive.</p>
            </div>
        </div>
    
        <div class="postbox">
            <div class="inside">
                <h3><?php _e('LogicHunt Networks', 'wp-counter-up') ?></h3>
                <p><a target="_blank" href="http://logichunt.com">LogicHunt</a>: Joomla and Worpress Plugin, Extensions, Theme.</p>
	            <p><a target="_blank" href="http://themearth.com">ThemEarth</a>: Themes & Templates.</p>
            </div>
        </div>

    </div> <!-- .meta-box-sortables -->

</div> <!-- #postbox-container-1 .postbox-container -->