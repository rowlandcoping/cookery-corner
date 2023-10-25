<body>

<div style="width: 40%; margin: 20px auto;">
		
			<h2>Reset Password</h2>
			<h3><span style="color:red"><?php if (!empty($errormess)) {echo "!--- ".$errormess." ---!";}?></span></h3>
			
			<p>Use this form to request password reset e-mail:</p>
			<hr>
			<form method="post" action="/passwordreset" >
			e-mail address: <input type="text" name="email" placeholder="Enter your e-mail address">
			</p>
			
			<p><button type="submit" class="btn" name="reset-request">Request Reset</button></p>
		</form>
		
		
		<p><a href="/index.php">Back to Homepage</a></p>
</div>

</body>
