@extends('layouts.site')

@section('content')
    <div class="container">
        <h3>PDF Preview</h3>
        <iframe src="{{ asset('storage/pdfs/' . $filename) }}" width="100%" height="600px" frameborder="0"></iframe>
    </div>
@endsection
