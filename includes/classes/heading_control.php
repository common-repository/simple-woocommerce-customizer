<?php


namespace SimpleWoocommerceCustomizer;



  class Heading_Control extends \WP_Customize_Control {

    /**
    * The type of customize control being rendered.
    *
    * @since  1.0.9
    * @access public
    * @var    string
    */
    public $type = 'heading';

    /**
    * Enqueue scripts/styles.
    *
    * @since  1.0.9
    * @access public
    * @return void
    */
    public function enqueue() {


    }

    /**
    * Displays the control content.
    *
    * @since  1.0.9
    * @access public
    * @return void
    */
    public function render_content() {
      echo "<h3>{$this->label}</h3>";
   }


  }

?>
