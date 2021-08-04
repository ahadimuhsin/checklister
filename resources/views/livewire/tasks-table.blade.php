<table class="table table-responsive-sm" wire:sortable="updateTaskOrder">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
        <tr wire:sortable.item="{{ $task->id }}" wire:key="task-{{ $task->id }}">
            <td>{{ $task->name }}</td>
            <td>{!! $task->description !!}</td>
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
