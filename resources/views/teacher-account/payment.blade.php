@extends('layouts.master')

@section('content')
<div class="row">
  <div class="col-lg-12">

    <div class="card">
      <div class="card-header bg-dark text-white">
        Teachers Salary Payment
      </div>

      <div class="card-body">

        {{-- ================= TEACHERS INFO ================= --}}
        <div class="row mb-3">
          <div class="col-md-4">
            <strong>Name:</strong> {{ $student_details->teachers_name_eng }}
          </div>
          <div class="col-md-4">
            <strong>Grade:</strong> {{ $student_details->teaching_grade }}
          </div>
          <div class="col-md-4">
            <strong>Academic Year:</strong> {{ $student_details->academic_year }}
          </div>
        </div>

        {{-- ================= SALARY BREAKDOWN ================= --}}
        @php
    use Carbon\Carbon;

    $basicSalaryYearly = 0;
    $otherAllowancesTotal = 0;
    $calculatedFees = [];

    foreach ($fee_setting as $fee) {
        $feeName = trim(strtolower($fee->allowance_type));
        $amount = 0;

        if ($feeName === 'basic salary') {
            $basicSalaryYearly = $fee->allowance_amount * 12;
            $amount = $basicSalaryYearly;
        }
        elseif ($feeName === 'other allowances') {
            $amount = $fee->allowance_amount;
            $otherAllowancesTotal += $amount;
        }
        elseif ($feeName === 'examination charge') {
            $amount = $fee->allowance_amount * 4;
            $otherAllowancesTotal += $amount;
        }

        $calculatedFees[] = [
            'name'   => $fee->allowance_type,
            'amount' => $amount,
        ];
    }

    // ================= LEAVE DEDUCTION =================
    $allowedLeaveDays = 5;
    $extraLeaveDays = max($totalLeaveDays - $allowedLeaveDays, 0);

    $leaveDeduction = ($basicSalaryYearly / 365) * $extraLeaveDays;

    // ================= TDS (1% of Basic Salary) =================
    $tdsDeduction = $basicSalaryYearly * 0.01;

    // ================= TOTALS =================
    $totalAllowances = $basicSalaryYearly + $otherAllowancesTotal;
    $totalDeduction = $leaveDeduction + $tdsDeduction;
    $netSalary = $totalAllowances - $totalDeduction;

    $paidAmount = $totalPaid ?? 0;
    $dueAmount = max($netSalary - $paidAmount, 0);
@endphp


        <table class="table table-bordered">
          <thead class="thead-light">
            <tr>
              <th style="background-color:green;color:white;">Allowance Type</th>
              <th class="text-right" style="background-color:green;color:white;">Amount</th>
            </tr>
          </thead>
          <tbody>
            @foreach($calculatedFees as $fee)
              <tr>
                <td>{{ $fee['name'] }}</td>
                <td class="text-right">{{ number_format($fee['amount'], 2) }}</td>
              </tr>
            @endforeach

            <tr class="bg-light">
              <th>Total Allowances</th>
              <th class="text-right">{{ number_format($totalAllowances, 2) }}</th>
            </tr>
          </tbody>
          <thead class="thead-light">
            <tr>
              <th style="background-color:red;color:white;">Deductions (TDS / Extra-Leave) <span style="color:yellow;">&nbsp;Note: If Staff Has Used More Than 5 Days Of Leave Then Salary Will Deduct (As Per Day Basis) !!!</span><span style="font-weight:bold;text-white;">&nbsp;Your Leave Days : {{$totalLeaveDays}}</span></th>
              <th class="text-right" style="background-color:red;color:white;">Amount</th>
            </tr>
          </thead>
          <tbody>

            <tr>
                <td>
                    TDS (1% of Basic Salary)
                </td>
                <td class="text-right">
                    {{ number_format($tdsDeduction, 2) }}
                </td>
            </tr>

            <tr>
                <td>
                    Leave ({{ $extraLeaveDays }} extra days)
                </td>
                <td class="text-right">
                    {{ number_format($leaveDeduction, 2) }}
                </td>
            </tr>

            <tr class="bg-light">
                <th>Total Deduction</th>
                <th class="text-right">
                    {{ number_format($totalDeduction, 2) }}
                </th>
            </tr>

            <tr class="bg-dark text-white">
                <th>After Deduction Total Salary</th>
                <th class="text-right">
                    {{ number_format($netSalary, 2) }}
                </th>
            </tr>

          </tbody>
        </table>

        {{-- ================= PAYMENT FORM ================= --}}
        <form action="{{route('teachers-salary-payment-save')}}" method="POST">
          @csrf

          {{-- hidden --}}
          <input type="hidden" name="teachers_id" value="{{ $student_details->id }}">
          <input type="hidden" name="academic_year" value="{{ $student_details->academic_year }}">
          <input type="hidden" name="grade" value="{{ $student_details->teaching_grade }}">
          <input type="hidden" name="teachers_code" value="{{ $student_details->unique_id }}">

          <div class="row" style="margin-top:10px;">
            <div class="col-md-4">
              <label>Total Paid Till Date</label>
              <input type="text"
                     class="form-control"
                     value="{{ number_format($paidAmount, 2) }}"
                     readonly>
            </div>

            <div class="col-md-4">
              <label>Pay Amount</label>
              <input type="number"
                     step="0.01"
                     name="total_paid_amount"
                     id="payAmount"
                     class="form-control"
                     required>
            </div>

            <div class="col-md-4">
              <label>Due Amount</label>
              <input type="text"
                     name="due_amount"
                     id="dueAmount"
                     class="form-control"
                     value="{{ $dueAmount }}"
                     readonly>
            </div>
          </div>
          @php
            $date = optional($payments)->payment_to_date
                    ?? $student_details->created_at->format('Y-m-d');
          @endphp

          <div class="row mt-3">
            <div class="col-md-4">
              <label>Payment From</label>
              <input type="date"
                     name="payment_from_date"
                     value="{{ $date }}"
                     class="form-control"
                     required>
            </div>

            <div class="col-md-4">
              <label>Payment To</label>
              <input type="date"
                     name="payment_to_date"
                     class="form-control"
                     required>
            </div>

            <div class="col-md-4">
              <label>Enrollment Date</label>
              <input type="date"
                     name="enrollment_date"
                     value="{{ $student_details->created_at->format('Y-m-d') }}"
                     class="form-control"
                     readonly>
            </div>
          </div>

          <div class="mt-4">
            <button type="submit" class="btn btn-success">
              <i class="fa fa-money"></i> Save Payment
            </button>
          </div>

        </form>

      </div>
    </div>

  </div>
</div>
@endsection

{{-- ================= SCRIPT ================= --}}
@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const payInput = document.getElementById('payAmount');
    const dueInput = document.getElementById('dueAmount');

    if (!payInput || !dueInput) return;

    const totalFee = Number({{ $netSalary }});
    const paidTillNow = Number({{ $paidAmount }});


    payInput.addEventListener('input', function () {
      const currentPay = parseFloat(this.value) || 0;
      let due = totalFee - (paidTillNow + currentPay);

      if (due < 0) due = 0;

      dueInput.value = due.toFixed(2);
    });

  });
</script>
@endpush

