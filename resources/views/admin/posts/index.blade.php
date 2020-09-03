<x-admin-master>
@section('content')
<h1> all posts</h1>
@if(Session::has('message'))
{{Session::get('message')}}
@elseif(Session::has('messagecreate'))
{{Session::get('messagecreate')}}
@else
{{Session::get('update')}}
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>OWNER</th>
                      <th>TIILE</th>
                      <th>IMAGE</th>
                      <th>CREATE_AT</th>
                      <th>UPDATE_AT </th>
                      <th>DELETE</th>

                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>OWNER</th>
                        <th>TIILE</th>
                        <th>IMAGE</th>
                        <th>CREATE_AT</th>
                        <th>UPDATE_AT </th>
                        <th>DELETE</th>
                    </tr>
                  </tfoot>
                 <tbody>
                     @foreach ($posts as $post)


                     <tr>
                     <td>{{$post->id}}</td>
                     <td> {{$post->user->name}} </td>
                     <td><a href="{{route('post.edit',$post->id)}}" >{{$post->title}}</td>
                     <td> <div><img height="40px" src="{{$post->post_image}}" alt="" ></div></td>
                     <td>{{$post->created_at}}</td>
                     <td>{{$post->updated_at}}</td>

                     <td>
                        @can('view',$post)


                         <form method="post" action="{{route('post.destroy', $post->id)}}" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    @endcan


                                </td>

                     </tr>
                     @endforeach

                 </tbody>
                </table>
              </div>
            </div>
          </div>
        {{--  {{$posts->links()}}--}}
@endsection
@section('scripts')
  <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
      <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
@endsection
</x-admin-master>
