<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>School Management System</title>
  <style type="text/css">
    :root {
      --bleeding: 0.5cm;
      --margin: 1cm;
    }
    @page {
      size: A4;
    }
    body {
      font-family: Kalimati, Georgia, serif;
      font-size:18px;
      margin: 0 auto;
      padding: 0;
      background: rgb(204, 204, 204);
      display: flex;
      flex-direction: column;
    }
    .page {
      display: inline-block;
      position: relative;
      width: 310mm;
      font-size: 18px;
      margin: 2em auto;
      padding: calc(var(--bleeding) + var(--margin));
      background:#fff;
    }
    @media screen {
      .page::after {
        position: absolute;
        content: '';
        top: 0;
        left: 0;
        width: calc(100% - var(--bleeding) * 2);
        height: calc(100% - var(--bleeding) * 2);
        margin: var(--bleeding);
        pointer-events: none;
        z-index: 9999;
        font-size: 18px;
      }
    }
    @media all {
      .rtable{ 
        width:100%;
        border-collapse: collapse;
        margin: 25px 0;
        font-size:18px;
      }
      .rtable th,
        .rtable td {
            border:1px solid #000;
            padding: 12px 15px;
        }
    }
  </style>
</head>
<body style="--bleeding: 0.5cm;--margin: 1cm;">
  <div class="page">
    <!-- <img src="{{ asset('assets/images/new_logo.png') }}" style="height: 100px; width: 140px; margin-top:0px;"> -->
    <div style="font-size: 32px;margin-left:400px;margin-top:-46px">{{ $row->schoolname }}</div>
    <div style="font-size: 20px;margin-left:452px;margin-top:-5px">{{ $row->slogan }}</div>
    <!-- <div style="margin-left: 420px;margin-top:10px;font-size: 20px;">{{ getProfile()->type == 1 ? 'गाउँकार्यपालिकाको कार्यालय' : 'नगरकार्यपालिकाको कार्यालय'}}</div> -->
    <div style="margin-left: 430px;margin-top:-1px;font-size: 14px;">{{getProfile()->address }}, {{ getProfile()->district .','. getProfile()->pradesh }}</div>
    @if(!empty(getProfile()->logo))
     <img src="{{ asset('storage/'.getProfile()->logo) }}" style="margin-left:890px;height:100px;margin-top:-70px;width:119px; height:100px;">
    @endif
    <div style="margin-top:20px; border-bottom:2px solid #000"></div>
    <div style="text-align:center; margin-top:30px;text-decoration:underline"><b>Teacher's Details</b></div>
    <div style="margin-top:5px;">
      <table class="rtable">
        <thead>
          <tr>
                <th>S.n.</th>
                <th>Full Name</th>
                <th>Teacher's Cit No.</th>
                <th>License No.</th>
                <th>PAN No. </th>
                <th>Contact No. </th>
                <th>Status </th>
            </tr>
        </thead>
        <tbody>
          @php $i = 1; @endphp
          @foreach($newdata as $key => $val)
          <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $val->teachers_name_eng }}</td>
            <td>{{ $val->teachers_citno }}</td>
            <td>{{ $val->teachers_teacher_licenseno }}</td>
            <td>{{ $val->teachers_panno }}</td>
            <td>{{ $val->teachers_mobno }}</td>
            <td><p class="btn btn-{{  $val->teacher_enroll_status == 1 ? 'success' : 'danger' }} btn-rounded btn-fw btn-sm">{{  $val->teacher_enroll_status == 1 ? 'Permanent' : 'Temporary' }}</p></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>   
</div><!--end of page-->
<script type="text/javascript">
  window.print();
</script>
</body>
</html>