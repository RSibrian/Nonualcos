@if (Session::has('create'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">
            &times;
        </button>
        <ul>
            <li>
                {{Session::get('create')}}
            </li>
        </ul>
    </div>
@endif