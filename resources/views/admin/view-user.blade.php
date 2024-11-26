@extends('layouts.admin')

@section('content')

<div class="page-inner">
    <section class="section">
        <div class="row">
            <div class="col-lg-6">

                

                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">User Details</div>
                                <div class="card-tools">
                                    <a href="{{url('/admin/users')}}" class="btn btn-primary">
                                        <i class="icon-action-undo"></i>
                                        Back
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <p>
                                        <strong>First Name</strong><br>
                                        <span>{{$user[0]->first_name}}</span>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <strong>Last Name</strong><br>
                                        <span>{{$user[0]->last_name}}</span>
                                    </p>
                                </div>

                                <div class="col-md-6">
                                    <p>
                                        <strong>Email</strong><br>
                                        <span>{{$user[0]->email}}</span>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <strong>Phone</strong><br>
                                        <span>{{$user[0]->phone}}</span>
                                    </p>
                                </div>

                                <div class="col-md-6">
                                    <p>
                                        <strong>Flat</strong><br>
                                        <span>{{$user[0]->flat}}</span>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <strong>Building</strong><br>
                                        <span>{{$user[0]->building}}</span>
                                    </p>
                                </div>

                                <div class="col-md-6">
                                    <p>
                                        <strong>Landmark</strong><br>
                                        <span>{{$user[0]->landmark}}</span>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <strong>City/Emirates</strong><br>
                                        <span>{{$user[0]->city}}</span>
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p>
                                        <strong>Country</strong><br>
                                        <span>{{$user[0]->country}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        

            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Map</h5>

                    <!-- Vertical Form -->
                    <div class="row g-3">
                        <div class="col-12">
                            <div id="map"></div>
                        </div>
                    </div><!-- Vertical Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

@endsection
