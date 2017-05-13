<form role="search" method="get" id="searchform" class="search-form" action="<?php echo home_url( '/' ) ?>">
	<div class="searchbox-wrapper">
        <label>
			<span class="screen-reader-text"><?php _e('Search for:',  'bonestheme') ?></span>
			<input type="search" class="search-field" value="<?php echo get_search_query() ?>" name="s" placeholder="SEARCH" title="<?php _e('Search for:',  'bonestheme') ?>" />
        </label>
		<input type="submit" class="search-submit fa fa-search" value="<?php _e('&#xf002;','bonestheme'); ?>" />
	</div>
</form>
