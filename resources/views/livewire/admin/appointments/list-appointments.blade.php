<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Appointments</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Appointments</li>
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-end mb-2">
                        <a href="{{ route('admin.appointments.create') }}">
                            <button class="btn btn-primary btn-sm">
                                <i class="fas fa-plus-circle mr-1"></i>
                                Add New Appointment
                            </button>
                        </a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Client Name</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>cname</td>
                                        <td>date</td>
                                        <td>time</td>
                                        <td>status</td>
                                        <td>
                                            <a href="#">
                                                <i class="fas fa-edit mr-2"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fas fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            {{-- {{ $Appointments->links() }} --}}
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


    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog"
        aria-labelledby="confirmationModalLabel" aria-hidden="true" data-backdrop="static" wire:ignore.self>
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5>Delete Appointment</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Appointment?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-danger" wire:click.prevent="deleteAppointment">
                        <i class="fas fa-trash mr-1"></i> Delete Appointment
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
