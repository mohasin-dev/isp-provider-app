@extends('app')

@section('title','Category')

@push('css')

@endpush

@section('content')
<br><br><h3 style="border-bottom: 3px solid #999" class="text-center card-common">Add Category</h3>
<div class="container" style="margin-top: -65px;">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 ml-auto">
                <div class="row pt-md-5 mt-md-3 mb-5">
                    <div class="col-xl-12 col-sm-12 p-2">
                        <div class="card card-common">
                            <div class="card-body">
                                <form method="POST" action="{{ route('category.store') }}">
                                    @csrf
                                    <div class="form-group md-form">
                                      <label for="exampleInputEmail1">Category Name</label>
                                      <input type="text" name="name" class="form-control"  placeholder="Enter Category Name">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

@endpush

