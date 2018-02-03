
                    <table class="table table-hover table-bordered">
                        <tr> 
                            <th>{{ Form::checkbox('categoriesactionall', 1, null, ['id' => 'ckbCheckAll','class'=>' ckbCheckAll userchk']) }}</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile/Phone No.</th>
                                        
                        </tr>


                        @foreach($users as $key => $user)

                        <tr>
                            <td>{{ Form::checkbox('userid[]', $user->id, null, ['class' => 'field usercheckBoxClass']) }}</td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->mobile_no }}</td>
                            

                        </tr>   

                        @endforeach    

                        @if(sizeof($users)==0)
                        <tr><td colspan="7" style="text-align:center">no record found</td></tr>
                        @endif



                    </table>

              