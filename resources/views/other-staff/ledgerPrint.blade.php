<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Other Staff Payment Ledger</title>

    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 12px;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .school-name {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .school-address {
            font-size: 13px;
            margin-top: 3px;
        }

        .ledger-title {
            margin-top: 12px;
            font-size: 15px;
            font-weight: bold;
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
        }

        .text-right {
            text-align: right;
        }

        .total-row {
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }

        .signature {
            text-align: center;
            width: 30%;
        }

        @media print {
            body {
                margin: 0;
            }
        }
    </style>
</head>

<body onload="window.print()">

    {{-- Header --}}
    <div class="header">
        <div class="school-name">
            {{ $profile->schoolname ?? '' }}
        </div>
        <div class="school-address">
            {{ $profile->address ?? '' }}
        </div>

        <div class="ledger-title">
            Other Staff Payment Ledger
        </div>
    </div>

    @if($payment_detail->isEmpty())
        <p>No payment records available.</p>
    @else

    @php
        $totalPaid = 0;
    @endphp
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
    <table>
        <thead>
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
                    <td>{{ $payment->academic_year }}</td>
                    <td>{{ \Carbon\Carbon::parse($payment->paid_from)->format('Y-m-d') }}</td>
                    <td>{{ \Carbon\Carbon::parse($payment->paid_to)->format('Y-m-d') }}</td>
                    <td>{{ number_format($payment->total_paid_amount, 2) }}</td>
                    <td>{{ number_format($payment->due_amount, 2) }}</td>
                    <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr class="total-row">
                <td colspan="4" class="text-right">Total Paid</td>
                <td>{{ number_format($totalPaid, 2) }}</td>
                <td colspan="2"></td>
            </tr>
        </tfoot>
    </table>

    {{-- Footer --}}
    <div class="footer">
        <!-- <div class="signature">
            ________________________<br>
            Prepared By
        </div>

        <div class="signature">
            ________________________<br>
            Checked By
        </div> -->

        <div class="signature">
            ________________________<br>
            Approved By
        </div>
    </div>

    @endif

</body>
</html>
