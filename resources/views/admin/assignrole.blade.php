@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Division Floor Access Assignment</div>
                @if(isset($alert))
                <div class="alert alert-warning" role="alert">{{ $alert }}</div>
                @endif
                <div class="card-body">
                  <form method="POST" action="{{ route('admin.addsr', [], false) }}">
                    @csrf
                    <!-- <h5 class="card-title">Staff access assignment</h5> -->
                    <!-- <div class="form-group row">
                        <label for="lob" class="col-md-4 col-form-label text-md-right">Group</label>
                        <div class="col-md-6">
                            <input id="lob" type="text" name="lob" maxlength="15" required autofocus>
                        </div>
                    </div> -->
                    <div class="form-group row">
                      <label for="pporgunit" class="col-md-4 col-form-label text-md-right">Division</label>
                      <div class="col-md-6">
                        <select class="form-control" id="pporgunit" name="pporgunit">
                          @foreach ($divlist as $atask)
                          <option value="{{ $atask['pporgunit'] }}" {{ $atask['sel'] }} >{{ $atask['divname'] . ' (' . $atask['regcount'] . ')' }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <h5 class="card-title">Select which floor to give access to this division</h5>
                    @foreach($blist as $abuild)
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="{{ $abuild['id'] }}" id="defaultCheck{{ $abuild['id'] }}" name="cbfloor[]">
                      <label class="form-check-label" for="defaultCheck{{ $abuild['id'] }}">
                        {{ $abuild['unit'] . ' -> ' . $abuild['floor_name'] . '@' . $abuild['building_name'] }}
                      </label>
                    </div>
                    @endforeach

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">Assign Staff</button>
                        </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
