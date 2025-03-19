$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// *************************************** Agents Management *************************************

function deleteUser(user_id) {

    Swal.fire({
        title: lang["Are you sure to delete this agent?"],
        text: lang["All properties of this agent are also deleted!"],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#delete_user" + user_id).attr("disabled", true);
            // $("#delete_user"+package_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', user_id);

            $.ajax({
                url: 'delete_user',
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

                    $("#delete_user" + user_id).attr("disabled", false);
                }//success
            });//ajax
        }
    });

}//deleteUser
function UpdateUserStatus(user_id, status) {

    Swal.fire({
        title: lang["Alert"],
        text: lang["Are you sure to update the status of this agent?"],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#update_status" + user_id).attr("disabled", true);
            // $("#update_status"+user_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', user_id);
            ajax_data.append('status', status);

            $.ajax({
                url: 'update_user_status',
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

                    $("#update_status" + user_id).attr("disabled", false);

                }//success
            });//ajax
        }
    });
}//UpdateUserStatus
function approveProfile(user_id) {

    Swal.fire({
        title: lang["Alert"],
        text: lang["Are you sure to approve the profile of this agent?"],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#approve_profile" + user_id).attr("disabled", true);
            // $("#approve_profile"+user_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', user_id);
            ajax_data.append('status', status);

            $.ajax({
                url: 'approve_profile',
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

                    $("#approve_profile" + user_id).attr("disabled", false);

                }//successs
            });//ajax
        }
    });
}//UpdateUserStatus
$("#update_user_services_allow").submit(function (event) {
    event.preventDefault();


    $("#update_balance_btn").attr("disabled", true);
    $("#update_balance_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('id', $("#user_id").val());
    ajax_data.append('services_allow', $("#edit_services_allow").val());

    $.ajax({
        url: 'update_services_allow',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {

            $("#updateBalanceModal").modal('hide');

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
            $("#update_balance_btn").attr("disabled", false);
            $("#update_balance_btn").html("Update");
        }//success
    });//ajax
});
$("#update_profile").submit(function (event) {
    event.preventDefault();


    $("#edit_profile_btn").attr("disabled", true);
    $("#edit_profile_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('fname', $("#name").val());
    ajax_data.append('phone', $("#phone").val());
    ajax_data.append('picture', $('#picture')[0].files[0]);


    $.ajax({
        url: 'update_profile',
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
        }//success
    });//ajax


});
$("#update_password").submit(function (e) {
    e.preventDefault();

    if ($("#new_password").val().length < 8) {
        Swal.fire(lang["Alert"], lang['Password must me at least 8 characters!'], 'error').then((result) =>{
            return;
        });
        return;
    }

    if ($("#new_password").val() != $("#confirm_password").val()) {

        Swal.fire(lang["Alert"], lang['New Password and Confirm Password not match!'], 'error').then((result) =>{
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

// *************************************** Broker Office Management *************************************
$("#BrokerOffice_submit").submit(function (event) {
    event.preventDefault();


    $("#submit_btn").attr("disabled", true);
    $("#submit_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();

    ajax_data.append('title',$("#title").val());
    ajax_data.append('image', $("#BrokerOffice_image")[0].files[0]);
    ajax_data.append('city_id', $("#city_id option:selected").val());

    $.ajax({
        url: 'save_BrokerOffice',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {
            $("#addBrokerOfficemodal").modal('hide');
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
            $("#submit_btn").attr("disabled", false);
            $("#submit_btn").html("Submit");
        }//success
    });//ajax


});//BrokerOffice_submit
$("#edit_BrokerOffice").submit(function (event) {
    event.preventDefault();


    $("#edit_BrokerOffice_btn").attr("disabled", true);
    $("#edit_BrokerOffice_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);


    var ajax_data = new FormData();
    ajax_data.append('id', $("#BrokerOffice_id").val());
    ajax_data.append('title',$("#edit_title").val());
    ajax_data.append('city_id', $("#edit_city_id option:selected").val());
    var fileInput = $("#edit_BrokerOffice_image")[0];

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

            $("#editBrokerOfficemodal").modal('hide');

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


            $("#edit_BrokerOffice_btn").attr("disabled", false);
            $("#edit_BrokerOffice_btn").html("Update");
        }//success
    });//ajax


});//BrokerOffice_submit
function deleteBrokerOffice(BrokerOffice_id) {

    Swal.fire({
        title: lang['Are you sure to delete this Broker Office?'],
        text: lang["You won't be able to revert this."],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#BrokerOffice_delete_btn" + BrokerOffice_id).attr("disabled", true);
            // $("#BrokerOffice_delete_btn"+BrokerOffice_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', BrokerOffice_id);

            $.ajax({
                url: 'delete_BrokerOffice',
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
                    $("#BrokerOffice_delete_btn" + BrokerOffice_id).attr("disabled", false);

                }//successs
            });//ajax

        }
    });

}//deleteBrokerOffice
function updateBrokerOfficeStatus(BrokerOffice_id, status) {

    Swal.fire({
        title: lang["Alert"],
        text: lang["Are you sure to update the status of this Broker Office?"],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#update_status" + BrokerOffice_id).attr("disabled", true);
            // $("#update_status"+BrokerOffice_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', BrokerOffice_id);
            ajax_data.append('status', status);

            $.ajax({
                url: 'update_BrokerOffice_status',
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

                    $("#update_status" + BrokerOffice_id).attr("disabled", false);

                }//success
            });//ajax

        }
    });

}//updateBrokerOfficeStatus

// *************************************** Property Type Management *************************************
$("#propertyType_submit").submit(function (event) {
    event.preventDefault();


    $("#submit_btn").attr("disabled", true);
    $("#submit_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    var title = $("input[name='title[]']").map(function () {
        return $(this).val();
    }).get();

    ajax_data.append('title',title );
    ajax_data.append('image', $("#propertyType_image")[0].files[0]);
     ajax_data.append('position', $("input[name='add_position']").val());
    
    $.ajax({
        url: 'save_propertyType',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {
            $("#addpropertyTypemodal").modal('hide');
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
            $("#submit_btn").attr("disabled", false);
            $("#submit_btn").html("Submit");
        }//success
    });//ajax


});//propertyType_submit
$("#edit_propertyType").submit(function (event) {
    event.preventDefault();


    $("#edit_propertyType_btn").attr("disabled", true);
    $("#edit_propertyType_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var title = $("input[name='edit_title[]']").map(function () {
        return $(this).val();
    }).get();

    var ajax_data = new FormData();
    ajax_data.append('id', $("#propertyType_id").val());
    ajax_data.append('title', title);
    ajax_data.append('position', $("input[name='edit_position']").val());
    var fileInput = $("#edit_propertyType_image")[0];

    if (fileInput.files.length > 0) {
        ajax_data.append('image', fileInput.files[0]);
    }

    $.ajax({
        url: 'update_propertyType',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {

            $("#editpropertyTypemodal").modal('hide');

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


            $("#edit_propertyType_btn").attr("disabled", false);
            $("#edit_propertyType_btn").html("Update");
        }//success
    });//ajax


});//propertyType_submit
function deletePropertyType(propertyType_id) {

    Swal.fire({
        title: lang['Are you sure to delete this Property Type?'],
        text: lang["You won't be able to revert this."],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#propertyType_delete_btn" + propertyType_id).attr("disabled", true);
            // $("#propertyType_delete_btn"+propertyType_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', propertyType_id);

            $.ajax({
                url: 'delete_propertyType',
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
                    $("#propertyType_delete_btn" + propertyType_id).attr("disabled", false);

                }//successs
            });//ajax

        }
    });

}//deletePropertyType
function updatePropertyTypeStatus(propertyType_id, status) {

    Swal.fire({
        title: lang["Alert"],
        text: lang["Are you sure to update the status of this Property Type?"],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#update_status" + propertyType_id).attr("disabled", true);
            // $("#update_status"+propertyType_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', propertyType_id);
            ajax_data.append('status', status);

            $.ajax({
                url: 'update_propertyType_status',
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

                    $("#update_status" + propertyType_id).attr("disabled", false);

                }//successs
            });//ajax

        }
    });

}//updatePropertyTypeStatus

// ********************************************* PROPERTY MANAGEMENT ****************************
function UpdatePropertyAdminStatus(property_id,status){

    Swal.fire({
        title: lang["Alert"],
        text: lang["Are you sure to update the status of this property?"],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#update_pending_status"+property_id).attr("disabled", true);
            // $("#update_pending_status"+property_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', property_id);
            ajax_data.append('status', status);

            $.ajax({
                url: 'update_property_admin_status',
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
                    $("#update_pending_status"+property_id).attr("disabled", false);
                }//success
            });//ajax
        }
    });
}
function deleteAdminProperty(property_id){

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
                url: 'delete_property_admin',
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

}//deleteAdminProperty

// *************************************** Location Management *************************************
$("#location_submit").submit(function (event) {
    event.preventDefault();


    $("#submit_btn").attr("disabled", true);
    $("#submit_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();

    var title = $("input[name='title[]']").map(function () {
        return $(this).val();
    }).get();

    var answer = $("input[name='answer[]']").map(function () {
        return $(this).val();
    }).get();


    ajax_data.append('title',title );
    ajax_data.append('answer',answer );
    ajax_data.append('mandatory',$("#mandatory").is(":checked"));
    ajax_data.append('show_in_filters',$("#show_in_filters").is(":checked"));

    $.ajax({
        url: 'save_location',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {
            $("#addlocationmodal").modal('hide');
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

            $("#submit_btn").attr("disabled", false);
            $("#submit_btn").html("Submit");
        }//success
    });//ajax


});//location_submit
$("#edit_location").submit(function (event) {
    event.preventDefault();


    $("#edit_location_btn").attr("disabled", true);
    $("#edit_location_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('id', $("#location_id").val());

    var title = $("input[name='edit_title[]']").map(function () {
        return $(this).val();
    }).get();

    var answer = $("input[name='edit_answer[]']").map(function () {
        return $(this).val();
    }).get();


    ajax_data.append('title',title );
    ajax_data.append('answer',answer );
    ajax_data.append('mandatory',$("#edit_mandatory").is(":checked"));
    ajax_data.append('show_in_filters',$("#edit_show_in_filters").is(":checked"));

    $.ajax({
        url: 'update_location',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {

            $("#editlocationmodal").modal('hide');

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
            $("#edit_location_btn").attr("disabled", false);
            $("#edit_location_btn").html("Update");
        }//success
    });//ajax


});//location_submit
function deleteLocation(location_id) {

    Swal.fire({
        title: lang['Are you sure to delete this Location?'],
        text: lang["You won't be able to revert this."],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#location_delete_btn" + location_id).attr("disabled", true);
            // $("#location_delete_btn"+location_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', location_id);

            $.ajax({
                url: 'delete_location',
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

                    $("#location_delete_btn" + location_id).attr("disabled", false);

                }//success
            });//ajax

        }
    });

}//deleteLocation
function updateLocationStatus(location_id, status) {

    Swal.fire({
        title: lang["Alert"],
        text: lang["Are you sure to update the status of this Location?"],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#update_status" + location_id).attr("disabled", true);
            // $("#update_status"+location_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', location_id);
            ajax_data.append('status', status);

            $.ajax({
                url: 'update_location_status',
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

                    $("#update_status" + location_id).attr("disabled", false);

                }//success
            });//ajax

        }
    });

}//updateLocationStatus

// *************************************** Feature Category Management *************************************
$("#features_category_submit").submit(function (event) {
    event.preventDefault();


    $("#submit_btn").attr("disabled", true);
    $("#submit_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    var title = $("input[name='title[]']").map(function () {
        return $(this).val();
    }).get();

    ajax_data.append('title',title );
    ajax_data.append('property_type_id',$("#property_type_id option:selected").val() );

    $.ajax({
        url: 'save_features_category',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {
            $("#addfeatures_categorymodal").modal('hide');
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
                    // {{--window.features_category.href='{{session('features_category')}}';--}}
                });
            }

            $("#submit_btn").attr("disabled", false);
            $("#submit_btn").html("Submit");
        }//success
    });//ajax


});//features_category_submit
$("#edit_features_category").submit(function (event) {
    event.preventDefault();


    $("#edit_features_category_btn").attr("disabled", true);
    $("#edit_features_category_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('id', $("#features_category_id").val());
    var title = $("input[name='edit_title[]']").map(function () {
        return $(this).val();
    }).get();

    ajax_data.append('title',title );
    ajax_data.append('property_type_id',$("#edit_property_type_id").val() );


    $.ajax({
        url: 'update_features_category',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {

            $("#editfeatures_categorymodal").modal('hide');

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
                    // {{--window.features_category.href='{{session('features_category')}}';--}}
                });
            }
            $("#edit_features_category_btn").attr("disabled", false);
            $("#edit_features_category_btn").html("Update");
        }//success
    });//ajax


});//features_category_submit
function deleteCategory(features_category_id) {

    Swal.fire({
        title: lang['Are you sure to delete this Category?'],
        text: lang["You won't be able to revert this."],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#features_category_delete_btn" + features_category_id).attr("disabled", true);
            // $("#features_category_delete_btn"+features_category_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', features_category_id);

            $.ajax({
                url: 'delete_features_category',
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
                            // {{--window.features_category.href='{{session('features_category')}}';--}}
                        });
                    }

                    $("#features_category_delete_btn" + features_category_id).attr("disabled", false);

                }//success
            });//ajax

        }
    });

}//deleteCategory
function updateCategoryStatus(features_category_id, status) {

    Swal.fire({
        title: lang["Alert"],
        text: lang["Are you sure to update the status of this Category?"],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#update_status" + features_category_id).attr("disabled", true);
            // $("#update_status"+features_category_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', features_category_id);
            ajax_data.append('status', status);

            $.ajax({
                url: 'update_features_category_status',
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
                            // {{--window.features_category.href='{{session('features_category')}}';--}}
                        });
                    }

                    $("#update_status" + features_category_id).attr("disabled", false);

                }//success
            });//ajax

        }
    });

}//updateCategoryStatus

// *************************************** Features Management *************************************
$("#feature_submit").submit(function (event) {
    event.preventDefault();


    $("#submit_btn").attr("disabled", true);
    $("#submit_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    var title = $("input[name='title[]']").map(function () {
        return $(this).val();
    }).get();

    ajax_data.append('title',title );
    ajax_data.append('feature_category_id',$("#feature_category_id").val());

    $.ajax({
        url: 'save_feature',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {
            $("#addfeaturemodal").modal('hide');
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
                    // {{--window.feature.href='{{session('feature')}}';--}}
                });
            }

            $("#submit_btn").attr("disabled", false);
            $("#submit_btn").html("Submit");
        }//success
    });//ajax


});//feature_submit
$("#edit_feature").submit(function (event) {
    event.preventDefault();


    $("#edit_feature_btn").attr("disabled", true);
    $("#edit_feature_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('id', $("#feature_id").val());
    var title = $("input[name='edit_title[]']").map(function () {
        return $(this).val();
    }).get();

    ajax_data.append('title',title );
    ajax_data.append('feature_category_id',$("#edit_feature_category_id").val());


    $.ajax({
        url: 'update_feature',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {

            $("#editfeaturemodal").modal('hide');

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
                    // {{--window.feature.href='{{session('feature')}}';--}}
                });
            }
            $("#edit_feature_btn").attr("disabled", false);
            $("#edit_feature_btn").html("Update");
        }//success
    });//ajax


});//feature_submit
function deleteFeature(feature_id) {

    Swal.fire({
        title: lang['Are you sure to delete this Feature?'],
        text: lang["You won't be able to revert this."],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#feature_delete_btn" + feature_id).attr("disabled", true);
            // $("#feature_delete_btn"+feature_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', feature_id);

            $.ajax({
                url: 'delete_feature',
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
                            // {{--window.feature.href='{{session('feature')}}';--}}
                        });
                    }

                    $("#feature_delete_btn" + feature_id).attr("disabled", false);

                }//success
            });//ajax

        }
    });

}//deleteFeature
function updateFeatureStatus(feature_id, status) {

    Swal.fire({
        title: lang["Alert"],
        text: lang["Are you sure to update the status of this Feature?"],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#update_status" + feature_id).attr("disabled", true);
            // $("#update_status"+feature_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', feature_id);
            ajax_data.append('status', status);

            $.ajax({
                url: 'update_feature_status',
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
                            // {{--window.feature.href='{{session('feature')}}';--}}
                        });
                    }

                    $("#update_status" + feature_id).attr("disabled", false);

                }//success
            });//ajax

        }
    });

}//updateFeatureStatus

// *************************************** Town Management *************************************
$("#town_submit").submit(function (event) {
    event.preventDefault();


    $("#submit_btn").attr("disabled", true);
    $("#submit_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('title', $("#title").val());
    ajax_data.append('city_id', $("#city_id option:selected").val());

    $.ajax({
        url: 'save_town',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {
            $("#addtownmodal").modal('hide');
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

            $("#submit_btn").attr("disabled", false);
            $("#submit_btn").html("Submit");
        }//success
    });//ajax


});//town_submit
$("#edit_town").submit(function (event) {
    event.preventDefault();


    $("#edit_town_btn").attr("disabled", true);
    $("#edit_town_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('id', $("#town_id").val());
    ajax_data.append('title', $("#edit_title").val());
    ajax_data.append('city_id', $("#edit_city_id").val());


    $.ajax({
        url: 'update_town',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {

            $("#edittownmodal").modal('hide');

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
            $("#edit_town_btn").attr("disabled", false);
            $("#edit_town_btn").html("Update");
        }//success
    });//ajax


});//town_submit
function deleteTown(town_id) {

    Swal.fire({
        title: lang['Are you sure to delete this Town?'],
        text: lang["You won't be able to revert this."],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#town_delete_btn" + town_id).attr("disabled", true);
            // $("#town_delete_btn"+town_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', town_id);

            $.ajax({
                url: 'delete_town',
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

                    $("#town_delete_btn" + town_id).attr("disabled", false);

                }//successs
            });//ajax

        }
    });

}//deleteTown
function updateTownStatus(town_id, status) {

    Swal.fire({
        title: lang["Alert"],
        text: lang["Are you sure to update the status of this Town?"],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#update_status" + town_id).attr("disabled", true);
            // $("#update_status"+town_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', town_id);
            ajax_data.append('status', status);

            $.ajax({
                url: 'update_town_status',
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

                    $("#update_status" + town_id).attr("disabled", false);

                }//successs
            });//ajax

        }
    });

}//updateTownStatus
$("#ad_town").change(function (e) {
    e.preventDefault();

    town_id = $("#ad_town option:selected").val();

    if (town_id == "") {
        Swal.fire({
            icon: 'error',
            title: lang["Failed"],
            text: "Please select the a town",
        }).then(() => {
            $("#ad_city").html('');
            return;
        });
        return;

    }
    $.ajax({
        url: "get_cities",
        type: "POST",
        async: false,
        data: {
            town_id: town_id,
        },
        success: function (data) {
            let result = data;
            if (result.status == true) {
                data = result.result;
                $("#ad_city").html('');
                if (data.length > 0) {
                    $("#ad_city").append(` <option value="">---Please select---</option>`)
                    for (let i = 0; i < data.length; i++) {
                        let appendData = "";
                        appendData += `<option value="${data[i].id}">${data[i].title}</option>`;
                        $("#ad_city").append(appendData);
                    }

                } else {
                    $("#ad_city").html('');
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: lang["Failed"],
                    text: lang["Something went wrong, please try again!"],
                }).then(() => {

                });
            }
        }
    });
});

// *************************************** City Management *************************************
$("#city_submit").submit(function (event) {
    event.preventDefault();


    $("#submit_btn").attr("disabled", true);
    $("#submit_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('title', $("#title").val());
    ajax_data.append('number', $("#number").val());
    ajax_data.append('position', $("#position").val());
    ajax_data.append('image', $("#city_image")[0].files[0]);

    $.ajax({
        url: 'save_city',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {
            $("#addcitymodal").modal('hide');
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
            $("#submit_btn").attr("disabled", false);
            $("#submit_btn").html("Submit");
        }//success
    });//ajax


});//city_submit
$("#edit_city").submit(function (event) {
    event.preventDefault();


    $("#edit_city_btn").attr("disabled", true);
    $("#edit_city_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('id', $("#city_id").val());
    ajax_data.append('title', $("#edit_title").val());
    ajax_data.append('number', $("#edit_number").val());
    ajax_data.append('position', $("#edit_position").val());
    var fileInput = $("#edit_city_image")[0];

    if (fileInput.files.length > 0) {
        ajax_data.append('image', fileInput.files[0]);
    }


    $.ajax({
        url: 'update_city',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {

            $("#editcitymodal").modal('hide');

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


            $("#edit_city_btn").attr("disabled", false);
            $("#edit_city_btn").html("Update");
        }//success
    });//ajax


});//city_submit
function deleteCity(city_id) {

    Swal.fire({
        title: lang['Are you sure to delete this City?'],
        text: lang["You won't be able to revert this."],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#city_delete_btn" + city_id).attr("disabled", true);
            // $("#city_delete_btn"+city_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', city_id);

            $.ajax({
                url: 'delete_city',
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
                    $("#city_delete_btn" + city_id).attr("disabled", false);

                }//successs
            });//ajax

        }
    });

}//deleteCity
function updateCityStatus(city_id, status) {

    Swal.fire({
        title: lang["Alert"],
        text: lang["Are you sure to update the status of this City?"],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#update_status" + city_id).attr("disabled", true);
            // $("#update_status"+city_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', city_id);
            ajax_data.append('status', status);

            $.ajax({
                url: 'update_city_status',
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

                    $("#update_status" + city_id).attr("disabled", false);

                }//success
            });//ajax

        }
    });

}//updateCityStatus
function updateShowOnHomeStatus(city_id, status) {

    Swal.fire({
        title: lang["Alert"],
        text: lang["Are you sure to update the status of this City?"],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#show_on_home_status" + city_id).attr("disabled", true);
            // $("#show_on_home_status"+city_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', city_id);
            ajax_data.append('status', status);

            $.ajax({
                url: 'update_show_on_home_status',
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

                    $("#show_on_home_status" + city_id).attr("disabled", false);

                }//success
            });//ajax

        }
    });

}//updateShowOnHomeStatus
$("#ad_city").change(function (e) {
    e.preventDefault();

    town_id = $("#ad_town option:selected").val();

    if (town_id == "") {
        Swal.fire({
            icon: 'error',
            title: lang["Failed"],
            text: "Please select the a town",
        }).then(() => {
            $("#ad_city").html('');
            return;
        });
        return;

    }
    $.ajax({
        url: "get_cities",
        type: "POST",
        async: false,
        data: {
            town_id: town_id,
        },
        success: function (data) {
            let result = data;
            if (result.status == true) {
                data = result.result;
                $("#ad_city").html('');
                if (data.length > 0) {
                    $("#ad_city").append(` <option value="">---Please select---</option>`)
                    for (let i = 0; i < data.length; i++) {
                        let appendData = "";
                        appendData += `<option value="${data[i].id}">${data[i].title}</option>`;
                        $("#ad_city").append(appendData);
                    }

                } else {
                    $("#ad_city").html('');
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: lang["Failed"],
                    text: lang["Something went wrong, please try again!"],
                }).then(() => {

                });
            }
        }
    });
});

// *************************************** District Management *************************************
$("#district_submit").submit(function (event) {
    event.preventDefault();


    $("#submit_btn").attr("disabled", true);
    $("#submit_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('title', $("#title").val());
    ajax_data.append('latitude', $("#latitude").val());
    ajax_data.append('longitude', $("#longitude").val());
    ajax_data.append('city_id', $("#city_id option:selected").val());
    ajax_data.append('town_id', $("#town_id option:selected").val());


    $.ajax({
        url: 'save_district',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {
            $("#adddistrictmodal").modal('hide');
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
            $("#submit_btn").attr("disabled", false);
            $("#submit_btn").html("Submit");
        }//success
    });//ajax


});//district_submit
$("#edit_district").submit(function (event) {
    event.preventDefault();


    $("#edit_district_btn").attr("disabled", true);
    $("#edit_district_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('id', $("#district_id").val());
    ajax_data.append('title', $("#edit_title").val());
    ajax_data.append('latitude', $("#edit_latitude").val());
    ajax_data.append('longitude', $("#edit_longitude").val());
    ajax_data.append('city_id', $("#edit_city_id option:selected").val());
    ajax_data.append('town_id', $("#edit_town_id option:selected").val());

    $.ajax({
        url: 'update_district',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {

            $("#editdistrictmodal").modal('hide');

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


            $("#edit_district_btn").attr("disabled", false);
            $("#edit_district_btn").html("Update");
        }//success
    });//ajax


});//district_submit
function deleteDistrict(district_id) {

    Swal.fire({
        title: lang['Are you sure to delete this District?'],
        text: lang["You won't be able to revert this."],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#district_delete_btn" + district_id).attr("disabled", true);
            // $("#district_delete_btn"+district_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', district_id);

            $.ajax({
                url: 'delete_district',
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
                    $("#district_delete_btn" + district_id).attr("disabled", false);

                }//successs
            });//ajax

        }
    });

}//deleteDistrict
function updateDistrictStatus(district_id, status) {

    Swal.fire({
        title: lang["Alert"],
        text: lang["Are you sure to update the status of this District?"],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#update_status" + district_id).attr("disabled", true);
            // $("#update_status"+district_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', district_id);
            ajax_data.append('status', status);

            $.ajax({
                url: 'update_district_status',
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

                    $("#update_status" + district_id).attr("disabled", false);

                }//success
            });//ajax

        }
    });

}//updateDistrictStatus

// ************************* Settings Management **********************
$("#update_settings").submit(function (event) {
    event.preventDefault();
    $("#update_settings_btn").attr("disabled", true);
    $("#update_settings_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('site_name', $("#site_name").val());
    ajax_data.append('phone_number', $("#phone_number").val());
    ajax_data.append('email', $("#email").val());
    var fileInput = $("#logo")[0];
    var offer_image = $("#offer_image")[0];

    if (fileInput.files.length > 0) {
        ajax_data.append('logo', fileInput.files[0]);
    }
    if (offer_image.files.length > 0) {
        ajax_data.append('offer_image', offer_image.files[0]);
    }

    $.ajax({
        url: 'update_settings',
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

            $("#update_settings_btn").attr("disabled", false);
            $("#update_settings_btn").html("Update");
        }//success
    });//ajax


});
$("#update_social_links_settings").submit(function (event) {
    event.preventDefault();
    $("#update_social_links_btn").attr("disabled", true);
    $("#update_social_links_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('type', 'website');
    ajax_data.append('facebook', '');
    ajax_data.append('twitter', '');
    ajax_data.append('instagram', $("#instagram").val());
    ajax_data.append('linkedin', '');
    ajax_data.append('youtube', $("#youtube").val());
    ajax_data.append('tiktok', $("#tiktok").val());

    $.ajax({
        url: 'update_social_links_settings',
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
        }//successs
    });//ajax


});
$("#update_seo_links").submit(function (event) {
    event.preventDefault();
    $("#update_seo_btn").attr("disabled", true);
    $("#update_seo_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('seo_author', $("#seo_author").val());
    ajax_data.append('seo_canonical', $("#seo_canonical").val());
    ajax_data.append('seo_description', $("#seo_description").val());
    ajax_data.append('seo_keywords', $("#seo_keywords").val());

    $.ajax({
        url: 'update_seo_links',
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

            $("#update_seo_btn").attr("disabled", false);
            $("#update_seo_btn").html("Update");
        }//success
    });//ajax


});
$("#update_price").submit(function (event) {
    event.preventDefault();
    $("#update_price_btn").attr("disabled", true);
    $("#update_price_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('credit_expiration_days', $("#credit_expiration_days").val());
    ajax_data.append('create_ad', $("#create_ad").val());
    ajax_data.append('renew_ad', $("#renew_ad").val());
    ajax_data.append('credits_one_month', $("#credits_one_month").val());
    ajax_data.append('credits_two_month', $("#credits_two_month").val());
    ajax_data.append('credits_three_month', $("#credits_three_month").val());
    ajax_data.append('highlight_in_color', $("#highlight_in_color").val());
    ajax_data.append('free_images', $("#free_images").val());
    ajax_data.append('credits_per_image', $("#credits_per_image").val());

    $.ajax({
        url: 'update_charges_amount',
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

            $("#update_price_btn").attr("disabled", false);
            $("#update_price_btn").html("Update");
        }//successs
    });//ajax


});

$("#update_stripe_keys").submit(function (event) {
    event.preventDefault();

    $("#update_stripe_btn").attr("disabled", true);
    $("#update_stripe_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('STRIPE_PUBLIC_KEY', $("#STRIPE_PUBLIC_KEY").val());
    ajax_data.append('STRIPE_SECRET_KEY', $("#STRIPE_SECRET_KEY").val());

    $.ajax({
        url: 'update_stripe_keys',
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

            $("#update_stripe_btn").attr("disabled", false);
            $("#update_stripe_btn").html("Update");
        }//successs
    });//ajax


});

function removeCreditsOfferImage(){
    var ajax_data = new FormData();
    ajax_data.append('id', '');

    $.ajax({
        url: 'remove_credits_offer_image',
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


        }//successs
    });//ajax
}

// *************************************** Category Inputs management *************************************
$("#create_form_main_category").change(function (e) {

    e.preventDefault();
    category_id = $("#create_form_main_category option:selected").val();
    if (category_id == "") {
        Swal.fire({
            icon: 'error',
            title: lang["Failed"],
            text: "Please select the main service",
        }).then(() => {

        });
    }
    $.ajax({
        url: "get_subServices_by_mainService",
        type: "POST",
        data: {
            category_id: category_id,
        },
        success: function (data) {
            let result = data;

            if (result.status == true) {
                data = result.result;
                $("#create_form_sub_category").html('');
                if (data.length > 0) {
                    $("#create_form_sub_category").append(` <option value="">---Please select---</option>`)
                    for (let i = 0; i < data.length; i++) {
                        let appendData = "";
                        appendData += `<option value="${data[i].id}">${data[i].title}</option>`;
                        $("#create_form_sub_category").append(appendData);
                    }
                } else {
                    $("#create_form_sub_category").html('');
                }

            } else {
                Swal.fire({
                    icon: 'error',
                    title: lang["Failed"],
                    text: lang["Something went wrong, please try again!"],
                }).then(() => {

                });
            }
        }
    });
});
$("#edit_form_main_category").change(function (e) {
    e.preventDefault();
    category_id = $("#edit_form_main_category option:selected").val();
    if (category_id == "") {
        Swal.fire({
            icon: 'error',
            title: lang["Failed"],
            text: "Please select the a service",
        }).then(() => {
            return;
        });
        return;
    }
    $.ajax({
        url: "get_subServices_by_mainService",
        type: "POST",
        data: {
            category_id: category_id,
        },
        success: function (data) {

            let result = data;
            if (result.status == true) {
                data = result.result;
                $("#edit_form_sub_category").html('');
                if (data.length > 0) {
                    $("#edit_form_sub_category").append(` <option value="">---Please select---</option>`)
                    for (let i = 0; i < data.length; i++) {
                        let appendData = "";
                        appendData += `<option value="${data[i].id}">${data[i].title}</option>`;
                        $("#edit_form_sub_category").append(appendData);
                    }
                } else {
                    $("#edit_form_sub_category").html('');
                }

            } else {
                Swal.fire({
                    icon: 'error',
                    title: lang["Failed"],
                    text: lang["Something went wrong, please try again!"],
                }).then(() => {

                });

            }
        }
    });
});
$("#create_form").submit(function (event) {
    event.preventDefault();

    if ($('#property_type option:selected').val() == "") {
        alert("Please select the property type");
        return;
    }

    var input_label = $("input[name='input_label[]']").map(function () {
        return $(this).val();
    }).get();

    var input_type = $("select[name='input_type[]'] option:selected").map(function () {
        return $(this).val();
    }).get();

    var placeholder = $("input[name='placeholder[]']").map(function () {
        return $(this).val();
    }).get();

    var position = $("input[name='position[]']").map(function () {
        return $(this).val();
    }).get();

    var ajax_data = new FormData();
    //append into ajax data

    ajax_data.append('property_type_id', $('#property_type option:selected').val());
    ajax_data.append('input_label', input_label);
    ajax_data.append('input_type', input_type);
    ajax_data.append('placeholder', placeholder);
    ajax_data.append('position', position);

    $("#create_form_btn").attr("disabled", true);
    $("#create_form_btn").html(`Please wait...<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);


    $.ajax({
        url: "save_dynamic_inputs",
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

                });
            }

            $("#create_form_btn").attr("disabled", false);
            $("#create_form_btn").html('Submit');
        }//successs
    });
});
$("#edit_dynamic_input").submit(function (event) {
    event.preventDefault();


    if ($('#edit_town_id option:selected').val() == "") {
        alert("Please select property type");
        return;
    }

    var ajax_data = new FormData();
    //append into ajax data
    ajax_data.append('id', $("#form_id").val());
    ajax_data.append('property_type_id', $('#edit_property_type option:selected').val());
    ajax_data.append('input_label', $("#edit_input_label").val());
    ajax_data.append('input_type', $("#edit_input_type option:selected").val());
    ajax_data.append('placeholder', $("#edit_input_placeholder").val());
    ajax_data.append('position', $("#edit_position").val());

    $("#edit_form_btn").attr("disabled", true);
    $("#edit_form_btn").html(`Please wait...<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);


    $.ajax({
        url: "edit_dynamic_inputs",
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {
            $("#EditModal").modal('hide');

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

                });
            }

            $("#edit_form_btn").attr("disabled", false);
            $("#edit_form_btn").html('Update');
        }//successs
    });
});
function deleteInput(id) {

    Swal.fire({
        text: lang['All the properties which use this input are also deleted, Are you sure to delete?'],
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {

        if (result) {
            $.ajax({
                url: "delete_dynamic_inputs",
                type: "POST",
                data: {
                    id: id,
                },
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

                        });
                    }

                }//successs
            });//ajax
        }
    });
}//delete input

// *************************************** Blogs Management *************************************

function deleteBlog(blog_id) {

    Swal.fire({
        title: 'Are you sure to delete this blog?',
        text: "All patients of this blog also deleted! ",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#delete_blog" + blog_id).attr("disabled", true);
            // $("#delete_blog"+package_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', blog_id);

            $.ajax({
                url: 'delete_blog',
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

                    $("#delete_blog" + blog_id).attr("disabled", false);
                }//success
            });//ajax
        }
    });

}//deleteBlog
function UpdateBlogStatus(blog_id, status) {

    Swal.fire({
        title: lang["Alert"],
        text: "Are you sure to update the status of this blog?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#update_status" + blog_id).attr("disabled", true);
            // $("#update_status"+blog_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', blog_id);
            ajax_data.append('status', status);

            $.ajax({
                url: 'update_blog_status',
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

                    $("#update_status" + blog_id).attr("disabled", false);

                }//success
            });//ajax
        }
    });
}//UpdateBlogStatus

// *************************************** Currency Management *************************************

//currency_submit
function deleteCurrency(currency_id) {

    Swal.fire({
        title: lang['Are you sure to delete this Currency?'],
        text: lang["You won't be able to revert this."],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#currency_delete_btn" + currency_id).attr("disabled", true);
            // $("#currency_delete_btn"+currency_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', currency_id);

            $.ajax({
                url: 'delete_currency',
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

                    $("#currency_delete_btn" + currency_id).attr("disabled", false);

                }//success
            });//ajax

        }
    });

}//deleteCurrency
function updateCurrencyStatus(currency_id, status) {

    Swal.fire({
        title: lang["Alert"],
        text: lang["Are you sure to update the status of this Currency?"],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#update_status" + currency_id).attr("disabled", true);
            // $("#update_status"+currency_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', currency_id);
            ajax_data.append('status', status);

            $.ajax({
                url: 'update_currency_status',
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

                    $("#update_status" + currency_id).attr("disabled", false);

                }//successs
            });//ajax

        }
    });

}//updateCurrencyStatus
function updateCurrencyRate(currency_id, rate) {

    Swal.fire({
        title: lang["Alert"],
        text: lang["Are you sure to update the rate of this Currency?"],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#update_rate_status" + currency_id).attr("disabled", true);
            // $("#update_rate_status"+currency_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', currency_id);
            ajax_data.append('rate', rate);

            $.ajax({
                url: 'update_currency_rate',
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

                    $("#update_rate_status" + currency_id).attr("disabled", false);

                }//successs
            });//ajax

        }
    });

}//updateCurrencyRate

$("#send_notification").submit(function (event) {
    event.preventDefault();

    $("#submit_btn").attr("disabled", true);
    $("#submit_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();

    ajax_data.append('user_id', $("#user_id").val());
    ajax_data.append('subject', $("#subject").val());
    ajax_data.append('message', $("textarea#message").val());
    $.ajax({
        url: 'send_notification',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {

            $("#addUserModal").modal('hide')
            if (data.status == "true" || data.status == true) {
                Swal.fire({
                    icon: data.icon,
                    title: lang["Success"],
                    text: data.message,
                }).then(() => {
                    $("#send_notification").trigger("reset");
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
            $("#submit_btn").html('Submit');
        }//successs
    });//ajax
});


// *************************************** Delete Messages *************************************
function deleteMessage(message_id){

    Swal.fire({
        title: lang['Are you sure to delete this Message?'],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#message_delete_btn"+message_id).attr("disabled", true);
            // $("#message_delete_btn"+message_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', message_id);

            $.ajax({
                url: 'delete_message',
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

                    $("#message_delete_btn"+message_id).attr("disabled", false);

                }//successs
            });//ajax

        }
    });

}//deleteMessage

// *************************************** Delete Subscriber *************************************
function deleteSubscriber(id) {
    var ajax_data = new FormData();
    ajax_data.append('id', id);
    Swal.fire({
        title: lang['Are you sure to delete this subscriber?'],
        icon: 'info',
        buttons: true,
        dangerMode: true,
    }).then((result) => {

        if (result) {
            $.ajax({
                url: "delete_subscriber",
                type: "POST",
                processData: false,
                contentType: false,
                data:ajax_data,
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

                }//successs
            });//ajax
        }
    });
}//deleteSubscriber

// *************************************** Credit Package Management *************************************

$("#package_submit").submit(function (event) {
    event.preventDefault();

    $("#submit_btn").attr("disabled", true);
    $("#submit_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var title = $("input[name='title[]']").map(function () {
        return $(this).val();
    }).get();

    var text_1 = $("input[name='text_1[]']").map(function () {
        return $(this).val();
    }).get();
    var text_2 = $("input[name='text_2[]']").map(function () {
        return $(this).val();
    }).get();

    var description = $("input[name='description[]']").map(function () {
        return $(this).val();
    }).get();


    var ajax_data = new FormData();

    ajax_data.append('credits', $("#credits").val());
    ajax_data.append('price', $("#price").val());
    ajax_data.append('color', $("#color").val());
    ajax_data.append('title', title);
    ajax_data.append('text_1', text_1);
    ajax_data.append('text_2', text_2);
    ajax_data.append('description', description);

    $.ajax({
        url: 'save_package',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {
            $("#addpackagemodal").modal('hide');
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

            $("#submit_btn").attr("disabled", false);
            $("#submit_btn").html("Submit");
        }//successs
    });//ajax
});//package_submit
$("#edit_package").submit(function (event) {
    event.preventDefault();

    $("#edit_package_btn").attr("disabled", true);
    $("#edit_package_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('id', $("#package_id").val());
    var title = $("input[name='edit_title[]']").map(function () {
        return $(this).val();
    }).get();
    var text_1 = $("input[name='edit_text_1[]']").map(function () {
        return $(this).val();
    }).get();
    var text_2 = $("input[name='edit_text_2[]']").map(function () {
        return $(this).val();
    }).get();

    var description = $("input[name='edit_description[]']").map(function () {
        return $(this).val();
    }).get();

    ajax_data.append('credits', $("#edit_credits").val());
    ajax_data.append('price', $("#edit_price").val());
    ajax_data.append('color', $("#edit_color").val());
    ajax_data.append('title', title);
    ajax_data.append('text_1', text_1);
    ajax_data.append('text_2', text_2);
    ajax_data.append('description', description);

    $.ajax({
        url: 'update_package',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {

            $("#editpackagemodal").modal('hide');

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
            $("#edit_package_btn").attr("disabled", false);
            $("#edit_package_btn").html("Update");
        }//success
    });//ajax
});//package_submit
function deletePackage(package_id) {

    Swal.fire({
        title: lang['Are you sure to delete this Package?'],
        text: lang["You won't be able to revert this."],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#package_delete_btn" + package_id).attr("disabled", true);
            // $("#package_delete_btn"+package_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', package_id);

            $.ajax({
                url: 'delete_package',
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

                    $("#package_delete_btn" + package_id).attr("disabled", false);

                }//successs
            });//ajax

        }
    });

}//deletePackage
function updatePackageStatus(package_id, status) {

    Swal.fire({
        title: lang["Alert"],
        text: lang["Are you sure to update the status of this Package?"],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#package_update_status" + package_id).attr("disabled", true);
            // $("#package_update_status"+package_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', package_id);
            ajax_data.append('status', status);

            $.ajax({
                url: 'update_package_status',
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

                    $("#package_update_status" + package_id).attr("disabled", false);

                }//successs
            });//ajax

        }
    });

}//


// *************************************** Credit Discount Management *************************************

$("#discount_submit").submit(function (event) {
    event.preventDefault();

    $("#submit_btn").attr("disabled", true);
    $("#submit_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('package_id', $("#package_id").val());
    ajax_data.append('discount', $("#discount").val());

    $.ajax({
        url: 'save_discount',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {
            $("#adddiscountmodal").modal('hide');
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

            $("#submit_btn").attr("disabled", false);
            $("#submit_btn").html("Submit");
        }//successs
    });//ajax
});//discount_submit
$("#edit_discount_from").submit(function (event) {
    event.preventDefault();

    $("#edit_discount_btn").attr("disabled", true);
    $("#edit_discount_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

    var ajax_data = new FormData();
    ajax_data.append('id', $("#discount_id").val());
    ajax_data.append('package_id', $("#edit_package_id").val());
    ajax_data.append('discount', $("#edit_discount").val());
    $.ajax({
        url: 'update_discount',
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        success: function (data) {

            $("#editdiscountmodal").modal('hide');

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
            $("#edit_discount_btn").attr("disabled", false);
            $("#edit_discount_btn").html("Update");
        }//success
    });//ajax
});//discount_submit
function deleteDiscount(discount_id) {

    Swal.fire({
        title: lang['Are you sure to delete this Discount?'],
        text: lang["You won't be able to revert this."],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#discount_delete_btn" + discount_id).attr("disabled", true);
            // $("#discount_delete_btn"+discount_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', discount_id);

            $.ajax({
                url: 'delete_discount',
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

                    $("#discount_delete_btn" + discount_id).attr("disabled", false);

                }//successs
            });//ajax

        }
    });

}//deleteDiscount
function updateDiscountStatus(discount_id, status) {

    Swal.fire({
        title: lang["Alert"],
        text: lang["Are you sure to update the status of this Discount?"],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: lang["Cancel"],
        confirmButtonText: lang["OK"],
    }).then((result) => {
        if (result.isConfirmed) {

            $("#discount_update_status" + discount_id).attr("disabled", true);
            // $("#discount_update_status"+discount_id).html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', discount_id);
            ajax_data.append('status', status);

            $.ajax({
                url: 'update_discount_status',
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

                    $("#discount_update_status" + package_id).attr("disabled", false);

                }//successs
            });//ajax

        }
    });

}//
