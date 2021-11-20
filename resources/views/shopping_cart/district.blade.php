<option selected value="">---Chọn Quận / Huyện---</option>
@foreach ($districts as $district)
    <option value="{{$district->id}}:{{$district->name}}">{{$district->name}}</option>
@endforeach