
var elements = stripe.elements();
var style = {
    base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
};
// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');
// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
    if (event.error) {
        $('#card-errors').html(event.error.message);
    } else {
        $('#card-errors').html('');
    }
});

// Handle form submission.
// var form = document.getElementById('payment-form');
// form.addEventListener('submit', function(event) {
$("#payment_btn").click(function (event){
    alert();
    event.preventDefault();
    let amount=$("#amount").val();

    if(amount == 0){
        Swal.fire("Alert", "Please enter amount!", "info");
        return;
    }

    stripe.createToken(card).then(function(result) {
        if (result.error) {
            // Inform the user if there was an error.
            $('#card-errors').html(result.error.message);
            $("#payment_btn").html("Submit");
            $("#payment_btn").prop('disabled', false);
        } else {

            $("#payment_btn").html(`Please wait <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);
            $("#payment_btn").prop('disabled', true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var ajax_data = new FormData();
            ajax_data.append('token', result.token.id);
            ajax_data.append('amount', amount);
            ajax_data.append('currency', $("#currency option:selected").val());

            $.ajax({

                url: '/buy_credits',
                type: "POST",
                processData: false,
                contentType: false,
                data: ajax_data,
                success: function (data){

                    if (data.status == "true" || data.status == true) {
                        Swal.fire({
                            icon: data.icon,
                            title: 'Success',
                            text: data.message,
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: data.icon,
                            title: 'Failed',
                            text: data.message,
                        }).then(() => {

                        });
                    }

                    $("#payment_btn").attr("disabled", false);
                    $("#payment_btn").html("Submit");
                }//success
            });//ajax
        }
    });
});


