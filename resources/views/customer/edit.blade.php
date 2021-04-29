@extends('layouts.template',['data'=>$data])

@section('content')

<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Edit {{ $data['page_title'] }}</h3>
                <a class="float-right text-white" href="{{ route('guest.index') }}">Guest List</a>
              </div>
              <x-alert />
              <form method="post" action="{{ route('guest.update',$data['id'])}}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Guest Name</label>
                                <input type="text" class="form-control @error('guest_name') is-invalid @enderror" id="guest_name" name="guest_name" maxlength="75" value="{{ $data['guest']->guest_name}}">
                                @error('guest_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" maxlength="75" value="{{ $data['guest']->company_name}}">
                                @error('company_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control @error('email_id') is-invalid @enderror" id="email_id" name="email_id" maxlength="75" value="{{ $data['guest']->email_id}}">
                                @error('email_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Mobile No</label>
                                <input type="text" class="form-control @error('mobile_no') is-invalid @enderror" id="mobile_no" name="mobile_no" maxlength="10" value="{{ $data['guest']->mobile_no}}">
                                @error('mobile_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" maxlength="2000">{{ $data['guest']->address}}</textarea>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>State</label>
                                <select class="form-control @error('state_id') is-invalid @enderror" id="state_id" name="state_id" onchange="getCities(this.value);">
                                    <option value="">Select State {{ $data['guest']->state_id }}</option>
                                    @foreach($data['state'] as $s)
                                        <option value="{{ $s->id }}" {{ ($data['guest']->state_id == $s->id)? 'selected':'' }}>{{ $s->state }}</option>
                                    @endforeach
                                </select>
                                @error('state_id')
                                <br><span class="text-danger">{{ $message }}</span>
                                @enderror
                                <input type="hidden" id="city_id_url" name="city_id_url" value="{{ route('getcities') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>City</label>
                                <select class="form-control @error('city_id') is-invalid @enderror" id="city_id" name="city_id">
                                    <option value="">Select City</option>
                                    @foreach($data['city'] as $c)
                                        <option value="{{ $c->id }}" {{ ($data['guest']->city_id == $c->id)? 'selected':'' }}>{{ $c->city }}</option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                <br><span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Pincode</label>
                                <input type="text" class="form-control @error('pincode') is-invalid @enderror" id="pincode" name="pincode" minlength="5" maxlength="6" value="{{ $data['guest']->pincode}}">
                                @error('pincode')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Notes</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" maxlength="2000">{{ $data['guest']->notes}}</textarea>
                                @error('notes')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Save</button>
                </div>
               </form>
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection