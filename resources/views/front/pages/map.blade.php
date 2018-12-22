<?php
/**
 * @var \App\Models\StaticPages $model
 */

?>
@extends('layouts.front')

@section('css')
<link rel="stylesheet" href="{{asset('assets/css/map.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/MarkerCluster.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/MarkerCluster.Default.css')}}"/>
<style>
    .pac-container
    {
        display:none!important;
    }
</style>
<script src="{{asset('assets/js/lib/map.js')}}"></script>
<script src="{{asset('assets/js/lib/leaflet.js')}}"></script>
<script src="{{asset('assets/js/lib/leaflet.markercluster.js')}}"></script>
@stop

@section('content')
<main>
    <div class="page-header">
        <h1>{{$model->name}}</h1>
    </div>
    <input id="pac-input" class="controls test" autocomplete="on" type="text" placeholder="Поиск">
    <div id="map"></div>
    <div id="title"></div>
    <div class="page-end">
        @include('front.chanks.page_end')
    </div>
    <input type="hidden" id="building_count" value="{{App\Models\Building::count()}}">
</main>
@stop
@section('js')
@parent

{{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2wqz_Dz_LWEukfB3EgT4z9hHV7KEtOyg"></script>--}}
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    var addressPoints = [];
    var locations = [];

    //for autocomplete input collection


    function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: {lat: 50.446290, lng: 30.523086}
        });
        var infoWin = new google.maps.InfoWindow();


        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);


        var result_size = '';
        var skip = 0;
        var j = 0;
        var markers = [];
        var streets = new Array();
        function ajaxNewPoints(data) {

            $.ajax
            ({
                type: 'POST',
                url: '{{route("get.buildings.ajax")}}',
                data: data,
                success: function (result) {
                    if(result.location.length!=0)
                    {
                        result_size = result.location.length;
                        console.log(result);
                        locations = locations.concat(result.location);

                        var part_of_markers = locations.map(function (location, i) {
                            var marker = new google.maps.Marker({
                                position: location,
                                icon: 'assets/images/kuzia_marker.png'
                                //label: locations[i].labels
                            });
                            streets.push(locations[i].labels);

                            google.maps.event.addListener(marker, 'click', function(evt) {

                                infoWin.setContent('<div class="place_ifo" streetname=" ' +     locations[i].labels    + '">' +
                                        '<a href="https://kuzia.j2landing.com/connection">' +  locations[i].labels  + ' </a>'  +
                                        '</div>');
                                infoWin.open(map, this);


                                function conclusionStreet(){
                                    var streetTake =  $('.place_ifo').attr("streetname");
                                    window.localStorage.clear();
                                    localStorage.setItem('selected_street', streetTake);
                                    console.log(streetTake);
                                }
                                setTimeout(conclusionStreet, 1000);

                            });

                            return marker;

                        });
                        markers = markers.concat(part_of_markers);
// // Bias the SearchBox results towards current map's viewport.
                        map.addListener('bounds_changed', function() {
                            searchBox.setBounds(map.getBounds());
                            console.log(map.getBounds());
                        });

                        geocoder = new google.maps.Geocoder();
                        var input_value = '';
                        $( "#pac-input" ).on('keypress',function(e){
                            if(e.which == 13) {
                                geocoder.geocode( { 'address': $(this).val()}, function(results, status) {
                                    if (status == 'OK') {
                                        map.setZoom(19);
                                        map.setCenter({lat:results[0].geometry.location.lat(), lng:results[0].geometry.location.lng()});

                                    } else {
                                        alert('Geocode was not successful for the following reason: ' + status);
                                    }
                                });
                            }

                        });
                        $( "#pac-input" ).autocomplete({
                            select: function (a, b) {
                                console.log(b.item.value);
                                $( "#pac-input" ).val(b.item.value);
                                input_value = b.item.value;
                                geocoder.geocode( { 'address': b.item.value}, function(results, status) {
                                    if (status == 'OK') {
                                        map.setZoom(19);
                                        map.setCenter({lat:results[0].geometry.location.lat(), lng:results[0].geometry.location.lng()});

                                    } else {
                                        alert('Geocode was not successful for the following reason: ' + status);
                                    }
                                });

                            },
                            keyup:function() {
                                console.log($(this).val());
                            },
                            source: function( request, response ) {
                                var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
                                var results = $.ui.autocomplete.filter(streets, request.term);

                                response(results.slice(0, 10));

                            }
                        });
                        var markerCluster = new MarkerClusterer(map, markers,
                                {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
                    }
                    return result.location.length
                }
            });
        }
        var interval = 300;
        var total_buildings = $('#building_count').val();
        var n = Math.ceil(parseInt(total_buildings)/interval)-1;
        var data = {
            _token: $('meta[name="csrf-token" ]').attr('content'),
            limit: interval,
            skip:skip
        };
        ajaxNewPoints(data);

        skip = skip+interval;
        while (j<n)
        {


                console.log(skip);
                setTimeout(function()
                {
                    var data = {
                        _token: $('meta[name="csrf-token" ]').attr('content'),
                        limit: interval,
                        skip:skip
                    };
                    console.log(ajaxNewPoints(data));
                    skip = skip+interval;
                    console.log(parseInt(total_buildings)>skip);


                },5000);
            j++;
            console.log("j = "+j);

        }


        {{--console.log(result_size!==0);--}}
        {{--var j = 0;--}}
        {{--while (j<9)--}}
        {{--{--}}
        {{--console.log('while circle');--}}
        {{--var data = {--}}
        {{--_token: $('meta[name="csrf-token" ]').attr('content'),--}}
        {{--limit: 100,--}}
        {{--skip:skip--}}
        {{--};--}}
    {{--$.ajax--}}
    {{--({--}}
    {{--type: 'POST',--}}
    {{--url: '{{route("get.buildings.ajax")}}',--}}
    {{--data: data,--}}
    {{--success: function (result) {--}}
        {{--console.log(result.location.length);--}}
        {{--result_size = result.location.length;--}}
        {{--console.log('result_size = '+result_size);--}}
        {{--console.log('ajax');--}}
        {{--locations = result.location;--}}



        {{--markers.push(locations.map(function (location, i) {--}}
            {{--var marker = new google.maps.Marker({--}}
            {{--position: location,--}}
            {{--icon: 'assets/images/kuzia_marker.png'--}}
            {{--//label: locations[i].labels--}}
            {{--});--}}
            {{--streets.push(locations[i].labels);--}}
            {{--console.log('markers');--}}

            {{--google.maps.event.addListener(marker, 'click', function(evt) {--}}

                {{--infoWin.setContent('<div class="place_ifo" streetname=" ' +     locations[i].labels    + '">' +--}}
                {{--'<a href="https://kuzia.j2landing.com/connection">' +  locations[i].labels  + ' </a>'  +--}}
                {{--'</div>');--}}
                {{--infoWin.open(map, this);--}}


                {{--function conclusionStreet(){--}}
                    {{--var streetTake =  $('.place_ifo').attr("streetname");--}}
                    {{--window.localStorage.clear();--}}
                    {{--localStorage.setItem('selected_street', streetTake);--}}
                    {{--console.log(streetTake);--}}
                    {{--}--}}
                {{--setTimeout(conclusionStreet, 1000);--}}

                {{--});--}}
            {{--console.log(marker);--}}
            {{--return marker;--}}

            {{--}));--}}
        {{--console.log(markers);--}}


        {{--}--}}

    {{--});--}}
    {{--console.log('result_size2 = '+result_size);--}}
    {{--j++;--}}
    {{--}--}}

    //







    }
    // function addMarkers(points) {
    //     result_size = points.length;
    //     console.log('ajax');
    //     locations = points;
    //
    //
    //
    //     markers = locations.map(function (location, i) {
    //         var marker = new google.maps.Marker({
    //             position: location,
    //             icon: 'assets/images/kuzia_marker.png'
    //             //label: locations[i].labels
    //         });
    //         streets.push(locations[i].labels);
    //         console.log('markers');
    //
    //         google.maps.event.addListener(marker, 'click', function(evt) {
    //
    //             infoWin.setContent('<div class="place_ifo" streetname=" ' +     locations[i].labels    + '">' +
    //                 '<a href="https://kuzia.j2landing.com/connection">' +  locations[i].labels  + ' </a>'  +
    //                 '</div>');
    //             infoWin.open(map, this);
    //
    //
    //             function conclusionStreet(){
    //                 var streetTake =  $('.place_ifo').attr("streetname");
    //                 window.localStorage.clear();
    //                 localStorage.setItem('selected_street', streetTake);
    //                 console.log(streetTake);
    //             }
    //             setTimeout(conclusionStreet, 1000);
    //
    //         });
    //
    //         return marker;
    //
    //     });
    //     console.log(markers);
    //
    //     var markerCluster = new MarkerClusterer(map, markers,
    //         {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
    //
    // }

</script>

<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKFztHzVA7_L75JrTwyrzhk2asYAWUL7I&libraries=places&callback=initMap"
        type="text/javascript"></script>





<script>

    // var allpoints = 2000
    // var locationsAll
    // offs = 0
    //
    // ajaxNewPoints(offs)
    //
    // function ajaxNewPoints(offset) {
    //     ajax
    //
    //     succsess addMarkers(res)
    //     if(offs < allpoints) {
    //         offs +=100
    //         ajaxNewPoints(offs)
    //     }
    // }
    //
    // function addMarkers(poi) {
    //     poi.map -> google markers -> add locationsAll
    //
    //
    //
    //
    // }





    // getBuild();
</script>



<script type="text/javascript">
    var el1 = $('#error404-eye-left'), eyeBall1 = el1.find('div');
    var el2 = $('#error404-eye-right'), eyeBall2 = el2.find('div');
    el1.show();
    el2.show();
    var x1 = el1.offset().left + 37, y1 = el1.offset().top + 25;
    var r = 10, x, y, x2, y2, isEyeProcessed = false;
    $('html').mousemove(function (e) {
        if (!isEyeProcessed) {
            isEyeProcessed = true;
            var x2 = e.pageX, y2 = e.pageY;
            y = ((r * (y2 - y1)) / Math.sqrt((x2 - x1) * (x2 - x1) + (y2 - y1) * (y2 - y1))) + y1;
            x = (((y - y1) * (x2 - x1)) / (y2 - y1)) + x1;
            eyeBall1.css({
                marginTop: (y - y1 + 1) + 'px',
                marginLeft: (x - x1) + 'px'
            });
            eyeBall2.css({
                marginTop: (y - y1 + 1) + 'px',
                marginLeft: (x - x1) + 'px'
            });
            isEyeProcessed = false;
        }
    });
</script>



@endsection

