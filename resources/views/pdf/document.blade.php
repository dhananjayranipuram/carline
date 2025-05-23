<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>User Documents</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 20px;
        }

        h2 {
            margin-top: 30px;
            border-bottom: 1px solid #ccc;
        }

        .info-section {
            margin-bottom: 20px;
        }

        .image-container {
            margin: 10px 0;
        }

        .image-container img {
            width: 100%;
            max-width: 400px;
            height: auto;
            border: 1px solid #ccc;
        }

        .label {
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

    <h1>User Document Demo</h1>

    {{-- User Info --}}
    @php $user = $userAccount[0]; @endphp
    <div class="info-section">
        <p><strong>Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Phone:</strong> {{ $user->phone }}</p>
        <p><strong>City:</strong> {{ $user->city }}</p>
        <p><strong>Emirates:</strong> {{ $user->emirates }}</p>
    </div>

    {{-- Decrypted Images --}}
    {{-- @php $docs = $userDocument[0]->decrypted_files; @endphp

    @foreach ($docs as $label => $url)
        <div class="image-container">
            <div class="label">{{ ucwords(str_replace('_', ' ', $label)) }}</div>
            @if (Str::startsWith($url, 'http'))
                <img src="{{ $url }}" alt="{{ $label }}" style="max-width: 300px; border: 1px solid #000;">
            @endif
        </div>
    @endforeach --}}

    <img src="{{ $sign }}">

</body>
</html>
