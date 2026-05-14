@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<!-- Cards -->
<div class="row">

    <div class="col-md-3 mb-4">
        <div class="card shadow border-0 bg-primary text-white card-box">
            <div class="card-body text-center">
                <i class="fas fa-users fa-3x mb-3"></i>
                <h3>150</h3>
                <p class="mb-0">Total Users</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card shadow border-0 bg-success text-white card-box">
            <div class="card-body text-center">
                <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                <h3>85</h3>
                <p class="mb-0">Orders</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card shadow border-0 bg-warning text-white card-box">
            <div class="card-body text-center">
                <i class="fas fa-rupee-sign fa-3x mb-3"></i>
                <h3>₹25K</h3>
                <p class="mb-0">Revenue</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card shadow border-0 bg-danger text-white card-box">
            <div class="card-body text-center">
                <i class="fas fa-chart-line fa-3x mb-3"></i>
                <h3>12</h3>
                <p class="mb-0">Reports</p>
            </div>
        </div>
    </div>

</div>

<!-- Table -->
<div class="card shadow border-0">

    <div class="card-header bg-white">
        <h5 class="mb-0 font-weight-bold">
            Recent Activities
        </h5>
    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-bordered table-hover mb-0">

                <thead class="thead-dark">

                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>

                </thead>

                <tbody>

                    <tr>
                        <td>1</td>
                        <td>Demo User</td>
                        <td>
                            <span class="badge badge-success">
                                Active
                            </span>
                        </td>
                        <td>{{ date('d M Y') }}</td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>John Doe</td>
                        <td>
                            <span class="badge badge-warning">
                                Pending
                            </span>
                        </td>
                        <td>{{ date('d M Y') }}</td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>
@endsection
