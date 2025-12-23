<!DOCTYPE html>
<html>
<head>
    <title>Student Fee Ledger</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
        }
        th {
            background: #f2f2f2;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .header {
            margin-bottom: 15px;
        }
    </style>
</head>
<body onload="window.print()">
@php
    $student = $ledgerPayments->first()->student;
    $totalPaid = 0;
    $currentDue = 0;
@endphp
<div>
<div style="text-align:center; margin-bottom:15px;">
    <h2 style="margin:0;">{{ $profile->schoolname }}</h2>
    <p style="margin:0;">
        {{ $profile->address }},
        {{ $profile->palika }},
        {{ $profile->district }},
        {{ $profile->pradesh }}
    </p>
    <p style="margin:0;">
        Phone: {{ $profile->phone_no }} |
    </p>

    @if($profile->slogan)
        <em>{{ $profile->slogan }}</em>
    @endif
</div>

<hr style="margin-bottom:15px;">

</div>
<div class="header">
    <h3 class="text-center">STUDENT FEE LEDGER</h3>
    <p><strong>Name:</strong> {{ $student->student_full_name }}</p>
    <p><strong>Grade:</strong> {{ $student->student_enrollment_class }}</p>
    <p><strong>Academic Year:</strong> {{ $ledgerPayments->first()->academic_year }}</p>
</div>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Payment From</th>
            <th>Payment To</th>
            <th class="text-right">Paid Amount</th>
            <th class="text-right">Due Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ledgerPayments as $key => $payment)
            @php
                $totalPaid += $payment->total_paid_amount;
                $currentDue = $payment->due_amount;
            @endphp
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d-m-Y') }}</td>
                <td>{{ $payment->payment_from_date }}</td>
                <td>{{ $payment->payment_to_date }}</td>
                <td class="text-right">{{ number_format($payment->total_paid_amount, 2) }}</td>
                <td class="text-right">{{ number_format($payment->due_amount, 2) }}</td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <th colspan="4" class="text-right">Total Paid</th>
            <th class="text-right">{{ number_format($totalPaid, 2) }}</th>
            <th></th>
        </tr>
        <tr>
            <th colspan="5" class="text-right">Current Due</th>
            <th class="text-right">{{ number_format($currentDue, 2) }}</th>
        </tr>
    </tfoot>
</table>

<div style="margin-bottom:10px;">
___________________
<p>Checked By:</p>
<p style="margin-top:20px;">
    <strong>Printed On:</strong> {{ now()->format('d M Y, h:i A') }}
</p>
</div>
</body>
</html>
