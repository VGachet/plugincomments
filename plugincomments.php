<?php

/*

Plugin Name: Racourcis commentaires

Description: Un plugin permettant de racourcir les commentaires trop long

*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

add_action('plugins_loaded', 'plugin_load_textdomain');
function plugin_load_textdomain() {
	load_plugin_textdomain( 'plugincomments_textdomain', false, plugins_url('plugincomments_textdomain-fr_FR.mo' , __FILE__ ) . '/lang/' );
}


add_action('admin_menu', 'plugin_setup_menu');
 
function plugin_setup_menu()
{
        add_menu_page( 'Plugin Comments', 'Plugin Comments', 'manage_options', 'plugin', 'my_plugin_options' );
}

function my_plugin_options() 
{ 
 	echo '<h1>'.get_admin_page_title().'</h1>';

?>


<form method="post" action="options.php">

<? wp_nonce_field('update-options'); ?>
<p><?php _e('Number of characters displayed before the break ( " read more " ) :', 'plugincomments_textdomain')?></p>
<input type="text" name="option1" id="option1" value="<? echo get_option('option1'); ?>">

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="option1" />
<br/>
<input type="submit" value="<?php _e('Save Changes', 'plugincomments_textdomain'); ?>" />
</form>



<?php
} 


function wordpress_plugin_comments($comments) {

	wp_enqueue_script('newscript', plugins_url('wp_jquery.js' , __FILE__ ));

	$comments = get_comment_text();

	if(strlen($comments) > get_option('option1'))
	{

	$comment_court = substr($comments, get_option('option1'), strlen($comments));

	$comment_court = "<span id='texte'>".$comment_court.="</span>";

	$comment = substr($comments, 0, get_option('option1'));

	return "<span id='text'>".$comment."</span>".$comment_court.=' <a href="" id="cacher">(Hide)</a> <a href="" id="montrer">(Read More)</a>';
	}
	else
	{
		return $comments;
	}

};

add_filter('comment_text', 'wordpress_plugin_comments');