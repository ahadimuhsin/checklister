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

                    <form
                        action="{{ route('admin.checklist-groups.checklists.update', [$checklist_group, $checklist]) }}"
                        method="post">
                        @csrf
                        @method('put')
                        <div class="card-header">{{ __('Edit Checklist') }}</div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input class="form-control" id="name" name="name" type="text"
                                            value="{{ $checklist->name }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button class="btn btn-sm btn-primary" type="submit"> {{ __('Save') }}</button>
                        </div>
                    </form>
                </div>

                <form action="{{ route('admin.checklist-groups.checklists.destroy', [$checklist_group, $checklist]) }}"
                    method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-sm btn-danger" type="submit"
                        onclick="return confirm('{{ __('Are you sure?') }}')">
                        {{ __('Delete This Checklist') }}</button>
                </form>

                <hr>

                <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i> List of Tasks</div>
                    <div class="card-body">
                        <table class="table table-responsive-sm">
                            <tbody>
                                @foreach ($checklist->tasks as $task)
                                <tr>
                                    <td>{{ $task->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.checklists.tasks.edit', [$checklist, $task]) }}"
                                        class="btn btn-sm btn-warning">{{ __('Edit') }}</a>
                                        <form style="display: inline-block"
                                            action="{{ route('admin.checklists.tasks.destroy', [$checklist, $task]) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-danger" type="submit"
                                                onclick="return confirm('{{ __('Are you sure?') }}')">
                                                {{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <hr>
                {{-- Task Card --}}
                <div class="card">
                    @if ($errors->storetask->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->storetask->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('admin.checklists.tasks.store', [$checklist]) }}" method="post">
                        @csrf
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> New Task
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input class="form-control" id="name" name="name" type="text"
                                            value="{{ old('name') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">{{ __('Descirption') }}</label>
                                        <textarea class="form-control" id="description" name="description"
                                            rows="5">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button class="btn btn-sm btn-primary" type="submit"> {{ __('Save Task') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
