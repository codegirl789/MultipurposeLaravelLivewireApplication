<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @if (Session::has('message'))
                <button type="button" class="btn btn-success toastrDefaultSuccess">
                    <i class="fas fa-check-circle mr-1"></i> Success!
                    {{ Session::get('message') }}
                </button>
            @endif

            {{-- @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>
                            <i class="fas fa-check-circle mr-1"></i> Error!</strong>
                        {{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endforeach
            @endif --}}

            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-end mb-2">
                        <button wire:click.prevent="AddNew" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus-circle mr-1"></i>
                            Add New User
                        </button>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="#" wire:click.prevent="edit({{ $user }})">
                                                    <i class="fas fa-edit mr-2"></i>
                                                </a>
                                                <a href="#"
                                                    wire:click.prevent="confirmUserRemoval({{ $user->id }})">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            {{ $users->links() }}
                        </div>
                    </div>

                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->



    <!-- Create / Edit Modal -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="formLabel" aria-hidden="true"
        data-backdrop="static" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateUser' : 'createUser' }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formLabel">
                            @if ($showEditModal)
                                <span>Edit User</span>
                            @else
                                <span>Add New User</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input type="text" wire:model.defer="state.name"
                                class="form-control @error('name') is-invalid @enderror" id="Name"
                                aria-describedby="NameHelp" placeholder="Enter Name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleEmail">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="exampleEmail" wire:model.defer="state.email" aria-describedby="emailHelp"
                                placeholder="Enter email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Password">Password</label>
                            <input type="password" wire:model.defer="state.password"
                                class="form-control @error('password') is-invalid @enderror" id="Password"
                                placeholder="Password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="ConfirmPassword">Confirm Password</label>
                            <input type="password" wire:model.defer="state.password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="ConfirmPassword" placeholder="Confirm Password">
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">

                            @if ($showEditModal)
                                <span><i class="fas fa-check-circle mr-1"></i> Save Changes</span>
                            @else
                                <span><i class="fas fa-check-circle mr-1"></i> Save</span>
                            @endif

                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog"
        aria-labelledby="confirmationModalLabel" aria-hidden="true" data-backdrop="static" wire:ignore.self>
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5>Delete User</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-danger" wire:click.prevent="deleteUser">
                        <i class="fas fa-trash mr-1"></i> Delete User
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
