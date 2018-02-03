<div class="box-body table-responsive no-padding box box-primary">                  
    <table class="table table-hover table-bordered">
        <tr>
            
            <th>Category</th>
            <th>Keyword</th>
        </tr>

        @if($data)
            @foreach($data as $key => $value)
            <tr>
                <td>{{ $value->name }}</td>
                <td>{{ $value->keyword }}</td>
                
            </tr>
            @endforeach
        @else
            <tr><td></td></tr>
        @endif   
    </table>
</div>