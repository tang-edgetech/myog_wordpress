<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

?>
<?php astra_entry_before(); ?>
<?php 
if( is_account_page() ) { 
    $user_id = get_current_user_id();
?>
    <div class="woocommerce">
        <div class="myog-myaccount-wrapper">
            
            <?php 
            if( wc_get_account_endpoint_url( 'dashboard' ) || wc_get_account_endpoint_url( 'edit-account' ) )  {
                get_template_part( 'woocommerce/myaccount/my', 'account' );
            }
            ?>
            
        </div>
        <?php
        if( is_user_logged_in() ) {
        ?>
            <div class="modal fade modal-myog-logout" id="modal-myog-logout" tabindex="-1" aria-labelledby="modalMyogLogout" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h5 class="mb-0">Are you sure you want to sign out?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-logout-action btn-cancel" id="myog-logout-cancel" data-action="cancel" data-dismiss="modal" aria-label="Close"><span>Cancel</span></button>
                            <button type="button" class="btn btn-logout-action btn-proceed" id="myog-logout-proceed" data-action="proceed" data-label="Proceed Logout" onclick="window.location.href='<?php echo wp_logout_url();?>'"><span>Sure</span></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if( is_wc_endpoint_url('edit-account') ) { ?>
                <div class="modal fade modal-myog-account-update-log" id="modal-myog-account-update-log" tabindex="-1" aria-labelledby="modalMyogLogout" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-log btn-log-cancel" id="myog-log-cancel" data-action="cancel" data-dismiss="modal" aria-label="Close"><span>Cancel</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            ?>

        <?php
        }
        ?>
    </div>
<?php 
} 
else { ?>
<article
<?php
		echo astra_attr(
			'article-page',
			array(
				'id'    => 'post-' . get_the_id(),
				'class' => join( ' ', get_post_class() ),
			)
		);
		?>
>
	<?php astra_entry_top(); ?>

	<?php astra_entry_content_single_page(); ?>

	<?php
		astra_edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'astra' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<footer class="entry-footer"><span class="edit-link">',
			'</span></footer><!-- .entry-footer -->'
		);
		?>

	<?php astra_entry_bottom(); ?>

</article><!-- #post-## -->
<?php } ?>

<?php astra_entry_after(); ?>