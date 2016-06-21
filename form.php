<?php if ( $this->current_user_can_post ): ?>

<div class="bp-simple-post-form">

	<form class="standard-form bp-simple-post-form"  name="bp-form" method="post" action=""  enctype="multipart/form-data" id="<?php echo $this->get_id();?>">

		<!-- do not modify/remove the line blow -->
		
		<input type="hidden" name="bp_simple_post_form_id" value="<?php echo $this->id;?>" />
		<input type="hidden" name="action" value="bp_simple_post_new_post_<?php echo $this->id;?>" />

		<?php wp_nonce_field( 'bp_simple_post_new_post_' . $this->id ); ?>
		<?php wp_nonce_field( 'update-post_' . $post_id, '_bsfep_media_uploader_nonce' );?>

		<?php if ( $post_id ): ?>
			<input type="hidden" name="post_id" value="<?php echo $post_id;?>" id="post_ID"/>
		<?php endif;?>

		<!-- you can modify these, just make sure to not change the name of the fields -->

		 <label for="bp_simple_post_title"><?php _e( 'Title:', 'bsfep' );?>
			<input type="text" name="bp_simple_post_title"  value="<?php echo $title;?>"/>
		 </label>

		 <label for="bp_simple_post_text" ><?php _e( 'Post:', 'bsfep' ); ?>
			 
			 <?php wp_editor( $content, 'bp_simple_post_text', array( 'media_buttons'=> $this->allow_upload, 'quicktags'=> false)) ;?>
		  
		 </label>
		<?php if ( $this->has_post_thumbnail ):?>
			<div id="postimagediv"> 
				<div class="inside">
					<?php $thumbnail_id = get_post_meta( $post->ID, '_thumbnail_id', true );
						echo _wp_post_thumbnail_html( $thumbnail_id, $post->ID );
						?>
				</div>

			</div>
		<?php endif;?>
		<!-- taxonomy terms box -->
		
		<?php if ( $this->has_tax() ): ?>
			<div class='simple-post-taxonomies-box clearfix'>
				<?php $this->render_taxonomies();?>
				<div class="clear"></div>
			</div>
		<?php endif;?>

		<!-- custom fields -->
	   <?php if ( $this->has_custom_fields() ): ?>
		
		<div class='simple-post-custom-fields'>

			 <?php if ( $this->has_visible_meta() && $this->custom_field_title ): ?>
				 <h3> <?php echo $this->custom_field_title;?> </h3>
			 <?php endif;?>

			 <?php $this->render_custom_fields();?>
		 </div>

	   <?php endif;?>     

		<?php if ( $this->show_comment_option ): ?>
		
			<div class="simple-post-comment-option">
				
				<h4><?php _e( 'Allow Comments', 'bsfep');?></h4>
				
				<?php $current_status = $this->comment_status;
					
					if ( $post_id ) {
						$post =  get_post( $post_id );
						$current_status = $post->comment_status;
					}
				?>

				<label for="bp-simple-post-comment-status">
					<input id="bp-simple-post-comment-status" name="bp_simple_post_comment_status" type="checkbox" value="open" <?php echo checked('open', $current_status);?> /> <?php _e( 'Yes', 'bsfep');?>
			   </label>

			</div>   

		<?php endif;?>

		<input  type="hidden" value="<?php echo $_SERVER['REQUEST_URI']; ?>" name="post_form_url"  />
		<input id="submit" onsubmit="return validateForm()" name='bp_simple_post_form_subimitted' type="submit" value="<?php _e('Post','bsfep');?>" />
	</form>
</div>
<script>

function validateForm() {
    var x = document.forms["bp-form"]["custom_fields[description_du_projet]"].value; 
    if (x == null || x == "") {
        alert("Name must be filled out");
        return false;
    }
}</script>
<?php endif; ?>
