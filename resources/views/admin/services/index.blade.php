@extends('admin.admin_master')

@section('admin')



    <div class="py-12">

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="card-header"> All Brand  </div>
                        <table class="table">
                            <thead>

                            <tr>
                                <th scope="col">SL No</th>
                                <th scope="col">Service Image</th>
                                <th scope="col">Service Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--                            @php($i = 1)--}}
                            @foreach($services as $service)
                                <tr>
                                    <th scope="row"> {{ $services->firstItem()+$loop->index }} </th>
                                    <td><img src="{{ asset($service->image) }}" style="height:40px; width:70px;"> </td>
                                    <td> {{ $service->service_title }} </td>
                                    <td> {{ $service->description }} </td>



                                    <td>
                                        <a href="{{ url('services/edit/'.$service->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('services/delete/'.$service->id) }}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger">Delete</a>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $services->links() }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"> Add Service  </div>
                        <div class="card-body">


                            <form action="{{ route('store.services') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Service Image</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('image')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Service Title</label>
                                    <input type="text" name="service_title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('service_title')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Service Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                                    @error('description')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>








                                <button type="submit" class="btn btn-primary">Add Service</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>

@endsection

