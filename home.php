<?php
$get_section = $db->select("home_section",array("language_id" => $siteLanguage));
$row_section = $get_section->fetch();
$count_section = $get_section->rowCount();
@$section_heading = $row_section->section_heading;
@$section_short_heading = $row_section->section_short_heading;

$get_slides = $db->query("select * from home_section_slider LIMIT 0,1");
$row_slides = $get_slides->fetch();
$slide_id = $row_slides->slide_id; 
$slide_image = $row_slides->slide_image; 
?>
<style>
.list .row:nth-child(even) .image {
	order:1;
}
.list .row:nth-child(even) .contents {
	order:2;
}
.contents {display:flex; justify-content:center; align-items:center; flex-direction:column}
.contents h2 {font-size:3.2rem;}
.contents p {font-size:1.4rem;}
.contents .btn {padding:0.8rem 1.5rem; margin-top:1rem; font-size:15px;}
.list h1 {font-size:3.5rem;}
.fullscreen {width:100%; height:100vh; display:flex; align-items:center; justify-content:center; background-color:#f9f9f9;}
.gnav-search-inner.clearable {
    display: flex;
	justify-content:center;
}
.search-button-wrapper button {
	color: #FFF;
    background-color: #2ca35b;
    padding: .85rem 2rem;
    border-top-left-radius: 0px;
    border-bottom-left-radius: 0px;
    font-size: 1.2rem!important;
}
.search-input-wrapper.text-field-wrapper {
    /* display: flex; */
    width: 460px;
}
input#search-query {
    width: max-width:46opx;
    width: 100%;
    border: 1px solid #CFCBC8;
    padding: .9rem 2rem;
    margin-right: -3px;
    font-size: 1.2rem!important;
}
.leads {
    font-size: 1.6rem;
    text-align: center;
    margin-bottom: 20px;
    margin-top: -100px;
}
</style>
<!-- start market -->
<div class="container mb-5 cards">
	
	<div class="fullscreen">
		<div class="catnav-search-bar search-browse-wrapper with-catnav">
        <div class="search-browse-inner">
			  <p class="leads mb-5">Launching a token? Working on a Crypto project? <br/><small>Hire a <span class="text-primary">freelancer</span> now and pay with <span class="text-primary">VFY token</span>!</small></p>
          <form id="gnav-search" class="search-nav expanded-search apply-nav-height" method="post">
            <div class="gnav-search-inner clearable">
            
              <div class="search-input-wrapper text-field-wrapper">
                <input id="search-query" class="rounded" name="search_query"
                  placeholder="<?= $lang['search']['placeholder']; ?>" value="<?= @$_SESSION["search_query"]; ?>"  autocomplete="off">
              </div>
              <div class="search-button-wrapper hide">
                <button class="btn btn-primary" style="color:#FFF;background-color: <?php echo $site_color;?>" name="search" type="submit" value="Search">
                  <?= $lang['search']['button']; ?>
                </button>
              </div>
            </div>
			
            <ul class="search-bar-panel d-none"></ul>
          </form>
        </div>
      </div>
	</div>

  <div class="row">
    <div class="col-md-12 text-center list">
      <h1 class="mt-5 mb-1 <?=($lang_dir == "right" ? 'text-right':'')?>"><?= $lang['home']['cards']['title']; ?></h1>
      
      <div class="container"><!--- owl-carousel home-cards-carousel Starts --->
        <?php
          $get_cards = $db->select("home_cards",array("language_id" => $siteLanguage));
          while($row_cards = $get_cards->fetch()){
          $card_id = $row_cards->card_id;
          $card_title = $row_cards->card_title;
          $card_desc = $row_cards->card_desc;
          $card_image = getImageUrl("home_cards",$row_cards->card_image); 
          $card_link = $row_cards->card_link;
        ?>
        <div class="row p-5">
			<div class="col-lg-6 contents text-left">
				<h2><?= $card_title; ?></h2>
				<p><?= $card_desc; ?></p>
				<a href="<?= $card_link; ?>" class="btn btn-primary">View More</a>
			</div>
			<div class="col-lg-6 image">
				<img src="<?= $card_image; ?>" class="img-fluid" alt="<?= $card_title; ?>" />
			</div>
        </div>
        <?php } ?>
      </div><!--- owl-carousel home-cards-carousel Ends --->
    </div>
  </div>
</div>


<script>

$(document).ready(function(){

  var slider = $('#demo1').carousel({
    interval: 4000
  });

  var active = $(".carousel-item.active").find("video");
  var active_length = active.length;

  if(active_length == 1){
    slider.carousel('pause');
    console.log('paused');
    $(".carousel-indicators").css({"bottom": "90px"});
  }

  $("#demo1").on('slide.bs.carousel', function(event){
    var eq = event.to;
    // console.log(event.from);
    // console.log(event.to);
    var video = $(event.relatedTarget).find("video");
    if(video.length == 1){
        slider.carousel('pause');
        console.log('paused');
        $(".carousel-indicators").css({"bottom": "90px"});
        video.trigger('play');
    }else{
      $(".carousel-indicators").css({"bottom": "20px"});
    }
  });

  $('video').on('ended',function(){
    slider.carousel({'pause': false});
    console.log('started');
  });

});

</script>