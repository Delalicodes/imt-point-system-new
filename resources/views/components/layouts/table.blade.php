@section('table')
    <div class="card-block row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Point</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($points as $point)
                            <tr>
                                <td>{{ $point->user->first_name }} {{ $point->user->last_name }}</td>
                                <td>{{ $point->point }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
