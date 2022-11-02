@extends('layout.master')

@section('title')
    Lengkapi Identitas
@endsection

@section('activekuIdentitas')
    activeku
@endsection

@section('content')
    

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="my-0 py-0 text-uppercase">Lengkapi Identitas *</h4>
                <small for="" class="text-decoration-none my-0">( fill in your identity )</small>
            </div>
    
            <form action="{{ route('lengkapi.identitas') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class='form-group'>
                        <label for='fornama' class='text-capitalize'>Nama Peserta</label>
                        <small>(Participant's Name)</small>
                        <input type='text' name='nama' id='fornama' class="form-control text-capitalize @error('nama')
                            is-invalid
                        @enderror" placeholder='' value="{{$namapeserta}}">
                    </div>
        
                    <div class='form-group'>
                        <label for='fornama'  class='text-capitalize '>Nama Kontingen</label>
                        <small>(Contingent Name)</small>
                        <select class="form-control js-example-tags @error('kontingen')
                            is-invalid
                        @enderror" style="width: 100%" name="kontingen" required>
                        <option value="">Silahkan Ketikan Kontingen</option>
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
                            <input class="form-check-input @error('jk')
                                is-invalid
                            @enderror" type="radio" name="jk" id="jk1" value="l" @if ($jk == 'l' || old('jk') == 'l')
                                checked
                            @endif>
                            <label class="form-check-label" for="jk1">
                              Laki-Laki <small>(Malee)</small>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input @error('jk')
                                is-invalid
                            @enderror" type="radio" name="jk" id="jk2" value="p" @if ($jk == 'p' || old('jk') == 'p')
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
                        <input type='number' name='wa' id='forwa' class="form-control @error('wa')
                            is-invalid
                        @enderror" placeholder='' value="{{empty($wa)?old('wa'):$wa}}">
                    </div>
        
                    <div class='form-group'>
                        <label for='forgambar' class='text-capitalize'>Fas Photo - Latar Merah - Seragam Karate</label>
                        <small>(Photo Shoot - Red Backgroud - karate uniform)</small>
                        @php
                            $id = Session::get('id'); 
                            $peserta = DB::table('peserta')->where('idpeserta', $id);
                            if($peserta->count() == 1 ){
                                $gambar = $peserta->first()->gambar;
                            }else{
                                $gambar = url('img', 'background.jpg');
                            }
                        @endphp
                        
                        <input type='file' name='gambar' id='forgambar' class="form-control @error('gambar')
                            is-invalid
                        @enderror" accept="image/*" value="{{old('gambar')}}">
                    </div>
                        <img src="{{ $gambar }}" class="mt-3 rounded-lg" width="100px" alt="User Image">
                      
                      
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success px-3">UPDATE IDENTITAS</button>
                </div>
            </form>
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