<?php
function vardump($var) {
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
}
?>
<div class="ocdi  wrap  about-wrap">
  <h1 class="ocdi__title"><?php esc_html_e( 'One Click Demo Import', 'Divi' ); ?></h1>
  <div class="ocdi__intro-text">
		<p class="about-description">
			<?php esc_html_e( 'Importing demo data (post, pages, images, theme settings, ...) is the easiest way to setup your theme.', 'Divi' ); ?>
		</p>

		<p class="sub-description dashicons-before dashicons-info">
			<?php esc_html_e( 'It will allow you to quickly edit everything instead of creating content from scratch.', 'Divi' ); ?>
		</p>
	</div>
  <?php $categories = DiviImport::get_all_categories(); ?>
  <?php //echo vardump(DiviImport::get_all_templates()); ?>
  <!-- OCDI grid layout -->
  <div class="ocdi__gl  js-ocdi-gl">



    <div id="ocdi_gl-header" class="ocdi__gl-header  js-ocdi-gl-header no-display">
      <nav class="ocdi__gl-navigation">
        <ul>
          <li class="active"><a href="#all" class="ocdi__gl-navigation-link  js-ocdi-nav-link"><?php esc_html_e( 'All', 'Divi' ); ?></a></li>
          <?php foreach ( $categories as $key => $name ) : ?>

            <?php if ( $name == 'company' ) $title = esc_html__( 'category-company', 'Divi' ); ?>
            <?php if ( $name == 'shop' ) $title = esc_html__( 'category-ecommerce', 'Divi' ); ?>
            <?php if ( $name == 'blog' ) $title = esc_html__( 'category-blog', 'Divi' ); ?>
            <?php if ( $name == 'portfolio' ) $title = esc_html__( 'category-portfolio', 'Divi' ); ?>
            <?php if ( $name == 'landing' ) $title = esc_html__( 'category-landing', 'Divi' ); ?>

            <li><a href="#<?php echo esc_attr( $name ); ?>" class="ocdi__gl-navigation-link  js-ocdi-nav-link"><?php echo esc_html( $title ); ?></a></li>
          <?php endforeach; ?>
        </ul>
      </nav>
      <div clas="ocdi__gl-search">
        <input type="search" class="ocdi__gl-search-input  js-ocdi-gl-search" name="ocdi-gl-search" value="" placeholder="<?php esc_html_e( 'Search demos...', 'Divi' ); ?>">
      </div>
    </div>


    <div class="ocdi__gl-header  js-ocdi-gl-header">
      <nav class="ocdi__gl-navigation">
        <ul>
          <li class="active"><a href="#all" class="ocdi__gl-navigation-link  js-ocdi-nav-link"><?php esc_html_e( 'All', 'Divi' ); ?></a></li>
          <?php foreach ( $categories as $key => $name ) : ?>

            <?php if ( $name == 'company' ) $title = esc_html__( 'category-company', 'Divi' ); ?>
            <?php if ( $name == 'shop' ) $title = esc_html__( 'category-ecommerce', 'Divi' ); ?>
            <?php if ( $name == 'blog' ) $title = esc_html__( 'category-blog', 'Divi' ); ?>
            <?php if ( $name == 'portfolio' ) $title = esc_html__( 'category-portfolio', 'Divi' ); ?>
            <?php if ( $name == 'landing' ) $title = esc_html__( 'category-landing', 'Divi' ); ?>

            <li><a href="#<?php echo esc_attr( $name ); ?>" class="ocdi__gl-navigation-link  js-ocdi-nav-link"><?php echo esc_html( $title ); ?></a></li>
          <?php endforeach; ?>
        </ul>
      </nav>
      <div clas="ocdi__gl-search">
        <input type="search" class="ocdi__gl-search-input  js-ocdi-gl-search" name="ocdi-gl-search" value="" placeholder="<?php esc_html_e( 'Search demos...', 'Divi' ); ?>">
      </div>
    </div>
    <div class="ocdi__gl-item-container  wp-clearfix  js-ocdi-gl-item-container">
      <?php $templates = DiviImport::get_all_templates(); ?>
      <?php foreach ( $templates as $index => $item ) : ?>
        <?php $string = str_replace(' ', '', $item['categories']); ?>
        <div class="ocdi__gl-item js-ocdi-gl-item" data-categories="<?php echo esc_attr( strtolower($string) ); ?>" data-name="<?php echo esc_attr( strtolower($item['title'] )); ?>">
          <div class="ocdi__gl-item-image-container">
            <img class="ocdi__gl-item-image" src="<?php echo $item['url_screenshot']; ?>" alt="screenshot">
          </div>
          <div class="ocdi__gl-item-footer  ocdi__gl-item-footer--with-preview">
            <h4 class="ocdi__gl-item-title" title="<?php echo $item['title']; ?>">
              <?php echo $item['title']; ?>
            </h4>
            <button class="ocdi__gl-item-button  button  button-primary  js-ocdi-gl-import-data" value="<?php echo esc_attr( $index ); ?>"><?php esc_html_e( 'Choose it', 'Divi' ); ?></button>
            <a class="ocdi__gl-item-button  button" href="<?php echo esc_url( $item['url_preview'] ); ?>" target="_blank"><?php esc_html_e( 'Preview', 'Divi' ); ?></a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div id="js-ocdi-modal-content"></div>
  <p class="ocdi__ajax-loader  js-ocdi-ajax-loader">
    <span class="spinner"></span> <?php esc_html_e( 'Importing, please wait!', 'Divi' ); ?>
  </p>

  <div class="ocdi__response  js-ocdi-ajax-response"></div>
</div>



