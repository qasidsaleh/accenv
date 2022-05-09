<?php
/**
 * Template for displaying search forms in Twenty Seventeen
 *
 * @package WordPress
 * @subpackage Qip Pay
 */

?>

<form class="form-inline text-right" action="<?php echo get_home_url(); ?>" method="get">
    <div class="input-group">
        <input type="text" name="s" id="s" value="" data-swplive="true" placeholder="Search" />
        <span class="input-group-btn">
            <button class="btn" type="button submit" value="Search" id="searchsubmit">
                <i class="fas fa-search"></i>
            </button>
        </span>
    </div>
</form>
