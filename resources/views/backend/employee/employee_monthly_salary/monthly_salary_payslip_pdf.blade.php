@php
   $date = date('Y-m', strtotime($employee_details['0']->date));
    if ($date != '') {
        $where[] = ['date', 'like', $date . '%'];
    }
    $attendance = App\Models\EmployeeAttendance::with(['getEmployee'])->where($where)->where('emp_id', $employee_details['0']->emp_id)->get();
    $absentDays = count($attendance->where('status', 'Absent'));
    $basicSalary = (float)$employee_details['0']['getEmployee']['salary'];
    $dailySalary = (float)$basicSalary / 30;
    $cutoffSalary = $absentDays * (float)$dailySalary;
    $payableSalary = (float)$basicSalary - (float)$cutoffSalary;
@endphp
<head>
    <title>{{ $employee_details['0']['getEmployee']['name'] }} - Salary Receipt</title>
</head>
<body>
    <!--EMPLOYEE COPY-->
    <div class="Receipt">
        <div class="ReceiptHeader">
            <div class="HeaderText">
                <p>
                    <span class="HeaderLargeText">
                        EDUS<span class="primary">YS360</span><br/>
                    </span>
                    <span class="HeaderSmallText">
                    A Complete School Management System
                    </span>
                </p>
            </div>
            <h3>SALARY RECEIVED RECEIPT</h3>
        </div>
        <div class="ReceiptBody">
            <div class="StudentDetails">
                <table>
                    <tr>
                        <td width="75%;"><b>Employee's Name:</b> {{ $employee_details['0']['getEmployee']['name'] }}</td>
                        <td><b>Emp. ID:</b> {{ $employee_details['0']['getEmployee']['emp_id'] }}</td>
                    </tr>
                    <tr>
                        {{ $nepali_date = Carbon\Carbon::now('Asia/Kathmandu'); }}
                        <td><b>Bill Date: </b>{{ $nepali_date->format('d/m/Y') }}</td>
                        <td><b>Month:</b> {{ $date }} </td>
                    </tr>
                </table>
                <table border="1" cellpadding="5" class="stripped-table">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th width="85%;">Particulars</th>
                            <th>Amount (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width>1</td>
                            <td width="85%;" style="text-align: left; padding-left:10px;">Salary for the month of {{ $date }}</td>
                            <td>{{ $basicSalary }}</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td style="text-align: left;  padding-left:10px;">Absent Days Salary Deduction ({{ $absentDays }} x {{ (int)$dailySalary }}) </td>
                            <td>{{(int)$cutoffSalary }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right;"><b>Total Amount</b></td>
                            <td>{{ (int) $payableSalary }}</td>
                        </tr>
                    </tbody>
                </table>
                <small>Generated on: {{ $nepali_date }}</small>
                <p style="text-align:right; font-size:12px;">
                    -----------------------------<br/>
                    User: {{ auth()->user()->name }}
                </p>
            </div>
            <div class="ReceiptFooter">
                <small>
                    <b>Remarks: </b><br/>
                    If you have any questions regarding this payment, please feel free to contact our account department within 2 working days.
                </small>
            </div>
        </div>
    </div>
    <hr class="dashed" style="margin-top: 4rem; margin-bottom: 4rem;">
    <!--SCHOOL COPY-->
    <div class="Receipt">
        <div class="ReceiptHeader">
            <div class="HeaderText">
                <p>
                    <span class="HeaderLargeText">
                        EDUS<span class="primary">YS360</span><br/>
                    </span>
                    <span class="HeaderSmallText">
                    A Complete School Management System
                    </span>
                </p>
            </div>
            <h3>SALARY PAYMENT RECEIPT</h3>
        </div>
        <div class="ReceiptBody">
            <div class="StudentDetails">
                <table>
                    <tr>
                        <td width="75%;"><b>Employee's Name:</b> {{ $employee_details['0']['getEmployee']['name'] }}</td>
                        <td><b>Emp. ID:</b> {{ $employee_details['0']['getEmployee']['emp_id'] }}</td>
                    </tr>
                    <tr>
                        {{ $nepali_date = Carbon\Carbon::now('Asia/Kathmandu'); }}
                        <td><b>Bill Date: </b>{{ $nepali_date->format('d/m/Y') }}</td>
                        <td><b>Month:</b> {{ $date }} </td>
                    </tr>
                </table>
                <table border="1" cellpadding="5" class="stripped-table">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th width="85%;">Particulars</th>
                            <th>Amount (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width>1</td>
                            <td width="85%;" style="text-align: left; padding-left:10px;">Salary</td>
                            <td>{{ $basicSalary }}</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td style="text-align: left;  padding-left:10px;">Absent Days Salary Deduction ({{ $absentDays }} x {{ (int)$dailySalary }}) </td>
                            <td>{{(int)$cutoffSalary }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right;"><b>Total Amount</b></td>
                            <td>{{ (int) $payableSalary }}</td>
                        </tr>
                    </tbody>
                </table>
                <small>Generated on: {{ $nepali_date }}</small>
                <p style="text-align:right; font-size:12px;">
                    -----------------------------<br/>
                    User: {{ auth()->user()->name }}
                </p>
            </div>
            <div class="ReceiptFooter">
                <small>
                    <b>Remarks: </b><br/>
                    If you have any questions regarding this payment, please feel free to contact our account department within 2 working days.
                </small>
            </div>
        </div>
    </div>
</body>

<style>
    .Receipt{
        margin-top: -1rem;
    }
    .HeaderText{
        text-align: center;
    }
    .HeaderLargeText{
        font-size: 2.5rem;
        letter-spacing: 1px;
        height:1rem;
        font-weight: bolder;
    }
    .primary{
        color:#2384B6;
    }
    .StudentDetails{
        margin-top: 1.4rem;
    }
    h3{
        text-align: center;
        color:white;
        background: #2384B6;
        height:1.5rem;
        padding-top:2px;
        margin:-0.5rem 13rem;
        font-size: 18px;
    }
    td{
        padding-bottom:0.5rem;
    }
    table.stripped-table{
        min-width: 100%;
        font-size: 1rem;
        text-align: center;
    }
    .dashed{
        border-top:2px dashed black;
        width:100%;
        margin:1rem 0rem;
    }
</style>