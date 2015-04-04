<?php 
    /*
    Plugin Name: Latest Posts Slider
    Plugin URI: http://www.mobinerd.com/latest-posts-slider-wordpress-plugin/
    Description: A latest posts slider widget plugin
    Author: Srivathsan
    Version: 1.0
    Author URI: http://www.mobinerd.com
    */

setcookie("counter", 0, time() + (86400 * 30), "/"); // 86400 = 1 day

function featured_func(){
    
    include('slider.php');

} 

function slider(){
    
    $recent = wp_get_recent_posts($args);
    
    //print_r($recent);

   /* $image = wp_get_attachment_image_src( get_post_thumbnail_id(4), 'single-post-thumbnail' ); */
    
    for($i = 0; $i<5; $i++){
        
        update_option('feature_slider_' . $i, $recent[$i][post_title]);
        
        update_option('feature_author_id_' . $i, get_the_author($recent[$i][ID]));
        
        update_option('feature_slider_url_' . $i, $recent[$i][guid]);
        
        update_option('feature_slider_image_' . $i, wp_get_attachment_url( get_post_thumbnail_id($recent[$i][ID]) ));
        
    }

}



//Action Hooks
add_action('publish_post', 'slider');


//Widget area
add_action( 'widgets_init', function(){
     register_widget( 'Latest_posts' );
});	

/**
 * Adds Latest Posts widget.
 */
class Latest_posts extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'latest_post_slider', // Base ID
			__('Latest Posts Slider', 'text_domain'), // Name
			array( 'description' => __( 'Display a Latest Post Slider !', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
	
     	echo $args['before_widget'];
		
        //widget magic starts here
        
        ?>
        
        <style>
            .featured_main {
    
                width: 100%;
                height: 330px;
                position: relative;
                top: 0px;
                left: 0px;
                overflow: hidden;
                border: 3px solid #333;
            }
            
            .featured_main a {
    
                color: #fff;
                
            }
            
            .featured_main a:hover {
    
                color: #fff;
                text-decoration: underline;
                
            }
            
            .feature_title{
            
                background-color: rgba(0,0,0,0.7);
                position: absolute;
                bottom: 0px;
                font-size: 14px;
                width: 100%;
                padding: 10px;
                left: 0px;
            }
            
            .featured_main span {
                
                color: #fff;
                font-family: montserrat;
            
            }
            
            .featured_nav {
                position: absolute;
                top: 0px;
                right: 0px;
                width: 60px;
                height: 25px;
                background-color: rgba(0,0,0);
            }
            
            #feature_img {
                 box-shadow: inset 1px 1px 1px #000;
            }
            
            .featured_author {
                background-color: #333;
                position: absolute;
                top: 0px;
                right: 30px;
                font-size: 10px;
                font-family: Ubuntu;
                border-radius: 0 0 5px 5px;
                padding: 10px;
                z-index: 30;
            }
            
            .featured_right {
                position: absolute;
                bottom: 0px;
                right: 0px;
                padding: 10px;
                padding-bottom: 0;
                border-radius: 5px 5px 0 0;
            
            }
            
            .featured_right img {
                cursor: pointer;
            }
            
        </style>
        
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>

        <div class = "featured_main">
            
            <a id = "feature_url_img" href = "<?php echo get_option(feature_slider_url_0); ?>">
            <img id = "feature_img" src = "<?php echo get_option(feature_slider_image_0); ?>" width = "100%">
            </a>
                
            <span id = "feature_title" class = "feature_title">
                <a id = "feature_url" href = "<?php echo get_option(feature_slider_url_0); ?>">
                    <?php echo get_option(feature_slider_0); ?>
                </a>
            </span>
            
            <span class = "featured_author">
                POSTED BY SRI
            </span>
            
            <span class = "featured_right">
                <img src = "http://mobinerd.com/left.png" width = "22px" id = "pre_post">
                <img src = "http://mobinerd.com/right.png" width = "22px" id = "next_post">
            </span>
                
        </div>

        <script type = "text/javascript">
            
        $(document).ready(function(){
            
            var i = 0;
            var timeout;
            
            
            function nextpost(){
                
                
                    $("#feature_img").css("opacity", "0");    
                
                    if(i == 0){
                            
                            $("#feature_img").attr("src", "<?php echo get_option(feature_slider_image_1); ?>");
                            $("#feature_url").html("<?php echo get_option(feature_slider_1); ?>");
                            $("#feature_img_url").html("<?php echo get_option(feature_slider_1); ?>");
                            $("#feature_url").attr("href", "<?php echo get_option(feature_slider_url_1); ?>");
                    }
        
                    if(i == 1){
                        
                            $("#feature_img").attr("src", "<?php echo get_option(feature_slider_image_2); ?>");
                            $("#feature_url").html("<?php echo get_option(feature_slider_2); ?>");
                            $("#feature_img_url").html("<?php echo get_option(feature_slider_2); ?>");
                            $("#feature_url").attr("href", "<?php echo get_option(feature_slider_url_2); ?>");
                    }
        
                    if(i == 2){
                        
                            $("#feature_img").attr("src", "<?php echo get_option(feature_slider_image_3); ?>");
                            $("#feature_url").html("<?php echo get_option(feature_slider_3); ?>");
                            $("#feature_img_url").html("<?php echo get_option(feature_slider_3); ?>");
                            $("#feature_url").attr("href", "<?php echo get_option(feature_slider_url_3); ?>");
                    }
        
                    if(i == 3){
                            
                            $("#feature_img").attr("src", "<?php echo get_option(feature_slider_image_4); ?>");
                            $("#feature_url").html("<?php echo get_option(feature_slider_4); ?>");
                            $("#feature_img_url").html("<?php echo get_option(feature_slider_4); ?>");
                            $("#feature_url").attr("href", "<?php echo get_option(feature_slider_url_4); ?>");
                    }
        
        
                    if(i == 4){
                            
                            $("#feature_img").attr("src", "<?php echo get_option(feature_slider_image_0); ?>");
                            $("#feature_url").html("<?php echo get_option(feature_slider_0); ?>");
                            $("#feature_img_url").html("<?php echo get_option(feature_slider_0); ?>");
                            $("#feature_url").attr("href", "<?php echo get_option(feature_slider_url_0); ?>");
                    }
                
                    i++;
                
                    if(i==5)
                        i=0;
                
                     $("#feature_img").animate({opacity: 1});
            
            }
            
            function prepost(){
                
                
                    $("#feature_img").css("opacity", "0");    
                
                    if(i == 2){
                            
                            $("#feature_img").attr("src", "<?php echo get_option(feature_slider_image_1); ?>");
                            $("#feature_url").html("<?php echo get_option(feature_slider_1); ?>");
                            $("#feature_img_url").html("<?php echo get_option(feature_slider_1); ?>");
                            $("#feature_url").attr("href", "<?php echo get_option(feature_slider_url_1); ?>");
                    }
        
                    if(i == 3){
                        
                            $("#feature_img").attr("src", "<?php echo get_option(feature_slider_image_2); ?>");
                            $("#feature_url").html("<?php echo get_option(feature_slider_2); ?>");
                            $("#feature_img_url").html("<?php echo get_option(feature_slider_2); ?>");
                            $("#feature_url").attr("href", "<?php echo get_option(feature_slider_url_2); ?>");
                    }
        
                    if(i == 4){
                        
                            $("#feature_img").attr("src", "<?php echo get_option(feature_slider_image_3); ?>");
                            $("#feature_url").html("<?php echo get_option(feature_slider_3); ?>");
                            $("#feature_img_url").html("<?php echo get_option(feature_slider_3); ?>");
                            $("#feature_url").attr("href", "<?php echo get_option(feature_slider_url_3); ?>");
                    }
        
                    if(i == 0){
                            
                            $("#feature_img").attr("src", "<?php echo get_option(feature_slider_image_4); ?>");
                            $("#feature_url").html("<?php echo get_option(feature_slider_4); ?>");
                            $("#feature_img_url").html("<?php echo get_option(feature_slider_4); ?>");
                            $("#feature_url").attr("href", "<?php echo get_option(feature_slider_url_4); ?>");
                    }
        
        
                    if(i == 1){
                            
                            $("#feature_img").attr("src", "<?php echo get_option(feature_slider_image_0); ?>");
                            $("#feature_url").html("<?php echo get_option(feature_slider_0); ?>");
                            $("#feature_img_url").html("<?php echo get_option(feature_slider_0); ?>");
                            $("#feature_url").attr("href", "<?php echo get_option(feature_slider_url_0); ?>");
                    }
                
                    i--;
                
                    if(i==-1)
                        i=4;
                
                     $("#feature_img").animate({opacity: 1});
            
            }
            
            timeout = setInterval(function(){
                    
                nextpost();
                
            }, 5000);
            
            
            $("#next_post").click(function(){
                
                clearTimeout(timeout);
                nextpost();
            
            });
            
            $("#pre_post").click(function(){
                
                clearTimeout(timeout);
                prepost();
            
            });
            
                
        });
            
        </script>


        <?php
        
        //widget magic ends here
        
		echo $args["after_widget"];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ "title" ] ) ) {
			$title = $instance[ "title" ];
		}
		else {
			$title = __( "Latest Posts Slider", "text_domain" );
		}
		?>
		<p>
			Hit the Save Button and You're ready !
		</p>
		<?php 
        
        slider();
	}

} // class Latest_posts


?>