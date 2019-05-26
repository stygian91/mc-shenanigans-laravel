<tr data-url="{{ route('locations.update', [ $location->id ]) }}">
  <td>
    <input class="form-control" name="name" type="text" value="{{ $location->name }}">
  </td>

  <td>
    <select name="type" class="form-control">
      @foreach ($location_types as $location_type)
        <option value="{{ $location_type }}" @if ($location->type === $location_type) selected @endif>
          {{ ucfirst($location_type) }}
        </option>
      @endforeach
    </select>
  </td>

  <td>
    <input class="form-control" name="x" type="text" value="{{ $location->x }}">
  </td>

  <td>
    <input class="form-control" name="y" type="text" value="{{ $location->y }}">
  </td>

  <td>
    <input class="form-control" name="z" type="text" value="{{ $location->z }}">
  </td>

  <td>
      <button class="btn btn-success btn-update mr-3">Update</button>
      <button type="button" class="btn btn-danger btn-delete">Delete</button>
  </td>
</tr>
