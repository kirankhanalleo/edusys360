@extends('admin.admin_master')
@section('admin')

<main>
    <!---Header Start -->
    @include('admin.body.header')
    <!---Header End ---->
    <div class="insights">
        <div class="students">
            <span class="material-symbols-sharp">person_add</span> 
            <div class="middle">
                <div class="left">
                    <h3>Total Students</h3>
                    <h1>900</h1>
                </div>
            </div> 
            <small class="text-muted">Academic Year 2080</small>  
        </div>
        <!-- END OF STUDENTS -->
        <div class="income">
            <span class="material-symbols-sharp">stacked_line_chart</span> 
            <div class="middle">
                <div class="left">
                    <h3>Total Income</h3>
                    <h1>Rs. 25000</h1>
                </div>
            </div> 
            <small class="text-muted">This Month</small>  
        </div>
        <!-- END OF INCOME -->
        <div class="expenses">
            <span class="material-symbols-sharp">bar_chart</span> 
            <div class="middle">
                <div class="left">
                    <h3>Total Expenses</h3>
                    <h1>Rs. 2500</h1>
                </div>
            </div> 
            <small class="text-muted">This Month</small>  
        </div>
        <!-- END OF EXPENSES -->
    </div>
    <!-- END OF INSIGHTS -->
    
    <div class="data-table">
        <h2>Recent Events</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Event</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Timestamp</th>
                    <th></th>
                </tr>
                <tbody>
                    <tr>
                        <td>Kiran Khanal</td>
                        <td>Received</td>
                        <td>Rs. 1700</td>
                        <td class="warning">Pending</td>
                        <td>April 29, 2023 12:09</td>
                        <td class="primary">Details</td>
                    </tr>
                    <tr>
                        <td>John Doe</td>
                        <td>Paid</td>
                        <td>Rs. 15000</td>
                        <td class="success">Success</td>
                        <td>April 29, 2023 12:09</td>
                        <td class="primary">Details</td>
                    </tr>
                </tbody>
            </thead>
        </table>
        <a href="#">Show All</a>
    </div>
</main>
<div class="right">
  <div class="school-analytics">
      <h2>School Analytics</h2>
      <div class="item students">
          <div class="icon">
              <span class="material-symbols-sharp">school</span>
          </div>
          <div class="right">
              <div class="info">
                  <h3>NEW STUDENTS</h3>
                  <small class="text-muted">Academic Year 2080</small>
              </div>
              <h5 class="success">+20%</h5>
              <h3>75</h3>
          </div>
      </div>
      <!--END OF STUDENTS -->
      <div class="item teachers">
          <div class="icon">
              <span class="material-symbols-sharp">supervisor_account</span>
          </div>
          <div class="right">
              <div class="info">
                  <h3>TOTAL TEACHERS</h3>
                  <small class="text-muted">Academic Year 2080</small>
              </div>
              <h5 class="success">+20%</h5>
              <h3>20</h3>
          </div>
      </div>
      <!--END OF TEACHERS -->
      <div class="item staffs">
          <div class="icon">
              <span class="material-symbols-sharp">groups</span>
          </div>
          <div class="right">
              <div class="info">
                  <h3>TOTAL STAFFS</h3>
                  <small class="text-muted">Academic Year 2080</small>
              </div>
              <h5 class="success">+20%</h5>
              <h3>10</h3>
          </div>
      </div>
      <!--END OF STAFFS -->
      <div class="item add-item">
          <div>
              <span class="material-symbols-sharp">add</span>
              <h3>Add Analytics</h3>
          </div>
      </div>
  </div>
</div>
@endsection