<x-admin-master>
    @section('content')
    @if(Session('permission_up'))
    <div class="alert alert-danger">
        {{session('permission_up')}}
        @endif
    </div>
    <h1> Edit Permission : {{$permission->name}} </h1>

    <div class="row">
    <div class="col-sm-6">

        <form method="POST" action="{{route('permissions.update',$permission->id)}}" >
        @csrf
        @method('PUT')
        <div class="form-group">
          <label  for="name" >Name </label>
        <input type="text" name="name" class="form-control" id="name" value="{{$permission->name}}"  >

        </div>
        <button class="btn btn-primary" > Update </button>
      </form>
       </div>
    </div>

    @endsection
    </x-admin-master>


