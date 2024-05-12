<link rel="icon" type="image/x-icon" href="<?php echo $fullurl; ?>assets/img/favicon.png">
<!-- All Plugins -->
<link href="<?php echo $fullurl; ?>assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $fullurl; ?>assets/css/animation.css" rel="stylesheet">
<link href="<?php echo $fullurl; ?>assets/css/dropzone.min.css" rel="stylesheet">
<link href="<?php echo $fullurl; ?>assets/css/flatpickr.min.css" rel="stylesheet">
<link href="<?php echo $fullurl; ?>assets/css/flickity.min.css" rel="stylesheet">
<link href="<?php echo $fullurl; ?>assets/css/lightbox.min.css" rel="stylesheet">
<link href="<?php echo $fullurl; ?>assets/css/magnifypopup.css" rel="stylesheet">
<link href="<?php echo $fullurl; ?>assets/css/select2.min.css" rel="stylesheet">
<link href="<?php echo $fullurl; ?>assets/css/rangeSlider.min.css" rel="stylesheet">
<link href="<?php echo $fullurl; ?>assets/css/prism.css" rel="stylesheet">
<!-- Fontawesome & Bootstrap Icons CSS -->
<link href="<?php echo $fullurl; ?>assets/css/bootstrap-icons.css" rel="stylesheet">
<link href="<?php echo $fullurl; ?>assets/css/fontawesome.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="<?php echo $fullurl; ?>assets/css/style.css" rel="stylesheet">

<style>
    .header_icon{
        height: 20px !important;
        width: 20px !important;
        margin-right: 5px;
        object-fit: contain !important;
        filter: invert(100%);
    }
</style>

<script src="<?php echo $fullurl; ?>assets/js/jquery.min.js"></script>
<script src="<?php echo $fullurl; ?>assets/js/popper.min.js"></script>
<script src="<?php echo $fullurl; ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo $fullurl; ?>assets/js/dropzone.min.js"></script>
<script src="<?php echo $fullurl; ?>assets/js/flatpickr.js"></script>
<script src="<?php echo $fullurl; ?>assets/js/flickity.pkgd.min.js"></script>
<script src="<?php echo $fullurl; ?>assets/js/lightbox.min.js"></script>
<script src="<?php echo $fullurl; ?>assets/js/rangeslider.js"></script>
<script src="<?php echo $fullurl; ?>assets/js/select2.min.js"></script>
<script src="<?php echo $fullurl; ?>assets/js/counterup.min.js"></script>
<script src="<?php echo $fullurl; ?>assets/js/prism.js"></script>
<script src="<?php echo $fullurl; ?>assets/js/addadult.js"></script>
<script src="<?php echo $fullurl; ?>assets/js/custom.js"></script>

<div class="header header-transparent theme">
    <div class="container">
        <nav id="navigation" class="navigation navigation-landscape">
            <div class="nav-header">
                <a class="nav-brand static-show" href="#"><img src="<?php echo $fullurl; ?>assets/img/logo-light.png"
                        class="logo" alt=""></a>
                <a class="nav-brand mob-show" href="#"><img src="<?php echo $fullurl; ?>assets/img/logo.png"
                        class="logo" alt=""></a>
                <div class="nav-toggle"></div>
                <div class="mobile_nav">
                    <ul>
                        <li class="currencyDropdown me-2">
                            <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#currencyModal"><span
                                    class="fw-medium">INR</span></a>
                        </li>
                        <li class="languageDropdown me-2">
                            <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#countryModal"><img
                                    src="<?php echo $fullurl; ?>assets/img/flag/flag.png" class="img-fluid" width="17"
                                    alt="Country"></a>
                        </li>
                        <li>
                            <a href="#" class="bg-light-primary text-primary rounded" data-bs-toggle="modal"
                                data-bs-target="#login"><i class="fa-regular fa-circle-user fs-6"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="nav-menus-wrapper" style="transition-property: none;">
                <ul class="nav-menu">
                    <li>
                        <a href="documantion/index.html" target="_blank">
                            <img class="header_icon" src="<?php echo $fullurl; ?>images/flight1.png" alt=""> Flights
                        </a>
                    </li>
                    <li>
                        <a href="documantion/index.html" target="_blank">
                            <img class="header_icon" src="<?php echo $fullurl; ?>images/hotel1.png" alt=""> Hotels
                        </a>
                    </li>
                    <li>
                        <a href="documantion/index.html" target="_blank">
                            <img class="header_icon" src="<?php echo $fullurl; ?>images/holiday1.png" alt=""> Holidays
                        </a>
                    </li>

                </ul>

                <ul class="nav-menu nav-menu-social align-to-right">
                    <li class="currencyDropdown me-2">
                        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#currencyModal"><span
                                class="fw-medium">INR</span></a>
                    </li>
                    <li class="languageDropdown me-2">
                        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#countryModal"><img
                                src="assets/img/flag/flag.png" class="img-fluid" width="17" alt="Country"></a>
                    </li>
                    <li class="list-buttons light">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#login"><i
                                class="fa-regular fa-circle-user fs-6 me-2"></i>Sign In / Register</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>