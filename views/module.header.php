<?php
$siteRegulars = Config::find_by_id(1);
$booking_code = Config::getField('hotel_code', true);
$header = ob_start();
$tellinked = '';
    $telno = explode("/", $siteRegulars->contact_info);
    $lastElement = array_shift($telno);
    $tellinked .= '<a href="tel:' . $lastElement . '" target="_blank">' . $lastElement . '</a>/';
    foreach ($telno as $tel) {
        
        $tellinked .= '<a href="tel:+977-' . $tel . '" target="_blank">' . $tel . '</a>';
        if(end($telno)!= $tel){
        $tellinked .= '/';
        }   
}
?>
    <!-- header info begin -->
    <div id="header-info">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <ul class="header-contact">
                        <li class="icon_location">
                            <a href="<?= $siteRegulars->contact_info2 ?>" target="_blank"><?= $siteRegulars->fiscal_address ?></a>
                        </li>
                        <li class="icon_phone"><a href="tel:<?= $siteRegulars->contact_info ?>"><?= $siteRegulars->contact_info ?></a></li>
                        <li class="icon_email"><a href="mailto:<?= $siteRegulars->email_address ?>"><?= $siteRegulars->email_address ?></a></li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <div class="h_box">
                        <div class="social-icons-header">
                            <?= $jVars['module:socilaLinktop'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header info close -->

    <!-- header begin -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <span id="menu-btn"></span>

                    <!-- logo begin -->
                    <div id="logo">
                        <div class="inner">
                            <a href="<?= BASE_URL ?>home"><img src="<?= IMAGE_PATH ?>preference/<?= $siteRegulars->logo_upload ?>" alt="logo"></a>
                        </div>
                    </div>
                    <!-- logo close -->

                    <!-- mainmenu begin -->
                    <nav>
                        <?= $jVars['module:res-menu'] ?>
                    </nav>
                    <!-- mainmenu close -->
                </div>
            </div>
            <!-- Removed one div cause design broke -->
    </header>
    <!-- header close -->
<?php
$header = ob_get_clean();


$header = '
    <header class="header" data-header>
        <div class="container">
            <!-- 
            <h1>
            <a href="#" class="coiny"><img src="'. IMAGE_PATH .'preference/'. $siteRegulars->logo_upload .'" alt="HTML tutorial" style="width:42px;height:42px;">Mothers<a href="#" class="gistesy">Kitchen</a></a>
            </h1> -->

            <!-- <h1>
            <a href="#" class="coiny"><img src="'. IMAGE_PATH .'preference/'. $siteRegulars->logo_upload .'" alt="HTML tutorial" style="width:42px;height:42px;"><p><span class="Coiny">Mothers</span><span class="gistesy">Kitchen</span></p></a>
            </h1> -->

            
            <!-- <p class="font1">
                <h1>
                <a href="#">
                <span class="coiny"><img src="'. IMAGE_PATH .'preference/'. $siteRegulars->logo_upload .'" alt="Mothers Kithen Logo" style="width:60px;height: 60px;">Mothers</span>
                <span class="gistesy">Kitchen</span>
                </a>
                </h1>
            </p> -->

            <div class="contain">
                <a href=#>
                <img src="'. IMAGE_PATH .'preference/'. $siteRegulars->logo_upload .'" alt="mothers kitchen logo" width="150" height="150">
                </a>
                <p>
                <a href="#">
                <span class="coiny">Mothers</span> 
                <span class="gistesy">Kitchen</span>
                </a>
                </p>
                </div>
            

            <nav class="navbar" data-navbar>
            <ul class="navbar-list">

                '. $jVars['module:res-menu'] .'

            </ul>
            </nav>

            <div class="header-btn-group">
            <button class="search-btn" aria-label="Search" data-search-btn>
                <ion-icon name="search-outline"></ion-icon>
            </button>

            <!-- <button class="btn btn-hover">Order</button> -->
            <button class="btn btn-hover" onclick="document.getElementById(\'orderplace\').scrollIntoView({ behavior: \'smooth\' });">
                Order
            </button>
            <button class="nav-toggle-btn" aria-label="Toggle Menu" data-menu-toggle-btn>
                <span class="line top"></span>
                <span class="line middle"></span>
                <span class="line bottom"></span>
            </button>
            </div>

        </div>
    </header>';
$jVars['module:header'] = $header;