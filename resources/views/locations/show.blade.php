<div class="card mt-4">
  <form class="form-update" action="{{ route('locations.update', [ $location->id ]) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="card-header d-flex justify-content-between">
      <label class="mx-3">
        Name: <input class="form-control" name="name" type="text" value="{{ $location->name }}">
      </label>

      <label>
        Type:
        <select name="type" class="form-control">
          @foreach ($location_types as $location_type)
            <option value="{{ $location_type }}" @if ($location->type === $location_type) selected @endif>
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
            <label class="d-block">
              X: <input class="form-control" name="x" type="text" value="{{ $location->x }}">
            </label>
          </div>

          <div class="col-sm">
            <label class="d-block">
              Y: <input class="form-control" name="y" type="text" value="{{ $location->y }}">
            </label>
          </div>

          <div class="col-sm">
            <label class="d-block">
              Z: <input class="form-control" name="z" type="text" value="{{ $location->z }}">
            </label>
          </div>
        </div>

        <div class="row">
          <button type="submit" class="btn btn-success btn-update mx-3">Update</button>
          <button type="button" class="btn btn-danger btn-delete">Delete</button>
        </div>
      </div>
    </div>
  </form>

  <form class="form-delete" action="{{ route('locations.delete', [$location->id]) }}" method="POST">
    @method('DELETE')
    @csrf
  </form>
</div>

