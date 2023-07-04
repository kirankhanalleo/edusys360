@php
    $admission_fee = App\Models\FeeCategoryAmount::where('fee_category_id', '2')->where('class_id', $data->class_id)->first();
    $grossFee = $admission_fee->amount;
    $discountPercent = $data['getStudentDiscount']['discount'];
    $discountAmount = ($discountPercent / 100) * $grossFee;
    $netFee = (float)$grossFee - (float)$discountAmount;
@endphp 
<head>
    <title>{{ $data['getStudent']['name'] }} - Payment Receipt</title>
</head>
<body>
    <!--STUDENTS COPY-->
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
            <h3>PAYMENT RECEIPT</h3>
        </div>
        <div class="ReceiptBody">
            <div class="StudentDetails">
                <table>
                    <tr>
                        <td width="75%;"><b>Student's Name:</b> {{ $data['getStudent']['name'] }}</td>
                        <td><b>Reg. No:</b> {{ $data['getStudent']['reg_id'] }}</td>
                    </tr>
                    <tr>
                        {{ $nepali_date = Carbon\Carbon::now('Asia/Kathmandu'); }}
                        <td><b>Bill Date: </b>{{ $nepali_date->format('d/m/Y') }}</td>
                        <td><b>Batch:</b> {{ $data['getStudentYear']['name'] }}</td>
                    </tr>
                    <tr>
                        <td><b>Class:</b> {{ $data['getStudentClass']['name'] }}</td>
                        <td><b>Month: </b>{{ $month }}</td>
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
                            <td width="85%;" style="text-align: left; padding-left:10px;">Monthly Fee</td>
                            <td>{{ $grossFee }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right;"><b>Total Amount</b> </td>
                            <td>{{ $grossFee }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right;"><b>Scholorship @ {{ $discountPercent }}%</b></td>
                            <td>{{ $discountAmount }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right;"><b>Net Amount</b></td>
                            <td>{{ $netFee }}</td>
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
                    Once the payment is made, please be informed that the amount will not be eligible for a refund.
                </small>
            </div>
        </div>
    </div>
    <hr class="dashed">
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
            <h3>INCOME RECEIPT</h3>
        </div>
        <div class="ReceiptBody">
            <div class="StudentDetails">
                <table>
                    <tr>
                        <td width="75%;"><b>Student's Name:</b> {{ $data['getStudent']['name'] }}</td>
                        <td><b>Reg. No:</b> {{ $data['getStudent']['reg_id'] }}</td>
                    </tr>
                    <tr>
                        {{ $nepali_date = Carbon\Carbon::now('Asia/Kathmandu'); }}
                        <td><b>Bill Date: </b>{{ $nepali_date->format('d/m/Y') }}</td>
                        <td><b>Batch:</b> {{ $data['getStudentYear']['name'] }}</td>
                    </tr>
                    <tr>
                        <td><b>Class:</b> {{ $data['getStudentClass']['name'] }}</td>
                        <td><b>Month: </b>{{ $month }}</td>
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
                            <td width="85%;" style="text-align: left; padding-left:10px;">Monthly Fee</td>
                            <td>{{ $grossFee }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right;"><b>Total Amount</b> </td>
                            <td>{{ $grossFee }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right;"><b>Scholorship @ {{ $discountPercent }}%</b></td>
                            <td>{{ $discountAmount }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right;"><b>Net Amount</b></td>
                            <td>{{ $netFee }}</td>
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
                    Once the payment is made, please be informed that the amount will not be eligible for a refund.
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
        margin:-0.5rem 16rem;
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