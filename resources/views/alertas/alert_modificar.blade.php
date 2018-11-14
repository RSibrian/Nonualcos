@if (Session::has('update'))
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">
            &times;
        </button>
    <ul>
            <li>
                {{Session::get('update')}}
            </li>
    </ul>
    </div>
@endif