<!DOCTYPE html>
<html>
<head>
    // ...existing code...
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
    </script>
    <script src="{{ asset('js/google-analytics.js') }}"></script>
</head>
<body onload="initGoogleAnalytics()">
    // ...existing code...
</body>
</html>
