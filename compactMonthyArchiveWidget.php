<?php
/*
Plugin Name: Compact Monthly Archive Widget
Plugin URI: http://somethinkodd.com/cma
Description: Show a monthly archive list in a compact format (letter per month)
Version: 0.94 Beta
Author: SomethinkOdd Development Team
Author URI: http://somethinkodd.com/oddthinking
*/

/* Grateful thanks to Alan Morgan (http://tech.windsofstorm.net) whose widget_archives2 I used as a template. */

function STO_cma_init() {
	function widget_STO_cma($args) {
		extract($args);
		$options	= get_option('widget_STO_cma');
		$title		= empty($options['title']) ? __('Archives') : $options['title'];
	?>
			<?php echo $before_widget; ?>
				<?php echo $before_title . $title . $after_title; ?>
				<?php 
					global $wp_locale, $wpdb;
					$arcResults = $wpdb->get_results("SELECT DISTINCT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date ASC");
					if ($arcResults) {
						$numMonthEntries = sizeof($arcResults);
						$startYear = $arcResults[0]->year;
						$endYear = $arcResults[$numMonthEntries-1]->year;
						$nextEntry = 0;
						echo "\n	<ul class=\"STO_cma_archive_list\">";
						for ($currentYear = $startYear; $currentYear <= $endYear; $currentYear++)
						{
							echo "\n		<li class=\"STO_cma_line\"><span class=\"STO_cma_year\">".$currentYear.":</span>";
							echo "\n			<ul><li>";
							for ($currentMonth = 1; $currentMonth <= 12; $currentMonth++)
							{
								$monthInitial = substr(($wp_locale->get_month($currentMonth)),0,1);
								echo "<span class=\"STO_cma_month\">";
								$currentMonthHasEntry = 
									$nextEntry < $numMonthEntries && 
									$arcResults[$nextEntry]->year == $currentYear &&
									$arcResults[$nextEntry]->month == $currentMonth;
								if ($currentMonthHasEntry)
								{ 
									$url = get_month_link($currentYear,	$currentMonth);
									echo "<span class=\"STO_cma_link\"><a href=\"".$url."\">".$monthInitial."</a></span>";
									$nextEntry++;
								}
								else
								{
									echo "<span class=\"STO_cma_empty\">".$monthInitial."</span>";
								}
								echo "</span>";
								if ($currentMonth == 6)
								{ 
									// If a line break is required, recommend it at the halfway mark.
									echo "<span class=\"zwsp\"> </span>";
									// Several attempts were made to include thin space and zero-width white spaces here, but browser support wasn't there yet, especially Firefox.
								}
							}
							echo "</li></ul></li>\n";							
						}
						echo "\n	</ul>";
					} ?>
			<?php echo $after_widget; ?>
	<?php
	}

	function widget_STO_cma_control() {
		$options = $newoptions = get_option('widget_STO_cma');
		if ( $_POST["archives-submit"] ) {
			$newoptions['title']	= strip_tags(stripslashes($_POST["archives-title"]));
		}
		if ( $options != $newoptions ) {
			$options = $newoptions;
			update_option('widget_STO_cma', $options);
		}
		$title		= htmlspecialchars($options['title'], ENT_QUOTES);
	?>
				<p><label for="archives-title"><?php _e('Title:'); ?> <input style="width: 250px;" id="archives-title" name="archives-title" type="text" value="<?php echo $title; ?>" /></label></p>
				<input type="hidden" id="archives-submit" name="archives-submit" value="1" />
	<?php
	}

	if (function_exists('register_sidebar_widget')) {
		register_sidebar_widget('Compact Monthly Archives', 'widget_STO_cma');
		register_widget_control('Compact Monthly Archives', 'widget_STO_cma_control', 300, 50);
	}
}

// Run our code later in case this loads prior to any required plugins.
add_action('plugins_loaded', 'STO_cma_init');
?>
