@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @include('locations.errors')

      <div class="d-flex justify-content-between location-filters">
        <form action="{{ route('locations.index') }}" method="GET">
          <label>
            Search by name:
            <input type="text" name="search-term" class="form-control">
          </label>
        </form>

        <form action="{{ route('locations.index') }}" class="form-search-position" method="GET">
          Search by position:
          <br>

          <label>
            X-min:
            <input type="text" name="x-min" class="form-control">
          </label>

          <label>
            X-max:
            <input type="text" name="x-max" class="form-control">
          </label>

          <label>
            Y-min:
            <input type="text" name="y-min" class="form-control">
          </label>

          <label>
            Y-max:
            <input type="text" name="y-max" class="form-control">
          </label>

          <label>
            Z-min:
            <input type="text" name="z-min" class="form-control">
          </label>

          <label>
            Z-max:
            <input type="text" name="z-max" class="form-control">
          </label>
        </form>

        <a href="{{ route('locations.create') }}" class="d-block btn btn-success mb-2">Create New</a>
      </div>

      @if (!empty($locations) && count($locations))
        @foreach ($locations as $location)
          @include('locations.show')
        @endforeach
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
