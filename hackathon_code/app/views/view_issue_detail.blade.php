@extends('master')

@section('title')
    Issue Detai
@endsection

@section('head')

    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script type="text/javascript">
        var issue_detail = {{ json_encode($issue_detail) }};
        console.log(issue_detail);
        var latitude = issue_detail['latitude'];
        var longitude = issue_detail['longitude'];
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
                title =  'Issue Detail';
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
        <h1 class="no_margin_h1">
            <?php if($issue_detail->status == 'resolved') { ?>
                Resolved Issue Details
            <?php } else if($issue_detail->status == 'unresolved') { ?>
                Unresolved Issue Details
            <?php } ?> 
            <small> {{{ $issue_detail->image_processed_id }}} </small>
            </h1>
    </div>
</div><br>
<br>

<div class="row">
    <div class="col-sm-4">
        <div>
            
            <p class="add_margin_p"><b>Issue ID</b>: {{{ $issue_detail->image_processed_id }}} </p>
            <p class="add_margin_p"><b>Issue Raised On</b>: {{{ $issue_detail->date_submitted }}}</p>
            <p class="add_margin_p"><b>Image Validator</b>: {{{ $issue_detail->validator_name }}}</p>
                       
            <p class="add_margin_p"><b>Issue Location</b>: {{{ $issue_detail->location }}}</p>
            <?php if($issue_detail->status == 'resolved' || $issue_detail->assigned_to > 0) { ?>
            <p class="add_margin_p"><b>Worker Assigned</b>: {{{ $issue_detail->name }}}</p>
            <?php } ?>
            <br>
            <?php if($issue_detail->status == 'unresolved') { ?>
                <p><b> Please select worker to solve this unresolved task</b> </p>
                <br>
                <button class="btn btn-primary btn-md" id="assign_worker">Assign Worker</button>
                <br>
                <br>
            <?php } ?>
            
            <?php if($issue_detail->status == 'resolved') { ?>
                 <p><b> To change worker, please click on Change Worker button</b> </p>
                <br>
                <button class="btn btn-primary btn-md" id="assign_worker">Change Worker</button>
                <br>
                <br>
            <?php } ?>
                 <div class="form-horizontal">  
                    <select name="assign_to_worker" style="width:170px; float:left" class="form-control" id ="assign_to_worker" >
                        @foreach($workers as $worker)
                            <option value="<?php echo $worker->worker_id; ?>"  @if($issue_detail->worker_id == $worker->worker_id) selected @endif>{{$worker->name}}</option>
                        @endforeach
                    </select>

                    <button class="btn btn-default btn-md" id="edit_warning">Edit</button>
                    <button class="btn btn-primary btn-md" style="display: none;" id="save_worker">Save</button>
                    <button class="btn btn-default btn-md" style="display: none;" id="cancel_warning">Cancel</button>
                </div>
            <br>
             
            <?php if($issue_detail->status == 'unresolved') { ?>
                <p><b> Click on resolve button to mark this task as resolved</b> </p>
                <br>
                <button class="btn btn-success btn-md" id="resolve">Resolve Task</button>
                <br>
                <br>
            <?php } ?>

           
        </div>
        <br>
        <br>
    </div>
    <div class="col-lg-8" id="map-canvas" style="height:50%;"> </div>
</div>
<script>
    $('#assign_to_worker').hide();
    $('#edit_warning').hide();
    
   
    $('#assign_worker').on('click',function() {
           
            $('#edit_warning').show();
            $('#assign_to_worker').show();
            //disable the save button until the value changes in the dropdown
            $('#assign_to_worker').attr("disabled", true);
            $('#assign_worker').attr("disabled", true);

    });
        
    $('#edit_warning').on('click',function() {
           
            $('#edit_warning').hide();
            $('#save_worker').show();
            $('#cancel_warning').show();
            //disable the save button until the value changes in the dropdown
          //  $('#cancel_warning').attr("disabled", true);
            $('#assign_to_worker').attr("disabled", false);

        });
         $('#cancel_warning').on('click',function() {
            $(this).hide();
            $('#save_worker').hide();
            $('#edit_warning').show();
            $('#assign_to_worker').val({{$issue_detail->worker_id}});
            $('#assign_to_worker').attr("disabled", true);
        });
    $('#save_worker').on('click',function() {
        var worker_id = $('#assign_to_worker').val();
       
        var data = {
            'image_processed_id' : {{ $issue_detail->image_processed_id }},
            'assigned_to' : worker_id,
        };
        
         $.ajax({
                method: 'GET',
                data : data,
                url : '/assign_worker',
               
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
    
    $('#resolve').on('click',function() {
        var data = {
            'image_processed_id' : {{ $issue_detail->image_processed_id }},

        };
        
        $.ajax({
                method: 'GET',
                data : data,
                url : '/resolve',
               
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
