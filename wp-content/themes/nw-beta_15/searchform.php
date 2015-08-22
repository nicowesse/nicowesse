<?php

/**
 * The template used for the search form
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

?>

<form role="search" method="get" class="c-search-form" action="<?php echo home_url( '/' ); ?>">
	<input type="search" class="c-search-form__field" placeholder="Search for.." value="" name="s" title="Search for" data-swplive="true" autocomplete="false" />
	<span class="c-search-form__submit-container"><input type="submit" class="c-search-form__submit" value="Search" /></span>
</form>