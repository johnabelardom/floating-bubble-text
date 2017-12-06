<?php 

  if ( ! $fbt_vars ) {
    echo "Provided ID doesn't exists.";
  } else {
    $fbt_seconds = $seconds;
    $fbt_vars = $fbt_vars[0];

?>
<div id="floating-bubble-text" style="max-width: 100%;">
  <div id="fbt-tooltip" class="">
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

  <div id="fbt-image" style="text-align: center;">
    <img src="<?= $fbt_vars->picture_link ?>" >
  </div>
</div>

<script>
  var char = jQuery('#fbt-image img');
  var tooltip = jQuery('#fbt-tooltip .arrow');
  var charPosition = char.position();
  var slideIndex = 1;

  function plusDivs(n) {
    showDivs(slideIndex += n);
  }

  function showDivs(n) {
    var i;

    var x = jQuery(".linkSlides");
    if (n > x.length) {slideIndex = 1}    
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
       x[i].style.opacity = "0";
       x[i].style.display = "none";
    }
    x[slideIndex-1].style.opacity = "1"; 
    x[slideIndex-1].style.display = "block";   
  }

  jQuery(document).ready(function() {
    jQuery('[data-link-slide=1]').attr('style', '');
    secs = jQuery('#fbt-content').attr('data-seconds');
    // setInterval(showDivs(1), 1);
    setInterval(function(){ plusDivs(1) }, secs);
  })

</script>

<style>

#fbt-tooltip {
    max-width: 100%;
    position: relative;
    padding: 50px 30px;
    margin: 0 auto;
    border: 5px solid #EB4747;
    text-align: center;
    color: #333;
    background: #fff;
    -webkit-border-top-left-radius: 240px 140px;
    -webkit-border-top-right-radius: 240px 140px;
    -webkit-border-bottom-right-radius: 240px 140px;
    -webkit-border-bottom-left-radius: 240px 140px;
    -moz-border-radius: 240px / 140px;
    border-radius: 240px / 140px;
}

#fbt-tooltip:before {
    content: "";
    position: absolute;
    z-index: 10;
    bottom: -30px;
    right: 100px;
    width: 40px;
    height: 40px;
    border: 5px solid #EB4747;
    background: #fff;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
    display: block;
}

#fbt-tooltip:after {
    content: "";
    position: absolute;
    z-index: 10;
    bottom: -60px;
    right: 125px;
    width: 25px;
    height: 25px;
    border: 5px solid #EB4747;
    background: #fff;
    -webkit-border-radius: 25px;
    -moz-border-radius: 25px;
    border-radius: 25px;
    display: block;
}


#fbt-tooltip, .linkSlides, #floating-bubble-text, #fbt-image {
  transition-property: all;
  transition-timing-function: ease-in-out;
  transition-duration: 1s
}

#fbt-image img {
  max-width: 50%;
}
</style>

<?php 

  } 

?>