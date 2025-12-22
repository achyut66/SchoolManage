@extends('layouts.master')

@section('content')
<div class="row">
  <div class="col-lg-12">

    <div class="card">
      <div class="card-header bg-dark text-white">
        Student Fee Payment
      </div>

      <div class="card-body">

        {{-- ================= STUDENT INFO ================= --}}
        <div class="row mb-3">
          <div class="col-md-4">
            <strong>Name:</strong> {{ $student_details->student_full_name }}
          </div>
          <div class="col-md-4">
            <strong>Grade:</strong> {{ $student_details->student_enrollment_class }}
          </div>
          <div class="col-md-4">
            <strong>Academic Year:</strong> {{ $student_details->academic_year }}
          </div>
        </div>

        {{-- ================= FEE BREAKDOWN ================= --}}
        @php
          $totalFee = $fee_setting->sum('fee_amount');
          $paidAmount = $payments->sum('total_paid_amount');
          $dueAmount = $totalFee - $paidAmount;
        @endphp

        <table class="table table-bordered">
          <thead class="thead-light">
            <tr>
              <th>Fee Name</th>
              <th class="text-right">Amount</th>
            </tr>
          </thead>
          <tbody>
            @foreach($fee_setting as $fee)
              <tr>
                <td>{{ $fee->fee_name }}</td>
                <td class="text-right">{{ number_format($fee->fee_amount, 2) }}</td>
              </tr>
            @endforeach
            <tr class="bg-light">
              <th>Total Fee</th>
              <th class="text-right">{{ number_format($totalFee, 2) }}</th>
            </tr>
          </tbody>
        </table>

        {{-- ================= PAYMENT FORM ================= --}}
        <form action="" method="POST">
          @csrf

          {{-- hidden --}}
          <input type="hidden" name="student_id" value="{{ $student_details->id }}">
          <input type="hidden" name="academic_year" value="{{ $student_details->academic_year }}">
          <input type="hidden" name="grade" value="{{ $student_details->student_enrollment_class }}">

          <div class="row">
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

          <div class="row mt-3">
            <div class="col-md-4">
              <label>Payment From</label>
              <input type="date"
                     name="payment_from_date"
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
              <label>Admission Date</label>
              <input type="date"
                     name="admission_date"
                     class="form-control">
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
  document.getElementById('payAmount').addEventListener('input', function () {
    let totalFee = {{ $totalFee }};
    let paidTillNow = {{ $paidAmount }};
    let currentPay = parseFloat(this.value) || 0;

    let due = totalFee - (paidTillNow + currentPay);
    document.getElementById('dueAmount').value = due >= 0 ? due.toFixed(2) : 0;
  });
</script>
@endpush
