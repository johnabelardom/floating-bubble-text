<?php 
  // var_dump( $fbt_vars );
  // var_dump( $fbt_content );
  // exit(var_dump($bubble_position));

  if ( ! $fbt_vars ) {
    echo "Provided ID doesn't exists.";
  } else {
    $fbt_seconds = $seconds;
    $fbt_vars = $fbt_vars[0];

?>
<div id="floating-bubble-text" class="<?= $pos == '' ? '' : $pos  ?>" style="">
  <div id="fbt-tooltip" data-position-bubble="<?= $bubble_position ?>" class="<?= $bubble_position != 'top' ? "bubble" : "" ?>">
    <div id="fbt-content" data-seconds="<?= $fbt_seconds ?>">
    <?php 
      $x = 1;
      foreach ($fbt_content as $key => $post) {
    ?>
      <div class="linkSlides" data-link-slide="<?= $x++ ?>" style="opacity: 0; display: none;">
        <a href="<?= $post->guid ?>" target="_blank"><?= $post->post_title ?></a>
      </div>
    <?php 
      }
    ?>
    </div>
  </div>

  <div id="fbt-image" style="text-align: <?= $picture_align ?>;">
    <img src="<?= $fbt_vars->picture_link ?>" >
  </div>
</div>

<script>

</script>

<style>
  #fbt-tooltip {
    background: <?php echo $bubble_position == 'right' || $bubble_position == 'left' ? '#fff' : $bubble_color; ?>;
  }

  .top:after {
    border-top-color: <?php echo $bubble_color; ?>;
  }
</style>

<?php 

  } 

?>