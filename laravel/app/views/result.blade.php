@extends('packages.mrjuliuss.syntara.layouts.dashboard.master')
@section('content')
<script>
jQuery( document ).ready(function( $ ) {
 @if($trial->type=='voteapprove')
  var pieChartDataSource = [
    {category: 'Approve', value: {{$approve}} },
    {category: 'Disapprove', value: {{$disapprove}} },
    {category: 'Abstain', value:  {{$abstain}} }                                                      
];
 

@elseif($trial->type=='choicevote')
  var pieChartDataSource = [
  @foreach($choice_result as $cv)
    {category: '{{$cv->name}}', value: {{$cv->vote_count}} },
  @endforeach
  ];
@elseif($trial->type=='appointment')
  $("#barchart").dxChart({
    dataSource: [
      @foreach($choice_result as $cv)
        {day: '{{$cv->name}}', value: {{$cv->freq}}},
      @endforeach
    ],
    series: {
        argumentField: "day",
        valueField: "value",
        name: "Appointment Date",
        type: "bar",
        color: '#ffa500'
    }
});
@endif

@if($trial->type=='voteapprove'||$trial->type=='choicevote')
$(function () {             
    $("#pieChartContainer").dxPieChart({
        dataSource: pieChartDataSource,
        series: {
            argumentField: 'category',
            valueField: 'value',
        }    
    });
});

$("#pieChartContainer").dxPieChart({
    series: {
        //...
        label: {
            visible: true,
            connector: {
                visible: true
            }
        }
    },
    tooltip: {
        enabled: true,
        percentPrecision: 2,
        customizeText: function (value) {
            return value.percentText;
        }
    },
    title: {
        text: 'Vote Result'
    },
    legend: {
        horizontalAlignment: 'center',
        verticalAlignment: 'bottom'
    }
    //...
});
  @endif

  

  
  


});


</script>

<div class='container'>
@if(Session::has('message'))
    {{ Session::get('message') }}
@endif
<div class="row">
  <div class="col-sm-offset-2 col-xs-10">
  	<h3>Trial Name: {{$trial->title}}</h3>
	 <p>{{$trial->description}}</p>
   <p><a href="{{route('trial',array($trial->id))}}" class='btn btn-default'><span class="glyphicon glyphicon-arrow-left"></span> Go Back</a></p>
  </div>

   <div class="col-sm-offset-2 col-xs-10">
   <h4>Trial Result</h4>
    @if($trial->type=='voteapprove'||$trial->type=='choicevote')
    <div id="pieChartContainer" style="max-width:700px;height: 300px;"></div>
    @elseif($trial->type=='askcomment')
      <ol>
      @foreach($comments as $comment)
        <li>{{$comment->comment}}</li>
      @endforeach
      </ol>
    @elseif($trial->type=='appointment')
    <div id="barchart" style="max-width:700px;height: 300px;"></div>
    @endif
   </div>
</div>

@stop