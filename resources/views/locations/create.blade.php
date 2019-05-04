@extends('layouts.app')

@section('content')
<div class="container">
  @include('locations.errors')

  <div class="card mt-4">
    <form class="form-update" action="{{ route('locations.store') }}" method="POST">
      @csrf

      <div class="card-header d-flex justify-content-between">
        <label class="mx-3">
          Name: <input class="form-control" name="name" type="text" value="{{ $name }}">
        </label>

        <label>
          Type:
          <select name="type" class="form-control">
            @foreach ($location_types as $location_type)
              <option value="{{ $location_type }}" @if ($location_type === $type) selected @endif>
                {{ ucfirst($location_type) }}
              </option>
            @endforeach
          </select>
        </label>
      </div>

      <div class="card-body">
        <div class="container">
          <div class="row">
            <div class="col-sm">
              <label>
                X: <input class="form-control" name="x" type="text" value="{{ $x }}">
              </label>
            </div>

            <div class="col-sm">
              <label>
                Y: <input class="form-control" name="y" type="text" value="{{ $y }}">
              </label>
            </div>

            <div class="col-sm">
              <label>
                Z: <input class="form-control" name="z" type="text" value="{{ $z }}">
              </label>
            </div>
          </div>

          <div class="row">
            <button type="submit" class="btn btn-success btn-create ml-3">Create</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
