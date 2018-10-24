<?php

?>
<?php if (Route::getCurrentRoute()->getPath() == "images/unresolved" ){ ?>

<h2>Unresolved Issues <small>Displaying {{ $allissues->getFrom() }} to {{ $allissues->getTo() }} of {{ $allissues->getTotal() }} results</small></h1>
{{ $allissues->links() }}
<table class="table-fixed-head table table-bordered table-hover">
    <thead>
    <tr>
        <th>Issue Id</th>
        <th>Date Time</th>
        <th>Image Validatar</th>
        <th>Location</th>
    
    </tr>
    </thead>
    <tbody>
   
    @foreach($allissues as $issue)
        <tr>
            <td>
               <a href="/issue_detail/{{ $issue->image_processed_id }}">{{ $issue->image_processed_id }}</a>  
            </td>
            <td>
                {{ $issue->date_submitted }}
            </td>
            <td>
                {{ $issue->validator_name }}
            </td>
            <td>{{$issue->location}}</td>
     

        </tr>
       
    @endforeach
    </tbody>
</table>
<?php } ?>
<?php if (Route::getCurrentRoute()->getPath() == "images/resolved" ){ ?>

<h2>Resolved Issues <small>Displaying {{ $allissues->getFrom() }} to {{ $allissues->getTo() }} of {{ $allissues->getTotal() }} results</small></h1>
{{ $allissues->links() }}
<table class="table-fixed-head table table-bordered table-hover">
    <thead>
    <tr>
        <th>Issue Id</th>
        <th>Date Time</th>
        <th>Image Validatar</th>
        <th>Location</th>
        <th>Task Assignee</th>
        <th>Resolution Date</th>
    </tr>
    </thead>
    <tbody>
   
    @foreach($allissues as $issue)
        <tr>
            <td>
               <a href="/issue_detail/{{ $issue->image_processed_id }}">{{ $issue->image_processed_id }}</a>  
               
            </td>
            <td>
                {{ $issue->date_submitted }}
            </td>
            <td>
                {{ $issue->validator_name }}
            </td>
            <td>
                {{ $issue->location }}
            </td>
            <td>
                {{ $issue->name }}
            </td>
           
            <td>{{$issue->resolution_date}}</td>

        </tr>
       
    @endforeach
    </tbody>
</table>
<?php } ?>

<?php if (Route::getCurrentRoute()->getPath() == "images/processed" ){ ?>

<h2>Processed Images of Issues <small>Displaying {{ $allissues->getFrom() }} to {{ $allissues->getTo() }} of {{ $allissues->getTotal() }} results</small></h1>
{{ $allissues->links() }}
<table class="table-fixed-head table table-bordered table-hover">
    <thead>
    <tr>
        <th>Issue Id</th>
        <th>Date Time</th>
        <th>Image Validatar</th>
        <th>Worker Assigned</th>
        <th>Location</th>
        <th>Issue Status</th>
    </tr>
    </thead>
    <tbody>
   
    @foreach($allissues as $issue)
        <tr>
            <td>
               <a href="/issue_detail/{{ $issue->image_processed_id }}">{{ $issue->image_processed_id }}</a>  
               
            </td>
            <td>
                {{ $issue->date_submitted }}
            </td>
            <td>
                
                {{ $issue->validator_name }}
               
            </td>
             <td>
                <?php if($issue->status == 'resolved') { ?>
                {{ $issue->name }}
                <?php } else {?>
                    Not Applicable
                <?php } ?>
            </td>
            <td>
                {{ $issue->location }}
            </td>
            <td>
                {{ $issue->status }}
            </td>
        </tr>
       
    @endforeach
    </tbody>
</table>
<?php } ?>

<?php if (Route::getCurrentRoute()->getPath() == "images/review" ){ ?>

<h2>Require Manual Review <small>Displaying {{ $allissues->getFrom() }} to {{ $allissues->getTo() }} of {{ $allissues->getTotal() }} results</small></h1>
{{ $allissues->links() }}
<table class="table-fixed-head table table-bordered table-hover">
    <thead>
    <tr>
        <th>Image Id</th>
        <th>Capture Date Time</th>
        <th>Location</th>
        <th>Camera ID</th>
    </tr>
    </thead>
    <tbody>
   
    @foreach($allissues as $issue)
        <tr>
            <td>
               <a href="/review_detail/{{ $issue->image_id }}">{{ $issue->image_id }}</a>  
               
            </td>
            <td>
                {{ $issue->image_date_time }}
            </td>
            <td>
                {{ $issue->location }}
            </td>
         
            <td>
                {{ $issue->camera_id }}
            </td>
        </tr>
       
    @endforeach
    </tbody>
</table>
<?php } ?>