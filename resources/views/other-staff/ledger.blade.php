@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <strong>Other Staff Payment Ledger</strong>
            </div>

            <div class="card-body">

                @if($payment_detail->isEmpty())
                    <div class="alert alert-warning">
                        No payment records found for this staff.
                    </div>
                @else

                @php
                    $totalPaid = 0;
                @endphp
                <a href="{{ route('other-staff-ledgerPrint', $payment_detail->first()->staff_id)}}" class="btn btn-primary">Print</a>
                <div class="table-responsive">
                @if($payment_detail->isNotEmpty())
<div class="row mb-4" style="margin-top:10px;">
    <div class="col-md-6">
        <label class="form-label fw-bold">
            Staff Name :
            <span style="font-weight:bold;font-size:16px;">
                {{ $payment_detail->first()->staff_name }}
            </span>
        </label>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">
            Post :
            <span style="font-weight:bold;font-size:16px;">
                {{ $payment_detail->first()->staff_post }}
            </span>
        </label>
    </div>
</div>
@endif

                    <table class="table table-bordered table-striped align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Academic Year</th>
                                <th>Paid From</th>
                                <th>Paid To</th>
                                <th>Paid Amount</th>
                                <th>Remaining Due</th>
                                <th>Payment Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($payment_detail as $key => $payment)
                                @php
                                    $totalPaid += $payment->total_paid_amount;
                                @endphp

                                <tr>
                                    <td>{{ $key + 1 }}</td>

                                    <td>
                                        {{ $payment->academic_year }}
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($payment->paid_from)->format('Y-m-d') }}
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($payment->paid_to)->format('Y-m-d') }}
                                    </td>

                                    <td class="text-success fw-bold">
                                        {{ number_format($payment->total_paid_amount, 2) }}
                                    </td>

                                    <td class="text-danger fw-bold">
                                        {{ number_format($payment->due_amount, 2) }}
                                    </td>

                                    <td>
                                        {{ $payment->created_at->format('Y-m-d') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        {{-- Footer totals --}}
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="4" class="text-end">Total Paid</th>
                                <th class="text-success fw-bold">
                                    {{ number_format($totalPaid, 2) }}
                                </th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                @endif

                <div class="text-end mt-3">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        Back
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
