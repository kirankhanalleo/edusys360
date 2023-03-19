@extends('admin.admin_master')
@section('admin')

<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">  
<style>
  .add-user{
    position: absolute;
    right:20px;
    margin-top:20px;
  }
</style>
<div class="main-content">
  <div class="col-12">
    <div class="card">
      <a href="{{ route('assign.new.subject') }}" class="add-user btn rounded-pill btn-primary mb-5">Assign New Subject</a>
      <div class="card-header" style="padding-top:30px;">
        <h4>Viewing Assigned Subject</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <div id="table-1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="dataTables_length" id="table-1_length">
                  <label>
                    Show 
                    <select name="table-1_length" aria-controls="table-1" class="form-control form-control-sm">
                      <option value="10">10</option>
                      <option value="25">25</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
                    </select> 
                    entries
                  </label>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div id="table-1_filter" class="dataTables_filter">
                  <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="table-1"></label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-striped dataTable no-footer" id="table-1" role="grid" aria-describedby="table-1_info">
                  <thead>
                    <tr role="row">
                      <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1"  style="width: 10.698px;">S.N</th>
                      <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1"  style="width: 232.698px;">Class</th>
                      <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1"  style="width: 52.698px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!--fetching information as key and data-->
                    @foreach ( $allData as $key => $subject ) 
                    <tr role="row" class="odd">
                      <td class="sorting_1">{{ $key+1 }}</td>
                      <td>{{ $subject['student_class']['name']}}</td>
                      <td>
                        <a href="{{ route('edit.assigned.subject',$subject->class_id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('fee.amount.details',$subject->class_id) }}" class="btn btn-danger ml-1" onMouseOver="this.style.color='#FFFFFF'">Details</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-5">
                <div class="dataTables_info" id="table-1_info" role="status" aria-live="polite">
                  Showing 1 to {{ count($allData) }} of {{ count($allData) }} entries
                </div>
              </div>
              <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="table-1_paginate">
                  <ul class="pagination">
                    <li class="paginate_button page-item previous disabled" id="table-1_previous">
                      <a href="#" aria-controls="table-1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                    </li>
                    <li class="paginate_button page-item active">
                      <a href="#" aria-controls="table-1" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                    </li>
                    <li class="paginate_button page-item ">
                      <a href="#" aria-controls="table-1" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                    </li>
                    <li class="paginate_button page-item next" id="table-1_next">
                      <a href="#" aria-controls="table-1" data-dt-idx="3" tabindex="0" class="page-link">Next</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JS Libraies -->
<script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Page Specific JS File -->
<script src="{{ asset('assets/js/page/datatables.js') }}"></script>
@endsection
