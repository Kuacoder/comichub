<script src="{{URL::asset('/public/backend/js/scripts.js')}}"></script>
<script src="{{URL::asset('/public/backend/js/lib/jquery.min.js')}}"></script><!-- jquery vendor -->
<script src="{{URL::asset('/public/backend/js/lib/jquery.nanoscroller.min.js')}}"></script><!-- nano scroller -->
<script src="{{URL::asset('/public/backend/js/lib/sidebar.js')}}"></script><!-- sidebar -->
<script src="{{URL::asset('/public/backend/js/lib/bootstrap.min.js')}}"></script><!-- bootstrap -->
<script src="{{URL::asset('/public/backend/js/lib/mmc-common.js')}}"></script>
<script src="{{URL::asset('/public/backend/js/lib/mmc-chat.js')}}"></script>
<!--  Chart js -->
<script src="{{URL::asset('/public/backend/js/lib/chart-js/Chart.bundle.js')}}"></script>
<script src="{{URL::asset('/public/backend/js/lib/chart-js/chartjs-init.js')}}"></script>
<!-- // Chart js -->


<script src="{{URL::asset('/public/backend/js/lib/sparklinechart/jquery.sparkline.min.js')}}"></script>
<!-- scripit init-->
<script src="{{URL::asset('/public/backend/js/lib/sparklinechart/sparkline.init.js')}}"></script><!-- scripit init-->

<!--  Datamap -->
<script src="{{URL::asset('/public/backend/js/lib/datamap/d3.min.js')}}"></script>
<script src="{{URL::asset('/public/backend/js/lib/datamap/topojson.js')}}"></script>
<script src="{{URL::asset('/public/backend/js/lib/datamap/datamaps.world.min.js')}}"></script>
<script src="{{URL::asset('/public/backend/js/lib/datamap/datamap-init.js')}}"></script>
<!-- // Datamap -->
<script src="{{URL::asset('/public/backend/js/lib/weather/jquery.simpleWeather.min.js')}}"></script>
<script src="{{URL::asset('/public/backend/js/lib/weather/weather-init.js')}}"></script>
<script src="{{URL::asset('/public/backend/js/lib/owl-carousel/owl.carousel.min.js')}}"></script>
<script src="{{URL::asset('/public/backend/js/lib/owl-carousel/owl.carousel-init.js')}}"></script>
<!-- scripit init-->
</body>
<script src="{{URL::asset('/public/frontend/js/myscript.js')}}"></script>

</html>

<script>
// var chart = new Morris.Bar({

// });
$('#loc').click(function() {
    // var _token = "{{ csrf_token() }}";
    // var from_date = $('#datepicker').val();
    // var to_date = $('#datepicker2').val();
    // console.log('aaa');
    // $.ajax({
    //     url: "{{url('/fillter-by-date')}}",
    //     method: "POST",
    //     dataType: "JSON",
    //     data: {from_date:from_date, to_date:to_date, _token:_token},
    //     success: function(data){


    //         $('#do_chart_vaoday').fadeIn();
    //         $('#do_chart_vaoday').html(data);
    //         // chart.setData(data);
    //     }
    // });
});
</script>