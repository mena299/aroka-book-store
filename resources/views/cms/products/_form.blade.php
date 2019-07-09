<div class="breadcrumb ">
    <div class="row">
        <div class="form-group">
            <div class="col-xl-6">
                <label class="container-fluid" for="title_th">Title(Th) : </label>
                <small class="text-danger">{{ $errors->first('title_th') }}</small>
                <input type="text" class="form-control" id="title_th" name="title_th"
                       value="{!! isset($product->title_th) ? $product->title_th : null !!}">
            </div>

            <div class="col-xl-6">
                <label class="container-fluid" for="title_en">Title(En) : </label>
                <small class="text-danger">{{ $errors->first('title_en') }}</small>
                <input type="text" class="form-control" id="title_en" name="title_en"
                       value="{!! isset($product->title_en) ? $product->title_en : null !!}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <div class="col-xl-3">
                <label class="container-fluid" for="title_th">SKU : </label>
                <small class="text-danger">{{ $errors->first('sku') }}</small>
                <input type="text" class="form-control" id="sku" name="sku"
                       value="{!! isset($product->sku) ? $product->sku : null !!}">
            </div>

            <div class="col-xl-3">
                <label class="container-fluid" for="title_th">Pen Name : </label>
                <small class="text-danger">{{ $errors->first('pen_name_id') }}</small>
                <select class="form-control " name="pen_name_id" id="pen_name_id">
                    <option value="{!! null !!}">not select</option>
                    @foreach($penname as $p)
                        @if($product->pen_name_id == $p->id)
                            <option value="{!! $p->id !!}" selected>{!! $p->pen_name !!}</option>
                        @else
                            <option value="{!! $p->id !!}">{!! $p->pen_name !!}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="col-xl-3">
                <label class="container-fluid" for="title_th">Stock : </label>
                <small class="text-danger">{{ $errors->first('stock') }}</small>
                <input type="number" class="form-control" id="stock" name="stock"
                       value="{!! isset($product->stock) ? $product->stock : 0 !!}">
            </div>

            <div class="col-xl-3">
                <label class="container-fluid" for="title_th">Status : </label>
                <small class="text-danger">{{ $errors->first('status') }}</small>
                @if(isset($product->status) && $product->status == 'Y')
                    <input type="checkbox" name="status" id="status" class="checkbox-custom" checked value="Y">
                @else
                    <input type="checkbox" name="status" id="status" class="checkbox-custom" value="Y">
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <div class="col-xl-4">
                <label class="container-fluid" for="title_th">Product Cost : </label>
                <small class="text-danger">{{ $errors->first('product_cost') }}</small>
                <input type="number" class="form-control" id="product_cost" name="product_cost"
                       value="{!! isset($product->cost) ? $product->cost : null !!}">
            </div>

            <div class="col-xl-4">
                <label class="container-fluid" for="title_th">Register Cost : </label>
                <small class="text-danger">{{ $errors->first('register_cost') }}</small>
                <input type="number" class="form-control" id="register_cost" name="register_cost"
                       value="{!! isset($product->register) ? $product->register : null !!}">
            </div>

            <div class="col-xl-4">
                <label class="container-fluid" for="title_th">EMS Cost : </label>
                <small class="text-danger">{{ $errors->first('ems_cost') }}</small>
                <input type="number" class="form-control" id="ems_cost" name="ems_cost"
                       value="{!! isset($product->ems) ? $product->ems : null !!}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <div class="col-xl-6">
                <label class="container-fluid" for="content">Content : </label>
                <small class="text-danger">{{ $errors->first('content') }}</small>
                <textarea class="form-control" id="content" name="content"
                          rows="3">{!! isset($product->content) ? $product->content : null !!}</textarea>
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

