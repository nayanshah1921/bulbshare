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
                <h3 class="card-title">{{ $data['page_title'] }} List</h3>
                <a class="float-right text-white" href="javascript:void(0);" onclick="$('#add_customer').modal('show');">Add Customer</a>
                <input type="hidden" id="customer_details_url" name="customer_details_url" value="{{ route('customer.details') }}" />
              </div>
              <x-alert />
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped table-sm">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Company</th>
                  <th>Last Name</th>
                  <th>First Name</th>
                  <th>Email Address</th>
                  <th>Job Title</th>
                  <th>Business Phone</th>
                  <th>Address</th>
                  <th>City</th>
                  <th>Zip/ Postal Code</th>
                  <th>Country/ Region</th>
                  <th>Orders #</th>
                  <th>Orders Value</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data['customer'] as $d)
                <tr>
                  <td>{{ $d->id }}</td>
                  <td>{{ $d->company}}</td>
                  <td>{{ $d->last_name}}</td>
                  <td>{{ $d->first_name}}</td>
                  <td>{{ $d->email_address}}</td>
                  <td>{{ $d->job_title }}</td>
                  <td>{{ $d->business_phone }}</td>
                  <td>{{ $d->address }}</td>
                  <td>{{ $d->city }}</td>
                  <td>{{ $d->zip_postal_code }}</td>
                  <td>{{ $d->country_region }}</td>
                  <td>{{ $d->order_cnt }}</td>
                  <td>{{ $d->order_value }}</td>
                  <td>
                    <a class="btn btn-info btn-sm" href="javascript:void(0);" onclick="get_customer_details('{{ $d->id }}');">
                      <i class="fas fa-pencil-alt"></i></a>
                    <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="if(confirm('Do you want to delete this customer?')) { event.preventDefault();document.getElementById('form-delete-{{$d->id}}').submit() }">
                      <i class="fas fa-trash"></i></a>
                    <form style="display:none;" id="form-delete-{{$d->id}}" method="post" action="{{route('customer.destroy',$d->id)}}">
                      @csrf
                      @method('delete')
                    </form>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="14">No Customers Available. Create One...</td>
                </tr>  
                @endforelse
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
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
    <!-- /.content -->
    <div class="modal fade" id="add_customer">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add Customer</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="form_add_customer" name="form_add_customer" method="post" action="{{ route('customer.save')}}" autocomplete="off" enctype="multipart/form-data" class="form-horizontal">
              @csrf
              <div class="modal-body">
                  <div class="row">
                      <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                              <label>Company</label>
                              <input type="text" class="form-control @error('company') is-invalid @enderror" id="company" name="company" maxlength="50">
                              @error('company')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                              <label>Last Name</label>
                              <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" maxlength="50">
                              @error('last_name')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                              <label>First Name</label>
                              <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" maxlength="50">
                              @error('first_name')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                              <label>Job Title</label>
                              <input type="email" class="form-control @error('job_title') is-invalid @enderror" id="job_title" name="job_title" maxlength="50">
                              @error('job_title')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                              <label>Business Phone</label>
                              <input type="text" class="form-control @error('business_phone') is-invalid @enderror" id="business_phone" name="business_phone" maxlength="25">
                              @error('business_phone')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                              <label>Home Phone</label>
                              <input type="text" class="form-control @error('home_phone') is-invalid @enderror" id="home_phone" name="home_phone" maxlength="25">
                              @error('home_phone')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                              <label>Mobile Phone</label>
                              <input type="text" class="form-control @error('mobile_phone') is-invalid @enderror" id="mobile_phone" name="mobile_phone" maxlength="25">
                              @error('mobile_phone')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                              <label>Fax Number</label>
                              <input type="text" class="form-control @error('fax_number') is-invalid @enderror" id="fax_number" name="fax_number" maxlength="25">
                              @error('fax_number')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                              <label>Address</label>
                              <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" maxlength="500"></textarea>
                              @error('address')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                              <label>City</label>
                              <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" maxlength="50">
                              @error('city')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                              <label>State Province</label>
                              <input type="text" class="form-control @error('state_province') is-invalid @enderror" id="state_province" name="state_province" maxlength="50">
                              @error('state_province')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                              <label>Zip / Postal Code</label>
                              <input type="text" class="form-control @error('zip_postal_code') is-invalid @enderror" id="zip_postal_code" name="zip_postal_code" maxlength="15">
                              @error('zip_postal_code')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                              <label>Country / Region</label>
                              <input type="text" class="form-control @error('country_region') is-invalid @enderror" id="country_region" name="country_region" maxlength="50">
                              @error('country_region')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                              <label>Webpage</label>
                              <input type="text" class="form-control @error('webpage') is-invalid @enderror" id="webpage" name="webpage" maxlength="50">
                              @error('webpage')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" onclick="add_customer();">Save</button>
                  <input type="hidden" id="customer_id" name="customer_id" value="0" />
              </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
@endsection