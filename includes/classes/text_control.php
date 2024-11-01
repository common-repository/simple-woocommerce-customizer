<?php


namespace SimpleWoocommerceCustomizer;

class Text_Control extends \WP_Customize_Control {

  public $heading = 'heading';


  /**
  * Displays the control content.
  *
  * @since  1.0.9
  * @access public
  * @return void
  */
  protected function render() {
    $id    = 'customize-control-' . str_replace( array( '[', ']' ), array( '-', '' ), $this->id );
    $class = 'customize-control customize-control-' . $this->type;

    printf( '<li id="%s" class="%s">', esc_attr( $id ), esc_attr( $class ) );
    $this->render_content();
    echo '</li>';
  }

  /**
  * Render the control's content.
  *
  * Allows the content to be overridden without having to rewrite the wrapper in `$this::render()`.
  *
  * Supports basic input types `text`, `checkbox`, `textarea`, `radio`, `select` and `dropdown-pages`.
  * Additional input types such as `email`, `url`, `number`, `hidden` and `date` are supported implicitly.
  *
  * Control content can alternately be rendered in JS. See WP_Customize_Control::print_template().
  *
  * @since 3.4.0
  */
  protected function render_content() {

    $input_id         = '_customize-input-' . $this->id;
    $description_id   = '_customize-description-' . $this->id;
    $describedby_attr = ( ! empty( $this->description ) ) ? ' aria-describedby="' . esc_attr( $description_id ) . '" ' : '';

    ?>
    <?php if ( trim( $this->heading ) != '' ) : ?>
      <h2 class="customize-control-title" style="color:#555d66"><?php echo $this->heading; ?></h2>
    <?php endif; ?>
    <?php if ( ! empty( $this->label ) ) : ?>
      <label for="<?php echo esc_attr( $input_id ); ?>" class="customize-control-title"><?php echo esc_html( $this->label ); ?></label>
    <?php endif; ?>
    <?php if ( ! empty( $this->description ) ) : ?>
      <span id="<?php echo esc_attr( $description_id ); ?>" class="description customize-control-description"><?php echo $this->description; ?></span>
    <?php endif; ?>
    <input
    id="<?php echo esc_attr( $input_id ); ?>"
    type="<?php echo esc_attr( $this->type ); ?>"
    <?php echo $describedby_attr; ?>
    <?php $this->input_attrs(); ?>
    <?php if ( ! isset( $this->input_attrs['value'] ) ) : ?>
      value="<?php echo esc_attr( $this->value() ); ?>"
    <?php endif; ?>
    <?php $this->link(); ?>
    />
    <?php

  }

}

?>
