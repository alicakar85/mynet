{{ csrf_field() }}
<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">
        Adı Soyadı
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-10">
        <input type="text" name="name" id="name" class="form-control" placeholder="Adı Soyadı" value="{{ $person->name ?? old('name') }}">

        @if ($errors->has('name'))
            <p class="text-warning">{{ $errors->first('name') }}</p>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="birthday" class="col-sm-2 col-form-label">
        Doğum Tarihi
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-10">
        <input type="text" name="birthday" id="birthday" class="form-control datepicker" placeholder="Doğum Tarihi" value="{{ isset($person->birthday) ? $person->birthday->format('d.m.Y') : old('birthday') }}">

        @if ($errors->has('birthday'))
            <p class="text-warning">{{ $errors->first('birthday') }}</p>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="gender" class="col-sm-2 col-form-label">
        Cinsiyet
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-10">
        <select class="form-control" name="gender" id="gender">
            <option value="">Seçiniz</option>
            @foreach (App\Models\Person::genders() as $key => $gender)
                <option @if ((isset($person) && $person->gender == $key) || (! isset($person) && old('gender') == $key)) selected="selsected" @endif value="{{ $key }}">{{ $gender }}</option>
            @endforeach
        </select>

        @if ($errors->has('gender'))
            <p class="text-warning">{{ $errors->first('gender') }}</p>
        @endif
    </div>
</div>
<hr>
<div class="form-inline">
    <div class="form-group mb-2">
        <label for="address" class="col-form-label sr-only">
            Adres
        </label>
        <div class="col-sm-7">
            <input type="text" id="address" class="form-control mb-2 mr-sm-2" placeholder="Adres" value="">
        </div>
    </div>
    <div class="form-group mb-2">
        <label for="zip_code" class="col-form-label sr-only">
            Posta Kodu
        </label>
        <div class="col-sm-7">
            <input type="text" id="zip_code" class="form-control mb-2 mr-sm-2" placeholder="Posta kodu" value="">
        </div>
    </div>
    <div class="form-group mb-2">
        <label for="city_name" class="col-form-label sr-only">
            Şehir
        </label>
        <div class="col-sm-7">
            <input type="text" id="city_name" class="form-control mb-2 mr-sm-2" placeholder="Şehir" value="">
        </div>
    </div>
    <div class="form-group mb-2">
        <label for="country_name" class="col-form-label sr-only">
            Ülke
        </label>
        <div class="col-sm-7">
            <input type="text" id="country_name" class="form-control mb-2 mr-sm-2" placeholder="Ülke" value="">
        </div>
    </div>
    <div class="form-group mb-2">
        <label for="county" class="col-form-label">
            İşlem
        </label>
        <div class="col-sm-7">
            <button type="button" class="btn btn-dark add-address-area">Ekle</button>
        </div>
    </div>
    
    <div class="table-responsive">
        <table id="address-area" class="table">    
            @if (! empty($person) && $person->addresses)
                @foreach ($person->addresses as $address)
                    <tr>
                        <td><input class="form-control" name="person_address[address][]" value="{{ $address->address }}" /></td>
                        <td><input class="form-control" name="person_address[zip_codes][]" value="{{ $address->zip_code }}" /></td>
                        <td><input class="form-control" name="person_address[city_names][]" value="{{ $address->city_name }}" /></td>
                        <td><input class="form-control" name="person_address[country_names][]" value="{{ $address->country_name }}" /></td>
                        <td>
                            <input class="form-control" type="hidden" name="person_address[id][]" value="{{ $address->id }}" />    
                            <button type="button" class="btn btn-red remove-address-area">Kaldır</button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
$(function () {
    $('.add-address-area').click(function (e) {
        e.preventDefault();
        
        var address = $('#address').val();
        var zip_code = $('#zip_code').val();
        var city_name = $('#city_name').val();
        var country_name = $('#country_name').val();
        
        if (! (address && zip_code && city_name && country_name)) {
            swal({
                title: 'Hata',
                text: 'Formu eksiksiz doldurun',
                type: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Tamam",
                closeOnConfirm: !1
            });
            
            return false;
        }
        
        $('#address-area').append(
            '<tr>' +
                '<td><input class="form-control" name="person_address[address][]" value="' + address + '" /></td>' +
                '<td><input class="form-control" name="person_address[zip_codes][]" value="' + zip_code + '" /></td>' +
                '<td><input class="form-control" name="person_address[city_names][]" value="' + city_name + '" /></td>' +
                '<td><input class="form-control" name="person_address[country_names][]" value="' + country_name + '" /></td>' +
                '<td><button type="button" class="btn btn-red remove-address-area">Kaldır</button></td>' +
            '</tr>'
        );
        
        $('#address, #zip_code, #city_name, #country_name').val('');
    });
    
    $('body').on('click', '.remove-address-area', function () {
        $(this).closest('tr').remove();
    });
});
</script>
@endpush