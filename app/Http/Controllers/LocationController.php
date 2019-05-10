<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use View;
use Illuminate\Database\Eloquent\Builder;

class LocationController extends Controller
{
    public function __construct()
    {
        // TODO:
        View::share('location_types', [
            'overworld',
            'nether',
            'end'
        ]);
    }

    public function index(Request $request)
    {
        $rules = [
            'x-min' => 'numeric|nullable',
            'x-max' => 'numeric|nullable',
            'y-min' => 'numeric|nullable',
            'y-max' => 'numeric|nullable',
            'z-min' => 'numeric|nullable',
            'z-max' => 'numeric|nullable',
            'search-term' => 'string|nullable',
            'filter-type' => 'string|nullable|in:all,overworld,nether,end',
        ];
        $request->validate($rules);

        $locations_query = Location::query();
        $locations_query = $this->filterByPosition($request, $locations_query);

        $term = $request->input('search-term');
        if ($term) {
            $locations_query->where('name', 'like', '%' . $term . '%');
        }

        $filter_type = $request->input('filter-type');
        if ($filter_type && strtolower($filter_type) !== 'all') {
            $locations_query->where('type', '=', $filter_type);
        }

        $locations = $locations_query->paginate(10);
        return view('locations.index', [
            'locations' => $locations,
            'term' => $term,
            'x_min' => $request->input('x-min'),
            'x_max' => $request->input('x-max'),
            'y_min' => $request->input('y-min'),
            'y_max' => $request->input('y-max'),
            'z_min' => $request->input('z-min'),
            'z_max' => $request->input('z-max'),
            'filter_type' => $filter_type,
        ]);
    }

    public function create(Request $request)
    {
        return view('locations.create', [
            'x' => $request->old('x'),
            'y' => $request->old('y'),
            'z' => $request->old('z'),
            'name' => $request->old('name'),
            'type' => $request->old('type'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:1',
            'x' => 'required|numeric',
            'y' => 'required|numeric',
            'z' => 'required|numeric',
            'type' => 'required|string|in:overworld,nether,end',
        ]);

        Location::create($request->all());
        return redirect(route('locations.index'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'string|min:1',
            'x' => 'numeric',
            'y' => 'numeric',
            'z' => 'numeric',
            'type' => 'string|in:overworld,nether,end',
        ]);

        $location->fill($request->all());
        $location->save();

        return redirect(route('locations.index'));
    }

    public function delete(Request $request, Location $location)
    {
        $location->delete();

        return redirect(route('locations.index'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'search-term' => 'required|string|min:1',
        ]);

        $term = $request->input('search-term');
        $locations = Location::where('name', 'like', '%' . $term . '%')
            ->paginate(10);
        return view('locations.index', ['locations' => $locations]);
    }

    protected function filterByPosition(Request $request, Builder $query)
    {
        $position_keys = [
            'x-min',
            'x-max',
            'y-min',
            'y-max',
            'z-min',
            'z-max',
        ];

        $constraints = $request->only($position_keys);
        $constraints = array_filter($constraints);
        $constraints = array_map('floatval', $constraints);

        foreach ($constraints as $constraint_name => $constraint) {
            $coordinate = substr($constraint_name, 0, 1);
            $constraint_type = substr($constraint_name, -3);
            $operator = ($constraint_type === 'min') ? '>=' : '<=';

            $query->where($coordinate, $operator, $constraint);
        }

        return $query;
    }
}
