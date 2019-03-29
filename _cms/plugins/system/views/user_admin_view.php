<?php 

global $info;

$form_json = $info->form();
$form_d = new FormDesign($form_json);
?>

<div class="main-page bootstrap snippet">
	<div class="row">
		<div class="col-sm-3">
			<a class="btn btn-secondary" href="<?php echo $website->options->admin_path; ?>users/">
				<i class="fa fa-hand-o-left fa-2x" aria-hidden="true"></i>
			</a>
		</div>
		<div class="col-sm-5">
			<h3>
				<?php echo "{$info->names} {$info->surname} {$info->second_surname}"; ?>
			</h3>
		</div>
		<div class="col-sm-4">
			<h1 class="pull-right"><?php echo strtoupper($info->username); ?></h1>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-3">
			<div class="text-center">
				<img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
				<h6>Sube una foto diferente ...</h6>
				<hr>
				<input type="file" class="text-center center-block file-upload" />
			</div>
			</hr>
			<br>
			
			
			<!-- //
			<div class="panel panel-default">
				<div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>
				<div class="panel-body"><a href="http://bootnipets.com">bootnipets.com</a></div>
			</div>
			-->
			
			<!-- //
			<ul class="list-group">
				<li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
			</ul>
			-->
			
			<!-- //
			<div class="panel panel-default">
				<div class="panel-heading">Social Media</div>
				<div class="panel-body">
					<i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
				</div>
			</div>
			-->
		</div>
		
		<div class="col-sm-9">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
				<li role="presentation"><a href="#menu_1" aria-controls="menu_1" role="tab" data-toggle="tab">Menu 1</a></li>
				<li role="presentation"><a href="#menu_2" aria-controls="menu_2" role="tab" data-toggle="tab">Menu 2</a></li>
			</ul>
			
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="home">
					<form class="form" action="" method="post" id="update-user">
						<?php 
							echo $form_d->get_html();
						?>
					
						<div class="form-group">
							<div class="col-xs-12">
								<br>
								<button name="form-userData" value="true" class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Guardar</button>
								<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reiniciar</button>
							</div>
						</div>
					</form>
					<hr>
				</div>
				<div role="tabpanel" class="tab-pane" id="menu_1">
					<h2></h2>
					<hr>
					<form class="form" action="##" method="post" id="registrationForm">
						<div class="form-group">
							<div class="col-xs-6">
								<label for="mobile"><h4>Mobile</h4></label>
								<input type="text" class="form-control" name="mobile" id="mobile" placeholder="enter mobile number" title="enter your mobile number if any.">
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-6">
								<label for="email"><h4>Email</h4></label>
								<input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email.">
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-6">
								<label for="email"><h4>Location</h4></label>
								<input type="email" class="form-control" id="location" placeholder="somewhere" title="enter a location">
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-6">
								<label for="password"><h4>Password</h4></label>
								<input type="password" class="form-control" name="password" id="password" placeholder="password" title="enter your password.">
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-6">
								<label for="password2"><h4>Verify</h4></label>
								<input type="password" class="form-control" name="password2" id="password2" placeholder="password2" title="enter your password2.">
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-12">
								<br>
								<button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
								<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
							</div>
						</div>
					</form>
				</div>
				<div role="tabpanel" class="tab-pane" id="menu_2">
					<hr>
					<form class="form" action="##" method="post" id="registrationForm">
						<div class="form-group">
							<div class="col-xs-6">
								<label for="first_name"><h4>First name</h4></label>
								<input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name" title="enter your first name if any.">
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-6">
								<label for="last_name"><h4>Last name</h4></label>
								<input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" title="enter your last name if any.">
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-6">
								<label for="phone"><h4>Phone</h4></label>
								<input type="text" class="form-control" name="phone" id="phone" placeholder="enter phone" title="enter your phone number if any.">
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-6">
								<label for="mobile"><h4>Mobile</h4></label>
								<input type="text" class="form-control" name="mobile" id="mobile" placeholder="enter mobile number" title="enter your mobile number if any.">
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-6">
								<label for="email"><h4>Email</h4></label>
								<input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email.">
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-6">
								<label for="email"><h4>Location</h4></label>
								<input type="email" class="form-control" id="location" placeholder="somewhere" title="enter a location">
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-12">
								<br>
								<button class="btn btn-lg btn-success pull-right" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
								<!--<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>-->
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
/*
$(document).ready(function() {
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.avatar').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on('change', function(){
        readURL(this);
    });
});
*/
</script>
