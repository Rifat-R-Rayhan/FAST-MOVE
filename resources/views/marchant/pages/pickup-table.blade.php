@extends('server.layouts.masterlayout')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <div class="card">
        <div class="card-body">

            <form action="{{ url('/calculator/search') }}" method="get">
                @csrf
                <div class="input-group mb-3">
                    <div class="form-group-feedback form-group-feedback-left">
                        <input type="search" name="search" class="form-control form-control-lg"
                            placeholder="Search by From ID or Destination">
                        {{-- <input type="hidden" name="token"  value="{{request()->route('token')}}"> --}}
                        <div class="form-control-feedback form-control-feedback-lg">
                            <i class="icon-search4 text-muted"></i>
                        </div>
                    </div>

                    <div class="input-group-append ms-2">
                        <button type="submit" class="btn btn-primary btn-lg">Search</button>
                    </div>
                </div>


            </form>
        </div>
    </div>





    <div class="col-lg-6 stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pickup Table</h4>
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Alt Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Police Station</th>
                            <th scope="col">District</th>
                            <th scope="col">Division</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                            <th scope="col">Show</th>
                            <th scope="col">Update</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pickups as $pickup)
                            <tr class="table-info">
                                <td>{{ $pickup->id }}</td>
                                <td>{{ $pickup->name }}</td>
                                <td>{{ $pickup->phone }}</td>
                                <td>{{ $pickup->alt_phone }}</td>
                                <td>{{ $pickup->address }}</td>
                                <td>{{ $pickup->ps }}</td>
                                <td>{{ $pickup->district }}</td>
                                <td>{{ $pickup->divisions }}</td>

                                @if ($pickup->is_active == 1)
                                    <td><span class="badge bg-label-danger me-1">pending</span></td>
                                @else
                                    <td><span class="badge bg-label-success me-1">Confirmed</span></td>
                                @endif

                                {{-- <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            @if ($pickup->is_active == 1)
                                                <form action="{{ route('admin.pickup_confirmation') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $pickup->id }}">
                                                    <button class="btn btn-sm btn-success" type="submit"><i
                                                            class="fa-solid fa-check"></i></button>
                                                </form>
                                            @endif

                                            <a href="{{ route('pickup.show', $pickup->id) }}" class="btn btn-info">
                                                Show
                                            </a>

                                            <a href="{{ route('pickup.edit', $pickup->id) }}" class="btn btn-success"
                                                style="margin-left: 10px;">
                                                Update
                                            </a>

                                            <form action="{{ route('pickup.destroy', $pickup->id) }}" method="get">
                                                @csrf
                                                @method ('DELETE')
                                                <input type="hidden" name="id" value="{{ $pickup->id }}">
                                                <button class="dropdown-item" type="submit"
                                                    onclick="return confirm('Are you sure?')"><i
                                                        class="bx bx-trash me-1"></i> Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td> --}}

                                <td>

                                    @if ($pickup->is_active == 1)
                                        <form action="{{ route('admin.pickup_confirmation') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $pickup->id }}">
                                            <button class="btn btn-sm btn-success" type="submit"><i
                                                    class="fa-solid fa-check"></i>Accept</button>
                                        </form>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('pickup.show', $pickup->id) }}" class="btn btn-info">
                                        Show
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('pickup.edit', $pickup->id) }}" class="btn btn-success"
                                        style="margin-left: 10px;">
                                        Update
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('pickup.destroy', $pickup->id) }}" method="post"
                                        style="margin-left: 10px;">
                                        @csrf
                                        @method ('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $pickups->onEachSide(1)->links() }}
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
@endsection
