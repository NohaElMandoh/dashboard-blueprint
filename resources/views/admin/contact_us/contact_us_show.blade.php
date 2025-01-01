@extends('admin.layouts.app')

@section('content')

<div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  
                  <div class="card-body">
                  <h4 class="card-title">Name</h4>
                    <p class="card-description">{{$contact->name}}</p>
                    </p> 
                       <h4 class="card-title">E-mail</h4>
                    <p class="card-description">{{$contact->email}}</p>
                    </p>
                    <h4 class="card-title">Subject</h4>
                    <p class="card-description">{{$contact->subject}}</p>
                    </p>
                    <h4 class="card-title">Message</h4>
                    <p class="lead"> {{$contact->message}} </p>
                  </div>
                </div>
              </div>
    @endsection