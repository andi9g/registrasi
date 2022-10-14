@extends('layout.master')

@section('title')
    Lengkapi Identitas
@endsection

@section('activekuIdentitas')
    activeku
@endsection

@section('content')
    


    <div class="card">
        <div class="card-header">
            <h4 class="my-0 py-0 text-uppercase">Lengkapi Identitas *</h4>
            <small for="" class="text-decoration-none my-0">( fill in your identity )</small>
        </div>

        <div class="card-body">
            <div class='form-group'>
                <label for='fornama' class='text-capitalize'>Nama Peserta</label>
                <small>(Participant's Name)</small>
                <input type='text' name='nama' id='fornama' class='form-control ' placeholder='' value="{{$namapeserta}}">
            </div>

            <div class='form-group'>
                <label for='fornama' class='text-capitalize '>Nama Kontingen</label>
                <small>(Contingent Name)</small>
                <select class="form-control js-example-tags">
                    @foreach ($kontingen as $item)
                        <option value="{{$item->kontingen}}" @if ($item->kontingen == $namakontingen)
                            selected
                        @endif>{{$item->kontingen}}</option>
                    @endforeach
                </select>
            </div>

            <div class='form-group'>
                <label for='fornama' class='text-capitalize'>Jenis Kelamin</label>
                <small>(Gender)</small>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jk" id="jk1" value="option1" @if ($jk == 'l')
                        checked
                    @endif>
                    <label class="form-check-label" for="jk1">
                      Laki-Laki <small>(Malee)</small>
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="jk" id="jk2" value="option2" @if ($jk == 'p')
                        checked
                    @endif>
                    <label class="form-check-label" for="jk2">
                      Perempuan <small>(Femalee)</small>
                    </label>
                  </div>
            </div>
            

            <div class='form-group'>
                <label for='forwa' class='text-capitalize'>No. WA</label>
                <small>(Whatsapp Number)</small>
                <input type='number' name='wa' id='forwa' class='form-control ' placeholder='' value="{{$wa}}">
            </div>

            <div class='form-group'>
                <label for='forgambar' class='text-capitalize'>Foto Latar Merah</label>
                <small>(Seragam Baju Karate)</small>
                <input type='file' name='gambar' id='forgambar' class='form-control' placeholder='' value="{{$wa}}">
            </div>
              
              
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-success px-3">UPDATE IDENTITAS</button>
        </div>
    </div>

@endsection


@section('script')
<script>
    $(".js-example-tags").select2({
      tags: true
    });

    
</script>
@endsection