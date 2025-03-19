<!-- Content from the first file -->

<script src="{{asset('agent/js/jquery-3.6.4.min.js')}}"></script>
<script src="{{asset('agent/js/jquery-migrate-3.0.0.min.js')}}"></script>
<script src="{{asset('agent/js/popper.min.js')}}"></script>
<script src="{{asset('agent/js/bootstrap.min.js')}}"></script>
<script src="{{asset('agent/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('agent/js/jquery.mmenu.all.js')}}"></script>
<script src="{{asset('agent/js/ace-responsive-menu.js')}}"></script>
<script src="{{asset('agent/js/jquery-scrolltofixed-min.js')}}"></script>
<script src="{{asset('agent/js/wow.min.js')}}"></script>
<script src="{{asset('agent/js/isotop.js')}}"></script>
<script src="{{asset('agent/js/owl.js')}}"></script>
<script src="{{asset('agent/js/parallax.js')}}"></script>
<script src="{{asset('agent/js/script.js')}}"></script>
<script src="{{asset('agent/js/pricing-slider.js')}}"></script>
<script src="{{asset('agent/js/ajaxCall.js')}}?v=1.324"></script>
<script src="{{asset('agent/js/localization.js')}}"></script>
<script type="text/javascript"  src="{{asset('admin/assets/js/sweetAlert2.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.css">

<!-- Content from the second file -->

<script src="{{asset('agent/js/custom_map.js')}}"></script>
<script src="{{asset('agent/js/scrollbalance.js')}}"></script>
<script>
    // Fixed sidebar Custom Script For That
    $(function () {
        var cols = $('.wrap .column');
        var enabled = true;
        var scrollbalance = new ScrollBalance(cols, {
            minwidth: 0
        });
        // bind to scroll and resize events
        scrollbalance.bind();
    });
</script>
<!--<script>-->
<!--    function changeLanguage(languageCode) {-->
<!--        var htmlElement = document.documentElement;-->
<!--        if (languageCode === "ar") {-->
<!--            htmlElement.lang = "ar";-->
<!--            htmlElement.dir = "rtl";-->
<!--        } else {-->
<!--            htmlElement.lang = "en";-->
<!--            htmlElement.dir = "ltr";-->
<!--        }-->
<!--    }-->
<!--</script>-->
<!--<script>-->
<!--    function changeLanguage(code, flagSrc, langText) {-->
<!--        document.getElementById('selectedFlag').src = flagSrc;-->
<!--        document.getElementById('selectedLang').textContent = langText;-->
<!--        document.documentElement.dir = code === 'ar' ? 'rtl' : 'ltr';-->
<!--        $(".dropdown-language").removeClass("show");-->
<!--    }-->
<!--    function showLanguages() {-->
<!--        $(".dropdown-language").toggleClass("show");-->
<!--    }-->
<!--    $(document).on("click", function(event) {-->
<!--        if (!$(event.target).closest('.language').length) {-->
<!--            $(".dropdown-language").removeClass("show");-->
<!--        }-->
<!--    });-->
<!--</script>-->

{{--<script>--}}
{{--    function changeLanguage(code, flagSrc, langText) {--}}
{{--        document.getElementById('selectedFlagLang').src = flagSrc;--}}
{{--        document.getElementById('selectedLang').textContent = langText;--}}
{{--        document.documentElement.dir = code === 'ar' ? 'rtl' : 'ltr';--}}
{{--        $(".dropdown-language").removeClass("show");--}}
{{--    }--}}

{{--    function showLanguages() {--}}
{{--        $(".dropdown-language").toggleClass("show");--}}
{{--        $(".dropdown-currency").removeClass("show"); // Close the currency dropdown if open--}}
{{--    }--}}

{{--    $(document).on("click", function(event) {--}}
{{--        if (!$(event.target).closest('.language').length) {--}}
{{--            $(".dropdown-language").removeClass("show");--}}
{{--        }--}}
{{--    });--}}

{{--</script>--}}

{{--<script>--}}
{{--    function changeCurrency(code, flagSrc, currencyText) {--}}
{{--        document.getElementById('selectedFlagCurrency').src = flagSrc;--}}
{{--        document.getElementById('selectedCurrency').textContent = currencyText;--}}
{{--        $(".dropdown-currency").removeClass("show");--}}
{{--    }--}}

{{--    function showCurrencies() {--}}
{{--        $(".dropdown-currency").toggleClass("show");--}}
{{--        $(".dropdown-language").removeClass("show"); // Close the language dropdown if open--}}
{{--    }--}}

{{--    $(document).on("click", function(event) {--}}
{{--        if (!$(event.target).closest('.currency').length) {--}}
{{--            $(".dropdown-currency").removeClass("show");--}}
{{--        }--}}
{{--    });--}}

{{--    $(".amount").change(function (){--}}
{{--        let price = $(this).val();--}}

{{--        if(price != ""){--}}
{{--            price = price.toString();--}}
{{--            price = price.replace(/[^0-9.,]/g, '');--}}
{{--            price = price.replace(',', '.');--}}
{{--            var parsedPrice = parseFloat(price);--}}
{{--            // Check if parsedPrice is NaN--}}
{{--            if (isNaN(parsedPrice)) {--}}
{{--                parsedPrice = 0; // Set to 0 if NaN--}}
{{--            }--}}
{{--            var roundedPrice = Math.floor(parsedPrice / 1000) * 1000;--}}

{{--            sap='$1.';--}}

{{--            if($("#currencyDropdown option:selected").val() == 'USD'){--}}
{{--                sap='$1,';--}}
{{--            }--}}

{{--            $(this).val(roundedPrice.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, sap));--}}

{{--        }--}}
{{--    });--}}
{{--</script>--}}
</body>
</html>






