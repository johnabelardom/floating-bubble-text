<?php 
  // var_dump( $fbt_vars );
  // var_dump( $fbt_content );

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
    followRightCenter();
  })

  jQuery(window).on('resize', function() {
    followRightCenter();
  });

  function followTopLeft() {
    var imgPos = jQuery('#fbt-image').position();
    var tooltip = document.getElementById('fbt-tooltip');
    var x = imgPos.left + 25;
    var y = imgPos.top - 50;
    tooltip.style.position = "absolute";
    tooltip.style.left = x +'px';
    tooltip.style.top = y +'px';
  }

  function followTopRight() {
    var imgPos = jQuery('#fbt-image').position();
    var d = document.getElementById('fbt-tooltip');
    var x = imgPos.left + (imgPos.left / 2);
    var y = imgPos.top - 50;
    d.style.position = "absolute";
    d.style.left = x + 'px';
    d.style.top = y + 'px';
  }
  function followRightCenter() {
    var imgPos = jQuery('#fbt-image').position();
    var img = jQuery('#fbt-image');
    var tooltip = document.getElementById('fbt-tooltip');
    var x = imgPos.left + 25;
    var y = imgPos.top + ((img.height() / 2 + 1) - (tooltip.offsetHeight *2));
    console.log(x, y)
    tooltip.style.position = "absolute";
    tooltip.style.left = x + 'px';
    tooltip.style.top = y + 'px';
  }
  function followLeftCenter() {
    var imgPos = jQuery('#fbt-image').position();
    var img = jQuery('#fbt-image');
    var tooltip = document.getElementById('fbt-tooltip');
    var x = imgPos.left + (imgPos.left / 2);
    var y = imgPos.top + ((img.height() / 2 + 1) - (tooltip.offsetHeight *2));
    tooltip.style.position = "absolute";
    tooltip.style.left = x + 'px';
    tooltip.style.top = y + 'px';
  }


</script>

<style>

/*#fbt-tooltip {
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
}*/


#fbt-tooltip, .linkSlides, #floating-bubble-text, #fbt-image {
  transition-property: all;
  transition-timing-function: ease-in-out;
  transition-duration: 0.5s
}

#fbt-image img {
  max-width: 50%;
}

#fbt-tooltip {
  position: relative;
  background: #999;
  border-radius: .4em;
  padding: 30px;
  max-width: 100%;
  max-height: 100%;
  text-align: center;
}

#fbt-tooltip:after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 50%;
  width: 0;
  height: 0;
  border: 28px solid transparent;
  border-top-color: #eee;
  border-bottom: 0;
  margin-left: -14px;
  margin-bottom: -28px;
}
</style>

<?php 

  } 

?>