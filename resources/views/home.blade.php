@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Navigation</div>

                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('backup') }}" class="list-group-item list-group-item-action" title="Download a backup">
                            Download a backup
                        </a>

                        <a href="{{ route('locations.index') }}" class="list-group-item list-group-item-action" title="Manage locations">
                            Manage locations
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
