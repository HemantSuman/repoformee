<div class="box-body table-responsive no-padding box box-primary">                  
    <table class="table table-hover table-bordered">
        <tr>
            <th>Classified ID</th>
            <th>Classified Name</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Total Views</th>
            <th>Status</th>
            <th>Added Date</th>
        </tr>

        @if($data)
            @foreach($data as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ ($value->title) }}</td>
                <td>{{ $value->categoriesname['name']}}</td>
                <td>
                    @if($value->subcategoriesname['name'])
                        {{ $value->subcategoriesname['name'] }}
                    @endif
                </td>
                <td>{{ ($value->count) }}</td>
                <td>
                    <span class="label label-<?php if ($value->status == 0) { ?>danger<?php } else { ?>success<?php } ?>">
                        @if($value->status==0) Inactive @else Active @endif</span>
                </td>
                <td>{{@date('d-M-Y',strtotime($value->created_at))}}</td>
            </tr>
            @endforeach
        @else
            <tr><td></td></tr>
        @endif   
    </table>
</div>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        
        {!! $data->render() !!}
    </ul>
</div>