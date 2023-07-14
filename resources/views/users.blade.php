@extends('theme.default')


@section('content')

<div class="row">

    <div class="col-lg-12">

        <h1 class="page-header">Users</h1>

    </div>

</div>


<table class="table table-striped table-bordered table-hover">

    <thead>

        <tr>

            <th>#</th>

            <th>First Name</th>

            <th>Last Name</th>

            <th>Username</th>

        </tr>

    </thead>

    <tbody>

        <tr>

            <td>1</td>

            <td>Mehul</td>

            <td>Bagda</td>

            <td>@mdo</td>

        </tr>

        <tr>

            <td>2</td>

            <td>Vishal</td>

            <td>Panshuriya</td>

            <td>@fat</td>

        </tr>

        <tr>

            <td>3</td>

            <td>Piyush</td>

            <td>Kamani</td>

            <td>@twitter</td>

        </tr>

    </tbody>

</table>


@endsection