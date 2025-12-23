@extends('layouts.master')

@section('content')
<div class="row">
  <div class="col-lg-12">

    <div class="card">
      <div class="card-header bg-primary text-white">
        Student Fee Ledger
      </div>

      <div class="card-body">

        {{-- ================= STUDENT INFO ================= --}}
        @if($ledgerPayments->count())
          @php
            $student = $ledgerPayments->first()->student;
          @endphp

          <div class="row mb-3">
            <div class="col-md-4">
              <strong>Name:</strong> {{ $student->student_full_name }}
            </div>
            <div class="col-md-4">
              <strong>Grade:</strong> {{ $student->student_enrollment_class }}
            </div>
            <div class="col-md-4">
              <strong>Academic Year:</strong> {{ $ledgerPayments->first()->academic_year }}
            </div>
          </div>
        @endif

        <a href="{{ route('paid-student-details-ledgerPrint', $ledgerPayments->first()->student_id) }}"
            target="_blank"
            class="btn btn-primary">
            <i class="fa fa-print"></i> Print Ledger
        </a>


        {{-- ================= LEDGER TABLE ================= --}}
        <table class="table table-bordered table-striped">
          <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>Payment Date</th>
              <th>Payment From</th>
              <th>Payment To</th>
              <th class="text-right">Paid Amount</th>
              <th class="text-right">Due Amount</th>
            </tr>
          </thead>
          <tbody>
            @php
              $totalPaid = 0;
              $lastDue   = 0;
            @endphp

            @forelse($ledgerPayments as $key => $payment)
              @php
                $totalPaid += $payment->total_paid_amount;
                $lastDue = $payment->due_amount;
              @endphp

              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d M Y') }}</td>
                <td>{{ $payment->payment_from_date }}</td>
                <td>{{ $payment->payment_to_date }}</td>
                <td class="text-right text-success">
                  {{ number_format($payment->total_paid_amount, 2) }}
                </td>
                <td class="text-right text-danger">
                  {{ number_format($payment->due_amount, 2) }}
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center text-muted">
                  No payment records found.
                </td>
              </tr>
            @endforelse
          </tbody>

          {{-- ================= SUMMARY ================= --}}
          @if($ledgerPayments->count())
          <tfoot class="bg-light font-weight-bold">
            <tr>
              <td colspan="4" class="text-right">Total Paid</td>
              <td class="text-right text-success">
                {{ number_format($totalPaid, 2) }}
              </td>
              <td></td>
            </tr>
            <tr>
              <td colspan="4" class="text-right">Current Due</td>
              <td></td>
              <td class="text-right text-danger">
                {{ number_format($lastDue, 2) }}
              </td>
            </tr>
          </tfoot>
          @endif
        </table>

        {{-- ================= BACK BUTTON ================= --}}
        <a href="{{ route('paid-student-details') }}" class="btn btn-secondary">
          <i class="fa fa-arrow-left"></i> Back
        </a>

      </div>
    </div>

  </div>
</div>
@endsection
