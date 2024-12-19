<?php
$resinndetail = $imageList = $innerbred = $t = '';
$homearticle = Article::find_by_id(22);
if (!empty($homearticle)) {
    if ($homearticle->image != "a:0:{}") {
        $imageList = unserialize($homearticle->image);
        $imgno = array_rand($imageList);
        $file_path = SITE_ROOT . 'images/articles/' . $imageList[$imgno];
        if (file_exists($file_path)) {
            $imglink = IMAGE_PATH . 'articles/' . $imageList[$imgno];
        } else {
            $imglink = BASE_URL . 'template/web/img/mosaic_2.jpg';
        }
    } else {
        $imglink = BASE_URL . 'template/cms/img/mosaic_2.jpg';
    }
    $t .= ' <div class="col-xs-12">
                     <a href="' . BASE_URL . 'page/' . $homearticle->slug . '">
                    <div class="mosaic_container">
                        <img src="' . $imglink . '" alt="' . $homearticle->title . '" class="img-responsive add_bottom_30"><span class="caption_2"> ' . $homearticle->title . '</span>
                    </div>
                    </a>
                </div>';


}

$jVars['module:aboutarticle'] = $t;

/**
 *      Home page
 */
$resinnh = $articleQuality = $articleDelivery = '';

if (defined('HOME_PAGE')) {
    $recInn = Article::homepageArticle();
    // pr($recInn,1);
    if (!empty($recInn)) {
        // foreach ($recInn as $innRow) {
        //     $content = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($innRow->content));
        //     $readmore = '';
        //     if (!empty($innRow->linksrc)) {
        //         $linkTarget = ($innRow->linktype == 1) ? ' target="_blank" ' : '';
        //         $linksrc = ($innRow->linktype == 1) ? $innRow->linksrc : BASE_URL . $innRow->linksrc;
        //         $readmore = '<a href="' . $linksrc . '" title="">see more</a>';
        //     } else {
        //         $readmore = (count($content) > 1) ? '<a href="' . BASE_URL . 'page/' . $innRow->slug . '" title="">Read more...</a>' : '';
        //     }
        //     $resinnh .= '
        //         <div class="about-content">

        //             '. $innRow->content .'                    

        //             <button class="btn btn-hover" onclick="document.getElementById(\'orderplace\').scrollIntoView({ behavior: \'smooth\' });">
        //             Order Now
        //         </button>


        //   </div>
        //     ';
        // }
        foreach($recInn as $innRow){
            if($innRow->id == 16) 
            {
                $imgLink = '';
                if($innRow->image != 'a:0:{}'){
                    $unserializedImg = unserialize($innRow->image)[0];
                    $file_path = SITE_ROOT . 'images/articles/' . $unserializedImg;
                    if(file_exists($file_path)){
                        $imgLink = IMAGE_PATH . 'articles/' . $unserializedImg;
                    }else{
                        $imgLink = BASE_URL . 'template/web/assets/images/about-banner.png';
                    }
                }
                $resinnh = '
                    <section class="section section-divider gray about" id="services">
                        <div class="container">

                            <div class="about-banner">
                                
                                <img src="'. $imgLink .'" width="509" height="459" loading="lazy" alt="Burger with Drinks"
                                class="w-100 about-img">

                                <img src="'. BASE_URL .'template/web/assets/images/deli (2).png" width="200" height="400" alt="get up to 50% off now"
                                class="abs-img scale-up-anim">
                            </div>

                            <div class="about-content">
                                <h2 class="h2 section-title">
                                '. $innRow->title .'
                                <span class="span">'. $innRow->sub_title .'</span>
                                </h2>
                                    '. $innRow->content .'                    
                                <button class="btn btn-hover" onclick="document.getElementById(\'orderplace\').scrollIntoView({ behavior: \'smooth\' });">
                                    Order Now
                                </button>
                            </div>

                        </div>
                    </section>
                ';
            }

            if($innRow->id == 17){
                $imgLink = '';
                if($innRow->image != 'a:0:{}'){
                    $unserializedImg = unserialize($innRow->image)[0];
                    $file_path = SITE_ROOT . 'images/articles/' . $unserializedImg;
                    if(file_exists($file_path)){
                        $imgLink = IMAGE_PATH . 'articles/' . $unserializedImg;
                    }else{
                        $imgLink = BASE_URL . 'template/web/assets/images/cta-banner.png';
                    }
                }

                $articleQuality = '
                    <section class="section section-divider white cta" style="background-image: url(\''. BASE_URL .'template/web/assets/images/hero-bg.jpg\')">
                        <div class="container">

                            <div class="cta-content">

                                <h2 class="h2 section-title">
                                    '. $innRow->title .'
                                    <span class="span">'. $innRow->sub_title .'</span>
                                </h2>

                                <p class="section-text">'. strip_tags($innRow->content) .'</p>

                                <button class="btn btn-hover">Order Now</button>
                            </div>

                            <figure class="cta-banner">
                                <img src="'. $imgLink .'" width="700" height="637" loading="lazy" alt="Burger"
                                class="w-100 cta-img">

                                <!-- <img src="'. BASE_URL .'template/web/assets/images/sale-shape.png" width="216" height="226" loading="lazy"
                                alt="get up to 50% off now" class="abs-img scale-up-anim"> -->
                            </figure>

                        </div>
                    </section>
                ';
            }

            if($innRow->id = 18){
                $imgLink = '';
                if($innRow->image != 'a:0:{}'){
                    $unserializedImg = unserialize($innRow->image)[0];
                    $file_path = SITE_ROOT . 'images/articles/' . $unserializedImg;
                    if(file_exists($file_path)){
                        $imgLink = IMAGE_PATH . 'articles/' . $unserializedImg;
                    }else{
                        $imgLink = BASE_URL . 'template/web/assets/images/delivery-boy.svg';
                    }
                }

                $articleDelivery = '
                    <section class="section gray delivery">
                        <div class="container">

                        <div class="delivery-content">

                            <h2 class="h2 section-title">
                            '. $innRow->title .' <span class="span">'. $innRow->sub_title .'</span> <!--At your place-->
                            </h2>

                            <p class="section-text">
                                '. preg_replace('/<\/?p>/','',$innRow->content) .'
                            </p>

                            <button class="btn btn-hover">Order Now</button>
                        </div>

                        <figure class="delivery-banner">
                            <img src="'. BASE_URL .'template/web/assets/images/delivery-banner-bg.png" width="700" height="602" loading="lazy" alt="clouds"
                            class="w-100">

                            <img src="'. $imgLink .'" width="1000" height="880" loading="lazy" alt="delivery boy"
                            class="w-100 delivery-img" data-delivery-boy>
                        </figure>

                        </div>
                    </section>
                ';
            }
        }
    }

}

$jVars['module:home-article'] = $resinnh;
$jVars['module:home-article-1'] = $articleQuality;
$jVars['module:home-article-2'] = $articleDelivery;

/**
 *      Inner page detail
 */

$aboutdetail = $imageList = $aboutbred = '';

if (defined('INNER_PAGE') and isset($_REQUEST['slug'])) {
    $slug = addslashes($_REQUEST['slug']);
    $recRow = Article::find_by_slug($slug);

    if (!empty($recRow)) {

        $imglink = BASE_URL . 'template/web/images/default.jpg';
        if ($recRow->image != "a:0:{}") {
            $imageList = unserialize($recRow->image);
            $imgno = array_rand($imageList);
            $file_path = SITE_ROOT . 'images/articles/' . $imageList[$imgno];
            if (file_exists($file_path)) {
                $imglink = IMAGE_PATH . 'articles/' . $imageList[$imgno];
            }
            else{
                $imglink = BASE_URL . 'template/web/images/default.jpg';
            }
        }
        
        $innerbred .= '
        <!--================ Breadcrumb ================-->
        <div class="mad-breadcrumb with-bg-img with-overlay" data-bg-image-src="' . $imglink . '">
            <div class="container wide">
                <h1 class="mad-page-title">' . $recRow->title . '</h1>
                <nav class="mad-breadcrumb-path">
                    <span><a href="home" class="mad-link">Home</a></span> /
                    <span>' . $recRow->title . '</span>
		                    </nav>
            </div>
        </div>

        <!--================ End of Breadcrumb ================-->
        ';

        $rescontent = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->content));
        $content = !empty($rescontent[1]) ? $rescontent[1] : $rescontent[0];

        $aboutdetail .= 
        '<div class="mad-content no-pd">
            <div class="container">
                <div class="mad-section">
                    <div class="mad-entities mad-entities-reverse type-4">
                    '. $content.' 
                    </div>
                </div>
            </div>
        </div>';

    } else {
        redirect_to(BASE_URL);
    }
}

$jVars['module:inner-about-detail'] = $aboutdetail;
$jVars['module:inner-about-bread'] = $innerbred;


$restyp = '';

$typRow = Article::get_by_type();
if (!empty($typRow)) {
    $content = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($typRow->content));
    $readmore = '';
    if (!empty($typRow->linksrc)) {
        $linkTarget = ($typRow->linktype == 1) ? ' target="_blank" ' : '';
        $linksrc = ($typRow->linktype == 1) ? $typRow->linksrc : BASE_URL . $typRow->linksrc;
        $readmore = '<a class="text-link link-direct" href="' . $linksrc . '">see more</a>';
    } else {
        $readmore = (count($content) > 1) ? '<a href="' . BASE_URL . $typRow->slug . '">Read more...</a>' : '';
    }
    $restyp .= '<h3 class="h3 header-sidebar">' . $typRow->title . '</h3>
	<div class="home-content">
		' . $content[0] . ' ' . $readmore . '
	</div>';

}

$jVars['module:article_by_type'] = $restyp;



/*
    Why Choose Us
*/
$resinnh1 = '';

if (defined('HOME_PAGE')) {

    $resinnh1 .= '';

// pr($resinnh1);
    $recInn1 = Article::find_by_id(2);
    if (!empty($recInn1)) {
            $resinnh1 .= $recInn1->content;

        
    }

}

$jVars['module:home_article'] = $resinnh1;


/*
    HomePage Facilities
*/
$resinnh1 = '';

if (defined('HOME_PAGE')) {

    $resinnh1 .= '';


    $recInn1 = Article::find_by_id(3);

    if (!empty($recInn1)) {

            $resinnh1 .= $recInn1->content;

        
    }

}

$jVars['module:home_facilities'] = $resinnh1;

?>