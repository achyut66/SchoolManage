@extends('layouts.master')

@section('content')

@if ($message = Session::get('access'))
<div class="row">
    <div class="col-12">
        <div class="alert alert-fill-danger">
            <i class="fa fa-warning"></i> {{ $message }}
        </div>
    </div>
</div>
@endif

{{-- HEADER --}}
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <button class="button school-btn w-100">
            Welcome To School Management System ({{ $palikaProfile->schoolname }})
        </button>
    </div>
</div>

<hr>

{{-- STATS --}}
<div class="row">
    @php
        $stats = [
            ['icon'=>'fa-university','count'=>$tot_students,'label'=>'Total Students'],
            ['icon'=>'fa-user','count'=>$tot_steachers,'label'=>'Permanent Teachers'],
            ['icon'=>'fa-user','count'=>$tot_ateachers,'label'=>'Temporary Teachers'],
            ['icon'=>'fa-users','count'=>$tot_teachers,'label'=>'Total Teachers'],
        ];
    @endphp

    @foreach($stats as $s)
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <i class="fa {{ $s['icon'] }}" style="height:30px;"></i>
                <div class="text-center">
                    <h2>{{ $s['count'] }}</h2>
                    <p class="font-weight-bold mb-0">{{ $s['label'] }}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<hr>

                {{-- PIE CHART --}}
                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">

                        <div class="card">
                            <div class="card-header text-white" style="background-color:#041750;">
                                Students by Grade
                            </div>
                            <div class="card-body d-flex justify-content-center align-items-center" style="width:400px;margin-left:50px;">
                                <canvas id="studentPie"></canvas>
                            </div>
                            <!--  -->
                            <div class="card-body">
                                <canvas id="studentBar"></canvas>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header text-white" style="background-color:#041750;">
                                Teachers by Grade
                            </div>
                            <div class="card-body" style="width:400px;margin-left:50px;">
                                <canvas id="teacherPie"></canvas>
                            </div>
                            <!--  -->
                            <div class="card-body">
                                <canvas id="teacherBar"></canvas>
                            </div>
                        </div>

                    </div>
                </div>
                
                <!-- students table -->
                 <div class="row">
                 <div class="col-md-6">
  <div class="card">
    <div class="card-header text-center text-white" style="background-color:#041750;">
      Students Count (Grade / Section)
    </div>

    <div class="card-body p-0">
      <table class="table table-bordered mb-0">
        <thead class="">
          <tr>
            <th class="text-center" style="font-weight: bold;">Grade</th>
            <th class="text-center" style="font-weight: bold;">Section</th>
            <th class="text-center" style="font-weight: bold;">Students</th>
          </tr>
        </thead>

        <tbody>
          @php $studentGrandTotal = 0; @endphp

          @foreach($gradeSectionCounts as $grade => $sections)

            @php
              $gradeTotal = $sections->sum('total_students');
              $studentGrandTotal += $gradeTotal;
              $rowspan = count($sections) + 1; // +1 for total row
            @endphp

            @foreach($sections as $index => $row)
              <tr>
                {{-- Grade name only once --}}
                @if($index == 0)
                  <td rowspan="{{ $rowspan }}">
                    <strong>{{ $grade }}</strong>
                  </td>
                @endif

                <td>Section {{ $row->section }}</td>
                <td class="text-center">
                  {{ $row->total_students }}
                </td>
              </tr>
            @endforeach

            {{-- Grade total row --}}
            <tr class="bg-light font-weight-bold">
              <td class="text-right">Total</td>
              <td class="text-center">{{ $gradeTotal }}</td>
            </tr>

          @endforeach
        </tbody>

        <tfoot class=" font-weight-bold">
          <tr>
            <td colspan="2" class="text-right">Grand Total</td>
            <td class="text-center">{{ $studentGrandTotal }}</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<!-- ends here student table -->
 <!-- teachers table start here  -->
 <div class="col-md-6">
  <div class="card">
    <div class="card-header text-center text-white" style="background-color:#041750;">
      Teachers Count (Grade / Section)
    </div>

    <div class="card-body p-0">
      <table class="table table-bordered mb-0">
        <thead class="" style="font-weight: bold;">
          <tr>
            <th class="text-center" style="font-weight: bold;">Grade</th>
            <th class="text-center" style="font-weight: bold;">Section</th>
            <th class="text-center" style="font-weight: bold;">Teachers</th>
          </tr>
        </thead>

        <tbody>
          @php $teacherGrandTotal = 0; @endphp

          @foreach($gradeSectionCountsTeacher as $grade => $sections)

            @php
              $gradeTotal = $sections->sum('total_teachers');
              $teacherGrandTotal += $gradeTotal;
              $rowspan = count($sections) + 1;
            @endphp

            @foreach($sections as $index => $row)
              <tr>
                @if($index == 0)
                  <td rowspan="{{ $rowspan }}">
                    <strong>{{ $grade }}</strong>
                  </td>
                @endif

                <td>Section {{ $row->section }}</td>
                <td class="text-center">
                  {{ $row->total_teachers }}
                </td>
              </tr>
            @endforeach

            {{-- Grade total --}}
            <tr class="bg-light font-weight-bold">
              <td class="text-right">Total</td>
              <td class="text-center">{{ $gradeTotal }}</td>
            </tr>

          @endforeach
        </tbody>

        <tfoot class=" font-weight-bold">
          <tr>
            <td colspan="2" class="text-right">Grand Total</td>
            <td class="text-center">{{ $teacherGrandTotal }}</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
</div>
<!-- teachers table ends here -->

                {{-- TEACHERS TABLES --}}
                <div class="row">
                    @foreach([
                        ['title'=>'Permanent Teachers Profile','data'=>$sthai_teacher],
                        ['title'=>"Temporary Teacher's Profile",'data'=>$asthai_teacher]
                    ] as $table)
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-header cardhead">{{ $table['title'] }}</div>
                            <div class="card-body table-responsive">
                                @if($table['data']->isNotEmpty())
                                <div class="table-scroll">
                    <table class="table table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Profile</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($table['data'] as $i => $t)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>
                                    {{ $t->teachers_name_nep }} <br>
                                    <small>{{ $t->teachers_name_eng }}</small>
                                </td>
                                <td>{{ $t->teachers_mobno }}</td>
                                <td>
                                    <a href="{{ route('teachers-profile-detail',$t->id) }}"
                                      class="badge badge-success">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @else
                <div class="alert alert-warning">No data available</div>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection


@section('javascript')
{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<script>
const labels = @json($studentsByGrade->pluck('grade'));
const values = @json($studentsByGrade->pluck('total'));

const labels1 = @json($teachersByGrade->pluck('grade'));
const values1 = @json($teachersByGrade->pluck('total'));

new Chart(document.getElementById('studentPie'), {
    type: 'pie',
    data: {
        labels: labels,
        datasets: [{
            data: values
        }]
    },
    options: {
        responsive: true,
        plugins: {
            datalabels: {
                color: '#fff',
                font: { weight: 'bold', size: 13 },
                formatter: (value, ctx) => {
                    const data = ctx.chart.data.datasets[0].data;
                    const total = data.reduce((a,b)=>a+b,0);
                    const percent = ((value / total) * 100).toFixed(1);
                    return `${value} (${percent}%)`;
                }
            }
        }
    },
    plugins: [ChartDataLabels]
});
// for bar diagram
new Chart(document.getElementById('studentBar'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            data: values
        }]
    },
    options: {
        responsive: true,
        plugins: {
            datalabels: {
                color: '#fff',
                font: { weight: 'bold', size: 13 },
                formatter: (value, ctx) => {
                    const data = ctx.chart.data.datasets[0].data;
                    const total = data.reduce((a,b)=>a+b,0);
                    const percent = ((value / total) * 100).toFixed(1);
                    return `${value} (${percent}%)`;
                }
            }
        }
    },
    plugins: [ChartDataLabels]
});
// ends
new Chart(document.getElementById('teacherPie'), {
    type: 'pie',
    data: {
        labels: labels1,
        datasets: [{
            data: values1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            datalabels: {
                color: '#fff',
                font: { weight: 'bold', size: 13 },
                formatter: (value, ctx) => {
                    const data = ctx.chart.data.datasets[0].data;
                    const total = data.reduce((a,b)=>a+b,0);
                    const percent = ((value / total) * 100).toFixed(1);
                    return `${value} (${percent}%)`;
                }
            }
        }
    },
    plugins: [ChartDataLabels]
});
// teachers bar
new Chart(document.getElementById('teacherBar'), {
    type: 'bar',
    data: {
        labels: labels1,
        datasets: [{
            data: values1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            datalabels: {
                color: '#fff',
                font: { weight: 'bold', size: 13 },
                formatter: (value, ctx) => {
                    const data = ctx.chart.data.datasets[0].data;
                    const total = data.reduce((a,b)=>a+b,0);
                    const percent = ((value / total) * 100).toFixed(1);
                    return `${value} (${percent}%)`;
                }
            }
        }
    },
    plugins: [ChartDataLabels]
});
</script>
@endsection
