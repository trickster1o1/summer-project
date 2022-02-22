@extends('layouts.app')

@section('content')
<div class="container">
    
    @if (count($items) < 1)
        <div align='center' style="padding-bottom: 20em;">Nothing on cart </div>
        
    @else
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Product</th>
            <th scope="col">Title</th>
            <th scope="col">price</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
    <?php $count = 0; $total=0; ?>
    @foreach ($items as $item)
    <?php $count += 1; $total +=(float)$item->price; ?>
    <tr>
        <th scope="row" class="align-middle">{{$count}}</th>
        <td class="align-middle">
            <figure class="figure">
                <img src="/storage/{{$item['product']}}" class="figure-img img-fluid rounded" alt="Eror404" style="width:15em; height:auto;">
                <figcaption class="figure-caption">{{$item['description']}}</figcaption>
              </figure>
        </td>
        <td class="align-middle"><span style="font-size: 14pt;">{{$item['title']}}<span></td>
        <td class="align-middle" style="color:red;"><b>Npr. {{$item['price']}}</b></td>
        <td class="align-middle"><a href="/cart/remove/{{$item->id}}" class="btn btn-danger">Delete</a></td>
    </tr>
    @endforeach
    <tr>
      
      <th scope="row" class="align-middle"></th>
      <td class="align-middle">
        <b><span style="font-size: 15pt;">Total</span></b>
      </td>
      <td></td>
      <td class="align-middle"><span style="font-weight:bold;color:red;">NPR.{{$total}}</span></td>
      <td>
        <form action="https://uat.esewa.com.np/epay/main" method="POST" style="display: inline-block;">
          <input value="{{$total}}" name="tAmt" type="hidden">
          <input value="{{$total}}" name="amt" type="hidden">
          <input value="0" name="txAmt" type="hidden">
          <input value="0" name="psc" type="hidden">
          <input value="0" name="pdc" type="hidden">
          <input value="EPAYTEST" name="scd" type="hidden">
          <input value="{{Auth()->user()->id}}-{{Rand(10,1000)}}" name="pid" type="hidden">
          <input value="http://127.0.0.1:8000/sucess" type="hidden" name="su">
          <input value="http://127.0.0.1:8000/failed" type="hidden" name="fu">
          <input value="Buy" type="submit" class="btn btn-primary" style="width:75px;">
          </form> <br>
          <a href="/cart/cancel" class="btn btn-danger mt-1" style="width:75px;">Cancel</a>
      </td>
    </tr>
    </tbody>
    </table>
    @endif
    <div style="display: block;width:100%;height:24.6em;">
    </div>
    
</div>
@endsection
