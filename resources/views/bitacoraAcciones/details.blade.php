<table class="table">
    <td>URL: </td>
    <td>{{$audit->url}}</td>
    <td></td>
  </tr>
  <tr>
    <th>ATRIBUTO</th>
    <th>ANTES</th>
    <th>DESPUÉS</th>
  </tr>
  <?php $au=$audit->getModified(); ?>
  @foreach($au as $key => $value)
  <tr>
    <td>{{$key}}</td>
    <td>{{$value["old"] or ''}}</td>
    <td>{{$value["new"] or ''}}</td>
  </tr>
  @endforeach
</table>
