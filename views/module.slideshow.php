<?php
/* First Slideshow */
$reslide = $slideImg ='';

$Records = Slideshow::getSlideshow_by(0);


if($Records) {
    $imgLink = '';
    foreach($Records as $record){
        $file_path = SITE_ROOT . 'images/slideshow/' . $record->image;
        if(file_exists($file_path)){
            $imgLink = IMAGE_PATH .'slideshow/' . $record->image;
        }else{
            $imgLink = BASE_URL . 'template/web/assets/images/main.png';
        }

        $slideImg .= '
            <div class="item">
                <div class="relative-container">
                    <img src="' . $imgLink . '" alt="'. $record->title .'" class="absolute-image">
                </div>
            </div>
        ';
    }

    $reslide = '
        <figure class="hero-banner">
            <img src="'. BASE_URL .'template/web/assets/images/hero-banner-bg.png" width="820" height="716" alt="" aria-hidden="true" class="w-100 hero-img-bg position-absolute">
            
            <div class="owl-carousel home-banner">
              '. $slideImg .'
            </div>
          
          </figure>
    ';
}

$jVars['module:slideshow']= $reslide;
?>