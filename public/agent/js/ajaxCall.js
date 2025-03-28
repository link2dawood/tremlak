$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// ______________________________ CONTACT MESSAGES _____________________________
$("#contact_us").submit(function (event) {
    event.preventDefault();
    $("#submit_btn").attr("disabled", true);
    $("#submit_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('name', $("#name").val());
    ajax_data.append('email', $("#email").val());
    ajax_data.append('subject', $("#subject").val());
    ajax_data.append('message', $("textarea#message").val());
    $.ajax({
        url: '/contact_us_submit',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {

            if (data.status == "true" || data.status == true) {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Success"],
                    text: data.message,
                }).then(() => {
                    $("#contact_us").trigger("reset");
                });
            } else {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Failed"],
                    text: data.message,
                }).then(() => {
                    // {{--window.location.href='{{session('location')}}';--}}
                });
            }

            $("#submit_btn").attr("disabled", false);
            $("#submit_btn").html(`Submit<i class="fal fa-arrow-right-long"></i>`);
        }//success
    });//ajax


});
$("#news_letter").submit(function (event) {
    event.preventDefault();

    $("#news_letter_btn").attr("disabled", true);
    $("#news_letter_btn").html(`Please wait… <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('email', $("#news_email").val());

    $.ajax({
        url: "save_subscriber",
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {
            if (data.status == "true" || data.status == true) {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Success"],
                    text: data.message,
                }).then(() => {
                    $('#news_letter').trigger("reset");
                });
            } else {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Failed"],
                    text: data.message,
                }).then(() => {
                    // {{--window.location.href='{{session('location')}}';--}}
                });
            }

            $("#news_letter_btn").attr("disabled", false);
            $("#news_letter_btn").html("Subscribe");
        }//succes
    });//ajax
});//
// ******************************* Profile *******************
$("#update_profile_agent").submit(function (event) {
    event.preventDefault();


    $("#edit_profile_btn").attr("disabled", true);
    $("#edit_profile_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('email', $("#email").val());
    ajax_data.append('fname', $("#fname").val());
    ajax_data.append('lname', $("#lname").val());
    ajax_data.append('phone', $("#phone").val());
    ajax_data.append('broker_office', $("#broker_office option:selected").val());
    ajax_data.append('whatsapp', $("#whatsapp").val());
    ajax_data.append('website', $("#website").val());

    $.ajax({
        url: '/update_profile',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {

            if (data.status == "true" || data.status == true) {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Success"],
                    text: data.message,
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Failed"],
                    text: data.message,
                }).then(() => {
                    // {{--window.location.href='{{session('location')}}';--}}
                });
            }


            $("#edit_profile_btn").attr("disabled", false);
            $("#edit_profile_btn").html("Update Profile");
        }//succes
    });//ajax


});
$("#update_password").submit(function (e) {
    e.preventDefault();

    if ($("#new_password").val().length < 8) {
        Swal.fire(lang['Alert'], lang['Password must me at least 8 characters!'], 'error').then((result) => {
            return;
        });
        return;
    }

    if ($("#new_password").val() != $("#confirm_password").val()) {

        Swal.fire(lang['Alert'], lang['New Password and Confirm Password not match!'], 'error').then((result) => {
            return;

        });
        return;
    }

    var ajax_data = new FormData();
    ajax_data.append('old_password', $("#old_password").val());
    ajax_data.append('new_password', $("#new_password").val());

    $("#update_password_btn").attr("disabled", true);
    $("#update_password_btn").html(`Please wait <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    $.ajax({
        type: "POST",
        url: "/update_password",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {

            if (data.status == "true" || data.status == true) {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Success"],
                    text: data.message,
                }).then(() => {
                    $("#update_password").trigger("reset");
                });
            } else {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Failed"],
                    text: data.message,
                }).then(() => {

                });
            }

            $("#update_password_btn").attr("disabled", false);
            $("#update_password_btn").html('Update Password');

        }
    });
});

$("#update_broker_office").submit(function (event) {
    event.preventDefault();


    $("#update_broker_office_btn").attr("disabled", true);
    $("#update_broker_office_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);


    var ajax_data = new FormData();
    ajax_data.append('id', $("#office_id").val());
    ajax_data.append('title',$("#title").val());
    ajax_data.append('certificate_no',$("#certificate_no").val());
    ajax_data.append('city_id', $("#city_id option:selected").val());
    ajax_data.append('certificate_no_later', $("#certificate_no_later").is(":checked"));

    var fileInput = $("#image_path")[0];

    if (fileInput.files.length > 0) {
        ajax_data.append('image', fileInput.files[0]);
    }

    $.ajax({
        url: 'update_BrokerOffice',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {

            if (data.status == "true" || data.status == true) {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Success"],
                    text: data.message,
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Failed"],
                    text: data.message,
                }).then(() => {
                    // {{--window.location.href='{{session('location')}}';--}}
                });
            }


            $("#update_broker_office_btn").attr("disabled", false);
            $("#update_broker_office_btn").html("Update");
        }//success
    });//ajax


});//BrokerOffice_submit

$("#update_social_links").submit(function (event) {
    event.preventDefault();
    $("#update_social_links_btn").attr("disabled", true);
    $("#update_social_links_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('type', 'user');
    ajax_data.append('facebook', $("#facebook").val());
    ajax_data.append('twitter', $("#twitter").val());
    ajax_data.append('instagram', $("#instagram").val());
    ajax_data.append('linkedin', '');
    ajax_data.append('youtube', '');
    ajax_data.append('tiktok', '');

    $.ajax({
        url: '/update_social_links',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {

            if (data.status == "true" || data.status == true) {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Success"],
                    text: data.message,
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Failed"],
                    text: data.message,
                }).then(() => {
                    // {{--window.location.href='{{session('location')}}';--}}
                });
            }

            $("#update_social_links_btn").attr("disabled", false);
            $("#update_social_links_btn").html("Update");
        }//success
    });//ajax


});
$("#profile_image").change(function (event) {
    event.preventDefault();
    $("#profile_image").attr("disabled", true);


    var ajax_data = new FormData();
    ajax_data.append('picture', $('#profile_image')[0].files[0]);

    $.ajax({
        url: '/update_profile_image',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {

            if (data.status == "true" || data.status == true) {
                // Swal.fire({
                //     icon: data.icon,
                //     title: lang["Success"],
                //     text: data.message,
                // }).then(() => {
                window.location.reload();
                // });
            } else {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Failed"],
                    text: data.message,
                }).then(() => {
                    // {{--window.location.href='{{session('location')}}';--}}
                });
            }

            $("#profile_image").attr("disabled", false);

        }//success
    });//ajax


});

// _____________________ Property Management ______________________________

function showForm(type) {

    //apartment
    if(type == 1){

        $("#type_apartment").removeClass('d-none')
        $("#type_villa").addClass('d-none')
        $("#type_house").addClass('d-none')
        $("#type_building").addClass('d-none')
        $("#type_land").addClass('d-none')

    }else if(type == 2){

        $("#type_apartment").addClass('d-none')
        $("#type_villa").removeClass('d-none')
        $("#type_house").addClass('d-none')
        $("#type_building").addClass('d-none')
        $("#type_land").addClass('d-none')

    }else if(type == 3){

        $("#type_apartment").addClass('d-none')
        $("#type_villa").addClass('d-none')
        $("#type_house").removeClass('d-none')
        $("#type_building").addClass('d-none')
        $("#type_land").addClass('d-none')

    }else if(type == 4){

        $("#type_apartment").addClass('d-none')
        $("#type_villa").addClass('d-none')
        $("#type_house").addClass('d-none')
        $("#type_building").removeClass('d-none')
        $("#type_land").addClass('d-none')

    }else if(type == 5){

        $("#type_apartment").addClass('d-none')
        $("#type_villa").addClass('d-none')
        $("#type_house").addClass('d-none')
        $("#type_building").addClass('d-none')
        $("#type_land").removeClass('d-none')

    }else {

        $("#type_apartment").addClass('d-none')
        $("#type_villa").addClass('d-none')
        $("#type_house").addClass('d-none')
        $("#type_building").addClass('d-none')
        $("#type_land").addClass('d-none')
    }
}

// append the dynamic form base on property type
$("#property_type").change(function (e) {

    e.preventDefault();
    property_type = $("#property_type option:selected").val();

    if (property_type == "") {

        alert(lang["Please select a property type"]);
        return;
    }
    $("#append_features").html('');
    $("#append_dynamic_form").html('');

    if(property_type !=''){

        $("#description_text").removeClass('d-none')

    }else {

        $("#description_text").addClass('d-none')
    }
    showForm(property_type)

    $.ajax({
        url: "/get_dynamic_inputs_by_categories",
        type: "POST",
        data: {
            property_type_id: property_type,
        },
        success: function (data) {
            var result = data;

            if (result.status == true) {
                options = result.options;
                if (options.length > 0) {

                    $("#append_dynamic_form").html('');
                    $("#append_dynamic_form").append(options);


                    //append dynamic form
                    has_dynamic_form = 1;
                    // for (let i = 0; i < data.length; i++) {
                    //     let appendData = "";
                    //     let label = '';
                    //     let margin_top = '';
                    //     if (data[i].label == 'null' || data[i].label == null) {
                    //         label = '';
                    //         margin_top = 'margin-top: 17px !important';
                    //     } else {
                    //         label = data[i].label;
                    //         margin_top = '';
                    //     }
                    //     if (data[i].type == 'select') {
                    //         let option = data[i].placeholder;
                    //         let options = option.split('-');
                    //         appendData = `<div  class="col-md-4 my-2 location-area" style="${margin_top}">
                    //                             <label for="${label}" class="heading-color ff-heading fw600 mb10">${label}</label>
                    //                             <select name="dynamic_values[]" data-id="${data[i].property_type_id + "_" + data[i].id}" data-placeholder="${data[i].placeholder}" data-type="${data[i].type}" data-label="${label}" class="form-select">`;
                    //         let opt = ""
                    //         for (let op = 0; op < options.length; op++) {
                    //             opt += `<option value="${options[op]}" class="form-control">${options[op]}</option>`;
                    //         }
                    //         appendData += opt;
                    //         appendData += `</select>
                    //             </div>`;
                    //     } else if (data[i].type == 'multi-select') {
                    //         let option = data[i].placeholder;
                    //         let options = option.split('-');
                    //         appendData = `<div  class="col-md-4 my-2" style="${margin_top}">
                    //                             <label for="${label}" class="form-label">${label}</label>
                    //                             <select name="dynamic_values[]" data-id="${data[i].property_type_id + "_" + data[i].id}"
                    //                                     data-placeholder="${data[i].placeholder}" data-type="${data[i].type}" data-label="${label}" data-live-search="true" class="selectpicker  mb-3 w-100 selectpicker2" multiple aria-label="size 3 select example">`;
                    //         let opt = ""
                    //         for (let op = 0; op < options.length; op++) {
                    //             opt += `<option value="${op == 0 ? '0' : options[op]}" class="form-control" ${op == 0 ? "disabled selected " : ""} >${options[op]}</option>`;
                    //         }
                    //         appendData += opt;
                    //         appendData += `</select>
                    //             </div>`;
                    //     }else if(data[i].type == 'file'){
                    //
                    //         appendData = `<div class="col-md-4 my-2 ">
                    //                                 <label for="${label}" class="form-label">${label}</label>
                    //                                 <input type="${data[i].type}"
                    //                                         accept=".jpg, .jpeg, .png, .pdf"
                    //                                         data-id="${data[i].property_type_id + "_" + data[i].id}"
                    //                                         placeholder="${data[i].placeholder}"
                    //                                         data-placeholder="${data[i].placeholder}"
                    //                                         data-type="${data[i].type}"
                    //                                         data-label="${label}"
                    //                                         name="dynamic_files[]" class="form-control">
                    //
                    //                                         <input type="text" hidden
                    //                                         data-id="${data[i].property_type_id + "_" + data[i].id+"_t"}"
                    //                                         placeholder="${data[i].placeholder}"
                    //                                         data-placeholder="${data[i].placeholder}"
                    //                                         data-type="${data[i].type}"
                    //                                         data-label="${label}"
                    //                                         name="dynamic_values[]" class="form-control">
                    //                           </div>`;
                    //
                    //     } else {
                    //         let class_ = "";
                    //         let mt = ''
                    //         if (data[i].type == 'checkbox') {
                    //             class_ = "form-check-input";
                    //             mt = 'mt-5'
                    //         } else {
                    //             class_ = "form-control";
                    //             mt = '';
                    //         }
                    //         appendData = `<div class="col-md-4 my-2 ${mt}" style="${margin_top}">
                    //                                 <label for="${label}" class="form-label">${label}</label>
                    //                                 <input type="${data[i].type}"
                    //                                         data-id="${data[i].property_type_id + "_" + data[i].id}"
                    //                                         placeholder="${data[i].placeholder}"
                    //                                         data-placeholder="${data[i].placeholder}"
                    //                                         data-type="${data[i].type}"
                    //                                         data-label="${label}"
                    //                                         name="dynamic_values[]" class="${class_}">
                    //                           </div>`;
                    //     }
                    //     $("#append_dynamic_form").append(appendData);
                    //     $('.selectpicker2').selectpicker();
                    //     //remove the placeholder
                    //     var selects = document.querySelectorAll(".selectpicker2");
                    //     selects.forEach(select => {
                    //         select.addEventListener("change", function () {
                    //             var options = select.options;
                    //             for (let i = 0; i < options.length; i++) {
                    //                 if (options[i].selected && options[i].disabled) {
                    //                     options[i].removeAttribute('selected');
                    //                     $('.selectpicker2').selectpicker('refresh');
                    //                 }
                    //             }
                    //         });
                    //     });
                    // }

                } else {

                    $("#append_dynamic_form").html('');
                }
            } else {

                $("#append_dynamic_form").html('');

            }
        }
    });

$.ajax({
    url: "/get_features_category",
    type: "POST",
    data: {
        property_type_id: property_type,
    },
    success: function (data) {
        var result = data;

        if (result.status == true) {
            data = result.result;

            $("#append_features").html(data);

        } else {

            $("#append_features").html('');

        }
    }
});

});//property_type change


// append town base on city
$("#property_city").change(function (e) {

    e.preventDefault();
    city_id = $("#property_city option:selected").val();
    if (city_id == "") {
        alert(lang["Please select a city"]);
        return;
    }
    var ajax_data = new FormData();
    ajax_data.append('city_id', city_id);
    $.ajax({
        url: "/get_towns_by_city",
        type: "POST",
        processData: false,
        contentType: false,
        data:ajax_data ,
        success: function (data) {

            var result = data;
            if (result.status == true || result.status == 'true') {
                data = result.result;
                $("#property_town").html('');

                if (data.length > 0) {
                    $("#property_town").append(`<option value="">---Please Select----</option>`);
                    for (let i = 0; i < data.length; i++) {
                        let appendData = "";
                        appendData += `<option value="${data[i].id}">${data[i].title}</option>`;
                        $("#property_town").append(appendData);
                    }
                    $('.selectpicker').selectpicker('refresh');
                } else {
                    $("#property_town").html('');
                }

            } else {
                $("#property_town").html('');
                Swal.fire(lang["Some thing went wrong!"], "", "error");
            }
        }
    });

});
// append district base on town
$("#property_town").change(function (e) {
    e.preventDefault();

    town_id = $("#property_town option:selected").val();
    if (town_id == "") {
        alert(lang["Please select a province"]);
        return;
    }
    var ajax_data = new FormData();
    ajax_data.append('town_id', town_id);
    $.ajax({
        url: "/get_districts_by_town",
        type: "POST",
        processData: false,
        contentType: false,
        data:ajax_data ,
        success: function (data) {

            var result = data;

            if (result.status == true || result.status == 'true') {
                data = result.result;
                $("#property_district").html('');

                if (data.length > 0) {

                    $("#property_district").append(`<option value="">---Please Select----</option>`);
                    for (let i = 0; i < data.length; i++) {
                        let appendData = "";
                        appendData += `<option value="${data[i].id}">${data[i].title}</option>`;
                        $("#property_district").append(appendData);
                    }
                    $('.selectpicker').selectpicker('refresh');
                } else {
                    $("#property_district").html('');
                }

            } else {
                $("#property_district").html('');
                Swal.fire(lang["Some thing went wrong!"], "", "error");
            }
        }
    });

});
//append lat long and set google map
$("#property_district").change(function (e) {
    e.preventDefault();

    district_id = $("#property_district option:selected").val();
    if (district_id == "") {
        alert(lang["Please select a district"]);
        return;
    }
    var ajax_data = new FormData();
    ajax_data.append('district_id', district_id);
    ajax_data.append('property_id', $("#property_id ").val());

    $.ajax({
        url: "/get_single_districts",
        type: "POST",
        processData: false,
        contentType: false,
        data:ajax_data ,
        success: function (data) {

            var result = data;
            if (result.status == true || result.status == 'true') {
                data = result.result;
                $("#property_latitude").val(data.latitude);
                $("#property_longitude").val(data.longitude);

                // set the map also on this location
                // var mapUrl = "https://maps.google.com/maps?q=" + parseFloat(data.latitude) + "," + parseFloat(data.longitude) + "&t=m&z=14&output=embed&iwloc=near";
                // $('#map').attr('src', mapUrl);

                initMap(parseFloat(data.latitude),parseFloat(data.longitude),true);
                $("#map_div").removeClass('d-none')
            } else {
                $("#latitude").html('');
                $("#longitude").html('');
                initMap();
                $("#map_div").addClass('d-none')
                Swal.fire(lang["Some thing went wrong!"], "", "error");
            }
        }
    });
});

//post a property
$("#property_submit_btn").click(function (event) {
    event.preventDefault();

    if ($("#property_type option:selected").val() == '' || $("#property_type option:selected").val() == undefined) {
        Swal.fire(lang["Select type"], lang["Please select a type and try again"], "error").then((result) => {
            $("#nav-item1-tab").click();
        });
        return;
    }
    if (uploadProductImg.length == 0) {
        Swal.fire(lang["Select Image"], lang["Please select an image and try again"], "error").then((result) => {
            $("#nav-item2-tab").click();
        });
        return;
    }
    if ($("#property_town option:selected").val() == '' || $("#property_town option:selected").val() == undefined) {
        Swal.fire(lang["Select town"], lang["Please select a town and try again"], "error").then((result) => {
            $("#nav-item3-tab").click();
        });
        return;
    }
    if ($("#property_city option:selected").val() == '' || $("#property_city option:selected").val() == undefined) {
        Swal.fire(lang["Select city"], lang["Please select a city and try again"], "error").then((result) => {
            $("#nav-item3-tab").click();
        });
        return;
    }
    if ($("#property_district option:selected").val() == '' || $("#property_district option:selected").val() == undefined) {
        Swal.fire(lang["Select district"], lang["Please select a district and try again"], "error").then((result) => {
            $("#nav-item3-tab").click();
        });
        return;
    }
    if($("#property_price").val() == 0){

        Swal.fire(lang["Price required"], lang["Please change the price"], "error").then((result) => {
            $("#nav-item4-tab").click();
        });
        return;
    }
    var ajax_data = new FormData();

    //get the property type attributes
    let type=$("#property_type option:selected").val();
    //apartment
    if(type == 1){

        if ($("#apartment_type option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select type of apartment"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_type").focus();
            });
            return;

        }
        if ($("#apartment_conditionp option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select apartment condition"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_conditionp").focus();
            });
            return;

        }
        if ($("#apartment_grossm2").val() == '') {

            Swal.fire(lang['Alert'],lang["Please enter apartment Gross m²"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_grossm2").focus();
            });
            return;

        }
        if ($("#apartment_netm2").val() == '') {

            Swal.fire(lang['Alert'],lang["Please enter apartment Net m²"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_netm2").focus();
            });
            return;

        }
        if ($("#apartment_bed_rooms option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select apartment Bedrooms"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_bed_rooms").focus();
            });
            return;

        }
        if ($("#apartment_living_rooms option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select apartment Livingrooms"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_living_rooms").focus();
            });
            return;

        }
        if ($("#apartment_bath_rooms option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select apartment Bathrooms"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_bath_rooms").focus();
            });
            return;

        }

        if ($("#apartment_age option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select apartment age"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_age").focus();
            });
            return;

        }
        if ($("#apartment_status option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select apartment Status"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_status").focus();
            });
            return;

        }

        if ($("#apartment_building_floors option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select apartment Building Floors"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_building_floors").focus();
            });
            return;

        }
        if ($("#apartment_heating option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select apartment heating type"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_heating").focus();
            });
            return;

        }
        if ($("#apartment_elevator option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select apartment elevator"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_elevator").focus();
            });
            return;

        }
        if ($("#apartment_floors option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select apartment floor"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_floors").focus();
            });
            return;

        }

        ajax_data.append('type',$('#apartment_type option:selected').val())
        ajax_data.append('conditionp',$('#apartment_conditionp option:selected').val())
        ajax_data.append('grossm2',$('#apartment_grossm2').val())
        ajax_data.append('netm2',$('#apartment_netm2').val())
        ajax_data.append('bed_rooms',$('#apartment_bed_rooms option:selected').val())
        ajax_data.append('living_rooms',$('#apartment_living_rooms option:selected').val())
        ajax_data.append('bath_rooms',$('#apartment_bath_rooms option:selected').val())
        ajax_data.append('age',$('#apartment_age option:selected').val())
        ajax_data.append('status',$('#apartment_status option:selected').val())
        ajax_data.append('floors',$('#apartment_floors option:selected').val())
        ajax_data.append('building_floors',$('#apartment_building_floors option:selected').val())
        ajax_data.append('heating',$('#apartment_heating option:selected').val())
        ajax_data.append('elevator',$('#apartment_elevator option:selected').val())


    }else if(type == 2){

        if ($("#villa_conditionp option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select villa condition"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_conditionp").focus();
            });
            return;

        }
        if ($("#villa_grossm2").val() == '') {

            Swal.fire(lang['Alert'],lang["Please enter villa Gross m²"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_grossm2").focus();
            });
            return;

        }
        if ($("#villa_netm2").val() == '') {

            Swal.fire(lang['Alert'],lang["Please enter villa m² net"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_netm2").focus();
            });
            return;

        }
        if ($("#villa_landm2").val() == '') {

            Swal.fire(lang['Alert'],lang["Please enter villa Land m²"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_landm2").focus();
            });
            return;

        }
        if ($("#villa_bed_rooms option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select villa Bedrooms"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_bed_rooms").focus();
            });
            return;

        }
        if ($("#villa_living_rooms option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select villa Livingrooms"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_living_rooms").focus();
            });
            return;

        }
        if ($("#villa_bath_rooms option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select villa Bathrooms"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_bath_rooms").focus();
            });
            return;

        }

        if ($("#villa_age option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select villa age"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_age").focus();
            });
            return;

        }
        if ($("#villa_garden option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select villa garden"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_garden").focus();
            });
            return;

        }
        if ($("#villa_floors option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select villa floor"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_floors").focus();
            });
            return;

        }
        if ($("#villa_elevator option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select villa Elevator"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_elevator").focus();
            });
            return;

        }

        ajax_data.append('conditionp',$('#villa_conditionp option:selected').val())
        ajax_data.append('grossm2',$('#villa_grossm2').val())
        ajax_data.append('netm2',$('#villa_netm2').val())
        ajax_data.append('landm2',$('#villa_landm2').val())
        ajax_data.append('bed_rooms',$('#villa_bed_rooms option:selected').val())
        ajax_data.append('living_rooms',$('#villa_living_rooms option:selected').val())
        ajax_data.append('bath_rooms',$('#villa_bath_rooms option:selected').val())
        ajax_data.append('age',$('#villa_age option:selected').val())
        ajax_data.append('garden',$('#villa_garden option:selected').val())
        ajax_data.append('floors',$('#villa_floors option:selected').val())
        ajax_data.append('elevator',$('#villa_elevator option:selected').val())

    }else if(type == 3){

        if ($("#house_conditionp option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select house condition"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#house_conditionp").focus();
            });
            return;

        }
        if ($("#house_grossm2").val() == '') {

            Swal.fire(lang['Alert'],lang["Please enter house Gross m²"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#house_grossm2").focus();
            });
            return;

        }
        if ($("#house_netm2").val() == '') {

            Swal.fire(lang['Alert'],lang["Please enter house Net m²"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#house_netm2").focus();
            });
            return;

        }
        if ($("#house_landm2").val() == '') {

            Swal.fire(lang['Alert'],lang["Please enter house Land m²"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#house_landm2").focus();
            });
            return;

        }

        if ($("#house_bed_rooms option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select house Bedrooms"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#house_bed_rooms").focus();
            });
            return;

        }
        if ($("#house_living_rooms option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select house Livingrooms"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#house_living_rooms").focus();
            });
            return;

        }
        if ($("#house_bath_rooms option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select house Bathrooms"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#house_bath_rooms").focus();
            });
            return;

        }
        if ($("#house_age option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select house age"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#house_age").focus();
            });
            return;

        }
        if ($("#house_garden option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select house garden"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#house_garden").focus();
            });
            return;

        }
        if ($("#house_floors option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select house floor"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#house_floors").focus();
            });
            return;

        }

        ajax_data.append('conditionp',$('#house_conditionp option:selected').val())
        ajax_data.append('grossm2',$('#house_grossm2').val())
        ajax_data.append('netm2',$('#house_netm2').val())
        ajax_data.append('landm2',$('#house_landm2').val())
        ajax_data.append('bed_rooms',$('#house_bed_rooms option:selected').val())
        ajax_data.append('living_rooms',$('#house_living_rooms option:selected').val())
        ajax_data.append('bath_rooms',$('#house_bath_rooms option:selected').val())
        ajax_data.append('age',$('#house_age option:selected').val())
        ajax_data.append('garden',$('#house_garden option:selected').val())
        ajax_data.append('floors',$('#house_floors option:selected').val())

    }else if(type == 4){

        if ($("#building_conditionp option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select building condition"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#building_conditionp").focus();
            });
            return;

        }
        if ($("#building_grossm2").val() == '') {

            Swal.fire(lang['Alert'],lang["Please enter building Gross m²"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#building_grossm2").focus();
            });
            return;

        }
        if ($("#building_shops option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select Shops in Building"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#building_shops").focus();
            });
            return;

        }
        if ($("#building_storage_rooms option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select Storage Rooms in Building"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#building_storage_rooms").focus();
            });
            return;

        }
        if ($("#building_flats option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select Flats in Building"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#building_flats").focus();
            });
            return;

        }
        if ($("#building_age option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select building age"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#building_age").focus();
            });
            return;

        }
        if ($("#building_elevator option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select building elevator"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#building_elevator").focus();
            });
            return;

        }
        if ($("#building_floors option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select building floor"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#building_floors").focus();
            });
            return;

        }

        ajax_data.append('conditionp',$('#building_conditionp option:selected').val())
        ajax_data.append('grossm2',$('#building_grossm2').val())
        ajax_data.append('floors',$('#building_floors option:selected').val())
        ajax_data.append('flats',$('#building_flats option:selected').val())
        ajax_data.append('shops',$('#building_shops option:selected').val())
        ajax_data.append('storage_rooms',$('#building_storage_rooms option:selected').val())
        ajax_data.append('age',$('#building_age option:selected').val())
        ajax_data.append('elevator',$('#building_elevator option:selected').val())


    }else if(type == 5){

        if ($("#land_type option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select land type"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#land_type").focus();
            });
            return;

        }
        if ($("#land_status option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select land status"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#land_status").focus();
            });
            return;

        }
        if ($("#land_landm2").val() == '') {

            Swal.fire(lang['Alert'],lang["Please enter land m2"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#land_landm2").focus();
            });
            return;

        }

        ajax_data.append('landm2',$('#land_landm2').val())
        ajax_data.append('pricem2','')
        ajax_data.append('status',$('#land_status option:selected').val())
        ajax_data.append('flats',$('#land_flats option:selected').val())
        ajax_data.append('type',$('#land_type option:selected').val())

    }

    //get the
    var dynamic_labels = [];
    var dynamic_types = [];
    var dynamic_placeholders = [];
    var dynamic_values = [];
    var property_locations_ids = [];
    var property_locations_values = [];
    var property_outlooks = [];

    $("[name='dynamic_values[]']").each(function (index) {
        var inputType = $(this).data('type');

        if($(this).val() != "" ){


            if (inputType == "checkbox") {

                // For checkboxes, check if it's checked and push its value accordingly
                if ($(this).is(":checked")) {
                    dynamic_values.push("Yes");
                } else {
                    dynamic_values.push("No");
                }
            } else if (inputType == 'select') {

                // For select elements, append the selected option's value
                dynamic_values.push($(this).val());
            } else if (inputType == 'multi-select') {

                let temp_values_selected = ($(this).val().join('-'));
                dynamic_values.push(temp_values_selected);

            } else {

                dynamic_values.push($(this).val());
            }

            dynamic_labels.push($(this).data('label'));
            dynamic_types.push($(this).data('type'));
            dynamic_placeholders.push($(this).data('placeholder'));
        }
    });

    $("select[name='property_locations_values[]']").each(function() {
        let location_id = $(this).data('property_location_ids');

        if($(this).val() != ""){
            property_locations_ids.push(location_id);
            property_locations_values.push($(this).val());
        }

    });
    $("input[name='property_outlooks[]']:checked").each(function() {
        property_outlooks.push($(this).val());
    });

    $("#property_submit_btn").attr("disabled", true);
    $("#property_submit_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);


    ajax_data.append('property_type', $("#property_type option:selected").val());
    $("#descriptionEditor").val($("#editor").html());
    ajax_data.append('description', $("#descriptionEditor").val());
    ajax_data.append('property_town', $("#property_town option:selected").val());
    ajax_data.append('property_city', $("#property_city option:selected").val());
    ajax_data.append('property_district', $("#property_district option:selected").val());
    ajax_data.append('property_latitude', $("#property_latitude").val());
    ajax_data.append('property_longitude', $("#property_longitude").val());
    ajax_data.append('property_locations_ids', property_locations_ids);
    ajax_data.append('property_locations_values', property_locations_values);
    ajax_data.append('property_currency', $("#property_currency option:selected").val());
    ajax_data.append('property_price', $("#property_price").val());
    ajax_data.append('property_outlooks', property_outlooks);
    ajax_data.append('property_duration', $("#property_duration option:selected").val());
    ajax_data.append('want_to_highlight', $("#want_to_highlight").prop("checked") ? 'true' : 'false');
    for (var index = 0; index < uploadProductImg.length; index++) {
        ajax_data.append("files[]", uploadProductImg[index]);
    }
    ajax_data.append('dynamic_labels', dynamic_labels);
    ajax_data.append('dynamic_values', dynamic_values);
    ajax_data.append('dynamic_types', dynamic_types);
    ajax_data.append('dynamic_placeholders', dynamic_placeholders);

    $.ajax({
        url: '/save_property',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {

            if (data.status == "true" || data.status == true) {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Success"],
                    text: data.message,
                }).then(() => {
                    window.location.href="my_properties";
                });
            } else {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Failed"],
                    text: data.message,
                }).then(() => {
                    // {{--window.location.href='{{session('location')}}';--}}
                });
            }

            $("#property_submit_btn").attr("disabled", false);
            $("#property_submit_btn").html(`Submit Property<i class="fal fa-arrow-right-long"></i>`);
        }//success
    });//ajax


});

//update a property
$("#update_property_btn").click(function (event) {
    event.preventDefault();

    if ($("#property_type option:selected").val() == '' || $("#property_type option:selected").val() == undefined) {
        Swal.fire(lang["Select type"], lang["Please select a type and try again"], "error").then((result) => {
            $("#nav-item1-tab").click();
        });
        return;
    }
    if ($("#property_town option:selected").val() == '' || $("#property_town option:selected").val() == undefined) {
        Swal.fire(lang["Select town"], lang["Please select a town and try again"], "error").then((result) => {
            $("#nav-item3-tab").click();
        });
        return;
    }
    if ($("#property_city option:selected").val() == '' || $("#property_city option:selected").val() == undefined) {
        Swal.fire(lang["Select city"], lang["Please select a city and try again"], "error").then((result) => {
            $("#nav-item3-tab").click();
        });
        return;
    }
    if ($("#property_district option:selected").val() == '' || $("#property_district option:selected").val() == undefined) {
        Swal.fire(lang["Select district"], lang["Please select a district and try again"], "error").then((result) => {
            $("#nav-item3-tab").click();
        });
        return;
    }
    if($("#property_price").val() == 0){

        Swal.fire(lang["Price required"], lang["Please change the price"], "error").then((result) => {
            $("#nav-item4-tab").click();
        });
        return;
    }

    var ajax_data = new FormData();

    //get the property type attributes
    let type=$("#property_type option:selected").val();
    //apartment
    if(type == 1){

        if ($("#apartment_type option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select type of apartment"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_type").focus();
            });
            return;

        }
        if ($("#apartment_conditionp option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select apartment condition"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_conditionp").focus();
            });
            return;

        }
        if ($("#apartment_grossm2").val() == '') {

            Swal.fire(lang['Alert'],lang["Please enter apartment Gross m²"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_grossm2").focus();
            });
            return;

        }
        if ($("#apartment_netm2").val() == '') {

            Swal.fire(lang['Alert'],lang["Please enter apartment Net m²"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_netm2").focus();
            });
            return;

        }
        if ($("#apartment_bed_rooms option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select apartment Bedrooms"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_bed_rooms").focus();
            });
            return;

        }
        if ($("#apartment_living_rooms option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select apartment Livingrooms"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_living_rooms").focus();
            });
            return;

        }
        if ($("#apartment_bath_rooms option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select apartment Bathrooms"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_bath_rooms").focus();
            });
            return;

        }

        if ($("#apartment_age option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select apartment age"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_age").focus();
            });
            return;

        }
        if ($("#apartment_status option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select apartment Status"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_status").focus();
            });
            return;

        }

        if ($("#apartment_building_floors option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select apartment Building Floors"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_building_floors").focus();
            });
            return;

        }
        if ($("#apartment_heating option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select apartment heating type"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_heating").focus();
            });
            return;

        }
        if ($("#apartment_elevator option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select apartment elevator"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_elevator").focus();
            });
            return;

        }
        if ($("#apartment_floors option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select apartment floor"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#apartment_floors").focus();
            });
            return;

        }

        ajax_data.append('type',$('#apartment_type option:selected').val())
        ajax_data.append('conditionp',$('#apartment_conditionp option:selected').val())
        ajax_data.append('grossm2',$('#apartment_grossm2').val())
        ajax_data.append('netm2',$('#apartment_netm2').val())
        ajax_data.append('bed_rooms',$('#apartment_bed_rooms option:selected').val())
        ajax_data.append('living_rooms',$('#apartment_living_rooms option:selected').val())
        ajax_data.append('bath_rooms',$('#apartment_bath_rooms option:selected').val())
        ajax_data.append('age',$('#apartment_age option:selected').val())
        ajax_data.append('status',$('#apartment_status option:selected').val())
        ajax_data.append('floors',$('#apartment_floors option:selected').val())
        ajax_data.append('building_floors',$('#apartment_building_floors option:selected').val())
        ajax_data.append('heating',$('#apartment_heating option:selected').val())
        ajax_data.append('elevator',$('#apartment_elevator option:selected').val())


    }else if(type == 2){

        if ($("#villa_conditionp option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select villa condition"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_conditionp").focus();
            });
            return;

        }
        if ($("#villa_grossm2").val() == '') {

            Swal.fire(lang['Alert'],lang["Please enter villa Gross m²"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_grossm2").focus();
            });
            return;

        }
        if ($("#villa_netm2").val() == '') {

            Swal.fire(lang['Alert'],lang["Please enter villa m² net"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_netm2").focus();
            });
            return;

        }
        if ($("#villa_landm2").val() == '') {

            Swal.fire(lang['Alert'],lang["Please enter villa Land m²"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_landm2").focus();
            });
            return;

        }
        if ($("#villa_bed_rooms option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select villa Bedrooms"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_bed_rooms").focus();
            });
            return;

        }
        if ($("#villa_living_rooms option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select villa Livingrooms"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_living_rooms").focus();
            });
            return;

        }
        if ($("#villa_bath_rooms option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select villa Bathrooms"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_bath_rooms").focus();
            });
            return;

        }
        if ($("#villa_age option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select villa age"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_age").focus();
            });
            return;

        }
        if ($("#villa_garden option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select villa garden"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_garden").focus();
            });
            return;

        }
        if ($("#villa_floors option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select villa floor"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_floors").focus();
            });
            return;

        }
        if ($("#villa_elevator option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select villa Elevator"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#villa_elevator").focus();
            });
            return;

        }

        ajax_data.append('conditionp',$('#villa_conditionp option:selected').val())
        ajax_data.append('grossm2',$('#villa_grossm2').val())
        ajax_data.append('netm2',$('#villa_netm2').val())
        ajax_data.append('landm2',$('#villa_landm2').val())
        ajax_data.append('bed_rooms',$('#villa_bed_rooms option:selected').val())
        ajax_data.append('living_rooms',$('#villa_living_rooms option:selected').val())
        ajax_data.append('bath_rooms',$('#villa_bath_rooms option:selected').val())
        ajax_data.append('age',$('#villa_age option:selected').val())
        ajax_data.append('garden',$('#villa_garden option:selected').val())
        ajax_data.append('floors',$('#villa_floors option:selected').val())
        ajax_data.append('elevator',$('#villa_elevator option:selected').val())

    }else if(type == 3){

        if ($("#house_conditionp option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select house condition"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#house_conditionp").focus();
            });
            return;

        }
        if ($("#house_grossm2").val() == '') {

            Swal.fire(lang['Alert'],lang["Please enter house Gross m²"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#house_grossm2").focus();
            });
            return;

        }
        if ($("#house_netm2").val() == '') {

            Swal.fire(lang['Alert'],lang["Please enter house Net m²"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#house_netm2").focus();
            });
            return;

        }
        if ($("#house_landm2").val() == '') {

            Swal.fire(lang['Alert'],lang["Please enter house Land m²"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#house_landm2").focus();
            });
            return;

        }
        if ($("#house_bed_rooms option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select house Bedrooms"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#house_bed_rooms").focus();
            });
            return;

        }
        if ($("#house_living_rooms option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select house Livingrooms"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#house_living_rooms").focus();
            });
            return;

        }
        if ($("#house_bath_rooms option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select house Bathrooms"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#house_bath_rooms").focus();
            });
            return;

        }
        if ($("#house_age option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select house age"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#house_age").focus();
            });
            return;

        }
        if ($("#house_garden option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select house garden"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#house_garden").focus();
            });
            return;

        }
        if ($("#house_floors option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select house floor"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#house_floors").focus();
            });
            return;

        }

        ajax_data.append('conditionp',$('#house_conditionp option:selected').val())
        ajax_data.append('grossm2',$('#house_grossm2').val())
        ajax_data.append('netm2',$('#house_netm2').val())
        ajax_data.append('landm2',$('#house_landm2').val())
        ajax_data.append('bed_rooms',$('#house_bed_rooms option:selected').val())
        ajax_data.append('living_rooms',$('#house_living_rooms option:selected').val())
        ajax_data.append('bath_rooms',$('#house_bath_rooms option:selected').val())
        ajax_data.append('age',$('#house_age option:selected').val())
        ajax_data.append('garden',$('#house_garden option:selected').val())
        ajax_data.append('floors',$('#house_floors option:selected').val())

    }else if(type == 4){

        if ($("#building_conditionp option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select building condition"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#building_conditionp").focus();
            });
            return;

        }
        if ($("#building_grossm2").val() == '') {

            Swal.fire(lang['Alert'],lang["Please enter building Gross m²"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#building_grossm2").focus();
            });
            return;

        }
        if ($("#building_shops option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select Shops in Building"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#building_shops").focus();
            });
            return;

        }
        if ($("#building_storage_rooms option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select Storage Rooms in Building"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#building_storage_rooms").focus();
            });
            return;

        }
        if ($("#building_flats option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select Flats in Building"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#building_flats").focus();
            });
            return;

        }
        if ($("#building_age option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select building age"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#building_age").focus();
            });
            return;

        }
        if ($("#building_elevator option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select building elevator"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#building_elevator").focus();
            });
            return;

        }
        if ($("#building_floors option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select building floor"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#building_floors").focus();
            });
            return;

        }

        ajax_data.append('conditionp',$('#building_conditionp option:selected').val())
        ajax_data.append('grossm2',$('#building_grossm2').val())
        ajax_data.append('floors',$('#building_floors option:selected').val())
        ajax_data.append('flats',$('#building_flats option:selected').val())
        ajax_data.append('shops',$('#building_shops option:selected').val())
        ajax_data.append('storage_rooms',$('#building_storage_rooms option:selected').val())
        ajax_data.append('age',$('#building_age option:selected').val())
        ajax_data.append('elevator',$('#building_elevator option:selected').val())


    }else if(type == 5){

        if ($("#land_type option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select land type"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#land_type").focus();
            });
            return;

        }
        if ($("#land_status option:selected").val() == '') {

            Swal.fire(lang['Alert'],lang["Please select land status"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#land_status").focus();
            });
            return;

        }
        if ($("#land_landm2").val() == '') {

            Swal.fire(lang['Alert'],lang["Please enter land m2"], "error").then((result) => {
                $("#nav-item1-tab").click();
                $("#land_landm2").focus();
            });
            return;

        }

        ajax_data.append('landm2',$('#land_landm2').val())
        ajax_data.append('pricem2','')
        ajax_data.append('status',$('#land_status option:selected').val())
        ajax_data.append('flats',$('#land_flats option:selected').val())
        ajax_data.append('type',$('#land_type option:selected').val())

    }
    //get the dynamic filled form data
    var dynamic_labels = [];
    var dynamic_types = [];
    var dynamic_placeholders = [];
    var dynamic_values = [];
    var property_locations_ids = [];
    var property_locations_values = [];
    var property_outlooks = [];

    $("[name='dynamic_values[]']").each(function (index) {
        var inputType = $(this).data('type');

        if($(this).val() != "" ){


            if (inputType == "checkbox") {

                // For checkboxes, check if it's checked and push its value accordingly
                if ($(this).is(":checked")) {
                    dynamic_values.push("Yes");
                } else {
                    dynamic_values.push("No");
                }
            } else if (inputType == 'select') {

                // For select elements, append the selected option's value
                dynamic_values.push($(this).val());
            } else if (inputType == 'multi-select') {

                let temp_values_selected = ($(this).val().join('-'));
                dynamic_values.push(temp_values_selected);

            } else {

                dynamic_values.push($(this).val());
            }

            dynamic_labels.push($(this).data('label'));
            dynamic_types.push($(this).data('type'));
            dynamic_placeholders.push($(this).data('placeholder'));
        }
    });

    $("select[name='property_locations_values[]']").each(function() {
        let location_id = $(this).data('property_location_ids');

        if($(this).val() != ""){
            property_locations_ids.push(location_id);
            property_locations_values.push($(this).val());
        }

    });
    $("input[name='property_outlooks[]']:checked").each(function() {
        property_outlooks.push($(this).val());
    });

    $("#update_property_btn").attr("disabled", true);
    $("#update_property_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);


    ajax_data.append('id', $("#property_id").val());
    ajax_data.append('property_type', $("#property_type option:selected").val());
    ajax_data.append('property_town', $("#property_town option:selected").val());
    ajax_data.append('property_city', $("#property_city option:selected").val());
    ajax_data.append('property_district', $("#property_district option:selected").val());
    ajax_data.append('property_latitude', $("#property_latitude").val());
    ajax_data.append('property_longitude', $("#property_longitude").val());
    ajax_data.append('property_locations_ids', property_locations_ids);
    ajax_data.append('property_locations_values', property_locations_values);
    ajax_data.append('property_currency', $("#property_currency option:selected").val());
    ajax_data.append('property_price', $("#property_price").val());
    ajax_data.append('property_outlooks', property_outlooks);
    ajax_data.append('property_duration', $("#property_duration option:selected").val());
    ajax_data.append('want_to_highlight', $("#want_to_highlight").prop("checked") ? 'true' : 'false');
    for (var index = 0; index < uploadProductImg.length; index++) {
        ajax_data.append("files[]", uploadProductImg[index]);
    }

    ajax_data.append('dynamic_labels', dynamic_labels);
    ajax_data.append('dynamic_values', dynamic_values);
    ajax_data.append('dynamic_types', dynamic_types);
    ajax_data.append('dynamic_placeholders', dynamic_placeholders);

    $.ajax({
        url: '/update_property',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {

            if (data.status == "true" || data.status == true) {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Success"],
                    text: data.message,
                }).then(() => {
                    window.location.href="/my_properties";
                });
            } else {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Failed"],
                    text: data.message,
                }).then(() => {
                    // {{--window.location.href='{{session('location')}}';--}}
                });
            }

            $("#update_property_btn").attr("disabled", false);
            $("#update_property_btn").html(`Update Property<i class="fal fa-arrow-right-long"></i>`);
        }//success
    });//ajax


});
//update pause and active status
function UpdatePropertyStatus(property_id,status){

    Swal.fire({
        title: lang['Alert'],
        text: lang["Are you sure to update the status of this property?"],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {

            $("#update_status"+property_id).attr("disabled", true);
            // $("#update_status"+property_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', property_id);
            ajax_data.append('status', status);

            $.ajax({
                url: '/update_property_status',
                type: "POST",
                processData: false,
                contentType: false,
                data: ajax_data,
                success: function (data) {

                    if (data.status == "true" || data.status == true) {
                        Swal.fire({
                            icon: data.icon,
                            title: lang["Success"],
                            text: data.message,
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: data.icon,
                            title: lang["Failed"],
                            text: data.message,
                        }).then(() => {
                            // {{--window.location.href='{{session('location')}}';--}}
                        });
                    }
                    $("#update_status"+property_id).attr("disabled", false);
                }//success
            });//ajax
        }
    });
}

$("#renew_property").submit(function (e) {
    e.preventDefault();

    $("#renew_btn").attr("disabled", true);
    $("#renew_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('id', $("#property_id").val());
    ajax_data.append('property_duration', $("#property_duration option:selected").val());

    $.ajax({
        url: '/renew_property',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {
            $("#renew_modal").modal('hide')
            if (data.status == "true" || data.status == true) {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Success"],
                    text: data.message,
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Failed"],
                    text: data.message,
                }).then(() => {
                    // {{--window.location.href='{{session('location')}}';--}}
                });
            }

            $("#renew_btn").attr("disabled", false);
            $("#renew_btn").html('Submit');
        }//success
    });
});

function deleteProperty(property_id){

    Swal.fire({
        title: lang['Are you sure to delete this property?'],
        text: lang["You won't be able to revert this."],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#delete_property_btn"+property_id).attr("disabled", true);
            // $("#delete_property_btn"+package_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', property_id);

            $.ajax({
                url: '/delete_property',
                type: "POST",
                processData: false,
                contentType: false,
                data: ajax_data,
                success: function (data) {

                    if (data.status == "true" || data.status == true) {
                        Swal.fire({
                            icon: data.icon,
                            title: lang["Success"],
                            text: data.message,
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: data.icon,
                            title: lang["Failed"],
                            text: data.message,
                        }).then(() => {
                            // {{--window.location.href='{{session('location')}}';--}}
                        });
                    }

                    $("#delete_property_btn"+property_id).attr("disabled", false);

                }//success
            });//ajax

        }
    });

}//deleteProperty
function deletePropertyImage(product_id,preview_image,property_id){

    $("#delete_image_btn"+product_id).attr("disabled", true);
    // $("#delete_image_btn"+package_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('id', product_id);
    ajax_data.append('preview_image', preview_image);
    ajax_data.append('property_id', property_id);

    $.ajax({
        url: '/delete_property_image',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {

            if (data.status == "true" || data.status == true) {
                // Swal.fire({
                //     icon: data.icon,
                //     title: lang["Success"],
                //     text: data.message,
                // }).then(() => {
                //     window.location.reload();
                // });
                // window.location.reload();
                let images_count = parseInt($("#images_count").val());
                images_count = images_count-1;
                $("#images_count").val(images_count);
                $("#image_card"+product_id).addClass('d-none');
            } else {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Failed"],
                    text: data.message,
                }).then(() => {
                    // {{--window.location.href='{{session('location')}}';--}}
                });
            }

            $("#delete_image_btn"+product_id).attr("disabled", false);

        }//succes
    });//ajax

}//deletePropertyImage
function PreviewImage(product_id,property_id){

    $("#preview_image_btn"+product_id).attr("disabled", true);
    // $("#preview_image_btn"+package_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('id', product_id);
    ajax_data.append('property_id', property_id);

    $.ajax({
        url: '/preview_property_image',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {

            if (data.status == "true" || data.status == true) {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Success"],
                    text: data.message,
                }).then(() => {
                    window.location.reload();
                });
                // $("#preview_old").removeClass('active')
                // $("#preview"+product_id).addClass('active')


                 // $("#image_card"+product_id).hide();
            } else {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Failed"],
                    text: data.message,
                }).then(() => {
                    // {{--window.location.href='{{session('location')}}';--}}
                });
            }

            $("#preview_image_btn"+product_id).attr("disabled", false);

        }//succes
    });//ajax

}//deletePropertyImage

