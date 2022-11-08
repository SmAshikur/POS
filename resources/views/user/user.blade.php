@extends('layouts.master.master')
@section('content')
<section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4 mb-sm-5">
                <div class="card card-style1 border-0">
                    <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                        <div class="row align-items-center">
                            <div class="row">
                                <div class="d-flex justify-content-end">
                                        <a href="{{route('passGet')}}" class="btn btn-success">Change Pass</a>
                                    </div>
                            </div>
                            <div class="col-lg-6 mb-4 mb-lg-0">
                                @isset(auth::user()->profile_image)
                                <img src="{{asset('images/'.auth::user()->profile_image)}}" alt="..." style="height: 400px; width:400px">
                                @else
                                <img src="{{asset('images/setting/profile.jpg')}}" alt="..." style="height: 400px; width:400px">
                                @endisset
                                <div class="bg-secondary d-lg-inline-block px-3 py-2 px-sm-6 mb-1-9 mt-2 rounded">
                                    <h3 class="h2 text-white mb-0">{{auth::user()->name}}</h3>
                                    <span class="text-danger">{{auth::user()->role}}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 px-xl-10">
                                <div class="row">
                                    <div class="col-md-10 offset-1">

                                <form action="{{route('account.ok')}}" enctype="multipart/form-data" method="post"> @csrf
                                    <div class="modal-body mx-3">
                                        <input type="hidden" name="id"  class="form-control validate" value="{{auth::user()->id}}">

                                        <div class="md-form mb-1">
                                          <label data-error="wrong" data-success="right" for="form34">Your name</label>
                                          <input type="text" name="name" id="form34" class="form-control validate" value="{{auth::user()->name}}">
                                        </div>

                                        <div class="md-form mb-1">
                                          <label data-error="wrong" data-success="right" for="form29">Your email</label>
                                          <input type="email" name="email" id="form29" class="form-control validate" value="{{auth::user()->email}}">
                                        </div>
                                        <div class="md-form mb-1 row">
                                            <label data-error="wrong" data-success="right" for="form29">Your image</label>
                                            <div class="col-md-8">
                                                <input value="{{auth::user()->profile_image}}"  id="profile_image" type="file" class="form-control imagerender @error('profile_image') is-invalid @enderror" name="profile_image" value="{{ old('profile_image') }}" autocomplete="profile_image">
                                                @error('profile_image')
                                                    <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4" style="margin-top:-10px ">
                                                          <img style="width: 60px; height:60px;" src="{{asset('images/'.auth::user()->profile_image)}}" alt="" id="eidtImg" class="previewImg">
                                            </div>
                                        </div>
                                        <div class="md-form">
                                        <label data-error="wrong" data-success="right" for="form8">Your About</label>
                                          <textarea type="text" id="form8" name="about" class="md-textarea form-control" rows="4">
                                            {{Auth::user()->about}}</textarea>

                                        </div>

                                      </div>
                                      <div class="modal-footer d-flex justify-content-center">
                                        <button type="submit" class="btn btn-unique">Update <i class="fas fa-paper-plane-o ml-1"></i></button>
                                      </div>
                                </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-4 mb-sm-5">
                <div>
                    <span class="section-title text-primary mb-3 mb-sm-4">About Me</span>
                    <p>{{Auth::user()->about}}</p>
                    <p class="mb-0">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed.</p>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12 mb-4 mb-sm-5">
                        <div class="mb-4 mb-sm-5">
                            <span class="section-title text-primary mb-3 mb-sm-4">Skill</span>
                            <div class="progress-text">
                                <div class="row">
                                    <div class="col-6">Driving range</div>
                                    <div class="col-6 text-end">80%</div>
                                </div>
                            </div>
                            <div class="custom-progress progress progress-medium mb-3" style="height: 4px;">
                                <div class="animated custom-bar progress-bar slideInLeft bg-secondary" style="width:80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="10" role="progressbar"></div>
                            </div>
                            <div class="progress-text">
                                <div class="row">
                                    <div class="col-6">Short Game</div>
                                    <div class="col-6 text-end">90%</div>
                                </div>
                            </div>
                            <div class="custom-progress progress progress-medium mb-3" style="height: 4px;">
                                <div class="animated custom-bar progress-bar slideInLeft bg-secondary" style="width:90%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar"></div>
                            </div>
                            <div class="progress-text">
                                <div class="row">
                                    <div class="col-6">Side Bets</div>
                                    <div class="col-6 text-end">50%</div>
                                </div>
                            </div>
                            <div class="custom-progress progress progress-medium mb-3" style="height: 4px;">
                                <div class="animated custom-bar progress-bar slideInLeft bg-secondary" style="width:50%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar"></div>
                            </div>
                            <div class="progress-text">
                                <div class="row">
                                    <div class="col-6">Putting</div>
                                    <div class="col-6 text-end">60%</div>
                                </div>
                            </div>
                            <div class="custom-progress progress progress-medium" style="height: 4px;">
                                <div class="animated custom-bar progress-bar slideInLeft bg-secondary" style="width:60%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar"></div>
                            </div>
                        </div>
                        <div>
                            <span class="section-title text-primary mb-3 mb-sm-4">Education</span>
                            <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>
                            <p class="mb-1-9">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
