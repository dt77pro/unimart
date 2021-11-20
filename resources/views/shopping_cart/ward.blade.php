<option selected value="">---Phường / Xã---</option>
@foreach ($wards as $ward)
    <option value="{{$ward->name}}">{{$ward->name}}</option>
@endforeach