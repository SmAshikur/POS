@extends('layouts.master.master')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="row">
            <div class="d-flex justify-content-end">
                <a href="" class="btn btn-success btn-rounded mb-4" data-toggle="modal" data-target="#modalContactForm">
                    Edit settings</a>
            </div>
        </div>
        <div class="col-12">
            <div class="row  align-items-center">
                <div class="col-md-3 text-center mb-5">
                    <div class="avatar avatar-xl">
                        @isset($data->logo)
                            <img src="{{asset('images/'.config('data.logo'))}}" alt="..." class="avatar-img rounded-circle" style="height: 200px; width:200px" />

                        @else
                            <img src="{{asset('images/setting/bits.jpg')}}" alt="..." class="avatar-img rounded-circle" style="height: 200px; width:200px" />

                        @endisset
                    </div>
                </div>
                <div class="col-md-8 ml-5">
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <h4 class="mb-1">{{$data->name}}</h4>
                            <p class="small mb-3"><span class="badge badge-dark">{{$data->location}}</span></p>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-7">
                            <p class="text-muted">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit nisl ullamcorper, rutrum metus in, congue lectus. In hac habitasse platea dictumst. Cras urna quam, malesuada vitae risus at,
                                pretium blandit sapien.
                            </p>
                        </div>
                        <div class="col">
                            <p class="small mb-0 text-muted">Nec Urna Suscipit Ltd</p>
                            <p class="small mb-0 text-muted">P.O. Box 464, 5975 Eget Avenue</p>
                            <p class="small mb-0 text-muted">(537) 315-1481</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="">
                <form>

                    <hr class="my-4" />
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstname">Firstname</label>
                            <input type="text" id="firstname" class="form-control" placeholder="Brown" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastname">Lastname</label>
                            <input type="text" id="lastname" class="form-control" placeholder="Asher" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail4">Email</label>
                        <input type="text" class="form-control" id="inputEmail4" placeholder="brown@asher.me" />
                    </div>
                    <div class="form-group">
                        <label for="inputAddress5">Address</label>
                        <input type="text" class="form-control" id="inputAddress5" placeholder="P.O. Box 464, 5975 Eget Avenue" />
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCompany5">Company</label>
                            <input type="text" class="form-control" id="inputCompany5" placeholder="Nec Urna Suscipit Ltd" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputState5">State</label>
                            <select id="inputState5" class="form-control">
                                <option selected="">Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip5">Zip</label>
                            <input type="text" class="form-control" id="inputZip5" placeholder="98232" />
                        </div>
                    </div>
                   <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Save Change</button>
                   </div>
                </form>
                    <hr class="my-4" />
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <form class="form-horizontal" method="POST" action="{{route('passUp')}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="id"  class="form-control validate" value="{{auth::user()->id}}">

                                <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                    <label for="new-password" class=" control-label">Current Password</label>

                                    <div class="">
                                        <input id="current-password" type="password" class="form-control" name="current-password" required>

                                        @if ($errors->has('current-password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('current-password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                    <label for="new-password" class=" control-label">New Password</label>

                                    <div class="">
                                        <input id="new-password" type="password" class="form-control" name="new-password" required>

                                        @if ($errors->has('new-password'))
                                            <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('new-password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="new-password-confirm" class=" control-label">Confirm New Password</label>

                                    <div class="">
                                        <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class=" col-md-offset-4">
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary"> Change Password</button>
                                       </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2">Password requirements</p>
                            <p class="small text-muted mb-2">To create a new password, you have to meet all of the following requirements:</p>
                            <ul class="small text-muted pl-4 mb-0">
                                <li>Minimum 8 character</li>
                                <li>At least one special character</li>
                                <li>At least one number</li>
                                <li>Can’t be the same as a previous password</li>
                            </ul>
                        </div>
                    </div>

            </div>
        </div>
    </div>

    </div>
    <section>
        <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h4 class="modal-title w-100 font-weight-bold">Write to us</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('settings.update',$data->id)}}" enctype="multipart/form-data" method="post"> @csrf @method('put')
                <div class="modal-body mx-3">
                    <input type="hidden" name="id"  class="form-control validate" value="{{$data->id}}">

                    <div class="md-form mb-1">
                      <label data-error="wrong" data-success="right" for="form34">Your name</label>
                      <input type="text" name="name" id="form34" class="form-control validate" value="{{$data->name}}">
                    </div>

                    <div class="md-form mb-1">
                      <label data-error="wrong" data-success="right" for="form29">Your location</label>
                      <input type="text" name="location" id="form29" class="form-control validate" value="{{$data->location}}">
                    </div>
                    <div class="md-form mb-1">
                      <label data-error="wrong" data-success="right" for="form29">Your image</label>
                       <div class="">
                      <input value="{{$data->logo}}" name="logo" id="logo" type="file" class="form-control imagerender @error('logo') is-invalid @enderror" name="logo" value="{{ old('logo') }}"  autocomplete="logo">
                          @error('logo')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                  </div>
                                  <div class="d-flex justify-content-center my-1">
                                      <img style="width: 100px; height:100px;" src="{{asset('images/'.$data->logo)}}" alt="" id="eidtImg" class="previewImg">
                                  </div>
                              </div>
                    <div class="md-form">
                      <textarea type="text" id="form8" class="md-textarea form-control" rows="4"></textarea>
                      <label data-error="wrong" data-success="right" for="form8">Your About</label>
                    </div>

                  </div>
                  <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-unique">Update <i class="fas fa-paper-plane-o ml-1"></i></button>
                  </div>
            </form>
          </div>
        </div>
      </div>
    </section>
@endsection
