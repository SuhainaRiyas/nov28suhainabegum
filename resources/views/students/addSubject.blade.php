@extends('layouts.dashboard')

@section('title')
<title>Students List</title>
@endsection

@section('content')

<section class="user  mt-5">
      <div class="order_boxes">
        <div class="row">
          <div class="col-lg-12 col-lx-12">
            <div class="order-info">
              <h4 class="text-center pb-4">Add Subject</h4>
              <form name="add_name" id="add_name" method="post" >  
              <table class="table" id="dynamicAddRemove">
                <thead>
                  <tr>
                    <th>S.No.</th>
                    <th>Subject Name</th>
                    <th>Marks Scored</th>
                    <th>Grade</th>              
                    <th>Remove</th>
                  </tr>
                </thead>

                <tbody id="items">
              		<input type="hidden" name="student_id"  value="{{$id}}">
                  <?php foreach ($subjects as $i => $value) {  ?>
                    <tr id="{{$i}}"> 
                    <input type="hidden" name="moreFields[{{$i}}][subject_id]" id="subject_id-{{$i}}" value="{{$value->id}}">                     
                      <td class="sno">{{$i+1}}</td>
                       <td>
                    	<input type="text" name="moreFields[{{$i}}][subject]" id="subject-{{$i}}" data-id="{{$i}}" placeholder="Enter Subject Name" class="form-control" value="{{$value->subject_name}}" />
                       
                      </td>
                       <td>
                           <input type="text" name="moreFields[{{$i}}][marks]" id="marks-{{$i}}" data-id="{{$i}}"  placeholder="Enter Marks" class="form-control" value="{{$value->marks}}" />
                      </td>
                       <td>
                          <input type="text" name="moreFields[{{$i}}][grade]" id="grade-{{$i}}" data-id="{{$i}}"  placeholder="Enter Grade" class="form-control" value="{{$value->grade}}" />                      
                      </td>
                      
                       <td><button id="" data-id="{{$i}}" type="submit" class="remove-tr btn btn-danger"><i class="fa fa-trash"></i></button></td>
                       <!--  <span class="quanterror text-danger"></span> -->
                    </tr>
                   <?php }  ?> 
               </tbody>
               
               
              </table>
              <div class="row">
                <div class="col-6">
                     <button type="button" name="add" id="add-btn" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add more rows</button>
                </div>                 
              </div>
              <span class="text-danger text-right" id="error"></span> 
              <div class="text-right mt-3">
                
              		<a href="javascript:history.back()" class="btn btn-warning" id="back"><i class="fa fa-caret-left"></i> Back</a>              
                    <button class="btn btn-primary" id="savebtn"><i class="fa fa-save"></i> Save</button>
              </div>
              </form>
 
            </div>
          </div>
        </div>
      </div>
        
</section>

@endsection

@section('script')

<script type="text/javascript">

	
$("#add-btn").click(function(){
  $('#error').text('').hide();
	var i=$('#items tr:last').attr('id');  
	//var i=$('#items tr').length;  
	if(isNaN(i)) {
	    i = 0;
	}else{
	  ++i;
	}

	var output = '<tr id="'+i+'">';
	var sno = i+1;
	output += '<td class="sno">'+sno+'</td> <td><input type="text" name="moreFields['+i+'][subject]" placeholder="Enter Subject" data-id="'+i+'" id="subject-'+i+'" class="form-control" /></td> <td><input type="text" name="moreFields['+i+'][marks]" placeholder="Enter Marks scored"  data-id="'+i+'" id="marks-'+i+'" class="form-control" /></td> <td><input type="text" name="moreFields['+i+'][grade]" placeholder="Enter Grade" data-id="'+i+'" id="grade-'+i+'" class="form-control" /></td> <td><button type="button" class="btn btn-danger remove-tr"><i class="fa fa-trash"></i></button></td> </tr>'; 

	$("#dynamicAddRemove").append(output);
               
});

$(document).on('click', '.remove-tr', function(){  
	$(this).parents('tr').remove(); 
	SetSno(); 
});

var SetSno = function(){
        var SNo = $(document).find('.sno');
        var i = 1;
        SNo.each(function(){
            $(this).html(i);
            i++;            
        });      
    }
$("body").on("keyup", "[id^='marks-']", function(e){
  let id = $(this).attr('data-id');
  var reg = /^\d+$/;
  var mark = $('#marks-'+id).val();
  var match = reg.test(mark);
  if(!match){
    $('#error').text('* Please enter numbers').show();
    $('#savebtn').attr('disabled',true);
  }else{
    $('#error').text('').hide();
    $('#savebtn').attr('disabled',false);
  }
});

    $('#savebtn').click(function(e){ 
        e.preventDefault();  
         
            var data=$('#add_name').serialize();
            var str = 'moreFields';
            
            if(data.indexOf(str) != -1){
              $('#error').text('').hide();
            }else{
                $('#error').text('* Please add data to save').show();
                return false;
            }

             $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
             });          
             $.ajax({  
                  url:"{{url('subjectstore')}}",  
                  method:"POST",  
                  data:data,               
                  success:function(data)  
                  {
                    if(data == 'success'){
                      window.location.href= '{{url("students")}}';
                    }else{
                      $('#error').text('* '+data).show();
                    } 
                      
                  }   
             });  
        
      }); 

</script>


@endsection