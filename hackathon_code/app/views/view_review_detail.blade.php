@extends('master')

@section('title')
    Manual Review Issue
@endsection

@section('head')

    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script type="text/javascript">
        var issue_detail = {{ json_encode($issue_detail) }};
        console.log(issue_detail);
        var latitude = issue_detail['lat'];
        var longitude = issue_detail['longi'];
        var image_location = issue_detail['image_location'];
        var location_information = Array();
    
        function initMap() {
                var markers = new Array();
                var rdx=0;
                var myLatLng = {'lat' : latitude, 'lng':longitude};
                
                //initializing the map
                var map = new google.maps.Map(document.getElementById('map-canvas'), {
                            zoom: 20,
                            center: new google.maps.LatLng( myLatLng.lat, myLatLng.lng ),
                        });
                var endLatLon = new google.maps.LatLng(latitude, longitude);

                var latlng = Array();
                latlng.push({lat: latitude, lng:longitude });
                addMarker(latlng[0]);

            function addMarker(locations) {
                var title = '';
               
                var contentString = '';
                title =  'Image Detail';
                contentString = "<div style='float:left'><img src='http://img.dunyanews.tv/news/2017/October/10-18-17/news_big_images/410284_58344671.jpgLARGE'></div><div style='float:right; padding: 10px;'><b>Title</b><br/>123 Address<br/> City,Country</div>";

                var infowindow = new google.maps.InfoWindow({
                   content: contentString
                    });
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng( locations.lat, locations.lng),
                  
                        title : title,
                        labelOrigin: new google.maps.Point(15, 10),
                        offset: '50%',
                        map: map,
                });

                    marker.addListener('mouseover', function() {
                        infowindow.open(map, marker);
                    });
                    marker.addListener('mouseout', function() {
                        infowindow.close(map, marker);
                    });

                    markers.push(marker);
                }
            }
        google.maps.event.addDomListener(window, 'load', initMap);

    </script>

   

    @section('content')

<div class="row" style="width:57%;">
    <div class="col-sm-7"> 
        <h1 class="no_margin_h1">Review Image Detail <small> {{{ $issue_detail->image_id }}} </small></h1>
    </div>
</div><br>
<br>

<div class="row">
    <div class="col-sm-4">
        <div>
            
            <p class="add_margin_p"><b>Issue ID</b>: {{{ $issue_detail->image_id }}} </p>
            <p class="add_margin_p"><b>Image Capture Date Time</b>: {{{ $issue_detail->image_date_time }}}</p>                       

            
            <p class="add_margin_p"><b>Issue Location</b>: {{{ $issue_detail->location }}}</p>
            
            <p class="add_margin_p"><b>Camera ID</b>: {{{ $issue_detail->camera_id }}}</p>
            <br>
            <p><b> Check the image in the map to categorise it as valid or invalid</b> 
            </p>
                <br>
                <br>
                <br>
                <button class="btn btn-primary btn-md" id="validate">Validate Image</button>
                <button class="btn btn-default btn-md" id="invalidate">Invalidate Image</button>

                <br>
                <br>
        </div>
        <br>
        <br>
    </div>
    <div class="col-lg-8" id="map-canvas" style="height:50%;"> </div>
</div>

<script>
$('#validate').on('click',function() {
    var data = {
            'image_id' : {{ $issue_detail->image_id }},
            'validated_by' : 6,
            'image_status' : 'valid'
           
    };
        
    $.ajax({
            method: 'GET',
            data : data,
            url : '/validate',
               
            success:function(data) {
                    if(data) {
                        location.reload();
                    }
           },
           error:function(error) {
                alert("something did not work! Please try again");
           }
    });
});

$('#invalidate').on('click',function() {
      var data = {
            'image_id' : {{ $issue_detail->image_id }},
            'validated_by' : 6,
            'image_status' : 'invalid'
           
    };
        
    $.ajax({
            method: 'GET',
            data : data,
            url : '/validate',
               
            success:function(data) {
                   if(data) {
                        location.reload();
                    }
           },
           error:function(error) {
                alert("something did not work! Please try again");
           }
    });
});
</script>


@stop
