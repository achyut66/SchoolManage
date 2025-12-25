@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <strong>Other Staff Yearly Salary Payment</strong>
            </div>

            <div class="card-body">

                @php
                    $monthlySalary = $staff_detail->salary;
                    $totalYearly   = $monthlySalary * 12;

                    $alreadyPaid = $existingPayment->total_paid_amount ?? 0;
                    $dueAmount   = $existingPayment->due_amount ?? $totalYearly;
                @endphp

                {{-- Staff summary (TOP SECTION) --}}
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Staff Name : <span style="font-weight:bold;font-size:16px;">{{ $staff_detail->full_name }}</span></label>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Post : <span style="font-weight:bold;font-size:16px;">{{ $staff_detail->post }}</span></label>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Monthly Salary : <span style="font-weight:bold;font-size:16px;">{{ number_format($monthlySalary,2) }}</span></label>
                    </div>
                </div>

                <form action="{{ route('other-staff-payment') }}" method="POST">
                    @csrf

                    {{-- Required hidden fields --}}
                    <input type="hidden" name="staff_id" value="{{ $staff_detail->id }}">
                    <input type="hidden" name="staff_name" value="{{ $staff_detail->full_name }}">
                    <input type="hidden" name="staff_post" value="{{ $staff_detail->post }}">
                    <input type="hidden" name="staff_salary" value="{{ $monthlySalary }}">
                    <input type="hidden" name="academic_year" value="{{ $staff_detail->academic_year }}">

                    {{-- Calculated paid amount --}}
                    <input type="hidden" name="total_paid_amount" id="total_paid_amount">

                    {{-- Payment table --}}
                    <table class="table table-bordered text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Total Yearly Salary</th>
                                <th>Already Paid</th>
                                <th>Paid From</th>
                                <th>Paid To</th>
                                <th>Pay Now</th>
                                <th>Remaining Due</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <input class="form-control text-center" readonly
                                           value="{{ number_format($totalYearly,2) }}">
                                </td>

                                <td>
                                    <input class="form-control text-center" readonly
                                           value="{{ number_format($alreadyPaid,2) }}">
                                </td>

                                {{-- User input --}}
                                <td>
                                <input type="date"
                                    name="paid_from"
                                    value="{{ $existingPayment->paid_to ?? '' }}"
                                    class="form-control"
                                    required>

                                </td>

                                {{-- User input --}}
                                <td>
                                    <input type="date"
                                           name="paid_to"
                                           class="form-control"
                                           required>
                                </td>

                                {{-- User input --}}
                                <td>
                                    <input type="number"
                                           id="pay_now"
                                           class="form-control text-center"
                                           min="0"
                                           placeholder="Enter amount"
                                           {{ $dueAmount <= 0 ? 'disabled' : '' }}>
                                </td>

                                {{-- Auto calculated --}}
                                <td>
                                    <input type="text"
                                           name="due_amount"
                                           id="due_amount"
                                           class="form-control text-center"
                                           readonly
                                           value="{{ number_format($dueAmount,2) }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-end">
                        <button type="submit"
                                class="btn btn-success"
                                {{ $dueAmount <= 0 ? 'disabled' : '' }}>
                            Save Payment
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

{{-- Calculation Script --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const totalYearly = {{ $totalYearly }};
    const alreadyPaid = {{ $alreadyPaid }};

    const payNowInput = document.getElementById('pay_now');
    const dueInput = document.getElementById('due_amount');
    const totalPaidHidden = document.getElementById('total_paid_amount');

    totalPaidHidden.value = alreadyPaid;

    if (payNowInput) {
        payNowInput.addEventListener('input', function () {

            let payNow = parseFloat(this.value) || 0;

            if (payNow > (totalYearly - alreadyPaid)) {
                payNow = totalYearly - alreadyPaid;
                this.value = payNow;
            }

            let newTotalPaid = alreadyPaid + payNow;
            let remaining = totalYearly - newTotalPaid;

            dueInput.value = remaining.toFixed(2);
            totalPaidHidden.value = newTotalPaid.toFixed(2);
        });
    }
});
</script>
@endsection
