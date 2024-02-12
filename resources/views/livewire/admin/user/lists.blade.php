<div>
    {{ $users->links() }}
    <livewire:admin.user.form />
    <table class="table border text-center">
        <thead>
            <tr>
                <th scope="col">
                    @if ($selectAll or $userIds)
                        <button class="btn btn-danger btn-sm" wire:click="{{ $actionDelete }}">delete</button>
                    @else
                        select all 
                    @endif
                    <input style="vertical-align:middle;" class="form-check-input mt-0" wire:model.live="selectAll" type="checkbox" />
                </th>
                <th scope="col">Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr wire:key="{{ $user->id }}">
                    <th scope="col">
                        <div>
                            <input class="form-check-input mt-0" wire:model.change="userIds" type="checkbox"
                                value="{{ $user->id }}" />
                        </div>
                    </th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a class="btn btn-danger btn-sm" wire:confirm="جان حاجی مطمعنی؟ بعدا نگی ندونستمو فلان بهمان :/" wire:click="deleteRecord({{ $user->id }})">delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
