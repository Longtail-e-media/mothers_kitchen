<?php
/*
* Service home list
*/
$rescont = $ressercont = '';
$i = 0;
$j = 0;
$subpkgRec = Services::getservice_list();
// pr($subpkgRec,1);

if (!empty($subpkgRec)) {

    foreach($subpkgRec as $subRow){
        $iconLink = $imgLink = '';

        $file_path_icon = SITE_ROOT .'images/services/icon/'. $subRow->icon_image;
        if(file_exists($file_path_icon)){
            $iconLink = IMAGE_PATH . 'services/icon/'. $subRow->icon_image;
        }else{
            $iconLink = BASE_URL . 'template/web/assets/images/naan.svg';
        }

        $unseriallizedImage = unserialize($subRow->image)[0];
        $file_path = SITE_ROOT .'images/services/'. $unseriallizedImage;
        if(file_exists($file_path)){
            $imgLink = IMAGE_PATH .'services/'. $unseriallizedImage;
        }else{
            $imgLink = BASE_URL . 'template/web/assets/images/parotha1.png';
        }


        $rescont.='
            <li class="promo-item">
                  <div class="promo-card">
                    <div class="card-icon">
                      <img src="'. $iconLink .'" alt="icon" class="service-icon"/>
                    </div>

                    <h3 class="h3 card-title">'. $subRow->title .'</h3>
    
                    <p class="card-text">
                      '. preg_replace('/<\/?p>/','',$subRow->content) .'
                    </p>
    
                    <img src="'. $imgLink .'" width="300" height="300" loading="lazy" alt="Maxican Pizza" class="w-100 card-banner">
    
                  </div>
                </li>
        ';

    }


}

$jVars['module:home-service-list'] = $rescont;
$jVars['module:home-service-content-list'] = $ressercont;


$restscont = '';

$servpkgRec = Services::find_all();
// var_dump($subpkgRec); die();
if (isset($_REQUEST['slug']) and !empty($_REQUEST['slug'])) {
    $slug = $_REQUEST['slug'];
} else {
    $slug = 'health-club';
}
if (!empty($subpkgRec)) {
    $i = 0;
    $j = 0;
    $restscont .= '<div class="tab-section bg-gray body-room-5">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <h2 class="mb-0">Services</h2>
                            <ul class="pages-link">
                                <li><a href="' . BASE_URL . 'home">Home</a></li>
                                <li>/</li>
                                <li>Services</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="dining-tabs">
                        <ul class="nav nav-tabs">';
    foreach ($servpkgRec as $key => $serRec) {
        if ($slug == $serRec->slug) {
            $class = "active";
        } else {
            $class = "";
        }
        $actv = ($i == 0) ? 'active' : '';
        $restscont .= '<li class="' . $class . '">
                                <a href="#Sauna' . $serRec->id . '" id="' . $serRec->slug . '" role="tab" data-toggle="tab">' . $serRec->title . '<small class="d-block">' . $serRec->sub_title . '</small></a>
                            </li>';
        $i++;
    }
    $restscont .= '  </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="block small-padding both-padding page">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="tab-content">';
    foreach ($servpkgRec as $key => $serRec) {
        $imageList = '';
        if ($serRec->image != "a:0:{}") {
            $imageList = unserialize($serRec->image);
        }
        if ($slug == $serRec->slug) {
            $class1 = "active";
        } else {
            $class1 = "";
        }
        $actv = ($j == 0) ? 'active' : '';
        $restscont .= '<div role="tabpanel" class="tab-pane fade in ' . $class1 . '" id="Sauna' . $serRec->id . '">
                                <div class="dining-detail">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="dining-detail-carousel">';
        // var_dump($imageList); die();
        if ($serRec->image != "a:0:{}") {
            foreach ($imageList as $key => $imgServ) {
                $restscont .= ' <div class="item">
											<img src="' . IMAGE_PATH . 'services/' . $imgServ . '" alt="' . $serRec->title . '" />
										</div>';
            }
        }
        $restscont .= ' </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="service-content">
                                               ' . substr(strip_tags($serRec->content), 0, 30000) . '
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
        $j++;
    }
    $restscont .= '</div>
                    </div>
                </div>
            </div><!-- container -->
        </div><!-- block -->';


}

$jVars['module:service-detail-list'] = $restscont;

$facility_bread='';
if (defined('FACILITY_PAGE')) {
    $siteRegulars = Config::find_by_id(1);
    $imglink= $siteRegulars->facility_upload ;
    // pr($imglink);
if(!empty($imglink)){
    $img= IMAGE_PATH . 'preference/facility/' . $siteRegulars->facility_upload ;
}
else{
    $img='';
}

    $facility_bread='<div class="mad-breadcrumb with-bg-img with-overlay" data-bg-image-src="'.$img.'">
    <div class="container wide">
        <h1 class="mad-page-title">Hotel Amenities</h1>
        <nav class="mad-breadcrumb-path">
            <span><a href="index.html" class="mad-link">Home</a></span> /
            <span>Facilities</span>
        </nav>
    </div>
</div>';

}
$jVars['module:facilitybread'] = $facility_bread;

$facility = "";
if (defined('FACILITY_PAGE')) {


    $record = Services::getservice_list();
    if (!empty($record)) {
        $count = $countsec = 0;
        foreach ($record as $recRow) {
            if(!empty($recRow->icon)){
                $facility .= ' 
                <div class="mad-col">
                                <!--================ Icon Box ================-->
                                <article class="mad-icon-box">
                                span class="' . $recRow->icon . '"></span>
                                    <div class="mad-icon-box-content">
                                        <h6 class="mad-icon-box-title">
                                        ' . $recRow->title . '
                                        </h6>
                                    </div>
                                </article>
                                <!--================ End of Icon Box ================-->
                            </div>
                
                ';
            }else{

                $img = unserialize($recRow->image);
                $file_path = SITE_ROOT . 'images/services/' . $img[0];
                if (file_exists($file_path) && $img[0] != NULL) {
                    $imglink = IMAGE_PATH . 'services/' . $img[0];
                    $facility .= ' 
                    <div class="mad-col">
                                <!--================ Icon Box ================-->
                                <article class="mad-icon-box">
                                    <img src="' . $imglink . '" alt = '. $recRow->title .'>
                                    <div class="mad-icon-box-content">
                                        <h6 class="mad-icon-box-title">
                                        ' . $recRow->title . '
                                        </h6>
                                    </div>
                                </article>
                                <!--================ End of Icon Box ================-->
                            </div>


                    ';
                }
            }
        }
    }


}

$jVars['module:facility-list'] = $facility;



/*
* Service Page
*/
$rescont = '';


    $rescont .= '';


    $subpkgRec = services::find_8();    

    if (!empty($subpkgRec)) {
        $rescont .= '';
        foreach ($subpkgRec as $k => $v) {
            $img_nm = unserialize($v->image);
            $rescont .= '
            
                        
                        ';
            
            
        }
        $rescont .= '';

    }

// pr($rescont_left);
$rescont_final = '
                    <!-- detail features starts -->
                    <div class="mad-section mad-section.no-pb">
                    <div class="row justify-content-center">
                        <div class="col-xxl-10">
                            <div class="mad-title-wrap align-center">
                                <div class="mad-pre-title">The Advantages</div>
                                <h2 class="mad-section-title">Amenities and Facilities</h2>
                            </div>
                            <!--================ Icon Boxes ================-->
                            <div class="mad-icon-boxes align-center small-size item-col-5">
                                    '. $rescont .'
                                    </div>
                                    <!--================ End of Icon Boxes ================-->
                                </div>
                            </div>
                        </div>';
$jVars['module:service-homepage'] = $rescont_final;
$facilityhome = "";

if (defined('HOME_PAGE')) {


    $record = Services::getservice_list(30);
    if (!empty($record)) {
        foreach ($record as $recRow) {
            if(!empty($recRow->icon)){
                $facilityhome .= ' 
                <div class="mad-col">
            <!--================ Icon Box ================-->
            <article class="mad-icon-box">
                <img src="' . $imglink . '" alt="'. $recRow->title .'">
                <div class="mad-icon-box-content">
                    <h6 class="mad-icon-box-title">
                    '. $recRow->title .'
                    </h6>
                </div>
            </article>
            <!--================ End of Icon Box ================-->
        </div> 
                ';
            }else{

                $img = unserialize($recRow->image);
                $file_path = SITE_ROOT . 'images/services/' . $img[0];
                if (file_exists($file_path) && $img[0] != NULL) {
                    $imglink = IMAGE_PATH . 'services/' . $img[0];
                    $facilityhome .= '
                    <div class="mad-col">
            <!--================ Icon Box ================-->
            <article class="mad-icon-box">
                <img src="' . $imglink . '" alt="'. $recRow->title .'">
                <div class="mad-icon-box-content">
                    <h6 class="mad-icon-box-title">
                    '. $recRow->title .'
                    </h6>
                </div>
            </article>
            <!--================ End of Icon Box ================-->
        </div> 
                    ';
                }
            }
        }
    }


}
if (defined('FACILITY_PAGE')) {


    $record = Services::getservice_list(30);
    if (!empty($record)) {
        foreach ($record as $recRow) {
            if(!empty($recRow->icon)){
                $facilityhome .= ' 
                <div class="mad-col">
            <!--================ Icon Box ================-->
            <article class="mad-icon-box">
                <img src="' . $imglink . '" alt="'. $recRow->title .'">
                <div class="mad-icon-box-content">
                    <h6 class="mad-icon-box-title">
                    '. $recRow->title .'
                    </h6>
                </div>
            </article>
            <!--================ End of Icon Box ================-->
        </div> 
                ';
            }else{

                $img = unserialize($recRow->image);
                $file_path = SITE_ROOT . 'images/services/' . $img[0];
                if (file_exists($file_path) && $img[0] != NULL) {
                    $imglink = IMAGE_PATH . 'services/' . $img[0];
                    $facilityhome .= '
                    <div class="mad-col">
            <!--================ Icon Box ================-->
            <article class="mad-icon-box">
                <img src="' . $imglink . '" alt="'. $recRow->title .'">
                <div class="mad-icon-box-content">
                    <h6 class="mad-icon-box-title">
                    '. $recRow->title .'
                    </h6>
                </div>
            </article>
            <!--================ End of Icon Box ================-->
        </div> 
                    ';
                }
            }
        }
    }


}
$jVars['module:facility-list-home'] = $facilityhome;

?>