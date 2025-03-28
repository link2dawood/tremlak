@extends('pages.layouts.master')
@section('pageTitle',__('user.Property Details'))
@section('content')
<style>
    .list-title {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 2.8em;
        line-height: 1.4em;
        text-overflow: ellipsis;
    }
    .fixed-title {
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Limits text to exactly 2 lines */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        height: 48px; /* Adjust based on your font-size */
        line-height: 24px; /* Ensures two full lines */
        white-space: normal;
    }
</style>
    <section class="pt60 pb90 bgc-f7">
        <div class="container">

                <div id="favorites_container" class="col-lg-12 row">



                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var propertyId = JSON.parse(localStorage.getItem('favorites')) || [];

            // if(propertyId.length > 0){
                propertyId=propertyId.join(',');
                $.ajax({
                    url: '/favorite-render',
                    method: 'POST',
                    data: { propertyId: propertyId },
                    success: function(response) {
                        $('#favorites_container').html(response.html); // Assuming there's a container element where you want to inject the new content

                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('An error occurred. Please try again later.');
                    }
                });
            // }

        });

    </script>



@endsection
