@extends('layouts.app')
@section('content')
<div class="container">

    @if (count($product) < 1)
        No product fits the search index
    @else
    <div class="row">
        <?php 
          $count = 0;  
        ?>
        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
        @foreach ($product as $item)
          <?php 
            $count += 1;
          ?>
          @if ($count == 1)
            
              <img
                src="\storage\{{$item['product']}}"
                class="w-100 shadow-1-strong rounded mb-4 imgShadow"
                alt="" data-bs-toggle="offcanvas" data-bs-target="#a{{$item['id']}}" aria-controls="offcanvasRight"
              />
        
              <div class="offcanvas offcanvas-end" tabindex="-1" id="a{{$item['id']}}" aria-labelledby="offcanvasRightLabel" style="width:40%;">
                <div class="offcanvas-header">
                  <h5 id="offcanvasRightLabel">{{$item['title']}}</h5>
                  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <img
                    src="\storage\{{$item['product']}}"
                    class="w-100 shadow-1-strong rounded mb-4"
                    />
                    <div>
                      {{$item['description']}} <br>
                      <span style="color:red; font-weight: bold; font-size:15pt;">Npr.{{$item['price']}}</span>
                      <div>
                        @if (!Auth::check())
                              <a href="/login" class="btn btn-secondary">Buy</a>
                        @elseif (Auth()->user()->id == 1)
                          <a href="/" class="btn btn-secondary">Buy</a>
                          
                        @else
                            <form action="https://uat.esewa.com.np/epay/main" method="POST" style="display: inline-block;">
                              <input value="{{(float)$item['price']}}" name="tAmt" type="hidden">
                              <input value="{{(float)$item['price']}}" name="amt" type="hidden">
                              <input value="0" name="txAmt" type="hidden">
                              <input value="0" name="psc" type="hidden">
                              <input value="0" name="pdc" type="hidden">
                              <input value="EPAYTEST" name="scd" type="hidden">
                              <input value="a{{$item['id']}}" name="pid" type="hidden">
                              <input value="http://127.0.0.1:8000/sucess" type="hidden" name="su">
                              <input value="http://127.0.0.1:8000/failed" type="hidden" name="fu">
                              <input value="Buy" type="submit" class="btn btn-danger">
                              </form>
                        @endif
  
                        <a href="/cart/add/{{$item['id']}}" class="btn btn-primary" style="display: inline-block;">Add to cart</a>
                      </div>
                      <div class="pt-2">
                        <form class="form" action="/cmnt/{{$item['id']}}">
                          <div class="mb-3 row">
                            <fieldset class="rating">
                              Give your rating:
                              <input type="radio" id="{{$item['id']}}-star5" name="rating" value="5" /><label for="{{$item['id']}}-star5" title="Rocks!">5 stars</label>
                              <input type="radio" id="{{$item['id']}}-star4" name="rating" value="4" /><label for="{{$item['id']}}-star4" title="Pretty good">4 stars</label>
                              <input type="radio" id="{{$item['id']}}-star3" name="rating" value="3" /><label for="{{$item['id']}}-star3" title="Meh">3 stars</label>
                              <input type="radio" id="{{$item['id']}}-star2" name="rating" value="2" /><label for="{{$item['id']}}-star2" title="Kinda bad">2 stars</label>
                              <input type="radio" id="{{$item['id']}}-star1" name="rating" value="1" /><label for="{{$item['id']}}-star1" title="Sucks big time">1 star</label>
                            </fieldset>
                          </div>
                          
                          <div class="mb-3 row">
                            <label for="exampleFormControlTextarea1" class="form-label">Give your feedback:</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="cmnt"></textarea>
                          </div>
                          
                          <div class="mb-3 pb-4" style="float:right;">
                            <input type="submit" class="btn btn-secondary">  
                          </div>
  
                        </form>
                      </div>
                      <div>
                        <ul class="list-group w-100">
                        <span style="font-weight: bold;">Reviews</span>
                        @foreach ($item->reviews as $review)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                          <div class="ms-2 me-auto">
                            <div class="fw-bold">Anonymus</div>
                            {{$review->comment}}
                          </div>
                          <span class="badge bg-primary rounded-pill">rated-{{$review['rating']}}</span>
                        </li>
                        @endforeach
  
                        </ul>
                      </div>
                    </div>
                </div>
              </div>
            @elseif ($count == 3)
              <?php $count=0; ?>
  
          @endif   
        @endforeach
      </div>
      <?php $count=0; ?>
      <div class="col-lg-4 mb-4 mb-lg-0">
      @foreach ($product as $item)
          <?php 
            $count += 1;
          ?>
          @if ($count == 2)
            <img
              src="\storage\{{$item['product']}}"
              class="w-100 shadow-1-strong rounded mb-4 imgShadow"
              alt="" data-bs-toggle="offcanvas" data-bs-target="#a{{$item['id']}}" aria-controls="offcanvasRight"
            />
  
            <div class="offcanvas offcanvas-end" tabindex="-1" id="a{{$item['id']}}" aria-labelledby="offcanvasRightLabel" style="width:40%;">
              <div class="offcanvas-header">
                <h5 id="offcanvasRightLabel">{{$item['title']}}</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                  <img
                  src="\storage\{{$item['product']}}"
                  class="w-100 shadow-1-strong rounded mb-4"
                  />
                  <div>
                    {{$item['description']}} <br>
                    <span style="color:red; font-weight: bold; font-size:15pt;">Npr.{{$item['price']}}</span>
                    <div>
                      @if (!Auth::check())
                              <a href="/login" class="btn btn-secondary">Buy</a>
                      @elseif (Auth()->user()->id == 1)
                          <a href="/" class="btn btn-secondary">Buy</a>
                          
                      @else
                            <form action="https://uat.esewa.com.np/epay/main" method="POST" style="display: inline-block;">
                              <input value="{{(float)$item['price']}}" name="tAmt" type="hidden">
                              <input value="{{(float)$item['price']}}" name="amt" type="hidden">
                              <input value="0" name="txAmt" type="hidden">
                              <input value="0" name="psc" type="hidden">
                              <input value="0" name="pdc" type="hidden">
                              <input value="EPAYTEST" name="scd" type="hidden">
                              <input value="a{{$item['id']}}" name="pid" type="hidden">
                              <input value="http://127.0.0.1:8000/sucess" type="hidden" name="su">
                              <input value="http://127.0.0.1:8000/failed" type="hidden" name="fu">
                              <input value="Buy" type="submit" class="btn btn-danger">
                              </form>
                      @endif
  
                        <a href="/cart/add/{{$item['id']}}" class="btn btn-primary" style="display: inline-block;">Add to cart</a>
                    </div>
  
                    <div class="pt-4">
                      <form class="form" action="/cmnt/{{$item['id']}}">
                        <div class="mb-3 row">
                          <fieldset class="rating">
                            Give your rating:
                            <input type="radio" id="{{$item['id']}}-star5" name="rating" value="5" /><label for="{{$item['id']}}-star5" title="Rocks!">5 stars</label>
                            <input type="radio" id="{{$item['id']}}-star4" name="rating" value="4" /><label for="{{$item['id']}}-star4" title="Pretty good">4 stars</label>
                            <input type="radio" id="{{$item['id']}}-star3" name="rating" value="3" /><label for="{{$item['id']}}-star3" title="Meh">3 stars</label>
                            <input type="radio" id="{{$item['id']}}-star2" name="rating" value="2" /><label for="{{$item['id']}}-star2" title="Kinda bad">2 stars</label>
                            <input type="radio" id="{{$item['id']}}-star1" name="rating" value="1" /><label for="{{$item['id']}}-star1" title="Sucks big time">1 star</label>
                          </fieldset>
                        </div>
                        
                        <div class="mb-3 row">
                          <label for="exampleFormControlTextarea1" class="form-label">Give you feedback:</label>
                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="cmnt"></textarea>
                        </div>
                        
                        <div class="mb-3 pb-4" style="float:right;">
                          <input type="submit" class="btn btn-secondary">  
                        </div>
  
                      </form>
                    </div>
                    <div>
                      <ul class="list-group w-100">
                      <span style="font-weight: bold;">Reviews</span>
                      
                      @foreach ($item->reviews as $review)
                      <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                          <div class="fw-bold">Anonymus</div>
                          {{$review->comment}}
                        </div>
                        <span class="badge bg-primary rounded-pill">rated-{{$review['rating']}}</span>
                      </li>
                      @endforeach
  
                      </ul>
                    </div>
                  </div>
              </div>
            </div>
            @elseif ($count == 3)
              <?php $count=0; ?>
  
          @endif   
        @endforeach
      </div>
      <div class="col-lg-4 mb-4 mb-lg-0">
      <?php $count = 0; ?>
      @foreach ($product as $item)
          <?php 
            $count += 1;
          ?>
            @if ($count == 3)
              <?php $count=0; ?>
              
                <img
                  src="\storage\{{$item['product']}}"
                  class="w-100 shadow-1-strong rounded mb-4 imgShadow"
                  alt=""  data-bs-toggle="offcanvas" data-bs-target="#a{{$item['id']}}" aria-controls="offcanvasRight"
                />
  
                <div class="offcanvas offcanvas-end" tabindex="-1" id="a{{$item['id']}}" aria-labelledby="offcanvasRightLabel" style="width:40%;">
                  <div class="offcanvas-header">
                    <h5 id="offcanvasRightLabel">{{$item['title']}}</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <div class="offcanvas-body">
                      <img
                      src="\storage\{{$item['product']}}"
                      class="w-100 shadow-1-strong rounded mb-4"
                      />
                      <div>
                        {{$item['description']}} <br>
                        <span style="color:red; font-weight: bold; font-size:15pt;">Npr.{{$item['price']}}</span>
                        <div>
                          @if (!Auth::check())
                              <a href="/login" class="btn btn-secondary">Buy</a>
                          @elseif (Auth()->user()->id == 1)
                              <a href="/" class="btn btn-secondary">Buy</a>
                          @else
                            <form action="https://uat.esewa.com.np/epay/main" method="POST" style="display: inline-block;">
                              <input value="{{(float)$item['price']}}" name="tAmt" type="hidden">
                              <input value="{{(float)$item['price']}}" name="amt" type="hidden">
                              <input value="0" name="txAmt" type="hidden">
                              <input value="0" name="psc" type="hidden">
                              <input value="0" name="pdc" type="hidden">
                              <input value="EPAYTEST" name="scd" type="hidden">
                              <input value="a{{$item['id']}}" name="pid" type="hidden">
                              <input value="http://127.0.0.1:8000/sucess" type="hidden" name="su">
                              <input value="http://127.0.0.1:8000/failed" type="hidden" name="fu">
                              <input value="Buy" type="submit" class="btn btn-danger">
                              </form>
                          @endif
                            <a href="/cart/add/{{$item['id']}}" class="btn btn-primary" style="display: inline-block;">Add to cart</a>
                        </div>
  
                        <div class="pt-4">
                          <form class="form" action="/cmnt/{{$item['id']}}">
                            <div class="mb-3 row">
                              <fieldset class="rating">
                                Give your rating:
                                <input type="radio" id="{{$item['id']}}-star5" name="rating" value="5" /><label for="{{$item['id']}}-star5" title="Rocks!">5 stars</label>
                                <input type="radio" id="{{$item['id']}}-star4" name="rating" value="4" /><label for="{{$item['id']}}-star4" title="Pretty good">4 stars</label>
                                <input type="radio" id="{{$item['id']}}-star3" name="rating" value="3" /><label for="{{$item['id']}}-star3" title="Meh">3 stars</label>
                                <input type="radio" id="{{$item['id']}}-star2" name="rating" value="2" /><label for="{{$item['id']}}-star2" title="Kinda bad">2 stars</label>
                                <input type="radio" id="{{$item['id']}}-star1" name="rating" value="1" /><label for="{{$item['id']}}-star1" title="Sucks big time">1 star</label>
                              </fieldset>
                            </div>
                            
                            <div class="mb-3 row">
                              <label for="exampleFormControlTextarea1" class="form-label">Give you feedback:</label>
                              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name='cmnt'></textarea>
                            </div>
                            
                            <div class="mb-3 pb-4" style="float:right;">
                              <input type="submit" class="btn btn-secondary">  
                            </div>
    
                          </form>
                        </div>
                        <div>
                          <ul class="list-group w-100">
                          <span style="font-weight: bold;">Reviews</span>
                          
                          @foreach ($item->reviews as $review)
                          <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                              <div class="fw-bold">Anonymus</div>
                              {{$review->comment}}
                            </div>
                            <span class="badge bg-primary rounded-pill">rated-{{$review['rating']}}</span>
                          </li>
                          @endforeach
    
                          </ul>
                        </div>
                      </div>
                  </div>
                </div>
              
  
          @endif   
        @endforeach
      </div>
  
      </div>
      <div class="d-flex justify-content-center pt-4">
        {{$product->links()}}
      </div> 
    @endif
    
</div>
@endsection
