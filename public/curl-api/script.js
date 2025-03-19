
 $(document).ready(function () {
   $(".submitbtn1").click(function () {
     $.get("api1.php", function (data, status) {
       $("#loader").html(data);
     });
   });
 });
 $(document).ready(function () {
   $(".submitbtn2").click(function () {
     $.get("api2.php", function (data, status) {
       $("#loader").html(data);
     });
   });
 });
 $(document).ready(function () {
   $(".submitbtn3").click(function () {
     $.get("api3.php", function (data, status) {
       $("#loader").html(data);
     });
   });
 });










 

 
/*
 $(document).ready(function(){
   $("button").click(function(){
    $.get("api1.php",function(data, status){
      $("#loader").html(data);
    } )
   });

 });
*/
 
 
 
 
 
 
 
 
/*


const api1 =
  "http://api.geonames.org/weatherIcaoJSON?ICAO=LSZH&username=adinaavram";

const api2 =
  "http://api.geonames.org/streetNameLookupJSON?q=Museum&username=adinaavram";

const api3 =
  "http://api.geonames.org/findNearestAddressJSON?lat=37.451&lng=-122.18&username=adinaavram";

*/


