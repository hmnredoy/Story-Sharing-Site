@extends('../layout.admin.dashboard')

@section('title', 'Members')

@section('rightbar')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
               <div class="panel panel-default">
                <div class="panel-heading">
                    Search Items
                    <span id="total_records"></span>
                </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <input class="form-control" placeholder="Search" name="search" id="search" type="text">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                    </tr>
                                </thead>

                                <tbody>
                              
                                </tbody>
                                
                            </table>
                        </div>
                    



               </div>
           </div>
       </div>





<script>
 $(document).ready(function(){

    fetch_user_data();

    function fetch_user_data(query = ''){

        $.ajax({
            url:"{{ route('search.member_search') }}",
            method:'GET',
            data:{query:query, _token:"{{csrf_token()}}"},
            dataType:'json'

            success:function(data){

                $('tbody').html(data.table_data);
                $('#total_records').text(data.total_data);
                
            }
        });
    }

    $(document).on('keyup', '#search', function(){
        var query = $(this).val();

        fetch_user_data(query);
    });



 });

</script>

@endsection