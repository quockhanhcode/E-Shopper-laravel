@extends('admin_layout');
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê danh sách người dùng
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên User</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
            <th>Author</th>
            <th>Admin</th>
            <th>User</th>
            <th>Action</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_user as $key => $all_user)
        <form action="{{URL::to('assign-roles')}}" method="post">
        {{csrf_field()}}
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$all_user->admin_name}}</td>
            <td>
            {{$all_user->admin_email}}
            <input type="hidden" name="admin_email" value="{{$all_user->admin_email}}" >
            </td>
            <td>{{$all_user->admin_phone}}</td>
            <td>{{$all_user->admin_password}}</td>

            <td>  <input type="checkbox" name="author_roles" {{$all_user->hasRole('author') ? 'checked' : ''}}> </td>
            <td> <input type="checkbox" name="admin_roles" {{$all_user->hasRole('admin') ? 'checked' : ''}} > </td>
            <td> <input type="checkbox" name="user_roles" {{$all_user->hasRole('user') ? 'checked' : ''}} > </td>
            
            <td><span class="text-ellipsis">
            <button type="submit" class="btn btn-primary">Choose</button>
            </span></td>
          </tr>
          </form>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection