@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Activity Category Management</div>
                <div class="card-body">
                  <form method="POST" action="{{ route('admin.addtt', [], false) }}">
                    @csrf
                    <h5 class="card-title">Add new category</h5>
                    <div class="form-group row">
                        <label for="descr" class="col-md-4 col-form-label text-md-right">Description</label>
                        <div class="col-md-6">
                            <input id="descr" class="form-control" type="text" name="descr" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="remark" class="col-md-4 col-form-label text-md-right">Remark</label>
                        <div class="col-md-6">
                          <textarea rows="3" class="form-control" id="remark" name="remark"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                          <input class="form-check-input" name="is_pbe" type="checkbox" value="yup" id="defaultCheck1">
                          <label class="form-check-label" for="defaultCheck1">Use Assigned P/BE</label>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">Add Activity Category</button>
                        </div>
                    </div>
                  </form>
                </div>
                <div class="card-header"> </div>
                <div class="card-body">
                  <h5 class="card-title">List of activity category</h5>
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Description</th>
                        <th scope="col">Remark</th>
                        <th scope="col">Is PBE</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($currtasklist as $atask)
                      <tr>
                        <td>{{ $atask['descr'] }}</td>
                        <td>{{ $atask['remark'] }}</td>
                        <td>{{ $atask['is_pbe'] }}</td>
                        <td><a href="{{ route('admin.deltt', ['taskid' => $atask['id']], false) }}">Remove</a></td>
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
