@extends('layouts.master')
@section('title','Ineterest Calculator')

@section('content')
<div class="container col-md-8 p-3">
    {{Form::open(['url'=>route('get-interest'),'method'=>'POST','name'=>'interestForm','id'=>'interestForm'])}}
        <div class="form-group">
            <label for="inerestType">Interest Type</label>
            {{Form::select('inerestType',['FD'=>'Fixed Diposits','RD'=>'Recurring Diposits'],!empty($inerestType)?$inerestType:old('inerestType'),['id'=>'inerestType','class'=>'form-control','placeholder'=>'Please select interest type'] )}}
            <span class="text-danger">{!! $errors->first('inerestType') !!}</span>
        </div>
        
        <div class="form-group {{ !empty($errors->first('pricipalAmount')) || !empty(old('pricipalAmount')) || !empty($pricipalAmount) ?'':'d-none'}}" id="amountField">
            <label for="pricipalAmount">Principal Amount</label>
            <input type="text" name="pricipalAmount" class="form-control" id="pricipalAmount" value="{{!empty($pricipalAmount)?$pricipalAmount:old('pricipalAmount')}}" placeholder="Enter Amount">
            <span class="text-danger">{!! $errors->first('pricipalAmount') !!}</span>
        </div>

        <div class="form-row">
            <div class="col">
                <label for="duration" id="timeLabel">Time Period (In Year)</label>
                <input type="number" name="duration" class="form-control" id="duration" value="{{!empty($timePeriod)?$timePeriod:old('duration')}}" placeholder="years">
                <span class="text-danger">{!! $errors->first('duration') !!}</span>
            </div>

            <div class="col">
                <label for="interestRate">Rate of Interest</label>
                <input type="text" name="interestRate" class="form-control" id="interestRate" placeholder="Eg: 5%" value="{{!empty($interestRate)?$interestRate:old('interestRate')}}">
                <span class="text-danger">{!! $errors->first('interestRate') !!}</span>
            </div>
        </div>

        <center class="form-group p-3">
        {{Form::submit('Calculate',['id'=>'calculateButton','class'=>'btn btn-primary'])}}
        </center>
    {{Form::close()}}

    @if(!empty($totalAmount))
    <div class="alert alert-info" role="alert">
        <p>Principal Amount is : <strong>{{$pricipalAmount}}</strong></p>
        @if(!empty($totalInvestAmount) && $inerestType == 'RD')
        <p>Total invest Amount : <strong>{{$totalInvestAmount}}</strong></p>
        @endif
        <p>Total Interest is &nbsp&nbsp&nbsp&nbsp :<strong> {{$interestAmount}}</strong></p>
        <p>Total Amount is &nbsp&nbsp&nbsp : <strong>{{$totalAmount}}</strong></p>
    </div>
    @endif
</div>

<script>
$(document).ready(function(){
    $('#inerestType').change(function(){
        if($(this).val() != ''){
            if($(this).val() == 'FD'){
                $('#duration').attr('placeholder','years');
                $('#timeLabel').text('Time Period (In Year)');
            }else{
                $('#duration').attr('placeholder','months');
                $('#timeLabel').text('Time Period (In Months)');
            }
            $('#amountField').removeClass('d-none');
        }else{
            $('#amountField').addClass('d-none');
        }
    });
});
</script>
@endsection

