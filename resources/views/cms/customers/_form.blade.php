<div class="breadcrumb ">
    <div class="row">
        <div class="form-group">
            <div class="col-xl-4">
                <label class="container-fluid" for="name">Name : </label>
                <small class="text-danger">{{ $errors->first('name') }}</small>
                <input type="text" class="form-control" id="name" name="name" value="{!! isset($customer->name) ? $customer->name : null !!}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-xl-4">
                <label class="container-fluid" for="email">Email : </label>
                <small class="text-danger">{{ $errors->first('email') }}</small>
                <input type="email" class="form-control" id="email" name="email" value="{!! isset($customer->email) ? $customer->email : null !!}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-xl-4">
                <label class="container-fluid" for="number">Phone Number : </label>
                <small class="text-danger">{{ $errors->first('number') }}</small>
                <input type="text" class="form-control" id="number" name="number" value="{!! isset($customer->phone_number) ? $customer->phone_number : null !!}">
            </div>
        </div>

    </div>

    <div class="row">
        <div class="form-group">
            <div class="col-xl-4">
                <label class="container-fluid" for="name">Twitter : </label>
                <small class="text-danger">{{ $errors->first('twitter') }}</small>
                <input type="text" class="form-control" id="twitter" name="twitter" value="{!! isset($customer->twitter) ? $customer->twitter : null !!}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-xl-4">
                <label class="container-fluid" for="email">Facebook : </label>
                <small class="text-danger">{{ $errors->first('facebook') }}</small>
                <input type="text" class="form-control" id="facebook" name="facebook" value="{!! isset($customer->facebook) ? $customer->facebook : null !!}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-xl-4">
                <label class="container-fluid" for="email">Instagram : </label>
                <small class="text-danger">{{ $errors->first('instagram') }}</small>
                <input type="text" class="form-control" id="instagram" name="instagram" value="{!! isset($customer->instagram) ? $customer->instagram : null !!}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <div class="col-xl-6">
                <label class="container-fluid" for="address">Address : </label>
                <small class="text-danger">{{ $errors->first('address') }}</small>
                <textarea class="form-control" id="address" name="address" rows="3">{!! isset($customer->address) ? $customer->address : null !!}</textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xl-6">
                <label class="container-fluid" for="address">Remark : </label>
                <small class="text-danger">{{ $errors->first('remark') }}</small>
                <textarea class="form-control" id="remark" name="remark" rows="3">{!! isset($customer->remark) ? $customer->remark : null !!}</textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <div class="col-xl-12">
                <label class="container-fluid"> </label>
                <button type="submit" class="btn btn-primary form-control">Save</button>
            </div>
        </div>
    </div>

</div>
