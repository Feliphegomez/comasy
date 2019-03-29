<?php 
$website->get_controller_plugin('system', 'login');
if($website->isUser() == false)
{
	?>
	<div class="main-page login-page ">
		<h2 class="title1">Iniciar sesión</h2>
		<div class="widget-shadow">
			<div class="login-body">
				<form action="#" method="post">
					<input type="text" class="user" name="inputNickLogin" placeholder="Enter Your Email" required="">
					<input type="password" name="inputPasswordLogin" class="lock" placeholder="Password" required="">
					<div class="forgot-grid">
						<label class="checkbox">
							<input type="checkbox" name="checkbox" checked=""><i></i>Recordar cuenta</label>
						<div class="forgot">
							<a href="#">¿Se te olvidó tu contraseña?</a>
						</div>
						<div class="clearfix"> </div>
					</div>
					<input type="submit" name="submit_login" value="Iniciar">
					<div class="registration">
						¿No tienes una cuenta?
						<a class="" href="signup.html">
							Crea una cuenta
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php 
}
