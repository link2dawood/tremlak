<!-- JavaScript for handling language and currency changes -->

// $(document).ready(function () {
//
//     // On page load, check localStorage first, then session
//     var language = localStorage.getItem('language');
//     var currencyCode = localStorage.getItem('currencyCode');
//     if(language == null || currencyCode == null){
//         language='en';
//         currencyCode='USD';
//         localStorage.setItem('language',language);
//         localStorage.setItem('currencyCode',currencyCode);
//
//     }
//
//     // Language dropdown change event
//     $('#languageDropdown').on('change', function () {
//         var selectedLanguage = $(this).val();
//
//
//         // Update localStorage
//         localStorage.setItem('language', selectedLanguage);
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });
//         route=`{{ route('setLanguage') }}`;
//         var ajax_data = new FormData();
//         ajax_data.append('language',selectedLanguage );
//
//         $.ajax({
//             type: 'POST',
//             processData: false,
//             contentType: false,
//             url: '/setLanguage',
//             data:ajax_data,
//             success: function (data) {
//
//                 if(data.trim() == "true"){
//                     window.location.reload();
//                 }
//             },
//             error: function () {
//
//                 console.error('Error updating');
//             }
//         });
//
//     });
//     // Currency dropdown change event
//     $('#currencyDropdown').on('change', function () {
//         var selectedCurrencyCode = $(this).val();
//
//         // Update localStorage
//         localStorage.setItem('currencyCode', selectedCurrencyCode);
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });
//         route=`{{ route('setCurrency') }}`;
//
//         var ajax_data = new FormData();
//         ajax_data.append('currencyCode',selectedCurrencyCode );
//
//         $.ajax({
//             type: 'POST',
//             processData: false,
//             contentType: false,
//             url: '/setCurrency',
//             data:ajax_data,
//             success: function (data) {
//
//                 if(data.trim() == "true"){
//                     window.location.reload();
//                 }
//
//             },
//             error: function () {
//
//                 console.error('Error updating');
//             }
//         });
//
//     });
//
//     // WithOut Changing Dropdown set values from local storage
//     if( language != null && currencyCode != null){
//
//         $('#currencyDropdown').val(currencyCode);
//         $("#languageDropdown").val(language);
//
//         //language
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });
//         var ajax_data = new FormData();
//         ajax_data.append('language',language );
//         route=`{{ route('setLanguage') }}`;
//         $.ajax({
//             type: 'POST',
//             url: '/setLanguage',
//             processData: false,
//             contentType: false,
//             data:ajax_data,
//             success: function (data) {
//
//                 if(data.trim() == 'true'){
//                     $("#languageDropdown").val(language)
//                     // window.location.reload();
//                 }
//
//             },
//             error: function () {
//                 console.error('Error updating');
//             }
//         });
//
//         //currencyCode
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });
//         var ajax_data = new FormData();
//         ajax_data.append('currencyCode',currencyCode );
//         route=`{{ route('setCurrency') }}`;
//         $.ajax({
//             type: 'POST',
//             processData: false,
//             contentType: false,
//             url: '/setCurrency',
//             data:ajax_data,
//             success: function (data) {
//
//                 if(data.trim() == 'true'){
//
//                     $('#currencyDropdown').val(currencyCode)
//                     // window.location.reload();
//                 }
//
//             },
//             error: function () {
//                 console.error('Error updating');
//             }
//         });
//     }
//
// });

function changeLanguage(code, flagSrc, langText) {

    document.getElementById('selectedFlagLang').src = flagSrc;
    document.getElementById('selectedLang').textContent = langText;
    // document.documentElement.dir = code === 'ar' ? 'rtl' : 'ltr';
    $(".dropdown-language").removeClass("show");

    var selectedLanguage = code;

    // Update localStorage
    localStorage.setItem('selectedFlagLang', flagSrc);
    localStorage.setItem('selectedLang', langText);
    localStorage.setItem('language', selectedLanguage);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    route=`{{ route('setLanguage') }}`;
    var ajax_data = new FormData();
    ajax_data.append('language',selectedLanguage );

    $.ajax({
        type: 'POST',
        processData: false,
        contentType: false,
        url: '/setLanguage',
        data:ajax_data,
        success: function (data) {

            if(data.trim() == "true"){
                window.location.reload();
            }
        },
        error: function () {

            console.error('Error updating');
        }
    });
}
function showLanguages() {

    $(".dropdown-language").toggleClass("show");
    $(".dropdown-currency").removeClass("show");
}


function changeCurrency(code, flagSrc, currencyText) {
    document.getElementById('selectedFlagCurrency').src = flagSrc;
    document.getElementById('selectedCurrency').textContent = currencyText;
    $(".dropdown-currency").removeClass("show");

    var selectedCurrencyCode = code;

    localStorage.setItem('currencyCode', selectedCurrencyCode);
    localStorage.setItem('selectedFlagCurrency', flagSrc);
    localStorage.setItem('selectedCurrency', selectedCurrencyCode);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    route=`{{ route('setCurrency') }}`;

    var ajax_data = new FormData();
    ajax_data.append('currencyCode',selectedCurrencyCode );

    $.ajax({
        type: 'POST',
        processData: false,
        contentType: false,
        url: '/setCurrency',
        data:ajax_data,
        success: function (data) {

            if(data.trim() == "true"){
                window.location.reload();
            }

        },
        error: function () {

            console.error('Error updating');
        }
    });

}
function showCurrencies() {
    $(".dropdown-currency").toggleClass("show");
    $(".dropdown-language").removeClass("show"); // Close the language dropdown if open
}

$(document).on("click", function(event) {
    if (!$(event.target).closest('.currency').length) {
        $(".dropdown-currency").removeClass("show");
    }
});
$(document).on("click", function(event) {
    if (!$(event.target).closest('.language').length) {
        $(".dropdown-language").removeClass("show");
    }
});



$(document).ready(function () {

    // Default settings
    var defaultLanguage = 'tr';  // Turkish Language Code
    var defaultCurrency = 'TRY'; // Turkish Lira
    var defaultLangFlag = "https://websiteprojecttest.com/flags/trky.svg"; // Update path if necessary
    var defaultCurrencyFlag = "https://websiteprojecttest.com/flags/trky.svg"; // Update path if necessary

    // Get localStorage values
    var language = localStorage.getItem('language');
    var currencyCode = localStorage.getItem('currencyCode');

    // If no value is stored, set Turkish as default
    if (!language || !currencyCode) {
        localStorage.setItem('language', defaultLanguage);
        localStorage.setItem('currencyCode', defaultCurrency);

        localStorage.setItem('selectedFlagLang', defaultLangFlag);
        localStorage.setItem('selectedLang', 'Turkish');

        localStorage.setItem('selectedFlagCurrency', defaultCurrencyFlag);
        localStorage.setItem('selectedCurrency', defaultCurrency);
    }

    // Update UI elements with stored values
    $("#selectedFlagLang").attr("src", localStorage.getItem('selectedFlagLang'));
    $("#selectedLang").text(localStorage.getItem('selectedLang'));

    $("#selectedFlagCurrency").attr("src", localStorage.getItem('selectedFlagCurrency'));
    $("#selectedCurrency").text(localStorage.getItem('selectedCurrency'));


    // WithOut Changing Dropdown set values from local storage
    if( language != null && currencyCode != null){

        document.getElementById('selectedFlagLang').src = localStorage.getItem('selectedFlagLang');
        document.getElementById('selectedLang').textContent = localStorage.getItem('selectedLang').toUpperCase();
        $(".dropdown-language").removeClass("show");


        document.getElementById('selectedFlagCurrency').src = localStorage.getItem('selectedFlagCurrency');
        document.getElementById('selectedCurrency').textContent = localStorage.getItem('selectedCurrency');
        $(".dropdown-currency").removeClass("show");


        //language
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var ajax_data = new FormData();
        ajax_data.append('language',language );
        route=`{{ route('setLanguage') }}`;
        $.ajax({
            type: 'POST',
            url: '/setLanguage',
            processData: false,
            contentType: false,
            data:ajax_data,
            success: function (data) {

                if(data.trim() == 'true'){

                    document.getElementById('selectedFlagLang').src = localStorage.getItem('selectedFlagLang');
                    document.getElementById('selectedLang').textContent = localStorage.getItem('selectedLang').toUpperCase();
                    $(".dropdown-language").removeClass("show");

                }

            },
            error: function () {
                console.error('Error updating');
            }
        });

        //currencyCode
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var ajax_data = new FormData();
        ajax_data.append('currencyCode',currencyCode );
        route=`{{ route('setCurrency') }}`;
        $.ajax({
            type: 'POST',
            processData: false,
            contentType: false,
            url: '/setCurrency',
            data:ajax_data,
            success: function (data) {

                if(data.trim() == 'true'){

                    document.getElementById('selectedFlagCurrency').src = localStorage.getItem('selectedFlagCurrency');
                    document.getElementById('selectedCurrency').textContent = localStorage.getItem('selectedCurrency');
                    $(".dropdown-currency").removeClass("show");

                }

            },
            error: function () {
                console.error('Error updating');
            }
        });
    }

});
