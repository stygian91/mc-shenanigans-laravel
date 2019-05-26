@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @include('locations.errors')

      <div class="row">
        <div class="col-2">
          <a href="{{ route('locations.create') }}" class="d-block btn btn-success">Create New</a>
        </div>
      </div>

      <form action="{{ route('locations.index') }}" method="GET" class="d-flex justify-content-between location-filters form-search">
        <label>
          Search by name:
          <input type="text" name="search-term" class="form-control" value="{{ $term }}">
        </label>

        <div class="search-position">
          Search by position:
          <br>

          <label>
            X-min:
            <input type="text" name="x-min" class="form-control" value="{{ $x_min }}">
          </label>

          <label>
            X-max:
            <input type="text" name="x-max" class="form-control" value="{{ $x_max }}">
          </label>

          <label>
            Y-min:
            <input type="text" name="y-min" class="form-control" value="{{ $y_min }}">
          </label>

          <label>
            Y-max:
            <input type="text" name="y-max" class="form-control" value="{{ $y_max }}">
          </label>

          <label>
            Z-min:
            <input type="text" name="z-min" class="form-control" value="{{ $z_min }}">
          </label>

          <label>
            Z-max:
            <input type="text" name="z-max" class="form-control" value="{{ $z_max }}">
          </label>
        </div>

        <div class="mb-2">
          <select name="filter-type" class="form-control">
            <option value="all">All</option>

            @foreach ($location_types as $location_type)
              <option
                value="{{ $location_type }}"
                @if ($filter_type === $location_type)
                  selected
                @endif
              >
                {{ ucfirst($location_type) }}
              </option>
            @endforeach
          </select>
        </div>

        <button type="submit" class="btn btn-primary mb-2">Search</button>
      </form>

      @if (!empty($locations) && count($locations))
        <div class="card mt-5">
          <div class="card-body">
            <table class="table table-bordered table-hover">
              <thead>
                <th scope="col">Name</th>
                <th scope="col">Type</th>
                <th scope="col" class="col-coord">X:</th>
                <th scope="col" class="col-coord">Y:</th>
                <th scope="col" class="col-coord">Z:</th>
                <th scope="col">Actions:</th>
              </thead>

              <tbody>
                @foreach ($locations as $location)
                  @include('locations.show')
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

      @else
        <div class="card">
          <div class="card-body">
            No results found
          </div>
        </div>
      @endif

      <div class="mt-4 d-flex justify-content-center">
        {{ $locations->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
