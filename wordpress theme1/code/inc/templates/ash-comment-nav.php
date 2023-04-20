  <nav  class="comment-navigation" role="navigation">
    <h3><?php esc_html_e('Comment navigation','Ash_theme' ); ?> </h3>
  			<div class="row">
         		<div class="col-xs-12 col-sm-6">
              <div class="post-link-nav">
                <i class="fa fa-chevron-left fa-3x" aria-hidden="true"></i>
								<?php previous_comments_link(esc_html__('Older Comments','Ash_theme')) ?>
              </div>                
						</div>  
          	<div class="col-xs-12 col-sm-6 text-right">
              <div class="post-link-nav">
                <?php next_comments_link(esc_html__('New Comments','Ash_theme')) ?>
              <i class="fa fa-chevron-right fa-3x" aria-hidden="true"></i>
              </div>                
						</div>  
				</div>  <!--row-->
  </nav>