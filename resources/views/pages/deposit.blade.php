@extends('layouts.app', ['page' => __('Tables'), 'pageSlug' => 'deposit'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Simple Table</h4>
                            <p class="card-category"> Here is a subtitle for this table</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Time
                                    </th>
                                    <th>
                                        Salary
                                    </th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            Paid
                                        </td>
                                        <td>
                                            12:46 - 2023/10/9
                                        </td>
                                        <td class="text-primary">
                                            $36,738
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2
                                        </td>
                                        <td>
                                            Awaiting Payment
                                        </td>
                                        <td>
                                            12:46 - 2023/10/9
                                        </td>
                                        <td class="text-primary">
                                            $23,789
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            3
                                        </td>
                                        <td>
                                            Awaiting Payment
                                        </td>
                                        <td>
                                            12:46 - 2023/10/9
                                        </td>
                                        <td class="text-primary">
                                            $56,142
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            4
                                        </td>
                                        <td>
                                            Paid
                                        </td>
                                        <td>
                                            12:46 - 2023/10/9
                                        </td>
                                        <td class="text-primary">
                                            $38,735
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            5
                                        </td>
                                        <td>
                                            Paid
                                        </td>
                                        <td>
                                            12:46 - 2023/10/9
                                        </td>
                                        <td class="text-primary">
                                            $63,542
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            6
                                        </td>
                                        <td>
                                            Paid
                                        </td>
                                        <td>
                                            12:46 - 2023/10/9
                                        </td>
                                        <td class="text-primary">
                                            $78,615
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
