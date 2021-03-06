<?php

if ( isset($_POST['name_of_nonce_field']) and wp_verify_nonce( $_POST['name_of_nonce_field'], 'name_of_my_action') ){
  $post = (object) [
    'url' => get_site_url(),
    'rating' => $_POST['radio'],
    'comment' => $_POST['problems']
  ];

  $post = json_encode($post);

  $ch = curl_init('https://lapshin.pw/api/votes/add.php');

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

  $response = curl_exec($ch);
  $response = json_decode($response, true);

  curl_close($ch);

  if (isset($response['message']) and $response['message'] == 'Entry Created') {

    // Update option when user voted
    if ( !get_option( 'divi_metric_voted' ) ) {
      add_option( 'divi_metric_voted', time() );
    } else {
      update_option( 'divi_metric_voted', time() );
    }

    // Show success notice
    echo '
      <div class="nps-alert alert-success">
        Спасибо за вашу оценку. Она поможет нам улучшить наш продукт.
      </div>
    ';
  } else {
    echo '
      <div class="nps-alert alert-danger" role="alert">
        Не верный ввод данных. Пожалуйста, повторите.
      </div>
    ';
  }
}

/**
 * Hook for adding the custom plugin page header
 */
do_action( 'divi-metric/plugin_page_header' );
?>
<div class="ocdi  wrap  about-wrap">
  <?php ob_start(); ?>
  <h1 id="epanel-title"><?php esc_html_e( 'Divi Metric', 'Divi' ); ?></h1>
  <?php
    $plugin_title = ob_get_clean();

    // Display the plugin title (can be replaced with custom title text through the filter below).
    echo wp_kses_post( apply_filters( 'divi-metric/plugin_page_title', $plugin_title ) );
  ?>

  <div class="nps">
    <div class="nps-header">
      <?php esc_html_e( 'Divi Metric', 'Divi' ); ?>
    </div>
    <form method="post" id="nps-computy" action="?page=divi-metric">
      <?php wp_nonce_field('name_of_my_action','name_of_nonce_field'); ?>
      <div class="question-container">
        <div class="desc-nps">Пoжaлуйcтa, oцeнитe пo шкaлe oт 0 дo 10, нacкoлькo вepoятнo, чтo Bы пopeкoмeндуeтe нac дpугу или кoллeгe?</div>
        <div class="nps-radios" >
          <input type="radio" id="radio-0" name="radio" value="0"   >
          <label for="radio-0">
            <div class="index i0">0</div>
          </label>

          <input type="radio" id="radio-1" name="radio" value="1">
          <label for="radio-1">
            <div class="index i1">1</div>
          </label>

          <input  type="radio" id="radio-2" name="radio" value="2">
          <label for="radio-2">
            <div class="index i2">2</div>
          </label>

          <input  type="radio" id="radio-3" name="radio" value="3">
          <label for="radio-3">
            <div class="index i3">3</div>
          </label>

          <input type="radio" id="radio-4" name="radio" value="4">
          <label for="radio-4">
              <div class="index i4">4</div>
          </label>

          <input type="radio" id="radio-5" name="radio" value="5">
          <label for="radio-5">
              <div class="index i5">5</div>
          </label>

          <input  type="radio" id="radio-6" name="radio" value="6">
          <label for="radio-6">
              <div class="index i6">6</div>
          </label>

          <input  type="radio" id="radio-7" name="radio" value="7">
          <label for="radio-7">
              <div class="index i7">7</div>
          </label>

          <input  type="radio" id="radio-8" name="radio" value="8">
          <label for="radio-8">
              <div class="index i8">8</div>
          </label>
          <input type="radio" id="radio-9" name="radio" value="9">
          <label for="radio-9">
              <div class="index i9">9</div>
          </label>

          <input type="radio" id="radio-10" name="radio" value="10">
          <label for="radio-10">
              <div class="index i10">10</div>
          </label>
        </div>
      </div>
      <div class="nps-input-forms">
        <div class="textarea">
          <div class="title-nps">
          Baши пpeдлoжeния пo улучшeнию кaчecтвa нaшeй paбoты (дoпoлнитeльныe уcлуги и т.д.)
          </div>
          <textarea cols="30" rows="5" class="nps-textarea" name="problems" required></textarea>
        </div>         
        <div class="clear">
            <button name="button" type="submit" class="nps-submit"><span class="spin"></span>Отправить</button>
        </div>
      </div>
    </form>
  </div>
</div>