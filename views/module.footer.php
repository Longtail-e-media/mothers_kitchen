<?php
$siteRegulars = Config::find_by_id(1);
$lastElement='';
$phonelinked='';
$whatsapp='';
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
$phoneno = explode("/", $siteRegulars->whatsapp);
$lastElement = array_shift($phoneno);
$phonelinked .= '<a href="tel:+977-' . $lastElement . '" target="_blank">' . $lastElement. '</a>/';
foreach ($phoneno as $phone) {
    
    $phonelinked .= '<a href="tel:+977-' . $phone . '" target="_blank">' . $phone . '</a>';
    if(end($phoneno)!= $phone){
    $phonelinked .= '/';
    }   
}
$footer = '
    <footer class="footer" id="contactinfo">

        <div class="footer-top" style="background-image: url(\''. BASE_URL .'template/web/assets/images/footer-illustration.png\')">
        <div class="container">

            <div class="footer-brand">

            <a href="" class="logoo">Mothers Kitchen<span class="span"></span></a>

            <p class="footer-text">
                Financial experts support or help you to to find out which way you can raise your funds more.
            </p>

            <ul class="social-list">

                <li>
                <a href="https://www.facebook.com/profile.php?id=61565717052376" class="social-link">
                    <i class="fa-brands fa-facebook"></i>
                </a>
                </li>

                <li>
                <a href="https://wa.me/9851401214" class="social-link">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
                </li>

                <li>
                <a href="#" class="social-link">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                </li>

                <li>
                <a href="#" class="social-link">
                    <i class="fa-brands fa-pinterest-p"></i>
                </a>
                </li>

            </ul>

            </div>

            <ul class="footer-list">

            <li>
                <p class="footer-list-title">Contact Info</p>
            </li>

            <li>
                <p class="footer-list-item">+977 9851401214, +977 9849367927</p>
            </li>

            <li>
                <p class="footer-list-item">motherskitchen001@gmail.com</p>
            </li>

            <li>
                <address class="footer-list-item">Arun Thapa Chowk, Jhamsikhel</address>
            </li>

            </ul>

            <ul class="footer-list">

            <li>
                <p class="footer-list-title">Opening Hours</p>
            </li>

            <li>
                <p class="footer-list-item">Everyday: 08:00 a.m -10:00 p.m</p>
            </li>

            

            </ul>

            <!-- <form onsubmit="sendToWhatsapp(event)" class="footer-form">


            <p class="footer-list-title">Book a Table</p>

            <div class="input-wrapper">

                <input type="text" name="full_name" id="fullName" required placeholder="Your Name" aria-label="Your Name"
                class="input-field">

                <input type="email" name="email_address" id="emailAddress" required placeholder="Email" aria-label="Email"
                class="input-field">
                

            </div>
            <div class="input-wrapper">
                <input type="text" name="location" id="location" required placeholder="Click \'Get Location\' to autofill" aria-label="location"
                class="input-field">
                <button class="btn btn-hover" type="button" onclick="getLocation()">Location</button>
            </div>

            <div class="input-wrapper">

                <select name="total_person" aria-label="Total person" id="totalPerson" class="input-field">
                <option value="person">Person</option>
                <option value="2 person">2 Person</option>
                <option value="3 person">3 Person</option>
                <option value="4 person">4 Person</option>
                <option value="5 person">5 Person</option>
                </select>

                <input type="date" name="booking_date" id="bookingDate" aria-label="Reservation date" class="input-field">

            </div>

            <textarea name="message" required id="message" placeholder="Message" aria-label="Message" class="input-field"></textarea>

            
            <button type="submit" class="btn btn-hover">Book A Table</button>

            </form> -->

        </div>
        </div>

        <div class="footer-bottom">
        <div class="container">
            <p class="copyright-text">
            &copy; 2024 <a href="#" class="copyright-link">Aashish Giri</a> All Rights Reserved.
            </p>
        </div>
        </div>

  </footer>
';
           

$jVars['module:footer'] = $footer;

if(!empty($siteRegulars->whatsapp_a)){
$whatsapp='
    <div class="whats_app">
        <a href="https://wa.me/+977'. $siteRegulars->whatsapp_a .'" target="_blank" class="whatsapp">
            <img src="https://mayurstay.com/atithisuites/dynamic/template/web/assets/images/icon/whatsapp.png">
        </a>
    </div>
';
}
else{
    $whatsapp='';
}

$jVars['module:footer-whatsapp'] = $whatsapp;
