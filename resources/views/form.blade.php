
<div class="form-group row @if($errors->has('contact_records')) alert-danger @endif">
    <label for="contact_records" class="col-sm-2 col-form-label is-invalid">Contact records</label>
    <div class="col-sm-10">
        <textarea id="contact_records" rows="10" name="contact_records"
                  class="form-control @if($errors->has('contact_records')) is-invalid @endif"
        >{{old('contact_records', $defaultRecords)}}</textarea>
        @if($errors->has('contact_records'))
            <div class="invalid-feedback">{{$errors->first('contact_records')}}</div>
        @endif
    </div>
</div>

<div class="form-group row @if($errors->has('office_latitude')) alert-danger @endif">
    <label for="office_latitude" class="col-sm-2 col-form-label">GPS Office Latitude</label>
    <div class="col-sm-10">
        <input type="number" step="0.0000001" min="-90" max="90" id="office_latitude"
               class="form-control @if($errors->has('office_latitude')) is-invalid @endif "
               value="{{old('office_latitude', $defaultOfficeLat )}}" name="office_latitude"
        />
        @if($errors->has('office_latitude'))
            <div class="invalid-feedback">{{$errors->first('office_latitude')}}</div>
        @endif
    </div>
</div>

<div class="form-group row @if($errors->has('office_longitude')) alert-danger @endif">
    <label for="office_longitude" class="col-sm-2 col-form-label">GPS Office Longitude</label>
    <div class="col-sm-10">
        <input type="number" step="0.0000001" min="-180" max="180" id="office_longitude"
               class="form-control @if($errors->has('office_longitude')) is-invalid @endif "
               value="{{old('office_longitude', $defaultOfficeLng )}}" name="office_longitude"
        />
        @if($errors->has('office_longitude'))
            <div class="invalid-feedback">{{$errors->first('office_longitude')}}</div>
        @endif
    </div>
</div>

<div class="form-group row @if($errors->has('range')) alert-danger @endif">
    <label for="range" class="col-sm-2 col-form-label">Range (km)</label>
    <div class="col-sm-10">
        <input type="number" step="1" min="0" id="range" name="range"
               class="form-control @if($errors->has('range')) is-invalid @endif "
               value="{{old('range', $defaultRangeKm )}}"
        />
        @if($errors->has('range'))
            <div class="invalid-feedback">{{$errors->first('range')}}</div>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-12">
        <button type="submit" class="btn btn-primary col-sm-12">Find affiliates</button>
    </div>
</div>
