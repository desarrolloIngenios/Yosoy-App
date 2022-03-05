@extends('app')
@section('content')
<!-- row -->
<div class="row row-sm">
    <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
        <div class="card  box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">Default Form</h4>
                <p class="mb-2">It is Very Easy to Customize and it uses in your website apllication.</p>
            </div>
            <div class="card-body pt-0">
                <form class="form-horizontal" >
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                    </div>
                    <div class="form-group mb-0 justify-content-end">
                        <div class="checkbox">
                            <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-2">
                                <label for="checkbox-2" class="custom-control-label mt-1">Check me Out</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <button type="submit" class="btn btn-primary">Sign in</button>
                            <button type="submit" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Vertical Form</h4>
                <p class="mb-2">It is Very Easy to Customize and it uses in your website apllication.</p>
            </div>
            <div class="card-body pt-0">
                <form >
                    <div class="">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="checkbox">
                            <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                                <label for="checkbox-1" class="custom-control-label mt-1">Check me Out</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 mb-0">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row -->
@endsection