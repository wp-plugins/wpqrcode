<?php
/*
	Plugin Name: WpQrCode
	Plugin URI: http://www.superbcodes.com/
	Description: This allows user to add a widget that generates QrCode for every page dynamically. Whenever a visitor visits the site the widget will show qrcode for current page that the visitor is visiting. User can add the widget with and without title, define the size of the qrcode, fill color and background color. If the user finds that widget is not working because of any problem with theme user can add custom HTML tag before and after the widget. Multiple widgets can be added same time.
	Tags: Qrcode,Dynamic,Widget,Canvas,Image,Html5
	Version: 1.0.2
	Author:	Nazmul Hossain Nihal
	Author URI: http://www.SuperbCodes.com/
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
	class WpQrCode extends WP_Widget {
		
		public function __construct(){
			parent::__construct(
				'WpQrCode',
				__( 'QrCode', 'WpQrCode' ), 
				array( 'description' => __( 'Generate QrCode for every page ', 'WpQrCode' ), )
			);
		}
		public function form( $instance ){
			$title = ! empty( $instance['title'] ) ? $instance['title'] : "";
			$type = ! empty( $instance['type'] ) ? $instance['type'] : "image";
			$size = ! empty( $instance['size'] ) ? $instance['size'] : "150";
			$fill = ! empty( $instance['fill'] ) ? $instance['fill'] : "#000000";
			$background = ! empty( $instance['background'] ) ? $instance['background'] : "#FFFFFF";
			$min = ! empty( $instance['min'] ) ? $instance['min'] : "4";
			$quiet = ! empty( $instance['quiet'] ) ? $instance['quiet'] : "";
			$before = ! empty( $instance['before'] ) ? $instance['before'] : "";
			$after = ! empty( $instance['after'] ) ? $instance['after'] : "";
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
				
				<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e( 'Type:' ); ?></label> 
				<select class="widefat" id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>">
					<?php
					
					$options = array(
						"image" => "Image",
						"canvas" => "Canvas"
					);
					
					foreach( $options as $value => $name ) {
						$selected = ( $type == $value ) ? 'selected="true"' : ''; 
						echo '<option value="' . $value . '" ' . $selected . '>' . $name . '</option>';
					}

					?>
				</select>
				
				<label for="<?php echo $this->get_field_id( 'size' ); ?>"><?php _e( 'Size: (in pixels)' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'size' ); ?>" name="<?php echo $this->get_field_name( 'size' ); ?>" type="text" value="<?php echo esc_attr( $size ); ?>">
				
				<label for="<?php echo $this->get_field_id( 'fill' ); ?>"><?php _e( 'Fill:' ); ?></label> <br />
				<input class="widefat color" id="<?php echo $this->get_field_id( 'fill' ); ?>" name="<?php echo $this->get_field_name( 'fill' ); ?>" type="text" value="<?php echo esc_attr( $fill ); ?>">
				<br />
				<label for="<?php echo $this->get_field_id( 'background' ); ?>"><?php _e( 'Background:' ); ?></label><br /> 
				<input class="widefat color" id="<?php echo $this->get_field_id( 'background' ); ?>" name="<?php echo $this->get_field_name( 'background' ); ?>" type="text" value="<?php echo esc_attr( $background ); ?>">
				<br />
				<label for="<?php echo $this->get_field_id( 'min' ); ?>"><?php _e( 'Min Version:' ); ?></label> 
				<select class="widefat" id="<?php echo $this->get_field_id( 'min' ); ?>" name="<?php echo $this->get_field_name( 'min' ); ?>">
				  <?php
					
					$options = array(
						"1" => "1",
						"2" => "2",
						"3" => "3",
						"4" => "4",
						"5" => "5",
						"6" => "6",
						"7" => "7",
						"8" => "8",
						"9" => "9",
						"10" => "10"
					);
					
					foreach( $options as $value => $name ) {
						$selected = ( $min == $value ) ? 'selected="true"' : ''; 
						echo '<option value="' . $value . '" ' . $selected . '>' . $name . '</option>';
					}

					?>
				</select>
				
				<label for="<?php echo $this->get_field_id( 'quiet' ); ?>"><?php _e( 'Quiet Zone:' ); ?></label> 
				<select class="widefat" id="<?php echo $this->get_field_id( 'quiet' ); ?>" name="<?php echo $this->get_field_name( 'quiet' ); ?>">
				  <?php
					
					$options = array(
						"0" => "0",
						"1" => "1",
						"2" => "2",
						"3" => "3",
						"4" => "4"
					);
					
					foreach( $options as $value => $name ) {
						$selected = ( $quiet == $value ) ? 'selected="true"' : ''; 
						echo '<option value="' . $value . '" ' . $selected . '>' . $name . '</option>';
					}

					?>
				</select>
				<label for="<?php echo $this->get_field_id( 'before' ); ?>"><?php _e( 'Before Widget Codes:' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'before' ); ?>" name="<?php echo $this->get_field_name( 'before' ); ?>" type="text" value="<?php echo esc_attr( $before ); ?>">
				
				<label for="<?php echo $this->get_field_id( 'after' ); ?>"><?php _e( 'After Widget Codes:' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'after' ); ?>" name="<?php echo $this->get_field_name( 'after' ); ?>" type="text" value="<?php echo esc_attr( $after ); ?>">
				<p>
				If you find this plugin useful then please rate this plugin <a style="text-decoration:none;" href="http://wordpress.org/extend/plugins/wpqrcode" target="_blank">here</a> <br /> and don't forget to visit my website <a style="text-decoration:none;" href="http://www.SuperbCodes.com/" target="_blank">SuperbCodes.com</a>.
				<br />
				<a style="text-decoration:none;" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=FYMPLJ69H9EM6" target="_blank">Donate This Plugin</a>
				</p>
			</p>
			<?php
		}

		public function widget( $args, $instance ){
			echo $args['before_widget'];
			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
			}
			echo $instance["before"];
			echo '<div style="text-align:center;">';
			ob_start();
			?>
				<script>
					$(document).ready(function(){
						$(".<?php echo $args['widget_id']; ?>").qrcode({
							"render": "<?php echo $instance["type"]; ?>",
							"fill": "<?php echo $instance["fill"]; ?>",
							"background": "<?php echo $instance["background"]; ?>",
							"quiet": "<?php echo $instance["quiet"]; ?>",
							"minVersion": "<?php echo $instance["min"]; ?>",
							"size": "<?php echo $instance["size"]; ?>",
							"height": "<?php echo $instance["size"]; ?>",
							"width": "<?php echo $instance["size"]; ?>",
							"text": "<?php echo "http://".$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>"
						});
					});
				 </script>
				<div class="<?php echo $args['widget_id']; ?>"></div>
			<?php
			echo ob_get_clean();
			echo '</div>';
			echo $instance["after"];
			echo $args['after_widget'];
		}
		
	}
	
	function register_WpQrCode() {
		register_widget( 'WpQrCode' );
	}
	
	add_action( 'widgets_init', 'register_WpQrCode' );
	
	
	function wpqrcode_add_color_picker( $hook ) {
	 
		if( is_admin() ) {   
			wp_enqueue_style( 'wp-color-picker' ); 
			wp_enqueue_script( 'custom-script-handle', plugins_url( 'js/jscolor.js', __FILE__ ), array( 'wp-color-picker' ), false, true ); 
		}
	}
	add_action( 'admin_enqueue_scripts', 'wpqrcode_add_color_picker' );
	
	function wpqrcode_scripts() {
		wp_enqueue_script('custom-script-1',  plugins_url('js/script.js', __FILE__), array('scriptaculous'));
		wp_enqueue_script('custom-script-2',plugins_url('js/wpqrcode.js', __FILE__),array( 'scriptaculous' ));
	}

	add_action( 'wp_enqueue_scripts', 'wpqrcode_scripts' );

?>