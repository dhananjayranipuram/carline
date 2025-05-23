@extends('layouts.site')

@section('content')
    <style>
        #signature-pad {
            width: 100%;
            height: 200px;
            border: 2px dashed #aaa;
            border-radius: 10px;
            background-color: #fff;
            touch-action: none;
        }

        .controls {
            margin-top: 15px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .controls button {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 500;
            border: none;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .controls .btn-clear {
            background-color: #dc3545;
            color: #fff;
        }

        .controls .btn-clear:hover {
            background-color: #bb2d3b;
        }

        .controls .btn-save {
            background-color: #28a745;
            color: #fff;
        }

        .controls .btn-save:hover {
            background-color: #218838;
        }

        #signature-image {
            margin-top: 20px;
            border: 1px solid #ccc;
            width: 100%;
            max-height: 200px;
            border-radius: 10px;
        }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="booking-form-group col-md-10 text-center">
                <h3 class="mb-4">Sign the Document</h3>
                <canvas id="signature-pad"></canvas>

                <div class="controls">
                    <button id="clear-signature" onclick="clearPad()" class="btn-clear">Clear</button>
                    <button id="save-signature" onclick="saveSignature()" class="btn-save">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
        const canvas = document.getElementById('signature-pad');

        // Resize canvas to match CSS width
        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = 200 * ratio; // fixed height
            canvas.getContext("2d").scale(ratio, ratio);
        }

        window.addEventListener("resize", resizeCanvas);
        resizeCanvas(); // initial call

        const signaturePad = new SignaturePad(canvas);

        function clearPad() {
            signaturePad.clear();
            document.getElementById('signature-image').src = '';
        }

        function saveSignature() {
            if (signaturePad.isEmpty()) {
                alert("Please provide a signature first.");
                return;
            }
            const dataURL = signaturePad.toDataURL();
            $('#signature-data').val(dataURL);
            $.ajax({
                url: baseUrl+'/signature-upload',
                method: 'POST',
                data: {
                    signature: dataURL,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    alert('Signature uploaded and encrypted successfully!');
                    
                    window.location.href = "{{ route('pdf.generate') }}";
                },
                error: function(xhr) {
                    alert('Failed to upload signature.');
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
@endsection
