<table class="table table-striped table-bordered table-hover table-condensed" style="table-layout: fixed; ">
    <td>@lang('messages.url') </td>
    <?php
// $url = $auditt->url;
// $newUrl = str_replace("store?", $auditt->auditable_id, $url);
     ?>
    <td colspan="2"><a href="{{$auditt->url}}">{{$auditt->url}}</a></td>
  </tr>
  <tr>
    <th>ATRIBUTO</th>
    <th>ANTES</th>
    <th>DESPUÉS</th>
  </tr>
  @foreach($auditt->getModified() as $key => $value)
  <tr>
    <td><strong>@lang('messages.'.$key)</strong></td>
    <td style="word-wrap: break-word">{{$value["old"] or ''}}</td>
    <td style="word-wrap: break-word">{{$value["new"] or ''}}</td>
  </tr>
  @endforeach
</table>
