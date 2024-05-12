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
                        <a href="<?php echo $fullurl; ?>flights">
                            <img class="header_icon" src="<?php echo $fullurl; ?>images/flight1.png" alt=""> Flights
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $fullurl; ?>hotels">
                            <img class="header_icon" src="<?php echo $fullurl; ?>images/hotel1.png" alt=""> Hotels
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $fullurl; ?>holidays">
                            <img class="header_icon" src="<?php echo $fullurl; ?>images/holiday1.png" alt=""> Holidays
                        </a>
                    </li>

                </ul>

                <ul class="nav-menu nav-menu-social align-to-right">
                    <li class="currencyDropdown me-2">
                        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#currencyModal">
                            <span class="fw-medium">INR</span>
                        </a>
                    </li>
                    <li class="languageDropdown me-2">
                        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#countryModal">
                            <img src="<?php echo $fullurl; ?>assets/img/flag/flag.png" class="img-fluid" width="17"
                                alt="Country">
                        </a>
                    </li>
                    <li class="languageDropdown me-2">
                        <a href="<?php echo $fullurl; ?>web-check-in" target="_blank" class="nav-link btn"
                            style="height: 45px;" type="button">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; Web Check-In
                        </a>
                    </li>
                    <li>
                        <div class="dropdown show">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="height: 45px;">
                                Dropdown link
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>

<!-- Choose Currency Modal -->
<div class="modal modal-lg fade" id="currencyModal" tabindex="-1" aria-labelledby="currenyModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-6" id="currenyModalLabel">Select Your Currency</h4>
                <a href="#" class="text-muted fs-4" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-square-xmark"></i></a>
            </div>
            <div class="modal-body">
                <div class="allCurrencylist">

                    <div class="suggestedCurrencylist-wrap mb-4">
                        <div class="d-inline-block mb-0 ps-3">
                            <h5 class="fs-6 fw-bold">Suggested Currency For you</h5>
                        </div>
                        <div class="suggestedCurrencylists">
                            <ul
                                class="row align-items-center justify-content-start row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-2 gy-2 gx-3 m-0 p-0">
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">United State Dollar</div>
                                        <div class="text-muted-2 text-md text-uppercase">USD</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Pound Sterling</div>
                                        <div class="text-muted-2 text-md text-uppercase">GBP</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency active" href="#">
                                        <div class="text-dark text-md fw-medium">Indian Rupees</div>
                                        <div class="text-muted-2 text-md text-uppercase">Inr</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Euro</div>
                                        <div class="text-muted-2 text-md text-uppercase">EUR</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Australian Dollar</div>
                                        <div class="text-muted-2 text-md text-uppercase">aud</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Thai Baht</div>
                                        <div class="text-muted-2 text-md text-uppercase">thb</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="suggestedCurrencylist-wrap">
                        <div class="d-inline-block mb-0 ps-3">
                            <h5 class="fs-6 fw-bold">All Currencies</h5>
                        </div>
                        <div class="suggestedCurrencylists">
                            <ul
                                class="row align-items-center justify-content-start row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-2 gy-2 gx-3 m-0 p-0">
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">United State Dollar</div>
                                        <div class="text-muted-2 text-md text-uppercase">USD</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Property currency</div>
                                        <div class="text-muted-2 text-md text-uppercase">GBP</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Argentine Peso</div>
                                        <div class="text-muted-2 text-md text-uppercase">EUR</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Azerbaijani Manat</div>
                                        <div class="text-muted-2 text-md text-uppercase">Inr</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Australian Dollar</div>
                                        <div class="text-muted-2 text-md text-uppercase">aud</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Bahraini Dinar</div>
                                        <div class="text-muted-2 text-md text-uppercase">thb</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Brazilian Real</div>
                                        <div class="text-muted-2 text-md text-uppercase">USD</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Bulgarian Lev</div>
                                        <div class="text-muted-2 text-md text-uppercase">GBP</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Canadian Dollar</div>
                                        <div class="text-muted-2 text-md text-uppercase">EUR</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Chilean Peso</div>
                                        <div class="text-muted-2 text-md text-uppercase">Inr</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Colombian Peso</div>
                                        <div class="text-muted-2 text-md text-uppercase">aud</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Danish Krone</div>
                                        <div class="text-muted-2 text-md text-uppercase">thb</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Egyptian Pound</div>
                                        <div class="text-muted-2 text-md text-uppercase">USD</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Hungarian Forint</div>
                                        <div class="text-muted-2 text-md text-uppercase">GBP</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Japanese Yen</div>
                                        <div class="text-muted-2 text-md text-uppercase">EUR</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Jordanian Dinar</div>
                                        <div class="text-muted-2 text-md text-uppercase">Inr</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Kuwaiti Dinar</div>
                                        <div class="text-muted-2 text-md text-uppercase">aud</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Malaysian Ringgit</div>
                                        <div class="text-muted-2 text-md text-uppercase">thb</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCurrency" href="#">
                                        <div class="text-dark text-md fw-medium">Singapore Dollar</div>
                                        <div class="text-muted-2 text-md text-uppercase">thb</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Choose Countries Modal -->
<div class="modal modal-lg fade" id="countryModal" tabindex="-1" aria-labelledby="countryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-6" id="countryModalLabel">Select Your Country</h4>
                <a href="#" class="text-muted fs-4" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-square-xmark"></i></a>
            </div>
            <div class="modal-body">
                <div class="allCountrieslist">

                    <div class="suggestedCurrencylist-wrap mb-4">
                        <div class="d-inline-block mb-0 ps-3">
                            <h5 class="fs-6 fw-bold">Suggested Countries For you</h5>
                        </div>
                        <div class="suggestedCurrencylists">
                            <ul
                                class="row align-items-center justify-content-start row-cols-xl-4 row-cols-lg-3 row-cols-2 gy-2 gx-3 m-0 p-0">
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/united-states.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">United State Dollar</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/united-kingdom.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Pound Sterling</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry active" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/flag.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Indian Rupees</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/belgium.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Euro</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/brazil.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Australian Dollar</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/china.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Thai Baht</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="suggestedCurrencylist-wrap">
                        <div class="d-inline-block mb-0 ps-3">
                            <h5 class="fs-6 fw-bold">All Countries</h5>
                        </div>
                        <div class="suggestedCurrencylists">
                            <ul
                                class="row align-items-center justify-content-start row-cols-xl-4 row-cols-lg-3 row-cols-2 gy-2 gx-3 m-0 p-0">
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/united-states.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">United State Dollar</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/vietnam.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Property currency</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/turkey.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Argentine Peso</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/spain.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Azerbaijani Manat</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/japan.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Australian Dollar</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/flag.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Bahraini Dinar</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/portugal.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Brazilian Real</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/italy.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Bulgarian Lev</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/germany.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Canadian Dollar</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/france.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Chilean Peso</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/european.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Colombian Peso</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/china.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Danish Krone</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/brazil.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Egyptian Pound</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/belgium.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Hungarian Forint</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/turkey.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Japanese Yen</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/spain.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Jordanian Dinar</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/germany.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Kuwaiti Dinar</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/france.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Malaysian Ringgit</div>
                                    </a>
                                </li>
                                <li class="col">
                                    <a class="selectCountry" href="#">
                                        <div class="d-inline-block"><img src="assets/img/flag/brazil.png"
                                                class="img-fluid circle" width="35" alt=""></div>
                                        <div class="text-dark text-md fw-medium ps-2">Singapore Dollar</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>