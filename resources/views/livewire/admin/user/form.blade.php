<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        add new user
    </button>

    <!-- Modal -->
    <div wire:ignore.self class="modal modal-lg fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                        {{ $curentPage }} of {{ $totalPage }}
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form wire:submit="save">
                        @if ($curentPage === 1)
                            <div class="mb-3">
                                <input type="text" autofocus wire:model="form.name" class="form-control"
                                    placeholder="نام خود را وارد کنید">
                                @error('form.name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="text" wire:model="form.last_name" class="form-control"
                                    placeholder="نام خانوادگی خود را وارد کنید">
                                @error('form.last_name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        @elseif($curentPage === 2)
                            <div class="mb-3">
                                <input type="email" wire:model="form.email" class="form-control"
                                    placeholder="ایمیل خود را وارد کنید">
                                @error('form.email')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="file" wire:model="form.profile" class="form-control">
                                @error('form.profile')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        @else
                            <div class="mb-3">
                                <input type="text" wire:model="form.address" class="form-control"
                                    placeholder="ادس خورد را وارد کنید">
                                @error('form.address')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input wire:model="form.password" type="password" class="form-control"
                                    placeholder="رمز کاربر را وارد کنید">
                            </div>
                            @error('form.password')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                            <div class="mb-3">
                                <input wire:model="form.age" type="number" class="form-control"
                                    placeholder="سن کاربر را وارد کنید">
                            </div>
                            @error('form.age')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        @endif
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @if ($curentPage !== 1)
                        <button type="button" wire:click="previousPage" class="btn btn-danger">Previous</button>
                    @endif
                    @if ($curentPage !== 3)
                        <button type="button" wire:click="nextPage" class="btn btn-info">Next</button>
                    @else
                        <button type="button" wire:click="save" class="btn btn-success">Save</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
