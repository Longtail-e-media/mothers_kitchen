<?php
$reslgall = '';

$gallRec = Gallery::getParentgallery(1);
// pr($gallRec);
if (!empty($gallRec)) {
    foreach ($gallRec as $gallRow) {
        if($gallRow->id == 11){
            $childRec = GalleryImage::getGalleryImages($gallRow->id);
            if (!empty($childRec)) {
                $reslgall .= '';
                foreach ($childRec as $childRow) {
                    $file_path = SITE_ROOT . 'images/gallery/galleryimages/' . $childRow->image;
                    if (file_exists($file_path) and !empty($childRow->image)) {
                        $reslgall .= '
                            <div class="slide" id="slide1">
                                <img src="'. IMAGE_PATH .'gallery/galleryimages/'. $childRow->image .'" alt="Menu Item 1">
                            </div>
                        ';
                    }
                }
                $reslgall .= '';
            }
        }
    }
}

$res_gallery = '
    <section style="margin: auto;" id="menu">
        <div class="container" style="text-align: center;">

          
            <div style="display: block; text-align: center;">
                <div class="about-content" style="text-align: center;">
                    <h2 class="h2 section-title">
                    Our Regular<br>
                    <span class="span">Menu</span>
                    </h2>

                    <div class="slider" style="margin-left: auto; margin-right: auto; text-align: center;">
                        <div class="slides">
                            '. $reslgall .'
                        </div>
                        <button class="nav-button prev" onclick="prevSlide()">&#10094;</button>
                        <button class="nav-button next" onclick="nextSlide()">&#10095;</button>
                    </div>
                     <br>
                    
                    <div style="text-align: center;">
                        <!-- <button class="btn btn-hover" style="margin-left: auto; margin-right: auto; text-align: center;">Menu</button> -->
                    </div>
                </div>
            </div>

        </div>
    </section>
';

$jVars['module:galleryHome'] = $res_gallery;



$dininggallery = '';
$galldining = GalleryImage::getImagelist_by(19, 3);
if (!empty($galldining)) {
    $dininggallery .= '<div class="row about">
                     <div class="demo-gallery">
    		     <div id="lightgallery" class="list-unstyled">';
    foreach ($galldining as $row) {
        $dininggallery .= '<div class="item col-sm-4 col-xs-12" data-responsive="' . IMAGE_PATH . 'gallery/galleryimages/' . $row->image . '" data-src="' . IMAGE_PATH . 'gallery/galleryimages/' . $row->image . '" data-sub-html="<h4>' . $row->title . '</h4>">
                        <a href="">
                            <img src="' . IMAGE_PATH . 'gallery/galleryimages/' . $row->image . '"/>
                        </a>
                    </div>';
    }
    $dininggallery .= '</div>
    </div>
    </div>';
}
$jVars['module:dining-gallery'] = $dininggallery;

$gallerybread='';
$siteRegulars = Config::find_by_id(1);
$imglink= $siteRegulars->gallery_upload ;
if(!empty($imglink)){
    $img= IMAGE_PATH . 'preference/gallery/' . $siteRegulars->gallery_upload ;
}
else{
    $img='';
}

$gallerybread='
<div class="mad-breadcrumb with-bg-img with-overlay" data-bg-image-src="'.$img.'">
<div class="container wide">
    <h1 class="mad-page-title">Photo Gallery</h1>
    <nav class="mad-breadcrumb-path">
        <span><a href="home" class="mad-link">Home</a></span> /
        <span>Gallery</span>
    </nav>
</div>
</div>';

$jVars['module:gallery-bread'] = $gallerybread;

/**
 *      Main Gallery
 */
$thegal = $gallerylistbread = $thegalnav= '';
$gallRectit = Gallery::getParentgallery();

if ($gallRectit) {
    $thegal .= '';
    foreach ($gallRectit as $row) {
        $thegalnav .= '
        <li class="col-md" data-class="' . $row->id . '">' . $row->title . '</li>';
    }
    $thegal .= '';

    // $thegal .= '
    //     <div id="gallery" class="gallery full-gallery de-gallery gallery-3-cols">
    // ';
    foreach ($gallRectit as $row) {

        $gallRec = GalleryImage::getGalleryImages($row->id);
        foreach ($gallRec as $row1) {
            // pr($row1);

            $file_path = SITE_ROOT . 'images/gallery/galleryimages/' . $row1->image;
            if (file_exists($file_path) and !empty($row1->image)):
                $thegal .= ' 
                    <div class="col-md-4 images" data-class="' . $row1->galleryid . '" data-src="' . IMAGE_PATH . 'gallery/galleryimages/' . $row1->image . '" style="display: block;">
                        <img src="' . IMAGE_PATH . 'gallery/galleryimages/' . $row1->image . '" alt="' . $row1->galleryid . ' ">
                    </div>
                   
                ';
            endif;
        }
    }
    $thegal .= '';

}

$jVars['module:gallery-list'] = $thegal;
$jVars['module:gallery-nav'] = $thegalnav;
