<?php 
session_start();
session_regenerate_id();
?>
<!-- Latest minified bootstrap css -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

<!-- Latest minified bootstrap js -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- Button to trigger modal -->
<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
    Open Contact Form
</button>

<?php if(!isset($_COOKIE['userloggedin'])) {
 ?>
<!-- Modal -->
<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Contact Form</h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form">
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control" id="inputName" placeholder="Enter your name"/>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Enter your email"/>
                    </div>
                    <div class="form-group">
                        <label for="inputMessage">Password</label>
                        <textarea class="form-control" id="inputPassword" placeholder="Enter your pass"></textarea>
                    </div>
				</form>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
<?php } else 
{ ?>

<!-- Modal -->
<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Contact Form</h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form">
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Enter your email"/>
                    </div>
                    <div class="form-group">
                        <label for="inputMessage">Password</label>
                        <textarea class="form-control" id="inputPassword" placeholder="Enter your pass"></textarea>
                    </div>
				</form>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
				<button type="button" class="btn btn-default submitBtn" onclick="deleteAllCookies()">Clear Cookies</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitBtn" onclick="login()">LOGIN</button>
            </div>
        </div>
    </div>
</div>
<?php }?>
<script>
	
function deleteAllCookies() {
	$.ajax({
		type:'POST',
		url:'submitform.php',
		beforeSend: function () {
			$('.submitBtn').attr("disabled","disabled");
			$('.modal-body').css('opacity', '.5');
		},
		success:function(msg){
			if(msg == 'ok'){
				alert("cleared");
			}
		}
	});

}

function login(){
	
	var email = $('#inputEmail').val();
	var password = $('#inputPassword').val();

	$.ajax({
		type:'POST',
		url:'submitform.php',
		data:'frm=2&email='+email+'&pass='+password,
		beforeSend: function () {
			$('.submitBtn').attr("disabled","disabled");
			$('.modal-body').css('opacity', '.5');
		},
		success:function(msg){
			if(msg != null){
				alert('logged in successfully');
				location.replace(msg);
			}else{
				$('.statusMsg').html('<span style="color:red;">'+msg+'</span>');
			}
			$('.submitBtn').removeAttr("disabled");
			$('.modal-body').css('opacity', '');
		}
	});
    
}

function submitContactForm(){
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var name = $('#inputName').val();
    var email = $('#inputEmail').val();
	var password = $('#inputPassword').val();
    if(name.trim() == '' ){
        alert('Please enter your name.');
        $('#inputName').focus();
        return false;
    }else if(email.trim() == '' ){
        alert('Please enter your email.');
        $('#inputEmail').focus();
        return false;
    }else if(email.trim() != '' && !reg.test(email)){
        alert('Please enter valid email.');
        $('#inputEmail').focus();
        return false;
    }else if(message.trim() == '' ){
        alert('Please enter your message.');
        $('#inputMessage').focus();
        return false;
    }else{
        $.ajax({
            type:'POST',
            url:'submitform.php',
            data:'frm=1&name='+name+'&email='+email+'&pass='+password,
            beforeSend: function () {
                $('.submitBtn').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success:function(msg){
                if(msg == 'ok'){
                    $('#inputName').val('');
                    $('#inputEmail').val('');
                    $('#inputMessage').val('');
                    $('.statusMsg').html('<span style="color:green;">Thanks for contacting us, we\'ll get back to you soon.</p>');
                }else{
                    $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
                }
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
    }
}
</script>