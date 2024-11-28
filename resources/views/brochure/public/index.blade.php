@extends('layout.main')

@section('content')
    @include('layout.navbar')

    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-body">
                @if (!empty($files))
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Brochure Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $file)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <a href="{{ Storage::url($file) }}" target="_blank">{{ basename($file) }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted text-center">No brochures uploaded yet.</p>
                @endif
            </div>
        </div>
    </div>

    @include('layout.footer')
@endsection
