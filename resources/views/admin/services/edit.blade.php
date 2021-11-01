@extends('admin.admin_master')

@section('admin')



    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="py-12">

        <div class="container">
            <div class="row">

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"> Edit Service  </div>
                        <div class="card-body">


                            <form action="{{ url('services/update/'.$services->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{ $services->image }}">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Update Service Image</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $services->image }}">
                                    @error('image')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <img src="{{ asset($services->image) }}" style="width:400px; height:200px;">


                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Update Service Title</label>
                                    <input type="text" name="service_title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $services->service_title }}">
                                    @error('service_title')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Service Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{ $services->description }}</textarea>
                                    @error('description')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>





                                <button type="submit" class="btn btn-primary">Update Service</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

