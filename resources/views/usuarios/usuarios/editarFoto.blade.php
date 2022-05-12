@extends('layouts.app',['titulo'=>'Crear usuario'])

@section('breadcrumbs', Breadcrumbs::render('editarUsuario',$usuario))

@section('acciones')	
	<a href="{{ route('usuarios') }}" class="breadcrumb-elements-item">
	    <i class="fas fa-arrow-left"></i>
	    {{ __('Cancel') }}
	</a>
@endsection

@section('content')

<div class="card">
  <div class="card-body">
    <div class="form-group">

      <label class="">Foto:</label>
      <input type="file" value="{{ old('foto') }}" class="form-control{{ $errors->has('foto') ? ' is-invalid' : '' }}" name="foto" id="foto" >
      <span class="form-text text-muted">Formatos aceptados: gif, png, jpg. Tamaño máximo de archivo 2Mb</span>
      @if ($errors->has('foto'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('foto') }}</strong>
          </span>
      @endif
          
      </div>
  </div>
</div>

@prepend('scriptsHeader')

{{-- file input --}}
<link href="{{ asset('plus/bootstrap-fileinput/css/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css" />
<script src="{{ asset('plus/bootstrap-fileinput/js/plugins/piexif.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plus/bootstrap-fileinput/js/plugins/sortable.min.js') }}" type="text/javascript"></script>
<script src="{{asset('plus/bootstrap-fileinput/js/plugins/purify.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('plus/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
<script src="{{ asset('plus/bootstrap-fileinput/themes/fas/theme.min.js') }}"></script>
<script src="{{ asset('plus/bootstrap-fileinput/js/locales/es.js') }}"></script>
{{-- fin file input --}}

{{-- select bootsrap --}}
<link rel="stylesheet" href="{{ asset('plus/selectBootstrap/css/bootstrap-select.min.css') }}">
<script src="{{ asset('plus/selectBootstrap/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('plus/selectBootstrap/js/i18n/defaults-es_ES.min.js') }}"></script>
{{-- fin select bootsrap --}}


@endprepend

@push('scriptsFooter')
<script>
  $('#menuUsuario').addClass('active');
@if($usuario->foto)
  var foto="<img class='kv-preview-data file-preview-image' src='{{ Storage::url('public/usuarios/'.$usuario->foto) }}'>";
@else
var foto="<img class='kv-preview-data file-preview-image' src='https://placeimg.com/800/460/any/grayscale'>";
@endif



$("#foto").fileinput({
    uploadUrl: "{{ route('actualizarFotoUsuario') }}",
    uploadExtraData: {
      'id':{{ $usuario->id }}
    },
    allowedFileExtensions: ["jpg", "png", "gif","jpeg","svg"],
    maxImageWidth: 1200,
    maxImageHeight: 650,
    resizePreference: 'height',
    autoReplace: true,
    maxFileCount: 1,
    resizeImage: true,
    resizeIfSizeMoreThan: 1000,
     initialPreview: [foto],
    initialCaption: 'Initial-Image.jpg',
    theme:'fas',
    language:'es'
}).on('filepreupload', function() {
    $('#kv-success-box').html('');
}).on('fileuploaded', function(event, data) {
    var url=data.response.link;
    $('#kv-success-box').append(url);

    $('#kv-success-modal').modal('show');
});

</script>
@endpush


@endsection
