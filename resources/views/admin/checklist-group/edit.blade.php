@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.checklist-groups.update', $checklist_group->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="card-header">{{ __('Edit Checklist Group') }}</div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name">{{ __('Name') }}</label>
                                            <input class="form-control" id="name" name="name" type="text"
                                                value="{{ $checklist_group->name }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-sm btn-primary" type="submit"> {{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>

                    <form action="{{ route('admin.checklist-groups.destroy', $checklist_group->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-danger" type="submit"
                        onclick="return confirm('{{ __('Are you sure?') }}')"> {{ __('Delete This Checklist Group') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
