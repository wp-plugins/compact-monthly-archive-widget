=== Compact Monthly Archive ===
Contributors: OddThinking
Tags: archives, widget, calendar
Requires at least: 2.0.0
Tested up to: 2.3.2
Stable tag: 1.0

Show a monthly archive list in a compact format - one letter per month.

== Description ==

If your blog is over a year or two old, you may have noticed the list of archive pages is getting unwieldy.

This plugin is a widget that compresses the size of the arcgives list to two lines per *year* (three if the lines are narrow) rather than one line per per *month*.

== Installation ==

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Find the Widgets page (under Presentation in WordPress 2.0-2.3, but there are rumours that it is moving in Wordpress 2.4.)
1. Drag the Compact Monthly Archives into your preferred location.
1. Click on the icon on the right on the Compact Monthly Archives and set the title. (Default is "Archives".)
1. Modify the CSS of the theme to taste, using any of the following styles:
	* `STO_cma_archive_list` - this is applied to the `ul` tag that covers the entire calendar, apart from the title.
	* `STO_cma_line` - this applies to the `li` tag that represents each year.
	* `STO_cma_month` - this applies to each letter that represents a month.
	* `STO_cma_link` - this applies to each month that includes an article (and is, hence, a link.)
	* `STO_cma_empty` - this applies to each month that is empty (and is, hence, not a link)
	* `STO_cma_zwsp` - this applies to the whitespace gap between June and July. You may like to make it narrow.
	
Here is an example:

`.STO_cma_month a {
	line-height: 1.2em;
	padding: 0.2em;
}

.STO_cma_empty{
	color: #4984E3;
	line-height: 1.2em;
	padding: 0.2em;
	
}`

You almost certainly will want to change the example style to fit your theme.
	

== Frequently Asked Questions ==

= When would I use this? =

The default WordPress archive listing takes one line for every month. Once your blog gets over about a one or two years old, this becomes unwieldy. That's the point where you should consider this plug-in instead. This plug-in only takes two or three lines per year.

When your blog gets to be about 4-6 years old, it will start to get unwieldy again. Hopefully, by then, we will have a solution for that too.

= How do I localise it for my language? =

The widget automatically uses the first character from each month based on your locale. So all you need to is override the default title to a word meaning 'archives' in your language.

I haven't tested it on any right-to-left languages. If this doesn't work, let me know, and I will come up with a workaround.

== Screenshots ==

1. This is an example of a compact monthly archive. In this theme, white is a link that hasn't been visited. Light blue is a link that has been visited, and the greyish blue is a month with no articles, and hence has no link. You may choose your own colour-scheme.

== More information ==

This widget is licensed under [GPLv3](http://www.gnu.org/licenses/gpl-3.0.html).

Grateful thanks to [Alan Morgan](http://tech.windsofstorm.net) whose widget_archives2 I used as a template.

Potential developers should check out the [development history](http://www.somethinkodd.com/oddthinking/2007/03/29/more-theme-changes-2/). 

Finally, an obligatory plug for my blog, [OddThinking](http://somethinkodd.com/oddthinking).